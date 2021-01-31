@extends('layouts.template')

@section('title', 'Login Laundry')

@section('content')
<body>
    <div class="container">
    <h1 class="font-weight-bold text-center" style="margin-top: 100px">LAUNDRY</h1>
        <div class="col-md-6 offset-md-3">
            <div class="card" style="margin-top: 50px">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">LOGIN</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('loginAksi') }}" method="POST">
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
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}">
                            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection