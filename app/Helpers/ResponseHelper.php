<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class ResponseHelper
{
    public static function responseFormat($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
