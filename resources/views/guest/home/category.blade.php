@extends('guest.layouts.app')

@section('content')
<div class="flex-grow-1">
    <div class="container">
        <h1>Produk dalam Kategori: {{ $category }}</h1>
        <div class="row">
            @forelse($products as $product)
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card card-custom w-100">
                    <img src="{{ $product->foto_produk }}" class="card-img-top img-fluid" alt="{{ $product->nama_produk }}"
                        data-toggle="modal" data-target="#productModal{{ $product->id }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <p class="card-text">Harga: Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-primary btn-custom" data-toggle="modal"
                            data-target="#loginModal">Sewa</a>
                    </div>
                </div>
            </div>
            <!-- Product Modal -->
            <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog"
                aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->nama_produk }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ $product->foto_produk }}" class="img-fluid mb-3"
                                        alt="{{ $product->nama_produk }}">
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Deskripsi:</strong></p>
                                    <p>{{ $product->deskripsi_produk }}</p>
                                    <p><strong>Harga:</strong> Rp {{ number_format($product->harga_produk, 0, ',', '.') }}
                                    </p>
                                    <p><strong>Stok:</strong> {{ $product->stok_produk }}</p>
                                    <p><strong>Total Disewa:</strong> {{ $product->total_disewa }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Modal -->
            @empty
            <div class="col-12">
                <p class="text-center flex-grow-1">Tidak ada produk dalam kategori ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Anda perlu login untuk melakukan penyewaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Silakan login terlebih dahulu untuk menyewa produk.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Modal -->
@endsection