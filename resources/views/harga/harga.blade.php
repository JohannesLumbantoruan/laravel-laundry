@extends('layouts.template')

@section('title', 'Harga Laundry per Kilogram')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-center">Harga Laundry per Kilogram</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ubahHarga') }}" method="POST">
                        @csrf
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger text-center">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="harga" class="font-weight-bold">Harga/Kilogram</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga laundri per kilogram" value="{{ $harga->harga_per_kilo }}">
                                <span class="text-danger">@error('harga') {{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="Ubah harga">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection