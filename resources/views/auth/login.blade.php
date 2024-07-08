<!-- File: resources/views/auth/login.blade.php -->

@extends('guest.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-lg">
                    <h1 class="card-header h4 mb-3 fw-normal fw-bold" style="font-size: 20px">SELAMAT DATANG</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-lg btn-primary" style="font-size:small; width:45%;">Masuk</button>
                                <a class="btn btn-lg btn-danger ml-2" href="{{ route('register') }}" style="font-size:small; width:45%;">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
