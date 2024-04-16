<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Laporan</title>

    {{-- STYLE --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    <style>
      @media print{
      @page {
      size: auto;
      }
      }

      /* table { page-break-inside:auto }
      tr { page-break-inside:avoid; page-break-after:auto }
      thead { display:table-header-group }
      tfoot { display:table-footer-group } */
    </style>
  </head>

  <body onload="window.print()">
    <div class="">
      <table class="table table-borderless" style="border-bottom: 3px solid">
        <thead>
          <tr>
            <th scope="col" style="width:30%" class="text-center align-middle"><h1 class="font-weight-bolder">ALI TEKNIK</h1></th>
            <th scope="col" class="text-center align-middle">
              <h3 class="font-weight-bold">LAPORAN DATA TRANSAKSI</h3>
              <h2 class="font-weight-bold">ALI TEKNIK</h2>
              <p>Jalan Amd X Rt 02 Rw 06 No.14, Kreo, Larangan, RT.003/RW.006, Petukangan Utara, Kec. Pesanggrahan, Tanggerang, Banten 15156</p>
            </th>
          </tr>
        </thead>
      </table>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="text-center align-middle">No.</th>
            <th scope="col" class="text-center align-middle">Kode</th>
            <th scope="col" class="text-center align-middle">Nama</th>
            <th scope="col" class="text-center align-middle">Layanan</th>
            <th scope="col" class="text-center align-middle">Merk dan Tipe</th>
            <th scope="col" class="text-center align-middle">Jumlah</th>
            <th scope="col" class="text-center align-middle">Total Harga</th>
            <th scope="col" class="text-center align-middle">Tanggal Booking</th>
            <th scope="col" class="text-center align-middle">Tanggal Transaksi</th>
            <th scope="col" class="text-center align-middle">Status Pembayaran</th>
            <th scope="col" class="text-center align-middle">Status Transaksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cetak as $item)
          <tr>
            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
            <td class="text-center align-middle">{{ $item->code }}</td>
            <td class="text-center align-middle">{{ $item->name }}</td>
            <td class="text-center align-middle">{{ $item->option }}</td>
            <td class="text-center align-middle">{{ $item->brand }}</td>
            <td class="text-center align-middle">{{ $item->amount }}</td>
            <td class="text-center align-middle">{{ number_format($item->total_price,0,',','.') }}</td>
            <td class="text-center align-middle">{{ date('d-m-Y', strtotime($item->order_date)) }}</td>
            <td class="text-center align-middle">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
            <td class="text-center align-middle">{{ $item->payment_status }}</td>
            <td class="text-center align-middle">{{ $item->transaction_status }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    

    {{-- SCRIPT --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
