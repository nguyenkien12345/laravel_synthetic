@extends('layouts.home')

@section('content')
<div class="container">

    <h1 class="center"> {{$team->name}} </h1>

    <div class="row">
        <form class="col s12 m12 xl12" method="post" action="{{route('world-cup.team.update', [$team])}}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="input-field col s12 m12 xl12">
                    <input id="won" type="text" name="won" value="{{$team->won}}">
                    <label for="won">Won</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input id="lost" type="tel" name="draw" value="{{$team->draw}}">
                    <label for="draw">Draw</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input id="lost" type="tel" name="lost" value="{{$team->lost}}">
                    <label for="lost">Lost</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input id="goals_for" type="tel" name="goals_for" value="{{$team->goals_for}}">
                    <label for="goals_for">Goals For</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input id="goals_against" type="tel" name="goals_against" value="{{$team->goals_against}}">
                    <label for="goals_against">Goals Against</label>
                </div>
            </div>

            <div class="center">
                <button class="btn waves-effect waves-light" type="submit" name="action">update</button>
            </div>
        </form>
    </div>

</div>
@endsection
