<table class="table table-striped table-hover text-light" style="margin:auto">
    <thead>
    <tr>
        <th style="width: 50px">No.</th>
        <th style="width: 200px">Username</th>
        <th style="width: 200px">Total Win</th>
    </tr>
    @foreach ($tournament->users as $position => $user)
        <tr>
            <td>{{ $position + 1 }}</td>
            <td>@include('frontend.partials.username', ['user' => $user])</td>
            <td><span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($user->pivot->total_win, 2) }}</span></td>
        </tr>
    @endforeach
    </thead>
</table>