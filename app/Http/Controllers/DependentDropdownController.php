<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DependentDropdownController extends Controller
{
    public function getCountries(){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'api-token' => 'nEog23QmNaF-bN1CvcHFSkFPu9KvGUJamwtYFZLbxC-klCNDSdTixxXa2-1SWBhO2pc',
            'user-email' => 'liverpoolkien911@gmail.com'
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $token = json_decode($response->body(), true)['auth_token'];

        $countries = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->get('https://www.universal-tutorial.com/api/countries/');

        $countries = json_decode($countries->body(), true);

        return view('dependent-dropdown.index', ['token' => $token, 'countries' => $countries]);
    }

    public function getStates(Request $request){
        $states = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->token
        ])->get('https://www.universal-tutorial.com/api/states/' . $request->country);

        $states = json_decode($states->body(), true);

        return $states;
    }

    public function getCities(Request $request){
        $cities = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->token
        ])->get('https://www.universal-tutorial.com/api/cities/' . $request->state);

        $cities = json_decode($cities->body(), true);

        return $cities;
    }
}
