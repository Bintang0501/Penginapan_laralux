<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }
        .content {
            margin: 20px 0;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table, .content th, .content td {
            border: 1px solid #ddd;
        }
        .content th, .content td {
            padding: 8px;
            text-align: left;
        }
        .content th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nota Transaksi</h1>
            <p>{{ date('d M Y') }}</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama User</th>
                    <td>{{ $transaksi->nama_users }}</td>
                </tr>
                <tr>
                    <th>Email User</th>
                    <td>{{ $transaksi->email_users }}</td>
                </tr>
                <tr>
                    <th>Total Beli</th>
                    <td>Rp. {{ number_format($transaksi->total_beli) }}</td>
                </tr>
                <tr>
                    <th>Pajak</th>
                    <td>Rp. {{ number_format($transaksi->pajak) }}</td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>Rp. {{ number_format($transaksi->total_bayar) }}</td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td>Rp. {{ number_format($transaksi->kembalian) }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Terima kasih telah melakukan transaksi dengan kami.</p>
        </div>
    </div>
</body>
</html>
