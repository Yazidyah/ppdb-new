<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JalurService;
use Illuminate\Support\Facades\Log;

class JalurController extends Controller
{
    public function validateRegisterJalur(Request $request, JalurService $service)
    {
        $data = $request->validate([
            'jalur_id' => 'required|integer',
        ]);

        try {
            $service->assertJalurOpen((int)$data['jalur_id']);
        } catch (\RuntimeException $e) {
            Log::warning('Register blocked: jalur closed', [
                'jalur_id' => $data['jalur_id'],
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'status' => 'error',
                'code' => 'JALUR_CLOSED',
                'message' => 'Mohon maaf, jalur yang dipilih sedang ditutup.',
            ], 422);
        }

        // Proceed with further registration steps handled elsewhere
        return response()->json([
            'status' => 'ok',
        ]);
    }
}
