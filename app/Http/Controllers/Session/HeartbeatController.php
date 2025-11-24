<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HeartbeatController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->timestamp,
        ]);
    }
}

