<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ServiceRequest;

class ServiceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = Service::query();

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
                  <a class="dropdown-item" href="' . route('service.edit', $item) . '">
                    Sunting
                  </a>
                  <form action="' . route('service.destroy', $item) . '" method="POST">
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
        ->editColumn('logo', function ($item) {
          return $item->logo ? '<img src="' . Storage::url($item->logo) . '" style="max-height: 40px;" />' : '';
        })
        ->rawColumns(['action', 'logo'])
        ->make();
    }
    return view('pages.admin.service.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.admin.service.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ServiceRequest $request)
  {
    $data = $request->validated();

    $data['slug'] = Str::slug($request->name);

    if ($request->file('logo')) {
      $data['logo'] = $request->file('logo')->store('logos');
    };

    Service::create($data);

    return redirect()->route('service.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function show(Service $service)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function edit(Service $service)
  {
    return view('pages.admin.service.edit', [
      'item' => $service
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function update(ServiceRequest $request, Service $service)
  {
    $data = $request->validated();

    $data['slug'] = Str::slug($request->name);

    if ($request->file('logo')) {
      if ($service->logo) {
        Storage::delete($service->logo);
      }
      $data['logo'] = $request->file('logo')->store('logos');
    };

    Service::where('id', $service->id)->update($data);

    return redirect()->route('service.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function destroy(Service $service)
  {
    if ($service->logo) {
      Storage::delete($service->logo);
    }
    Service::destroy($service->id);

    return redirect()->route('service.index');
  }
}
