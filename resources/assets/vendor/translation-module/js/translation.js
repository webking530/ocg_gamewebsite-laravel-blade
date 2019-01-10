"use strict";

class Overlay {
    constructor(params) {
        this.source_language = params.source_language;
        this.target_language = params.target_language;
        this.save_translation_route = params.save_translation_route;
        this.get_page_translations_route = params.get_page_translations_route;
        this.get_orphan_translations_route = params.get_orphan_translations_route;

        this.htmlStruct =
            `<div id="to-container" title="Strings Available to Translate">
                <div class="to-text-center to-mb-15">
                    <button id="to-show-page-trans" class="ui-button ui-widget ui-corner-all">This page translations</button>
                    <button id="to-show-orphan-trans" class="ui-button ui-widget ui-corner-all">All orphaned translations</button>
                </div>
        
                <div class="to-text-center to-mb-10 to-languages">
                    <small>
                        <span>Translation Progress</span>
                        <span>Source Language: <strong id="to-source-lang">${this.source_language}</strong></span>
                        <span>Target Language: <strong id="to-target-lang">${this.target_language}</strong></span>
                    </small>
                </div>
        
                <div class="ui-progressbar to-mb-15"><div class="ui-progress-label"></div></div>
                
                <p class="to-text-center to-mb-5"><small>Approximate word count: <strong id="to-word-count"></strong></small></p>
        
                <p class="to-text-center"><small>&#9432; Translations will be autosaved when navigating out of each field</small></p>
        
                <hr class="to-divider">
        
                <div class="to-strings"></div>
            </div>`;

        this.$body = $('body');
        this.$body.append(this.htmlStruct);

        this.$overlayContainer = $( "#to-container" );

        this.$showPageTranslations = $('#to-show-page-trans');
        this.$showOrphanTranslations = $('#to-show-orphan-trans');

        this.$wordCount = $('#to-word-count');

        this.$stringsContainer = $('.to-strings');

        this.$progressBar = $(".ui-progressbar");
        this.$progressBarLabel = $(".ui-progress-label");
        this.progress = 0;
        this.words = 0;

        this.$pageTransElems = $('[data-trans]');

        this.init();
    }

    init() {
        $.post(this.get_page_translations_route, {
            source_language: this.source_language,
            target_language: this.target_language,
            keys: this.$pageTransElems.map(function() { return $(this).data('trans'); }).toArray()
        }, (response) => {
            this.progress = response.progress;
            this.words = response.words;

            this.initUI();
            this.initEvents();
            this.initList(response.translations);
            this.updateCurrentPageElements(response.translations);
        });
    }

    initUI() {
        this.$overlayContainer.dialog({
            minWidth: 500
        });

        this.updateProgress();
        this.$wordCount.html(this.words);
    }

    updateProgress() {
        this.$progressBar.progressbar({value: this.progress});
        this.$progressBarLabel.html(`${this.progress}`);
    }

    initList(translationElements) {
        this.$stringsContainer.html('');

        $.each(translationElements, (k, obj) => {
            const elem =
                `<div data-highlight-target="${obj.key}">
                    <textarea title="${obj.key}" class="to-${obj.status}" id="${obj.key}">${obj.value}</textarea>
                    <span class="to-loading-gif"></span>
                </div>`;

            this.$stringsContainer.append(elem);
        });
    }

    updateCurrentPageElements(translationElements) {
        $.each(translationElements, (k, obj) => {
            if (obj.status === 'done') {
                this.setValueForObject($(`[data-trans="${obj.key}"]`), obj.value);
            }
        });
    }

