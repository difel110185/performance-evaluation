<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class ErrorResponse extends JsonResponse
{
    /**
     * ErrorResponse constructor.
     * @param \Exception $exception
     * @param int $status
     * @param array $headers
     * @param int $options
     * @internal param string $message
     * @internal param $data
     */
    public function __construct(\Exception $exception, $status = 500, $headers = [], $options = 0)
    {
        $body = [
            'message' => $exception->getMessage(),
            'data' => null
        ];

        parent::__construct($body, $status, $headers, $options);
    }
}