<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Service;
use App\Models\SubDistrict;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index(Service $service)
  {
    $user = auth()->user();
    $item = Service::with(['galleries'])->where('slug', $service->slug)->firstOrFail();
    $cities = City::all(['id', 'alternative_name']);
    $provinces = Province::all();
    $districts = District::all();
    $subdistricts = SubDistrict::all();

    return view('pages.order', [
        'service' => $item,
        'user' => $user,
        'provinces' => $provinces,
        'cities' => $cities,
        'districts' => $districts,
        'subdistricts' => $subdistricts
    ]);
  }
  public function store(Service $service, Request $request)
  {
      $data = $request->only([
          'brand',
          'service',
          'detail',
          'amount',
          'order_date',
          'province_id',
          'city_id',
          'district_id',
          'phone_number',
          'subdistrict_id',
          'address',
      ]);
      $data['service'] = json_decode($data['service']);
      $price = $data['service']->price;
      $total_price = $price + ( $service->price * $data['amount'] );
      Transaction::create([
        'brand' => $data['brand'],
        'service_id' => $service->id,
        'detail' => $data['detail'],
        'amount' => $data['amount'],
        'order_date' => $data['order_date'],
        'price' => $price,
        'province_id' => $data['province_id'],
        'city_id' => $data['city_id'],
        'district_id' => $data['district_id'],
        'subdistrict_id' => $data['subdistrict_id'],
        'address' => $data['address'],
        'option' => $data['service']->label,
        'phone_number' => $data['phone_number'],
        'code' => 'TRX' . mt_rand(000000, 999999),
        'status' => 'PENDING',
        'transaction_status' => 'PENDING',
          'user_id' => auth()->user()->id,
          'total_price' => $total_price,
          'payment_status' => 'PENDING',
      ]);
        return redirect()->route('dashboard');
  }
}
