@extends('admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="mb-0 text-white">Laporan Sewa</h1>
                <form action="{{ route('admin.laporan') }}" method="GET" class="d-flex align-items-center">
                    <div class="form-group mb-0">
                        <select name="month" class="form-control">
                            <option value="">Pilih Bulan</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group mb-0 ml-2">
                        <select name="year" class="form-control">
                            <option value="">Pilih Tahun</option>
                            @for ($y = \Carbon\Carbon::now()->year; $y >= 2000; $y--)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-light ml-2">Filter</button>
                </form>
                <a href="{{ route('rentals.export') }}" class="btn btn-success ml-2">Export to Excel</a>
            </div>
            <div class="card-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentals as $index => $rental)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rental->user->nama }}</td>
                                    <td>{{ $rental->product->nama_produk }}</td>
                                    <td>{{ $rental->jaminan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rental->rental_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rental->return_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $rental->payment_method }}</td>
                                    <td>Rp {{ number_format($rental->denda, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($rental->total, 0, ',', '.') }}</td>
                                    <td>{{ $rental->status_pinjam }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
