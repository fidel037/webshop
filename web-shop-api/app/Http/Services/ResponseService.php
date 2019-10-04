<?php

namespace App\Http\Services;

/**
 * ResponseService
 */
class ResponseService
{
    public static function make($success, $message, $data = [], $status = 200)
    {
        if (empty($success) && $success !== false) {
            throw new \Exception("ResponseService not provided with all args", 500);
        }
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];
    }
}
