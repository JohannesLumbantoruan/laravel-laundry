<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Cetak PDF Laporan</title>

    <!-- meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <style type="text/css">
        th{
            text-align: left;
        }

        .table, .table tr, .table tr td, .table tr th{
            border: 1px solid black;
            border-collapse: collapse;
        }

        h2{
            text-align: center;
        }
    </style>

    <h2>Laporan Transaksi LARADRY</h2>
    <br>
    @if ($dari == "" || $sampai == "")
    @else
        <table>
            <tr>
                <th>Dari Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($dari)) }}</td>
            </tr>
            <tr>
                <th>Sampai Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($sampai)) }}</td>
            </tr>
        </table>
        <br>
    @endif
    
    <table class="table">
        <tr>
            <th>No.</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Berat (Kg)</th>
            <th>Tgl. Selesai</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>
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
                    {{ "PROSES" }}
                @elseif ($t->transaksi_status == "1")
                    {{ "DICUCI" }}
                @elseif ($t->transaksi_status == "2")
                    {{ "SELESAI" }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>