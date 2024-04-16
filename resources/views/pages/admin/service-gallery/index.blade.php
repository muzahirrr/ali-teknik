@extends('layouts.admin')

@section('title')
    Admin Service Gallery
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">List Gallery</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <a href="{{ route('service_gallery.create') }}" class="btn btn-primary mb-3">
            + Tambah Foto Layanan
          </a>
          <div class="table-responsive">
            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Layanan</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
                {data: 'service.name', name:'service.name'},
                {data: 'photo', name:'photo'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush