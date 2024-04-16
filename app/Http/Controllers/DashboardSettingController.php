<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    return view('pages.dashboard-alamat', [
      'user' => $user
    ]);
  }

  public function update(Request $request, User $user)
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => 'required|email|unique:users,email,' . $user->id,
      'province_id' => 'required',
      'regency_id' => 'required',
      'address' => 'required',
      'phone_number' => 'required',
    ]);

    User::where('id', Auth::user()->id)->update($data);

    return redirect()->route('dashboard-setting');
  }
}
