<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = Transaction::with(['user', 'service'])->latest()->get();

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
                  <a class="dropdown-item" href="' . route('transaction.edit', $item) . '">
                    Sunting
                  </a>
                  <form action="' . route('transaction.destroy', $item) . '" method="POST">
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
        ->editColumn('total_price', function ($item) {
          return number_format($item->total_price, 0, ',', '.');
        })
        ->editColumn('order_date', function ($item) {
          return date('d-m-Y', strtotime($item->order_date));
        })
        ->editColumn('created_at', function ($item) {
          return date('d-m-Y', strtotime($item->created_at));
        })
        ->editColumn('payment_status', function ($item) {
          $statusClass = '';
          if ($item->payment_status === 'PAID') {
            $statusClass = 'badge-success';
          } elseif ($item->payment_status === 'PENDING') {
            $statusClass = 'badge-warning';
          } elseif ($item->payment_status === 'UNPAID') {
            $statusClass = 'badge-danger';
          }
          return '<span class="badge badge-pill ' . $statusClass . '">' . $item->payment_status . '</span>';
        })
        ->editColumn('transaction_status', function ($item) {
          $statusClass = '';
          if ($item->transaction_status === 'SUCCESS') {
            $statusClass = 'badge-success';
          } elseif ($item->transaction_status === 'PENDING') {
            $statusClass = 'badge-warning';
          } elseif ($item->transaction_status === 'CANCELED') {
            $statusClass = 'badge-danger';
          } elseif ($item->transaction_status === 'PROCESS') {
            $statusClass = 'badge-primary';
          }
          return '<span class="badge badge-pill ' . $statusClass . '">' . $item->transaction_status . '</span>';
        })
        ->rawColumns(['action', 'total_price', 'order_date', 'created_at', 'payment_status', 'transaction_status'])
        ->make();
    }

    return view('pages.admin.transaction.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function show(Transaction $transaction)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function edit(Transaction $transaction)
  {
    return view('pages.admin.transaction.edit', [
      'item' => $transaction
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Transaction $transaction)
  {
    $data = $request->validate([
      'payment_status' => 'required',
      'transaction_status' => 'required',
      'payment_confirmation' => 'image|file',
    ]);

    if ($request->file('payment_confirmation')) {
      if ($transaction->payment_confirmation) {
        Storage::delete($transaction->payment_confirmation);
      }
      $data['payment_confirmation'] = $request->file('payment_confirmation')->store('payment_confirmations');
    } else {
      unset($data['payment_confirmation']);
    };

    Transaction::where('id', $transaction->id)->update($data);

    return redirect()->route('transaction.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function destroy(Transaction $transaction)
  {
    Transaction::destroy($transaction->id);

    return redirect()->route('transaction.index');
  }

  public function cetak($tglawal, $tglakhir)
  {
    $cetak = Transaction::with(['user', 'service'])->whereBetween('created_at', [$tglawal, $tglakhir])->latest()->get();
    return view('layouts.report', [
      'cetak' => $cetak
    ]);
  }
}
