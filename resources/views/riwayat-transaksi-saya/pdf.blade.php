<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>DISEE - Invoice HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ url('assets/pdf/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/pdf/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/pdf/img/favicon.ico') }}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/pdf/css/style.css') }}">
</head>
<body>

<!-- Invoice 1 start -->
<div class="invoice-1 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row g-0">
                                <div class="col-sm-6">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <img src="{{ asset('assets/pdf/img/logos/logo.png') }}" alt="logo">
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-sm-6 invoice-id">
                                    <div class="info">
                                        <h1 class="color-white inv-header-1">Invoice</h1>
                                        @php
                                            $randomId = rand(10000, 99999);
                                            use Carbon\Carbon;
                                         @endphp
                                        <p class="color-white mb-1">Invoice Number <span>#{{ $randomId }}</span></p>
                                        <p class="color-white mb-0">Invoice Date <span>{{ Carbon::parse($data['transaksi']->tanggal)->format('d F Y') }}
                                        </span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="invoice-number mb-30">
                                        <h4 class="inv-title-1">Invoice To</h4>
                                        <h2 class="name mb-10">{{ $data['transaksi']->nama_users }}</h2>
                                        <p class="invo-addr-1">
                                            {{-- Theme Vessel <br/> --}}
                                            {{$data['transaksi']->email_users}} <br/>
                                            {{-- 21-12 Green Street, Meherpur, Bangladesh <br/> --}}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="invoice-number mb-30">
                                        <div class="invoice-number-inner">
                                            <h4 class="inv-title-1">Invoice From</h4>
                                            <h2 class="name mb-10">Admin</h2>
                                            <p class="invo-addr-1">
                                                ParaLux  <br/>
                                                ParaLux@apexo.com <br/>
                                                169 Teroghoria, Bangladesh <br/>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table mb-0 table-striped invoice-table">
                                    <thead class="bg-active">
                                    <tr class="tr">
                                        <th>No.</th>
                                        <th class="pl0 text-start">Produk</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['detail'] as $item)
                                        @php
                                            $nomer = 0;
                                            $total = $item->harga * $item->qty;
                                            // $subtotal += $total;
                                        @endphp
                                        <tr class="tr">
                                            <td>
                                                <div class="item-desc-1">
                                                    <span>{{ ++$nomer }}</span>
                                                </div>
                                            </td>
                                            <td class="pl0">{{$item->nama_produk}}</td>
                                            <td class="text-center">{{$item->harga}}</td>
                                            <td class="text-center">{{$item->qty}}</td>
                                            <td class="text-end">{{ $total }}</td>
                                        </tr>
    
                                        @endforeach
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">SubTotal</td>
                                            <td class="text-end">{{ $data['transaksi']->total_beli }}</td>
                                        </tr>
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">Tax</td>
                                            <td class="text-end">{{ $data['transaksi']->total_beli * 0.11 }}</td>
                                        </tr>
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center f-w-600 active-color">Grand Total</td>
                                            <td class="f-w-600 text-end active-color">{{ $data['transaksi']->pajak }}</td>
                                        </tr>
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center f-w-600 active-color">Payment</td>
                                            <td class="f-w-600 text-end active-color">{{ $data['transaksi']->total_bayar }}</td>
                                        </tr>
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center f-w-600 active-color">Return</td>
                                            <td class="f-w-600 text-end active-color">{{ $data['transaksi']->total_bayar - $data['transaksi']->pajak }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-bottom">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-7">
                                    <div class="mb-30 dear-client">
                                        <h3 class="inv-title-1">Terms & Conditions</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been typesetting industry. Lorem Ipsum</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-5">
                                    <div class="mb-30 payment-method">
                                        <h3 class="inv-title-1">Payment Method</h3>
                                        {{-- <ul class="payment-method-list-1 text-14">
                                            <li><strong>Account No:</strong> 00 123 647 840</li>
                                            <li><strong>Account Name:</strong> Jhon Doe</li>
                                            <li><strong>Branch Name:</strong> xyz</li>
                                        </ul> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-contact clearfix">
                            <div class="row g-0">
                                <div class="col-lg-9 col-md-11 col-sm-12">
                                    <div class="contact-info">
                                        <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +00 123 647 840</a>
                                        <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i> info@themevessel.com</a>
                                        <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> 169 Teroghoria, Bangladesh</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i> Print Invoice
                        </a>
                        <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                            <i class="fa fa-download"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Invoice 1 end -->

<script src="{{ asset('assets/pdf/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/pdf/js/jspdf.min.js') }}"></script>
<script src="{{ asset('assets/pdf/js/html2canvas.js') }}"></script>
<script src="{{ asset('assets/pdf/js/app.js') }}"></script>
{{-- <script>
    document.getElementById('invoice_download_btn').addEventListener('click', function() {
        window.location.href = '{{ route("downloadPDF", $data["transaksi"]->id) }}';
    });
</script> --}}
</body>
</html>
