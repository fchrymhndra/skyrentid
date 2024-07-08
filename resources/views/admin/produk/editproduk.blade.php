<!-- Edit Product View -->
@extends('admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="mb-0 text-white">Edit Product</h1>
                <a href="{{ route('products') }}" class="btn btn-light btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id_produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kategori">Category</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="Kamera" {{ $product->kategori == 'Kamera' ? 'selected' : '' }}>Kamera</option>
                            <option value="Lensa" {{ $product->kategori == 'Lensa' ? 'selected' : '' }}>Lensa</option>
                            <option value="Stabilizer" {{ $product->kategori == 'Stabilizer' ? 'selected' : '' }}>Stabilizer</option>
                            <option value="Lighting" {{ $product->kategori == 'Lighting' ? 'selected' : '' }}>Lighting</option>
                            <option value="Audio" {{ $product->kategori == 'Audio' ? 'selected' : '' }}>Audio</option>
                            <option value="Tripod" {{ $product->kategori == 'Tripod' ? 'selected' : '' }}>Tripod</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Product Name</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_produk">Product Description</label>
                        <textarea name="deskripsi_produk" class="form-control" required>{{ $product->deskripsi_produk }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="stok_produk">Stock</label>
                        <input type="number" name="stok_produk" class="form-control" value="{{ $product->stok_produk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Price</label>
                        <input type="number" name="harga_produk" class="form-control" value="{{ $product->harga_produk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_produk">Product Photo</label>
                        <input type="file" name="foto_produk" class="form-control">
                        @if($product->foto_produk)
                            <small>Current Photo: <img src="{{ asset($product->foto_produk) }}" width="50" height="50" alt="Current Photo"></small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="riwayat_service">Service History</label>
                        <textarea name="riwayat_service" class="form-control">{{ $product->riwayat_service }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_disewa">Total Rented</label>
                        <input type="number" name="total_disewa" class="form-control" value="{{ $product->total_disewa }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
