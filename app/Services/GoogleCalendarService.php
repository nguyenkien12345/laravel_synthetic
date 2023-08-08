<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\Common;

class GoogleCalendarService
{

    public function getAllEvent(){
            $data = [];

            $events = Event::where('status', true)->get();

            foreach($events as $event){
                $color = Common::getColorPriority($event->priority);
                $data[] = [
                    'id' => $event->id,
                    'title' => $event->title,
                    'priority' => $event->priority,
                    'start' => $event->start_date,
                    'end' => $event->end_date,
                    'color' => $color,
                    // Ngoài color là màu nền ra ta còn một vài thuộc tính khác như textColor, borderColor (áp dụng cho các event)
                    'image' => 'https://meliawedding.com.vn/wp-content/uploads/2022/05/hinh-nen-gai-xinh-8-1.jpg',
                ];
            }

            return $data;
    }

    public function getDetailEvent($id){
        $result = Event::findOrFail($id);
        return $result;
    }

    public function addEvent($data){
        $result = Event::create($data);
        return $result;
    }

    public function deleteEvent($id){
        $result = Event::find($id);
        if(!$result) return null;
        $data = $result->delete();
        return $data;
    }
}
