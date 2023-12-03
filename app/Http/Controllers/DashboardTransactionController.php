<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
  public function index()
  {
      $user = auth()->user();
      if ($user->roles == 'USER'){
        $transactions = Transaction::with(['user', 'service'])
        ->where('user_id', $user->id)
        ->get();
      } else {
        $transactions = Transaction::with(['user', 'service'])->get();
      }

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

        $role = auth()->user()->roles;
        return redirect()->route($role ? 'user.dashboard-transaction' : 'dashboard-transaction');
    }
}
