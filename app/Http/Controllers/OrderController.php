<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Regency;

class OrderController extends Controller
{
  public function index(Service $service)
  {
    $user = auth()->user();
    $item = Service::with(['galleries'])->where('slug', $service->slug)->firstOrFail();
    $regencies = Regency::all();
    return view('pages.order', [
      'service' => $item,
      'user' => $user
    ]);
  }
  public function store(Request $request)
  {
    // $request->validate([
    //   'pasang' => ['required', 'string'],
    //   'bongkar' => ['required', '']
    // ]);
    dd($request);
  }
}
