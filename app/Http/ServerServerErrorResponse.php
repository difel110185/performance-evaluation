<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class ServerErrorResponse extends JsonResponse
{
    /**
     * ErrorResponse constructor.
     * @param \Exception $exception
     * @param null $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @internal param string $message
     * @internal param $data
     */
    public function __construct(\Exception $exception, $data = null, $status = 500, $headers = [], $options = 0)
    {
        $body = [
            'message' => $exception->getMessage(),
            'data' => $data
        ];

        parent::__construct($body, $status, $headers, $options);
    }
}