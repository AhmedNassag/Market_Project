<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ٌReceipt</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>

<body onload="window.print()" >
    <div style="padding:5px">
        <div id="showScroll" class="container">
            <div class="receipt">

                <!-- <div style="margin-bottom: -15px; margin:7px;">
                    <p class="text-left">Donations are not refundable</p>
                    <p class="text-left" style="width: 100%">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
                </div> -->


                <div class="logo text-center" style="border:0.5pxsolid">
                    <!-- <div></div> -->
                    <img src="{{ asset('logo3.png') }}" width="100%" height="130px" />
                </div>

                <!-- <div class="head-notes">
                    <p class="text-center">احتفظ بالإيصال 30 يوم للإسترجاع أو التبديل</p>
                    <p class="text-center">للأغذية الطازجة الإسترجاع خلال 24 ساعة</p>
                </div> -->

                <div class="receipt-bdy" style="padding:5px; margin-top:-7px">
                    <p class="monospace text-left ">Keep rcpt for refund/exchange </p>
                    <p class="monospace text-left" style="margin-top:-7px">1 day fresh food, 30 days others</p>
                </div>

                <div class="products" style="margin-top:-27px">
                    <div class="product-item">
                        <table width="100%" style="border: 0;">
                            @foreach ($transaction->transaction_details as $transaction_detail)
                                <p class="product-code text-left monospace">{{ $transaction_detail->product->code }}</p>
                                <p class="product-container monospace">
                                    @if($transaction_detail->qty > 1)
                                        <span class="weight text-left" style="width:5%; margin:0;">{{ $transaction_detail->qty }}*{{ $transaction_detail->base_price }}</span>
                                    @else
                                        <span class="weight text-left" style="width:5%; margin:0;"></span>
                                    @endif
                                    <span style="width:10%;"></span>
                                    <span class="product-name text-left" style="width:35%;">{{ $transaction_detail->name }}</span>
                                    <span class="product-price text-left" style="width:20%; margin-left:-50px">{{ $transaction_detail->qty * $transaction_detail->base_price }}</span>
                                    <span style="width:30%;"></span>
                                </p>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="prices" style="padding:5px;">
                    <p style="margin-bottom: 3px; margin-top:-25px">
                        <span class="stars monospace text-left">****</span>
                        <span class="monospace" style="position: relative;left: 30px; font-weight: bold;color: #000;font-size: 16px;">TOT</span>
                        <span class="" style="position: relative;left: 10px; font-size:12px; font-family: inherit;">{{ $transaction->total_price }}</span>
                    </p>

                    <p style="margin-top: 2px; margin-bottom: 3px">
                        <span class="monospace"></span>
                        <span class="stars monospace" style="position: relative;right: 30px;font-size:12px">Cash</span>
                        <span class="" style="position: relative;left: 10px; font-size:12px; font-family: inherit;">{{ $transaction->accept }}</span>
                    </p>

                    <p style="margin-top: 2px">
                        <span class="monospace"></span>
                        <span class="stars monospace" style="position: relative;right: 30px;font-size:12px">CHANGE</span>
                        <span class="" style="position: relative;left: 10px; font-size:12px; font-family: inherit;">{{ $transaction->return }}</span>
                    </p>

                </div>

                <?php
                    $v = mt_rand(100,999);
                    // $x = mt_rand(10,99);
                    $x  = array_map('intval', str_split($transaction->transaction_code));
                ?>

                <div class="receipt-info" style="padding:5px">
                    <p>served by : <span class="name-res" style="font-family: 'VCR OSD Mono';">{{ strtoupper(auth()->user()->name) }}</span></p>
                    <p>Total Number of Items Sold = <span class="number-of-items">{{ $transaction->transaction_details->count() }}</span></p>
                    <p class="monospace" style="font-family: 'Arial';">
                        {{ $transaction->created_at->format('d/m/y') }} &nbsp;{{ $transaction->created_at->format('H:i') }}
                        <span style="padding:5px; font-family: 'Arial';">{{ $transaction->transaction_code[0] }}{{ $transaction->transaction_code[2] }}&nbsp;{{ $transaction->id }}</span>
                    </p>
                    <p class="invoice-num">INVOICE NO: </p>
                    <!-- <td>
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($transaction->transaction_code, 'C39', 1, 33, [1, 1, 1], true) }}" alt="{{ $transaction->transaction_code }}" width="100" height="40">
                    </td> -->
                </div>

                <div class="barcode" style="padding:5px;font-family: 'inherit';">
                    <img class="text-center"
                        src="data:image/png;base64,{{ DNS1D::getBarcodePNG($transaction->transaction_code, 'C39', 1, 33, [1, 1, 1], true) }}"
                        alt="{{ $transaction->transaction_code }}" width="80%" height="50"
                    >
                </div>

                <div class="receipt-footer" style="padding:5px">
                    <p style="margin:3px;font-size:13px; font-family: 'Arial';letter-spacing:2px;">Prices  Include VAT</p>
                    <p style="margin:3px;font-size:13px; font-family: 'Arial';letter-spacing:2px;">On Subjected Items Only</p>
                    <p style="margin:3px;color:#000;font-weight: 900;font-size:13px; font-family: 'Arial';letter-spacing:1px;" class="taxation">Tax card number <span class="tax-number">200 - 185 - 128</span></p>
                    <p style="margin:3px;color:#000;font-weight: 900;font-size:13px; font-family: 'VCR OSD Mono';" class="receipt-end">Brought to you by <span class="someone">MAJID AL FUTTAIM </span></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
