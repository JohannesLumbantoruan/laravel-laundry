@extends('layouts.template')

@section('title', 'Daftar Transaksi')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Daftar Transaksi</h2>
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

                <a href="{{ route('tambahTransaksi') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Transaksi</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Berat (Kg)</th>
                                <th>Tgl. Selesai</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th width="24%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ "LARADRY-".($t->transaksi_id + 789) }}</td>
                                <td>{{ date('d/m/Y', strtotime($t->transaksi_tgl)) }}</td>
                                <td>{{ $t->pelanggan->pelanggan_nama }}</td>
                                <td>{{ $t->transaksi_berat }}</td>
                                <td>{{ date('d/m/Y', strtotime($t->transaksi_tgl_selesai)) }}</td>
                                <td>{{ "Rp. ".number_format($t->transaksi_harga) }}</td>
                                <td>
                                    <?php
                                    if ($t->transaksi_status == "0")
                                    {
                                        echo "<span class='badge badge-warning'>PROSES</span>";
                                    }
                                    elseif ($t->transaksi_status == "1")
                                    {
                                        echo "<span class='badge badge-info'>DICUCI</span>";
                                    }
                                    elseif ($t->transaksi_status == "2")
                                    {
                                        echo "<span class='badge badge-success'>SELESAI</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('invoice', $t->transaksi_id) }}" class="btn btn-sm btn-warning"><i class="fa fa-file-invoice-dollar"></i> Invoice</a>
                                        <a href="{{ route('editTransaksi', $t->transaksi_id) }}" class="btn btn-sm btn-info"><i class="fa fa-wrench"></i> Edit</a>
                                        <a href="{{ route('batalkanTransaksi', $t->transaksi_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batalkan</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection