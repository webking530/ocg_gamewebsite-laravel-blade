@extends('frontend.layout.app')

@section('meta')
    <title>{{ $news->name }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ $news->keywords }}" />
    <meta name="description" content="{{ $news->content }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">{{ $news->name }}</h1>
                </div>
            </div>

            <article class="blog-post">
                <div class="col-md-12">
                    <div class="post-infos mb-xl">
                        <span class="info like">
                            <i class="fas fa-calendar-alt"></i> Post Date:
                            <span class="like-number font-weight-semibold custom-color-dark">
                                {{ $news->created_at->format('l, F j, Y, g:i a') }}
                            </span>
                        </span>
                    </div>

                    <hr class="solid">

                    <div class="text-light">
                        {!! $news->content !!}
                    </div>

                </div>
            </article>
        </div>
    </div>
@endsection

@section('scripts')

@endsection