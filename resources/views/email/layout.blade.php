<div style="background:#f3f3f3;padding:15px">
    <div style="width:450px;margin:auto;background:white;padding:10px;text-align:center">
        <img src="{{ asset('img/logo.png') }}" alt="{{ trans('app.meta.title') }}" width="400"/>
    </div>

    <div style="width:450px;margin:auto;background:white;padding:10px">
        @yield('content')

        <br>
        <p>{{ trans('emails.email_footer') }}</p>
    </div>

    <div style="width:450px;margin:auto;background:white;padding:10px;text-align:center">
        <hr>
        <p><em>{{ trans('emails.email_automatic') }}</em></p>
        <p><a target="_blank" href="{{ route('home.terms') }}">{{ trans('legal.terms_conditions.title') }}</a> | <a target="_blank" href="{{ route('home.policy') }}">{{ trans('legal.privacy_policy.title') }}</a></p>
        <p><a href="{{ route('home') }}">{{ trans('app.meta.short_title') }}</a> |
            <a href="https://plus.google.com/u/0/101876203649115488412">Google+</a> |
            <a href="https://twitter.com/OCGcasino">Twitter</a> |
            <a href="https://www.facebook.com/OCGcasino">Facebook</a> |
            <a href="https://www.instagram.com/ocgcasino/">Instagram</a>
        </p>
        <p>{{ trans('app.copyright_footer', ['date' => date('Y')]) }}</p>
    </div>
</div>