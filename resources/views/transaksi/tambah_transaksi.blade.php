@extends('layouts.template')

@section('title', 'Tambah Transaksi')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">Tambah Transaksi</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('tambahTransaksiAksi') }}" method="POST">
                    @csrf
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="pelanggan" class="font-weight-bold">Pelanggan</label>
                            <select name="pelanggan" class="form-control">
                                <option value="">-Pilih Pelanggan-</option>
                                @foreach ($pelanggan as $p)
                                <option value="{{ $p->pelanggan_id }}">{{ $p->pelanggan_nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('pelanggan') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="berat" class="font-weight-bold">Berat</label>
                            <input type="number" name="berat" class="form-control" placeholder="Masukkan berat cucian" value="{{ old('berat') }}">
                            <span class="text-danger">@error('berat') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai" class="font-weight-bold">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control">
                            <span class="text-danger">@error('tgl_selesai') {{ $message }} @enderror</span>
                        </div>
                        <br>

                        <table class="table table-bordered">
                            <tr>
                                <th>Jenis Pakaian</th>
                                <th width="20%">Jumlah</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control"></td>
                            </tr>
                        </table>
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