@extends('admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="mb-0 text-white">Data Produk</h1>
                <a href="{{ route('products.create') }}" class="btn btn-light">Add New Product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Total Disewa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $product->kategori }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->stok_produk }}</td>
                                    <td>Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</td>
                                    <td>{{ $product->total_disewa }}</td>
                                    <td>
                                        <select class="form-control status_produk" data-id="{{ $product->id_produk }}">
                                            <option value="on" {{ $product->status_produk == 'on' ? 'selected' : '' }}>On</option>
                                            <option value="off" {{ $product->status_produk == 'off' ? 'selected' : '' }}>Off</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.show', $product->id_produk) }}" class="btn btn-info btn-sm">Show</a>
                                            <a href="{{ route('products.edit', $product->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a action="{{ route('products.destroy', $product->id_produk) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.status_produk');

        selects.forEach(select => {
            select.addEventListener('change', function() {
                const productId = this.getAttribute('data-id');
                const status = this.value;

                fetch(`/update-product-status/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status_produk: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status produk berhasil diperbarui.');
                    } else {
                        alert('Terjadi kesalahan saat memperbarui status produk.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status produk.');
                });
            });
        });
    });
</script>
