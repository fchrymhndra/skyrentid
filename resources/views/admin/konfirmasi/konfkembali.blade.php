@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0 text-white">Konfirmasi Kembali</h1>
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
                            <th scope="col">Denda</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $index => $rental)
                        @if($rental->status_kembali == 'Pending')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rental->user->nama }}</td>
                            <td>{{ $rental->product->nama_produk }}</td>
                            <td>{{ $rental->jaminan }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->rental_date)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->return_date)->isoFormat('D MMMM YYYY') }}</td>
                            <td>{{ $rental->payment_method }}</td>
                            <td>
                                <form action="{{ route('rental.updateDenda', $rental->id_order) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="denda" class="form-control form-control-sm" value="{{ $rental->denda ?? 0 }}" required>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan Denda</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($rental->total + ($rental->denda ?? 0), 0, ',', '.') }}</td>
                            <td>{{ $rental->status_kembali }}</td>
                            <td>
                                <form action="{{ route('rental.return', $rental->id_order) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" {{ $rental->denda === null ? 'disabled' : '' }}>Confirm Return</button>
                                </form>
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
