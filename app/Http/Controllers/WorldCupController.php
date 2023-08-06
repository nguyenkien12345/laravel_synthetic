<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTeamWorldCupRequest;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Http\Request;

class WorldCupController extends Controller
{
    public function index()
    {
        // Lấy ra toàn bộ các bảng đấu kèm theo các câu lạc bộ của bảng đấu đó và sắp xếp giảm dần theo điểm, hiệu số bàn thắng bại
        $groups = Group::with(['teams' => function ($query) {
            $query->orderByRaw('(won * 3) + (draw * 1)')->orderByRaw('goals_for - goals_against');
        }])->orderBy('name')->get();
        // Trong function là đang sử dụng data của bảng team để truy vấn
        // Còn ngoài function là đang dùng data của bảng group để truy vấn
        return view('worldcups.index', compact('groups'));
    }

    public function edit(Team $team)
    {
        return view('worldcups.edit', compact('team'));
    }

    public function update(UpdateTeamWorldCupRequest $request, Team $team)
    {
        $team->update($request->safe()->except('matches_played'));
    }
}
