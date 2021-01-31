@extends('layouts.template')

@section('title', 'Edit Transaksi')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">Edit Transaksi</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('editTransaksiAksi', $transaksi->transaksi_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <a href="{{ route('transaksi') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <br>

                        <div class="form-group">
                            <label for="pelanggan" class="font-weight-bold">Pelanggan</label>
                            <select name="pelanggan" class="form-control">
                                <option value="">-Pilih Pelanggan-</option>
                                @foreach ($pelanggan as $p)
                                <option <?php if ($p->pelanggan_id == $transaksi->transaksi_pelanggan){echo "selected='selected'";} ?> value="{{ $p->pelanggan_id }}">{{ $p->pelanggan_nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('pelanggan') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="berat" class="font-weight-bold">Berat</label>
                            <input type="number" name="berat" class="form-control" placeholder="Masukkan berat cucian" value="{{ $transaksi->transaksi_berat }}">
                            <span class="text-danger">@error('berat') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai" class="font-weight-bold">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" value="{{ $transaksi->transaksi_tgl_selesai }}">
                            <span class="text-danger">@error('tgl_selesai') {{ $message }} @enderror</span>
                        </div>
                        <br>

                        <table class="table table-bordered">
                            <tr>
                                <th>Jenis Pakaian</th>
                                <th width="20%">Jumlah</th>
                            </tr>
                            @foreach ($pakaian as $p)
                            <tr>
                                <td><input type="text" name="jenis_pakaian[]" class="form-control" value="{{ $p->pakaian_jenis }}"></td>
                                <td><input type="number" name="jumlah_pakaian[]" class="form-control" value="{{ $p->pakaian_jumlah }}"></td>
                            </tr>
                            @endforeach
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
                            <label for="status" class="font-weight-bold">Status</label>
                            <select name="status" class="form-control">
                                <option <?php if ($transaksi->transaksi_status == "0"){echo "selected='selected'";} ?> value="0">PROSES</option>
                                <option <?php if ($transaksi->transaksi_status == "1"){echo "selected='selected'";} ?> value="1">DICUCI</option>
                                <option <?php if ($transaksi->transaksi_status == "2"){echo "selected='selected'";} ?> value="2">SELESAI</option>
                            </select>
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