<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Cetak PDF Invoice</title>

    <!-- meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <style class="text/css">
    .table, .table tr, .table tr th, .table tr td{
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
    }

    table{
        border: 1px solid black;
        width: 60%;
        margin-left: auto;
        margin-right: auto;
    }

    th{
        text-align: left;
    }

    h2, h3, p{
        text-align: center;
    }
    </style>

    <h2>Invoice Transaksi LARADRY</h2>
    <table>
        <tr>
            <th>No. Invoice</th>
            <th>:</th>
            <td>{{ "LARADRY-".($transaksi->transaksi_id + 789) }}</td>
        </tr>
        <tr>
            <th>Tgl. Laundry</th>
            <th>:</th>
            <td>{{ date('d/m/Y', strtotime($transaksi->transaksi_tgl)) }}</td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <th>:</th>
            <td>{{ $transaksi->pelanggan->pelanggan_nama }}</td>
        </tr>
        <tr>
            <th>No. HP</th>
            <th>:</th>
            <td>{{ $transaksi->pelanggan->pelanggan_hp }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>:</th>
            <td>{{ $transaksi->pelanggan->pelanggan_alamat }}</td>
        </tr>
        <tr>
            <th>Berat Cucian (Kg)</th>
            <th>:</th>
            <td>{{ $transaksi->transaksi_berat }}</td>
        </tr>
        <tr>
            <th>Tgl. Selesai</th>
            <th>:</th>
            <td>{{ date('d/m/Y', strtotime($transaksi->transaksi_tgl_selesai)) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <th>:</th>
            <td>
                @if ($transaksi->transaksi_status == "0")
                {{ "PROSES" }}
                @elseif ($transaksi->transaksi_status == "1")
                {{ "DICUCI" }}
                @elseif ($transaksi->transaksi_status == "2")
                {{ "SELESAI" }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Harga</th>
            <th>:</th>
            <td>{{ "Rp. ".number_format($transaksi->transaksi_harga) }}</td>
        </tr>
    </table>
    <br>

    <h3>Daftar Cucian</h3>
    <table class="table">
        <tr>
            <th>Jenis Pakaian</th>
            <th>Jumlah</th>
        </tr>
        @foreach ($pakaian as $p)
        <tr>
            <td>{{ $p->pakaian_jenis }}</td>
            <td>{{ $p->pakaian_jumlah }}</td>
        </tr>
        @endforeach
    </table>
    <br>
    <p><b>"Terimakasih telah mempercayakan cucian anda kepada kami."</b></p>
</body>
</html>