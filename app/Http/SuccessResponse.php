<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class SuccessResponse extends JsonResponse
{
    /**
     * SuccessResponse constructor.
     * @param string $message
     * @param $data
     * @param int $status
     * @param array $headers
     * @param int $options
     */
    public function __construct($message = '', $data = null, $status = 200, $headers = [], $options = 0)
    {
        $body = [
            'message' => $message,
            'data' => $data
        ];

        parent::__construct($body, $status, $headers, $options);
    }
}