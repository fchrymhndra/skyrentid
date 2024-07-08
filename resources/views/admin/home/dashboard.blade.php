@extends('admin.layout.app')

@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2" style="color:#3D5093; font-weight:bolder;">Dashboard Admin</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($topProducts as $product)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card h-100">
                                        <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <img src="{{ $product->foto_produk }}" class="img-fluid rounded" alt="{{ $product->nama_produk }}" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                            <p class="card-text">{{ $product->deskripsi_produk }}</p>
                                            <p class="card-text"><strong>Total Disewa:</strong> {{ $product->total_disewa }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
