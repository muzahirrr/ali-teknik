<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function index(Service $service)
  {
    $item = Service::with(['galleries'])->where('slug', $service->slug)->firstOrFail();
    $user = Auth::user();

    return view('pages.order', [
      'user' => $user,
      'service' => $item,
    ]);
  }

  public function store(Service $service, Request $request)
  {
    $data = $request->validate([
      'brand' => 'required|string',
      'option' => 'required',
      'amount' => 'required|integer',
      'detail' => '',
      'order_date' => 'required',
      'name' => 'required|string',
      'province' => 'required|string',
      'regency' => 'required|string',
      'address' => 'required|string',
      'phone_number' => 'required',
    ]);

    $data['option'] = json_decode($data['option']);
    $earlyPrice = $service->price;
    $price = $earlyPrice + $data['option']->price;
    $total_price = $price * $data['amount'];

    $transaction = Transaction::create([
      'user_id' => Auth::user()->id,
      'service_id' => $service->id,
      'code' => 'TRX' . mt_rand(000000, 999999),
      'brand' => $data['brand'],
      'option' => $data['option']->label,
      'detail' => $data['detail'],
      'amount' => $data['amount'],
      'order_date' => $data['order_date'],
      'price' => $price,
      'total_price' => $total_price,
      'payment_status' => 'UNPAID',
      'transaction_status' => 'PENDING',
      'name' => $data['name'],
      'province' => $data['province'],
      'regency' => $data['regency'],
      'address' => $data['address'],
      'phone_number' => $data['phone_number'],
    ]);

    return redirect()->route('dashboard-transaction-detail', $transaction->code);
  }
}
