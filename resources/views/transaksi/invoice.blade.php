@extends('layouts.template')

@section('title', 'Invoice Transaksi Laundry - LARADRY')

@section('content')
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <h2 class="font-weight-bold text-center mt-5">INVOICE LARADRY</h2>
                <div class="btn-group float-right">
                    <a href="{{ route('pdfInvoice', $transaksi->transaksi_id) }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="{{ route('printInvoice', $transaksi->transaksi_id) }}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </div>

                <br><br>

                <table class="table">
                    <tr>
                        <th width="30%">No. Invoice</th>
                        <th>:</th>
                        <td>{{ "LARADRY-".($transaksi->transaksi_id + 789) }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tgl. Laundry</th>
                        <th>:</th>
                        <td>{{ date('d/m/Y', strtotime($transaksi->transaksi_tgl)) }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama Pelanggan</th>
                        <th>:</th>
                        <td>{{ $transaksi->pelanggan->pelanggan_nama }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No. HP</th>
                        <th>:</th>
                        <td>{{ $transaksi->pelanggan->pelanggan_hp }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Alamat</th>
                        <th>:</th>
                        <td>{{ $transaksi->pelanggan->pelanggan_alamat }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Berat Cucian (Kg)</th>
                        <th>:</th>
                        <td>{{ $transaksi->transaksi_berat }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tgl. Selesai</th>
                        <th>:</th>
                        <td>{{ $transaksi->transaksi_tgl_selesai }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Status</th>
                        <th>:</th>
                        <td>
                            <?php
                            if ($transaksi->transaksi_status == "0")
                            {
                                echo "<span class='badge badge-warning'>PROSES</span>";
                            }
                            elseif ($transaksi->transaksi_status == "1")
                            {
                                echo "<span class='badge badge-info'>DICUCI</span>";
                            }
                            elseif ($transaksi->transaksi_status == "2")
                            {
                                echo "<span class='badge badge-success'>SELESAI</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Harga</th>
                        <th>:</th>
                        <td>{{ $transaksi->transaksi_harga }}</td>
                    </tr>
                </table>
                <br><br>

                <h3 class="font-weight-bold text-center">Daftar Cucian</h3>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Jenis Pakaian</th>
                            <th width="30%">Jumlah</th>
                        </tr>            
                    </thead>
                    <tbody>
                        @foreach ($pakaian as $p)
                        <tr>
                            <td>{{ $p->pakaian_jenis }}</td>
                            <td>{{ $p->pakaian_jumlah }}</td>
                        </tr>
                        @endforeach            
                    </tbody>
                </table>
                <br>

                <p class="text-center mb-5"><b>"Terimakasih telah mempercayakan cucian anda kepada kami"</b></p>
            </div>
        </div>
    </div>
</body>
@endsection