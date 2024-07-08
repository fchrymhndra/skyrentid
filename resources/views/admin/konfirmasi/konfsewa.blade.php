@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0 text-white">Konfirmasi Sewa</h1>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jaminan</th>
                            <th scope="col">Tanggal Sewa</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $index => $rental)
                        @if($rental->status_pinjam == 'Pending')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rental->user->nama }}</td>
                            <td>{{ $rental->product->nama_produk }}</td>
                            <td>{{ $rental->jaminan }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->rental_date)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->return_date)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ $rental->payment_method }}</td>
                            <td>Rp {{ number_format($rental->total, 0, ',', '.') }}</td>
                            <td>{{ $rental->status_pinjam }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('rental.confirm', $rental->id_order) }}" method="POST"
                                        class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mr-2">Confirm</button>
                                    </form>
                                    <form action="{{ route('rental.reject', $rental->id_order) }}" method="POST"
                                        class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection