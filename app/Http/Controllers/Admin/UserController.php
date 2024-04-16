<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = User::query();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($item) {
          return '
            <div class="btn-group">
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                  type="button"
                  data-toggle="dropdown">
                  Aksi
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="' . route('user.edit', $item) . '">
                    Sunting
                  </a>
                  <form action="' . route('user.destroy', $item) . '" method="POST">
                    ' . method_field('delete') . csrf_field() . '
                    <button type="submit" onclick="return confirm(\'Are You Sure\')" class="dropdown-item text-danger">
                      Hapus
                    </button>
                  </form>
                </div>
              </div>
            </div>
          ';
        })
        ->rawColumns(['action'])
        ->make();
    }
    return view('pages.admin.user.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.admin.user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    $data = $request->validated();

    $data['password'] = bcrypt($request->password);

    User::create($data);

    return redirect()->route('user.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('pages.admin.user.edit', [
      'item' => $user
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(UserRequest $request, User $user)
  {
    $data = $request->validated();

    if ($request->password) {
      $data['password'] = bcrypt($request->password);
    } else {
      unset($data['password']);
    }

    User::where('id', $user->id)->update($data);

    return redirect()->route('user.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    User::destroy($user->id);

    return redirect()->route('user.index');
  }
}
