<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardTransactionController extends Controller
{
  public function index()
  {
    $transactions = Transaction::with(['user', 'service'])
      ->where('user_id', Auth::user()->id)
      ->latest()
      ->get();
    return view('pages.dashboard-transaksi', [
      'transactions' => $transactions
    ]);
  }

  public function edit(Transaction $transaction)
  {
    return view('pages.dashboard-transaksi-detail', [
      'item' => $transaction
    ]);
  }

  public function update(Request $request, Transaction $transaction)
  {
    $data = $request->validate([
      'payment_confirmation' => 'required|image|file'
    ]);

    if ($request->file('payment_confirmation')) {
      if ($transaction->payment_confirmation) {
        Storage::delete($transaction->payment_confirmation);
      }
      $data['payment_confirmation'] = $request->file('payment_confirmation')->store('payment_confirmations');
    };

    Transaction::where('id', $transaction->id)->update($data);
    Transaction::where('id', $transaction->id)->update([
      'payment_status' => 'PENDING'
    ]);

    return redirect()->route('dashboard-transaction');
  }
}
