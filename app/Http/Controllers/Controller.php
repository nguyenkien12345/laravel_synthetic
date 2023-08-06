<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sentResponse($data = null, $status = true, $message = ''){
        return \response()->json([
            'status' => $status,
            'message' => $message,
            'time' => date("d/m/Y h:i:s"),
            'data' => $data,
        ]);
    }
}
