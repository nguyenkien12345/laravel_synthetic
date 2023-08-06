<?php

namespace App\Http\Requests;

use App\Enums\PollStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePollRequest extends FormRequest
{

    public function authorize()
    {
        // Chắc chắn đây là người tạo ra poll mới được phép chỉnh sửa thông qua relationship created_by
        return auth()->user()->is($this->poll->user) && $this->poll->status === PollStatus::PENDING->value;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'created_by' => auth()->id(),
            'start_at' => Carbon::parse($this->start_date . $this->start_time)->toDateTimeString(),
            'end_at' =>  Carbon::parse($this->end_date . $this->end_time)->toDateTimeString(),
        ]);
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'start_at' => ['required', 'date', 'after_or_equal:now'],
            'end_at' => ['required', 'date', 'after:start_at'],
            // Trong Model poll có thuộc tính options nên ta vẫn hoàn toàn có thể validate field này
            'options' => ['required', 'array', 'min:2']
        ];
    }
}
