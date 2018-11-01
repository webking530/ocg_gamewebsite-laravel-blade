
// Edit game Settings Start
var container = document.getElementById('jsoneditor');
var options = {
    mode: 'tree',
//    modes: ['code', 'form', 'text', 'tree', 'view'] // allowed modes
};
if (json == 'null') {
    json = {};
}
var settingsjson = new Array();
settingsjson = JSON.parse(json);
var editor = new JSONEditor(container, options, settingsjson);
editor.expandAll();

$('.submitJson').click(function (e) {
    var settings = editor.get();
    $('.settings').val(JSON.stringify(settings));
    $('.submitJsonForm').submit();
});

// Edit game Settings End