<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        .: Nota Pembelian :.
    </title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .teks-tengah {
            text-align: center;
        }

        .teks-left {
            text-align: left;
        }

        .title {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .teks-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="title">
        Nota Pembelian
    </div>

    <table style="margin-bottom: 20px;">
        <tbody>
            <tr>
                <td>Pembeli</td>
                <td>:</td>
                <td>{{ $transaksi->nama_users }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $transaksi->email_users }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->tanggal)->translatedFormat('d F Y - H:i:s'); }}
                </td>
            </tr>
            <tr>
                <td>Gunakan Point</td>
                <td>:</td>
                <td>
                    @if ($transaksi->use_reedem == "0")
                        Tidak
                    @else
                        Ya
                    @endif
                </td>
            </tr>
            <tr>
                <td>Point</td>
                <td>:</td>
                <td>{{ $transaksi->point }} Poin</td>
            </tr>
        </tbody>
    </table>

    <table border="1" cellpadding="10" cellspacing="1" style="width: 100%; margin-bottom: 20px;">
        <thead>
            <tr>
                <th class="teks-tengah">No.</th>
                <th class="teks-left">Hotel</th>
                <th class="teks-left">Nama Produk</th>
                <th>Tipe Produk</th>
                <th class="teks-tengah">Quantity</th>
                <th class="teks-tengah">Harga</th>
                <th class="teks-tengah">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomer = 0;
                $total = 0;
            @endphp
            @foreach ($transaksiDetail as $item)
                @php
                    $totalHargaQty = $item->harga * $item->qty;
                @endphp
                <tr>
                    <td class="teks-tengah">{{ ++$nomer }}.</td>
                    <td class="teks-left">{{ $item->produks->hotel->nama }}</td>
                    <td class="teks-left">{{ $item->nama_produk }}</td>
                    <td class="teks-tengah">{{ $item->tipe_produk }}</td>
                    <td class="teks-tengah">{{ $item->qty }}</td>
                    <td class="teks-tengah">Rp. {{ number_format($item->harga) }}</td>
                    <td class="teks-tengah">Rp. {{ number_format($totalHargaQty) }}</td>
                </tr>

                @php
                    $total += $item->harga * $item->qty;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="teks-right">SubTotal</td>
                <td class="teks-tengah">
                    Rp. {{ number_format($total) }}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="teks-right">Pajak</td>
                <td class="teks-tengah">
                    Rp. {{ number_format($transaksi->pajak) }}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="teks-right">Total Bayar</td>
                <td class="teks-tengah">
                    Rp. {{ number_format($transaksi->total_bayar) }}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="teks-right">Kembalian</td>
                <td class="teks-tengah">
                    Rp. {{ number_format($transaksi->kembalian) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <hr>
    <div class="teks-tengah" style="margin-top: 20px; margin-bottom: 20px; text-transform: uppercase; font-weight: bold">
        # Terima Kasih #
    </div>
    <hr>

</body>
</html>
