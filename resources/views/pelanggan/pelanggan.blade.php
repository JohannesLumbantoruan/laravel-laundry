@extends('layouts.template')

@section('title', 'Daftar Pelanggan')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Daftar Pelanggan</h2>
            </div>
            <div class="card-body">
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

                <form action="{{ route('cariPelanggan') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Cari pelanggan" value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-light">
                            <span><i class="fa fa-search"></i></span>
                        </button>
                    </div>
                </form>
                <br>

                <a href="{{ route('tambahPelanggan') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Pelanggan</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th width="14%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->pelanggan_nama }}</td>
                                <td>{{ $p->pelanggan_hp }}</td>
                                <td>{{ $p->pelanggan_alamat }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('editPelanggan', $p->pelanggan_id) }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                        <a href="{{ route('hapusPelanggan', $p->pelanggan_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                    <div class="d-flex justify-content-center">
                        {{ $pelanggan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection