<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Send a success response
     *
     * @param  string  $message
     * @param  mixed  $data
     * @param  int  $code HTTP status code
     * @return JsonResponse | Response
     */
    protected function successResponse(string $message = "", mixed $data = "", int $code = 200): JsonResponse|Response
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Send an error responsse
     *
     * @param  array $data
     * @param  int  $code HTTP status code
     * @return JsonResponse | Response
     */
    protected function errorResponse(string $message = "", mixed $data = "", int $code = 400): JsonResponse|Response
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $data,
        ], $code);
    }
}
