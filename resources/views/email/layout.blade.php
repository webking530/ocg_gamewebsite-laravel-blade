<div style="background:#333;padding:15px">
    <div style="width:450px;margin:auto;background:white;padding:10px;text-align:center">
        <img src="{{ asset('img/logo.png') }}" alt="{{ trans('app.meta.title') }}" width="200"/>
    </div>

    <div style="width:450px;margin:auto;background:#333;padding:10px;color:white">
        @yield('content')

        <br>
        <p>{!! trans('emails.email_footer') !!}</p>
    </div>

    <div style="width:450px;margin:auto;background:#333;padding:10px;text-align:center;color:white">
        <hr>
        <p><em>{{ trans('emails.email_automatic') }}</em></p>
        <p>
            <a style="color:#85a8e6" target="_blank" href="{{ route('home.terms') }}">{{ trans('legal.terms_conditions.title') }}</a> |
            <a style="color:#85a8e6" target="_blank" href="{{ route('home.policy') }}">{{ trans('legal.privacy_policy.title') }}</a>
        </p>
        <p>
            <a style="color:#85a8e6" href="{{ route('home') }}">{{ trans('app.meta.short_title') }}</a> |
            <a style="color:#85a8e6" href="https://plus.google.com/u/0/101876203649115488412">Google+</a> |
            <a style="color:#85a8e6" href="https://twitter.com/OCGcasino">Twitter</a> |
            <a style="color:#85a8e6" href="https://www.facebook.com/OCGcasino">Facebook</a> |
            <a style="color:#85a8e6" href="https://www.instagram.com/ocgcasino/">Instagram</a>
        </p>
        <p>{{ trans('app.copyright_footer', ['date' => date('Y')]) }}</p>
    </div>
</div>