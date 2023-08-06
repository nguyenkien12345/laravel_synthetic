<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoogleCalendarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:1024'],
            'priority' => ['required', 'integer'],
            'start_date' => ['required', 'after_or_equal:today'],
            'end_date' => ['required', 'after_or_equal:start_date'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'integer' => ':attribute must be number',
            'min' => 'Min length of :attribute is :min',
            'max' => 'Max length of :attribute is :max',
            'start_date.after_or_equal' => 'Start Date must be greater than or equal to Today',
            'end_date.after_or_equal' => 'End Date must be greater than or equal to Start Day',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'priority' => 'Priority',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }
}
