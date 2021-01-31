@extends('layouts.template')

@section('title', 'Tambah Pelanggan')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">Tambah Pelanggan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('tambahPelangganAksi') }}" method="POST">
                    @csrf
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        
                        <a href="{{ route('pelanggan') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <br>

                        <div class="form-group">
                            <label for="pelanggan_nama" class="font-weight-bold">Nama Pelanggan</label>
                            <input type="text" name="pelanggan_nama" class="form-control" placeholder="Masukkan nama pelanggan" value="{{ old('pelanggan_nama') }}">
                            <span class="text-danger">@error('pelanggan_nama') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="pelanggan_hp" class="font-weight-bold">No. HP Pelanggan</label>
                            <input type="text" name="pelanggan_hp" class="form-control" placeholder="Masukkan no. hp pelanggan" value="{{ old('pelanggan_hp') }}">
                            <span class="text-danger">@error('pelanggan_hp') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="pelanggan_alamat" class="font-weight-bold">Alamat Pelanggan</label>
                            <input type="text" name="pelanggan_alamat" class="form-control" placeholder="Masukkan alamat pelanggan" value="{{ old('pelanggan_alamat') }}">
                            <span class="text-danger">@error('pelanggan_alamat') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection