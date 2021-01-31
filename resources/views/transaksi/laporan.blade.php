@extends('layouts.template')

@section('title', 'Laporan Transaksi - LARADRY')

@section('content')
<body>
    @include('navigation')
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Filter Laporan</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('laporanAksi') }}" method="GET">
                    <table class="table table bordered">
                        <tr>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                        </tr>
                        <tr>
                            <td><input type="date" name="tgl_dari" class="form-control"></td>
                            <td><input type="date" name="tgl_sampai" class="form-control"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" class="btn btn-primary btn-block" value="FILTER"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-header">
                <h3 class="font-weight-bold text-center">Laporan Transaksi LARADRY</h3>
            </div>
            <div class="card-body">
                <div class="btn-group float-right">
                    <a href="{{ route('pdfLaporan') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="{{ route('printLaporan') }}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </div>
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
                                    <?php if ($t->transaksi_status == "0")
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