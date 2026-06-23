<!DOCTYPE html>
<html>

<head>

    <title>Jewellery Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        .invoice-box {
            border: 2px solid #000;
            padding: 20px;
        }

        .company-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-header h1 {
            margin: 0;
            font-size: 32px;
        }

        .company-header p {
            margin: 3px 0;
            font-size: 14px;
        }

        .top-section {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .top-section td {
            vertical-align: top;
            padding: 5px;
        }

        .customer-box,
        .invoice-box-right {
            border: 1px solid #000;
            padding: 10px;
            height: 120px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .product-table th {
            background: #f2f2f2;
        }

        .summary-table {
            width: 350px;
            float: right;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .summary-table td {
            border: 1px solid #000;
            padding: 10px;
        }

        .summary-table .label {
            font-weight: bold;
        }

        .footer {
            clear: both;
            margin-top: 100px;
        }

        .signature {
            width: 250px;
            float: right;
            text-align: center;
        }

        .signature p {
            margin-top: 60px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        @media print {
            body {
                padding: 0;
            }

            .invoice-box {
                border: none;
            }
        }
    </style>

</head>

<body onload="window.print()">

    <div class="invoice-box">

        <div class="company-header">

            <h1>JEWELLERY SHOP</h1>

            <p>No 10, Tiruppur Main Road, Tiruppur</p>

            <p>Mobile : 8680902097</p>

            <p>GST No : 33ABCDE1234F1Z5</p>

        </div>

        <table class="top-section">

            <tr>

                <td width="60%">

                    <div class="customer-box">

                        <div class="section-title">
                            Customer Details
                        </div>

                        <p>
                            <b>Name :</b>
                            {{ $payment->Customer_Name }}
                        </p>

                        <p>
                            <b>Mobile :</b>
                            {{ $payment->Customer_Mobile }}
                        </p>

                        <p>
                            <b>Address :</b>
                            {{ $payment->Customer_Address }}
                        </p>

                    </div>

                </td>

                <td width="40%">

                    <div class="invoice-box-right">

                        <p>
                            <b>Invoice No :</b>
                            {{ $payment->Invoice_No }}
                        </p>

                        <p>
                            <b>Date :</b>
                            {{ date('d-m-Y', strtotime($payment->Date)) }}
                        </p>

                        <p>
                            <b>Payment Mode :</b>
                            {{ $payment->Payment_Mode }}
                        </p>

                        <p>
                            <b>Status :</b>
                            {{ $payment->Payment_Status }}
                        </p>

                    </div>

                </td>

            </tr>

        </table>

        <!-- PRODUCT TABLE -->
        <table class="product-table">

            <thead>

                <tr>

                    <th>S.No</th>
                    <th>Product</th>
                    <th>Purity</th>
                    <th>Gross WT</th>
                    <th>Stone WT</th>
                    <th>Net WT</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Making Charge</th>
                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1</td>

                    <td>{{ $payment->Product_Type }}</td>

                    <td>{{ $payment->Purity }}</td>

                    <td>{{ $payment->Gross_Weight }}</td>

                    <td>{{ $payment->Stone_Weight }}</td>

                    <td>{{ $payment->Net_Weight }}</td>

                    <td>{{ $payment->Quantity }}</td>

                    <td>₹ {{ number_format($payment->Rate, 2) }}</td>

                    <td>₹ {{ number_format($payment->Making_Charges, 2) }}</td>

                    <td>
                        ₹ {{ number_format($payment->Total_Amount, 2) }}
                    </td>

                </tr>

            </tbody>

        </table>

        <!-- GST SUMMARY -->
        <table class="summary-table">

            <tr>

                <td class="label">GST</td>

                <td>{{ $payment->GST }}</td>

            </tr>

            <tr>

                <td class="label">CGST</td>

                <td>{{ $payment->CGST }}</td>

            </tr>

            <tr>

                <td class="label">SGST</td>

                <td>{{ $payment->SGST }}</td>

            </tr>

            <tr>

                <td class="label">Grand Total</td>

                <td>
                    <b>
                        ₹ {{ number_format($payment->Total_Amount, 2) }}
                    </b>
                </td>

            </tr>

        </table>

        <!-- FOOTER -->
        <div class="footer">

            <div class="signature">

                <p>Authorized Signature</p>

            </div>

        </div>

    </div>

</body>

</html>