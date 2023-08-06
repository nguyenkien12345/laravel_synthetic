<?php

namespace App\Http\Controllers;

use App\Constants\Common;
use App\Http\Resources\GoogleCalendarResource;
use App\Http\Requests\GoogleCalendarRequest;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class GoogleCalendarController extends Controller
{
    private $googleCalendarService;

    public function __construct() {
        $this->googleCalendarService = new GoogleCalendarService();
    }

    public function index(){
        try {
            $bookings = $this->googleCalendarService->getAllEvent();
            $priorities = Common::PRIORITY;
            return view('google-calendar.index', compact('bookings', 'priorities'));
        }
        catch (\Exception $e) {
            return $this->sentResponse($e, false, $e->getMessage());
        }
    }

    public function addBooking(GoogleCalendarRequest $request){
      try {
        $data = $request->only(['title', 'notes', 'priority','start_date', 'end_date']);
        $result = $this->googleCalendarService->addEvent($data);
        return $this->sentResponse(new GoogleCalendarResource($result), true, 'Success');
      }
      catch (\Exception $e) {
        return $this->sentResponse($e, false, $e->getMessage());
      }
    }

    public function deleteBooking($id) {
        try {
            $data = $this->googleCalendarService->deleteEvent($id);
            $result = [
                'id' => $id,
                'data' => $data,
            ];
            return $this->sentResponse($result, true, 'Success');
        }
        catch (\Exception $e) {
            return $this->sentResponse($e, false, $e->getMessage());
        }
    }
}
