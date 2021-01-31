@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<body>
    @include('navigation')

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Sistem Informasi Laundry</h1>
            <h5>SI Laundry merupakan WEB yang dibuat menggunakan framework Laravel.</h5>
            <h5>Selamat menggunakan, <b>{{ Auth::guard('admin')->user()->username }}</b></h5>
        </div>
        <div class="row text-white clearfix">
            <div class="col-md-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-users"></i>
                            <div class="float-right">
                                {{ $pelanggan }}
                            </div>
                        </h1>
                    </div>
                    <div class="card-footer">
                        Jumlah Pelanggan
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-spinner"></i>
                            <div class="float-right">
                                {{ $proses }}
                            </div>
                        </h1>
                    </div>
                    <div class="card-footer">
                        Jumlah Cucian di Proses
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-hands-wash"></i>
                            <div class="float-right">
                                {{ $cuci }}
                            </div>
                        </h1>
                    </div>
                    <div class="card-footer">
                        Jumlah Pakaian di Cuci
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-check"></i>
                            <div class="float-right">
                                {{ $selesai }}
                            </div>
                        </h1>
                    </div>
                    <div class="card-footer">
                        Jumlah Transaksi Selesai
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="font-weight-bold"><i class="fa fa-exchange-alt"></i> Riwayat Transaksi Terakhir</h5>
                <br>

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
                                    @if ($t->transaksi_status == "0")
                                        <span class="badge badge-warning">PROSES</span>
                                    @elseif ($t->transaksi_status == "1")
                                        <span class="badge badge-info">DICUCI</span>
                                    @elseif ($t->transaksi_status == "2")
                                        <span class="badge badge-success">SELESAI</span>
                                    @endif
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