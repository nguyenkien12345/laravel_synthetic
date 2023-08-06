<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class AutoCompleteSearchController extends Controller
{
    public function index()
    {
        return view('auto-complete-search.index');
    }

    public function listTeam(Request $request)
    {
        $data = Team::select('name')
        ->where('name', 'LIKE', '%' . $request->search . '%')
        ->get();

        return response()->json($data);
    }
}
