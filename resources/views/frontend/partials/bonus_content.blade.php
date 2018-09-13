<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center mb-xl recent-posts">
                <h2 class="mb-lg mt-md">Available <strong>Bonuses</strong></h2>

                <div class="owl-carousel owl-theme mb-none" data-plugin-options="{'items': 1, 'autoplay': true, 'autoplayTimeout': 5000}">
                    @foreach ($bannersService->getBonusContent() as $chunk)
                        <div>
                            @foreach ($chunk as $bonus)
                                <div class="col-md-4">
                                    <article>
                                        <div class="date mb-xlg">
                                            <i class="{{ $bonus->icon }} bonus-icon"></i>
                                        </div>
                                        <h4 class="heading-primary text-left alternative-font"><a href="{{ route('home.bonuses') }}">{{ $bonus->name}}</a></h4>
                                        <p class="text-left text-light">{{ $bonus->description }}</p>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
