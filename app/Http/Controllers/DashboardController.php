<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $success = Transaction::where('transaction_status', 'SUCCESS')
      ->whereHas('user', function ($user) {
        $user->where('user_id', Auth::user()->id);
      });
    $process = Transaction::where('transaction_status', 'PROCESS')
      ->whereHas('user', function ($user) {
        $user->where('user_id', Auth::user()->id);
      });
    $pending = Transaction::where('transaction_status', 'PENDING')
      ->whereHas('user', function ($user) {
        $user->where('user_id', Auth::user()->id);
      });
    $cancel = Transaction::where('transaction_status', 'CANCELED')
      ->whereHas('user', function ($user) {
        $user->where('user_id', Auth::user()->id);
      });

    return view('pages.dashboard-home', [
      'success' => $success->count(),
      'process' => $process->count(),
      'pending' => $pending->count(),
      'cancel' => $cancel->count(),
    ]);
  }
}
