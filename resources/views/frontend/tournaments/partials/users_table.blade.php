<table class="table table-striped table-hover text-light" style="margin:auto">
    <thead>
    <tr>
        <th style="width: 50px">No.</th>
        <th style="width: 200px">Username</th>
        <th style="width: 200px">Total Win</th>
    </tr>
    @foreach ($tournament->users as $position => $user)
        @if ($user->pivot->total_win > $user->pivot->total_lose)
            <tr>
                <td>{{ $position + 1 }}</td>
                <td>@include('frontend.partials.username', ['user' => $user])</td>
                <td><span class="money-earned">
                        <i class="fas fa-coins"></i>
                        {{--<img src="{{ asset('img/altcoin.png') }}" />--}}
                        {{ number_format($user->pivot->total_win - $user->pivot->total_lose, 2) }}</span></td>
            </tr>
        @endif
    @endforeach
    </thead>
</table>