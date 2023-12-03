<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $transaction = Transaction::with(['user', 'service', 'city', 'subdistrict', 'province', 'district'])->findOrFail($id);
        return response()->json($transaction);
    }
}
