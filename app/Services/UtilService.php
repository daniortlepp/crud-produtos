<?php

namespace App\Services;

class UtilService
{
    public function __construct() {}

    public function getJSONReturn($status, $message, $data, $code) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

}
