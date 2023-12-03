<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
  public function index()
  {
      $transactions = Transaction::with(['user', 'service'])->get();
        return view('pages.dashboard-transaksi', [
            'transactions' => $transactions
        ]);
  }

    public function update(Request $request, string $id)
    {
        $payment_status = $request->input('payment_status');
        $transaction_status = $request->input('transaction_status');

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'payment_status' => $payment_status,
            'transaction_status' => $transaction_status
        ]);

        return redirect()->route('dashboard-transaction');
    }
}
