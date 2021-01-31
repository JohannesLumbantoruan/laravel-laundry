@extends('layouts.template')

@section('title', 'Laporan Transaksi - LARADRY')

@section('content')
<body>    
    <div class="container">
    <h2 class="font-weight-bold text-center mt-5">Laporan Transaksi LARADRY</h2>
    <br>
    @if ($dari == "" || $sampai == "")
        <br>
    @else
        <table>
            <tr>
                <th width="20%">Dari Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($dari)) }}</td>
            </tr>
            <tr>
                <th width="20%">Sampai Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($sampai)) }}</td>
            </tr>
        </table>
        <br><br>
    @endif

        <div class="card">
            <div class="card-body">                                   
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
                                    echo "<span class='badge badge-info'>DICUDI</span>";
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

    <script type="text/javascript">
        window.print();
    </script>
</body>
@endsection