<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ServiceGalleryRequest;
use App\Models\Service;

class ServiceGalleryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = ServiceGallery::with(['service']);

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
                  <form action="' . route('service_gallery.destroy', $item) . '" method="POST">
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
        ->editColumn('photo', function ($item) {
          return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="max-height: 80px;" />' : '';
        })
        ->rawColumns(['action', 'photo'])
        ->make();
    }
    return view('pages.admin.service-gallery.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $services = Service::all();

    return view('pages.admin.service-gallery.create', [
      'services' => $services
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ServiceGalleryRequest $request)
  {
    $data = $request->validated();

    if ($request->file('photo')) {
      $data['photo'] = $request->file('photo')->store('galleries');
    };

    ServiceGallery::create($data);

    return redirect()->route('service_gallery.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function show(ServiceGallery $service_gallery)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function edit(ServiceGallery $service_gallery)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function update(ServiceGalleryRequest $request, ServiceGallery $service_gallery)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Service  $service
   * @return \Illuminate\Http\Response
   */
  public function destroy(ServiceGallery $service_gallery)
  {
    if ($service_gallery->photo) {
      Storage::delete($service_gallery->photo);
    }

    ServiceGallery::destroy($service_gallery->id);

    return redirect()->route('service_gallery.index');
  }
}
