@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          <th>ID</th>
                          <th>User</th>
                          <th>Code Order</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Bukti Pembayaran</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @forelse($items as $item)
                          <tr>
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->user->name }}</td>
                              <td>{{ $item->kode_pemesanan}}</td>
                              <td>Rp. {{ number_format($item->total_harga) }}</td>
                              <td>{{ $item->status }}</td>
                              
                              <td><img src="{{ Storage::url($item->image) }}" alt="" style="width: 200px" class="img-thumbnail"></td>
                              <td>
                                  <a href="{{ route('transaction2.show', $item->id) }}" class="btn btn-primary">
                                      <i class="fa fa-eye"></i>
                                  </a>
                                  <a href="{{ route('transaction2.edit', $item->id) }}" class="btn btn-info">
                                      <i class="fa fa-pencil-alt"></i>
                                  </a>
                                  <form action="{{ route('transaction2.destroy', $item->id) }}" method="post" class="d-inline">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-danger">
                                          <i class="fa fa-trash"></i>
                                      </button>
                                  </form>

                              </td>
                          </tr>
                      @empty
                          <td colspan="7" class="text-center">
                              Data Kosong
                          </td>
                      @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
    <!-- /.container-fluid -->
@endsection