    initEvents() {
        const self = this;

        this.$stringsContainer.on('focus', '[data-highlight-target]', function() {
            const highlightTarget = $(this).data('highlight-target');
            const targetElem = $(`[data-trans="${highlightTarget}"]`);

            self.removeMask();

            if (targetElem.length > 0) {
                self.createMask(targetElem);
                self.focusElement(targetElem);

                self.$overlayContainer.dialog("widget").position({
                    my: 'left-10 bottom-10',
                    at: 'right+20',
                    of: targetElem
                });
            }
        });

        this.$stringsContainer.on('blur', 'textarea', function() {
            self.removeMask();

            if ($(this).data('save') === '1') {
                $(this).siblings('span.to-loading-gif').css('opacity', '1');

                const data = {
                    source_language: self.source_language,
                    target_language: self.target_language,
                    key: $(this).attr('id'),
                    value: $(this).val()
                };

                $.post(self.save_translation_route, data, (response) => {
                    if (response.status === 'success') {
                        $(this).data('save', '0');
                        $(this).siblings('span.to-loading-gif').css('opacity', '0');
                        $(this).removeClass('to-pending');
                        $(this).addClass('to-done');

                        self.progress = response.progress;
                        self.updateProgress();
                    } else {
                        alert(`ERROR: ${response.msg}`);
                    }
                });
            }
        });

        this.$stringsContainer.on('keyup', 'textarea', function(event) {
            // Ignore the TAB key
            if ((event.keyCode || event.which) !== 9) {
                $(this).data('save', '1');
            }


            const target = $(this).attr('id');
            let object = $(`[data-trans="${target}"]`);
            const value = $(this).val();

            if (object.is('input[type="submit"]')) {
                object.val(value);
            } else if (object.is('input')) {
                object.attr('placeholder', value);
            } else {
                object.html(value);
            }

            const box = self.getElementBoundingBox(object);
            const highlightElem = self.getMask();

            highlightElem.css('left', `${box.x}px`);
            highlightElem.css('top', `${box.y}px`);
            highlightElem.css('width', `${box.w}px`);
            highlightElem.css('height', `${box.h}px`);
        });

        this.$showPageTranslations.on('click', () => {
            $.post(this.get_page_translations_route, {
                source_language: this.source_language,
                target_language: this.target_language,
                keys: this.$pageTransElems.map(function() { return $(this).data('trans'); }).toArray()
            }, (response) => {
                this.progress = response.progress;
                this.words = response.words;

                this.initList(response.translations);
                this.updateCurrentPageElements(response.translations);
                this.updateProgress();
            });
        });

        this.$showOrphanTranslations.on('click', () => {
            $.post(this.get_orphan_translations_route, {
                source_language: this.source_language,
                target_language: this.target_language
            }, (response) => {
                this.progress = response.progress;
                this.words = response.words;

                this.initList(response.translations);
                this.updateCurrentPageElements(response.translations);
                this.updateProgress();
            });
        });
    }

    getMask() {
        return $('.to-mask');
    }

    removeMask() {
        $('.to-mask').remove();
    }

    getElementBoundingBox(element) {
        const x = element.offset().left - 5;
        const y = element.offset().top - 5;
        const w = element.width() + parseInt(element.css('padding-left')) + parseInt(element.css('padding-right')) + 10;
        const h = element.height() + parseInt(element.css('padding-top')) + parseInt(element.css('padding-bottom')) + 10;

        return {
            x, y, w, h
        }
    }

    createMask(targetElem) {
        const x = targetElem.offset().left - 5;
        const y = targetElem.offset().top - 5;
        const w = targetElem.width() + parseInt(targetElem.css('padding-left')) + parseInt(targetElem.css('padding-right')) + 10;
        const h = targetElem.height() + parseInt(targetElem.css('padding-top')) + parseInt(targetElem.css('padding-bottom')) + 10;

        const highlightElem = $('<div class="to-mask"></div>');

        highlightElem.css('left', `${x}px`);
        highlightElem.css('top', `${y}px`);
        highlightElem.css('width', `${w}px`);
        highlightElem.css('height', `${h}px`);

        this.$body.append(highlightElem);
    }

    getValueFromObject(object) {
        if (object.is('input[type="submit"]')) {
            return object.val()
        }

        if (object.is('input')) {
            return object.attr('placeholder')
        }

        return object.html();
    }

    setValueForObject(object, value) {
        $.each(object, (k, obj) => {
            if (object.is('input[type="submit"]')) {
                object.val(value);
                return true;
            }

            if (object.is('input')) {
                object.attr('placeholder', value);
                return true;
            }

            object.html(value);
            return true;
        });
    }

    focusElement(element) {
        $('html, body').stop().animate({
            'scrollTop': element.offset().top - 80
        }, 500, 'swing');
    }
}

/*$(document).ready(function() {
    new Overlay({
        source_language: 'en',
        target_language: 'es',
        save_translation_route: 'temporal',
        get_page_translations_route: 'temporal',
        get_orphan_translations_route: 'temporal'
    });
});*/