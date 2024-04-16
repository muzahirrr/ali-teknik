<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $users = User::count();
    $transactions = Transaction::count();
    $services = Service::count();
    $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');

    return view('pages.admin.dashboard-home', [
      'users' => $users,
      'transactions' => $transactions,
      'services' => $services,
      'revenue' => $revenue
    ]);
  }
}
