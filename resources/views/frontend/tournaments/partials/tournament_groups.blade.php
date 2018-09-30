@inject('gameService', "Models\Gaming\GameService")

<div class="col-md-4">
    <div class="featured-box featured-box-primary align-left mt-xlg">
        <div class="box-content">
            <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-trophy"></i> {{ trans('frontend/tournaments.meta.title') }}</h4>
            <hr>

            <div class="list-group list-group-dark">
                @foreach ($gameService->getGroupsList() as $groupIndex => $name)
                    <a href="{{ route('tournaments.history', ['group' => $groupIndex]) }}" class="list-group-item @if ($group !== null && $group == $groupIndex) active @endif">{{ mb_strtoupper($name) }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>