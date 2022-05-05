<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test()
    {
        return response()->json([
            'status' => true,
            'message' => 'BusOperator Test Api Works successfully',
        ], 200);
    }
}
