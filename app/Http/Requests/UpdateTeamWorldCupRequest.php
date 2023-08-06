<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamWorldCupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'matches_played' => $this->won + $this->draw + $this->lost
        ]);
    }

    public function rules()
    {
        return [
            'won' => ['required', 'integer', 'between:0,3'],                // Số trận thắng
            'draw' => ['required', 'integer', 'between:0,3'],               // Số trận hòa
            'lost' => ['required', 'integer', 'between:0,3'],               // Số trận thua
            'goals_for' => ['required', 'integer'],                         // Số bàn thắng ghi được
            'goals_against' => ['required', 'integer'],                     // Số bàn thua phải nhận
            'matches_played' => ['required', 'integer', 'between:0,3'],     // Số trận đã thi đấu
        ];
    }
}
