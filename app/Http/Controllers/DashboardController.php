<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
      $transaction = Transaction::get();
      $transaction_count = $transaction->count();
        $transaction_pending = $transaction->where('transaction_status', 'PENDING')->count();
        $transaction_success = $transaction->where('transaction_status', 'SUCCESS')->count();
        $transaction_failed = $transaction->where('transaction_status', 'CANCELED')->count();
        $transaction_process = $transaction->where('transaction_status', 'PROCESS')->count();
    return view('pages.dashboard-home', [
        'transaction_count' => $transaction_count,
        'transaction_pending' => $transaction_pending,
        'transaction_success' => $transaction_success,
        'transaction_failed' => $transaction_failed,
        'transaction_process' => $transaction_process
    ]);
  }
}
