@extends('layouts.template')

@section('title', 'Ganti Password')

@section('content')
<body>
    @include('navigation')
    
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">Ganti Password</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('gantiPasswordAksi') }}" method="POST">
                    @csrf
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="password_baru" class="font-weight-bold">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" placeholder="Password baru">
                            <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password_ulang" class="font-weight-bold">Konfirmasi Password</label>
                            <input type="password" name="password_ulang" class="form-control" placeholder="Ulangi password">
                            <span class="text-danger">@error('password_ulang') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection