@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="featured-boxes mt-none mb-none">
                    <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                        <div class="box-content">
                            <h1 class="mb-lg text-blue text-center">Create Tournament for {{ $tournament->formattedGroup }}</h1>
                            <hr>

                            {{ Form::open(['route' => 'tournament.store','class'=>'form-horizontal']) }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Games</label>

                                <div class="col-md-6">
                                    <select name="game[]" multiple="true" class="form-control">
                                        @foreach($games as $game)                    
                                        <option value="{{ $game->id }}">{{ $game->getNameAttribute() }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-4 control-label">Level</label>
                                <div class="col-md-6">
                                    <select name="level"  class="form-control">
                                        @for($i=1;$i<=6;$i++)                    
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>



                            <input type="hidden" name="group" value="{{ $tournament->group }}">

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
</script>
@endsection
