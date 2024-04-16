<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class DetailController extends Controller
{
  public function index(Service $service)
  {
    $item = Service::with(['galleries'])->where('slug', $service->slug)->firstOrFail();
    return view('pages.detail', [
      'service' => $item
    ]);
  }
}
