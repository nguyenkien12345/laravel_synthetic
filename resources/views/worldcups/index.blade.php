@extends('layouts.home')

@section('content')
<div class="container">

    @foreach ($groups as $group)
    <h3 class="center"> <b>{{$group->name}}</b> </h3>
    <table class="centered">
        <thead>
            <tr>
                <th>Team</th>
                <th>Matches played</th>
                <th>Won</th>
                <th>Draw</th>
                <th>Lost</th>
                <th>Goals for</th>
                <th>Goals against</th>
                <th>Goals difference</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group->teams as $team)
            <tr>
                <td>{{$team->name}}</td>
                <td>{{$team->matches_played}}</td>
                <td>{{$team->won}}</td>
                <td>{{$team->draw}}</td>
                <td>{{$team->lost}}</td>
                <td>{{$team->goals_for}}</td>
                <td>{{$team->goals_against}}</td>
                <td>{{$team->goals_difference}}</td>
                <td>{{$team->points}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

</div>
@endsection
