@extends('admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="mb-0 text-white">Tambah Produk</h1>
                <a href="{{ route('products') }}" class="btn btn-light btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kategori">Category</label>
                        <select name="kategori" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="Kamera">Kamera</option>
                        <option value="Lensa">Lensa</option>
                        <option value="Stabilizer">Stabilizer</option>
                        <option value="Lighting">Lighting</option>
                        <option value="Audio">Audio</option>
                        <option value="Tripod">Tripod</option>
                        <!-- Add more options as needed -->
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Product Name</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_produk">Product Description</label>
                        <textarea name="deskripsi_produk" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stok_produk">Stock</label>
                        <input type="number" name="stok_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Price</label>
                        <input type="number" name="harga_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_produk">Product Photo</label>
                        <input type="file" name="foto_produk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status_produk">Status</label>
                        <select name="status_produk" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="on">On</option>
                            <option value="off">Off</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="riwayat_service">Service History</label>
                        <textarea name="riwayat_service" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_disewa">Total Rented</label>
                        <input type="number" name="total_disewa" class="form-control" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
