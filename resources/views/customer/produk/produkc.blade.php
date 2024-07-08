@extends('customer.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Kategori Produk</h1>
    <div class="row mb-3">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-3">
            <a href="{{ route('categories.show', $category) }}"
                class="card category-card h-100 shadow-sm border-0 mx-auto">
                <img src="{{ asset('images/' . strtolower($category) . '.png') }}" class="card-img-top img-fluid"
                    alt="Kategori {{ $category }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $category }}</h5>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="container">
        <section class="products">
            <h2>Produk Pilihan</h2>
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card card-custom w-100">
                        <img src="{{ $product->foto_produk }}" class="card-img-top img-fluid"
                            alt="{{ $product->nama_produk }}" data-toggle="modal"
                            data-target="#productModal{{ $product->id }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text">Harga: Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                            <a class="btn btn-primary btn-custom" data-toggle="modal" data-target="#sewaModal"
                                data-id="{{ $product->id_produk }}" data-name="{{ $product->nama_produk }}"
                                data-price="{{ $product->harga_produk }}">Sewa</a>
                        </div>
                    </div>
                </div>
                <!-- Product Modal -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel{{ $product->id }}">
                                    {{ $product->nama_produk }}
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
                                        <p><strong>Harga:</strong> Rp
                                            {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
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
                @endforeach
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sewaModal" tabindex="-1" aria-labelledby="sewaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sewaModalLabel">Form Penyewaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rentalForm">
                        @csrf
                        <input type="hidden" id="id_produk" name="id_produk">
                        <input type="hidden" id="nama_produk" name="nama_produk">
                        <input type="hidden" id="id_user" name="id_user" value="{{ Auth::user()->id_user }}">

                        <div class="form-group">
                            <label for="jaminan">Jaminan</label>
                            <select class="form-control" id="jaminan" name="jaminan">
                                <option>KTP</option>
                                <option>SIM</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rental_date">Waktu Penyewaan</label>
                                    <input type="date" class="form-control" id="rental_date" name="rental_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="return_date">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="return_date" name="return_date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran</label>
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option>Cash</option>
                                <option>Transfer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="total_before_discount">Total Sebelum Diskon</label>
                            <input type="text" class="form-control" id="total_before_discount"
                                name="total_before_discount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="discount_info">Diskon</label>
                            <input type="text" class="form-control" id="discount_info" name="discount_info" readonly>
                        </div>

                        <div class="form-group">
                            <label for="total_discounted">Total Setelah Diskon</label>
                            <input type="text" class="form-control" id="total_discounted" name="total_discounted"
                                readonly>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="confirmRental">Sewa</button>
                </div>
            </div>
        </div>
    </div>
    @endsection