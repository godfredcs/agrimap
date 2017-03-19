<!DOCTYPE html>
<html>
    <head>
       <title>Print Receipt</title>
       <link href="/css/bootstrap.min.css" rel="stylesheet">
       <style>
           #company-location-info{
               margin-left: font-size: 0.5em;
           }

           #remarks-section{
               margin-top: 30px;
               font-size: 0.9em;
               font-style: italic;
           }
       </style>
    </head>

    <body>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <div class="logo">
                            <div class="row">
                                <img src="/images/logo.png">
                            </div>

                            <div class="row" style="margin-bottom: 30px">
                                <div class="col-xs-12">
                                    <h3>&nbsp;&nbsp;Ezi Pharmacy</h3>
                                </div>

                                <div class="col-xs-12" id="company-location-info">
                                    <p>123 Street, Heaven's Gate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class=col-xs-12>
                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 50%">Reference ID:</td>
                                <td>Date</td>
                            </tr>

                            <tr>
                                <td>{{ $order->viewable_id }}</td>
                                <td>{{ date('jS F Y') }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 50%">Customer's Name:</td>
                                <td>{{ $order->customer_name }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr>
                              <th style="width: 50%">PRODUCT</th>
                              <th style="width: 25%">QUANTITY</th>
                              <th>SUBTOTAL</th>
                            </tr>

                            @foreach($order->details as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>GHS {{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 50%">TOTAL:</td>
                                <td>GHS {{ number_format($order->total, 2, '.', ',') }}</td>
                            </tr>

                            <tr>
                                <td>AMOUNT PAID:</td>
                                <td>GHS {{ number_format($order->amount_paid, 2, '.', ',') }}</td>
                            </tr>

                            <tr>
                                <td>CHANGE:</td>
                                <td>GHS {{ number_format(($order->amount_paid - $order->total), 2, '.', ',') }}</td>
                            </tr>
                        </table>

                        <p id="remarks-section">
                        Thank you for patronising Ezi Pharmacy.Your health is our concern.We hope you
                        follow the recommended dosage regimes and we wish you speedy recovery.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>