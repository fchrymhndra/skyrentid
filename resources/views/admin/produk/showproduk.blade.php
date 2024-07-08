@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="mb-0 text-white">Detail Produk</h1>
            <a href="{{ route('products') }}" class="btn btn-light btn-sm">Back</a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
            <div class="col-md-4">
                <img src="{{ asset($product->foto_produk) }}" class="img-fluid rounded" alt="Product Photo">
            </div>
                <div class="col-md-8">
                    <h3 class="text-primary">{{ $product->nama_produk }}</h3>
                    <p class="text-muted">{{ $product->deskripsi_produk }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-primary">{{ $product->kategori }}</span>
                        <span class="badge badge-success">Stock: {{ $product->stok_produk }}</span>
                    </div>
                    <h4 class="text-danger mb-2">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</h4>
                    <p><strong>Status:</strong> <span class="badge badge-{{ $product->status_produk == 'on' ? 'success' : 'danger' }}">{{ ucfirst($product->status_produk) }}</span></p>
                    <p><strong>Service History:</strong> {{ $product->riwayat_service }}</p>
                    <p><strong>Total Rented:</strong> {{ $product->total_disewa }} times</p>
                </div>
            </div>
            
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 30%;">Category</th>
                        <td>{{ $product->kategori }}</td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ $product->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $product->deskripsi_produk }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stok_produk }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($product->status_produk) }}</td>
                    </tr>
                    <tr>
                        <th>Service History</th>
                        <td>{{ $product->riwayat_service }}</td>
                    </tr>
                    <tr>
                        <th>Total Rented</th>
                        <td>{{ $product->total_disewa }} times</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
