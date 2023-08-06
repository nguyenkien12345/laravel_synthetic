<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DateTimeResource;
use App\Helpers\Common;

class GoogleCalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $color = Common::getColorPriority($this->priority);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'priority' => $this->priority,
            'notes' => $this->notes,
            'status' => $this->status,
            'start' => $this->start_date,
            'end' => $this->end_date,
            'color' => $color,
            // 'created_at' => DateTimeResource::make($this->created_at),
            // 'updated_at' => DateTimeResource::make($this->updated_at)
        ];
    }
}
