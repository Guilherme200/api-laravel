<?php

namespace App\Domain\Shared\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(string $message): JsonResponse
    {
        return response()->json(['error' => $message], 404);
    }
}
