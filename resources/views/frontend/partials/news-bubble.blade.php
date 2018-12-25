@inject('bannersService', "Models\Banners\BannersService")

<div id="news-bubble" data-set-cookie-route="{{ route('cookies.set_read_news') }}" data-count-news-route="{{ route('cookies.count_unread_news') }}">
    <div class="news-circle">
        <span class="news-notification">0</span>
        <i class="fas fa-newspaper"></i>
    </div>

    <div class="news-list">
        <ul>
            @forelse ($bannersService->getLatestHeaderNews(5) as $news)
                <li data-news-id="{{ $news->id }}">
                    <a title="{{ $news->name }}" href="{{ route('news.details', ['news' => $news]) }}">{{ mb_strimwidth($news->name . 'asdasdasdasd asd sad asd as', 0, 30, '...') }}</a>
                    <br>
                    <small><i class="fas fa-calendar-alt"></i> {{ $news->date_from->format('F j, Y, g:i a') }}</small>
                </li>
            @empty
                <li>No news to show at the moment.</li>
            @endforelse
        </ul>
    </div>
</div>