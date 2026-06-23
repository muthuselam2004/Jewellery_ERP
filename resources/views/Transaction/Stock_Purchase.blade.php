@extends('layouts.app')

@section('content')

    <div class="main-container">

        <div class="container-fluid py-4">

            <input type="hidden" id="Page_Name" value="Sales_Details_Page">

            <form id="SalesForm" action="{{ url('/save-sales-details') }}" method="POST">

                @csrf

                <!-- ===================================== -->
                <!-- TOP CARD -->   
                <!-- ===================================== -->

                <div class="custom-report-card">

                    <div class="report-header">
                        <h3>Sales Entry</h3>
                    </div>

                    <div class="report-body">

                        <div class="row g-4">

                            <div class="col-md-3">
                                <label class="form-label">Barcode Number</label>

                                <input type="text" class="form-control custom-input" id="barcode_number"
                                    name="barcode_number">
                            </div>

                            <div class="col-md-3">

                                <button type="button" class="btn btn-view w-25" id="view_btn">

                                    View

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ===================================== -->
                <!-- TABLE CARD -->
                <!-- ===================================== -->

                <div class="card mt-3" id="table_card" style="display:none;">

                    <div class="card-body px-5">

                        <table class="table table-bordered" id="data_table">

                            <thead>

                                <tr>
                                    <th>S.No</th>
                                    <th>Inward Date</th>
                                    <th>Supplier Name</th>
                                    <th>Metal Name</th>
                                    <th>Metal Type</th>
                                    <th>Manufacturing Type</th>
                                    <th>Product Type</th>
                                    <th>Item Name</th>
                                    <th>Purity</th>
                                    <th>Gram</th>
                                    <th>Amount</th>
                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                    </div>

                    <!-- ===================================== -->
                    <!-- FORM DETAILS -->
                    <!-- ===================================== -->

                    <div class="report-body">

                        <div class="row g-4">

                            <!-- DATE -->
                            <div class="col-md-3">

                                <label>Invoice No</label>

                                <input type="text" class="form-control custom-input" id="invoice_no" name="invoice_no"
                                    value="{{ $invoiceNo }}" readonly>

                            </div>

                            <div class="col-md-3">

                                <label>Current Date</label>

                                <input type="date" name="inward_date" class="form-control custom-input"
                                    value="{{ date('Y-m-d') }}" required>

                            </div>

                            <!-- CURRENT RATE -->

                            <div class="col-md-3">

                                <label>Current Rate</label>

                                <input type="text" class="form-control custom-input" id="current_rate" name="current_rate"
                                    readonly>

                            </div>

                            <!-- HIDDEN FIELDS -->

                            <input type="hidden" id="category_name" name="category_name">

                            <input type="hidden" id="category_type" name="category_type">

                            <input type="hidden" id="manufacturing_type" name="manufacturing_type">

                            <input type="hidden" id="product_type" name="product_type">

                            <input type="hidden" id="stock_amount" name="stock_amount">

                            <!-- ITEM -->

                            <div class="col-md-3">

                                <label>Item</label>

                                <input type="text" class="form-control custom-input" id="item_name" name="item_name"
                                    readonly>

                            </div>

                            <!-- GROSS WEIGHT -->

                            <div class="col-md-3">

                                <label>Gross Weight</label>

                                <input type="text" class="form-control custom-input" id="gross_weight" name="gross_weight"
                                    readonly>

                            </div>

                            <!-- STONE WEIGHT -->

                            <div class="col-md-3">

                                <label>Stone Weight</label>

                                <input type="text" class="form-control custom-input" id="stone_weight" name="stone_weight"
                                    readonly>

                            </div>

                            <!-- NET WEIGHT -->

                            <div class="col-md-3">

                                <label>Net Weight</label>

                                <input type="text" class="form-control custom-input" id="net_weight" name="net_weight"
                                    readonly>

                            </div>

                            <!-- PURITY TYPE -->

                            <div class="col-md-3">

                                <label>Purity Type</label>

                                <input type="text" class="form-control custom-input" id="purity_type" name="purity_type"
                                    readonly>

                            </div>

                            <!-- PURITY -->

                            <div class="col-md-3">

                                <label>Purity</label>

                                <input type="text" class="form-control custom-input" id="purity" name="purity" readonly>

                            </div>

                            <!-- QUANTITY -->

                            <div class="col-md-3">

                                <label>Quantity</label>

                                <input type="text" class="form-control custom-input" id="quantity" name="quantity" readonly>

                            </div>

                            <!-- WASTAGE -->

                            <div class="col-md-3">

                                <label>Wastage</label>

                                <input type="text" class="form-control custom-input" id="wastage" name="wastage">

                            </div>

                            <!-- MAKING CHARGES -->

                            <div class="col-md-3">

                                <label>Making Charges</label>

                                <input type="text" class="form-control custom-input" id="making_charges"
                                    name="making_charges">

                            </div>

                            <!-- RATE -->

                            <div class="col-md-3">

                                <label>Rate</label>

                                <input type="text" class="form-control custom-input" id="gram" name="gram" readonly>

                            </div>

                            <!-- GST -->

                            <div class="col-md-3">

                                <label>GST</label>

                                <input type="text" class="form-control custom-input" id="gst" name="gst" readonly>

                            </div>

                            <!-- CGST -->

                            <div class="col-md-3">

                                <label>CGST</label>

                                <input type="text" class="form-control custom-input" id="cgst" name="cgst" readonly>

                            </div>

                            <!-- SGST -->

                            <div class="col-md-3">

                                <label>SGST</label>

                                <input type="text" class="form-control custom-input" id="sgst" name="sgst" readonly>

                            </div>

                            <!-- TOTAL AMOUNT -->

                            <div class="col-md-3">

                                <label>Total Amount</label>

                                <input type="text" class="form-control custom-input" id="amount" name="amount" readonly>

                            </div>

                            <div class="col-md-3">
                                <label class="d-block">Exchange Type</label>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="exchange_checkbox"
                                        name="exchange_checkbox" value="Old Ornaments">
                                    <label class="form-check-label" for="exchange_checkbox">
                                        Old Ornaments
                                    </label>
                                </div>
                            </div>

                            <div class="row g-4 exchange-fields" style="display:none;">

                                <div class="col-md-3">
                                    <label>Category</label>

                                    <select name="items[0][category_name]" class="form-control select2" id="metal_type">

                                        <option value="">Select Category</option>

                                    </select>
                                </div>

                                <div class="col-md-3">

                                    <label>Purity Type</label>

                                    <select name="items[0][display_purity_type]" id="display_purity_type"
                                        class="form-control select2">

                                        <option value="">Select</option>

                                    </select>

                                </div>

                                <div class="col-md-3">

                                    <label>Purity</label>

                                    <input type="text" name="items[0][Purity]" id="display_purity" class="form-control"
                                        readonly>

                                </div>

                                <div class="col-md-3">

                                    <label>Net Weight</label>

                                    <input type="text" class="form-control custom-input" id="exchange_net_weight"
                                        name="exchange_net_weight">

                                </div>

                                <div class="col-md-3">

                                    <label>Total Amount</label>

                                    <input type="text" class="form-control custom-input" id="exchange_amount"
                                        name="exchange_amount">

                                </div>

                                <div class="col-md-3">

                                    <label>Payment Amount</label>

                                    <input type="text" class="form-control custom-input" id="final_pay_amount"
                                        name="final_pay_amount" readonly>

                                </div>

                            </div>


                            <div class="col-md-3">

                                <button type="button" class="btn btn-view w-50" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal">

                                    Confirm

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- CONFIRM MODAL -->

                <div class="modal fade" id="confirmModal" tabindex="-1">

                    <div class="modal-dialog modal-dialog-centered modal-xl">

                        <div class="modal-content">

                            <!-- HEADER -->

                            <div class="modal-header bg-dark text-white">

                                <h5 class="modal-title">

                                    Customer & Payment Details

                                </h5>

                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">

                                </button>

                            </div>

                            <!-- BODY -->

                            <div class="modal-body">

                                <div class="row g-4">

                                    <!-- CUSTOMER DETAILS -->

                                    <div class="col-12">

                                        <h6 class="fw-bold text-primary">

                                            Customer Details

                                        </h6>

                                    </div>

                                    <!-- NAME -->

                                    <div class="col-md-4">

                                        <label>Customer Name</label>

                                        <input type="text" class="form-control" name="customer_name">

                                    </div>

                                    <!-- MOBILE -->

                                    <div class="col-md-4">

                                        <label>Mobile Number</label>

                                        <input type="text" class="form-control" name="customer_mobile">

                                    </div>

                                    <!-- ADDRESS -->

                                    <div class="col-md-4">

                                        <label>Address</label>

                                        <textarea class="form-control" name="customer_address" rows="1"></textarea>

                                    </div>

                                    <!-- PAYMENT DETAILS -->

                                    <div class="col-12 mt-4">

                                        <h6 class="fw-bold text-success">

                                            Payment Details

                                        </h6>

                                    </div>

                                    <div class="col-md-3">

                                        <label>Payment Mode</label>

                                        <select class="form-control" id="payment_mode" name="payment_mode">

                                            <option value="">Select</option>

                                            <option value="Cash">Cash</option>

                                            <option value="Card">Card</option>

                                            <option value="UPI">UPI</option>

                                            <option value="Bank Transfer">Bank Transfer</option>

                                            <option value="Cheque">Cheque</option>

                                        </select>

                                    </div>

                                    <!-- CASH FIELDS -->

                                    <div class="row mt-2 payment-section" id="cash_fields" style="display:none;">

                                        <div class="col-md-4">

                                            <label>Received By</label>

                                            <input type="text" class="form-control" name="cash_received_by">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Payment Date</label>

                                            <input type="date" class="form-control" name="inward_date">

                                        </div>

                                    </div>



                                    <!-- CARD FIELDS -->

                                    <div class="row mt-2 payment-section" id="card_fields" style="display:none;">

                                        <div class="col-md-4">

                                            <label>Card Type</label>

                                            <select class="form-control" name="card_type">

                                                <option value="">Select</option>

                                                <option value="Credit Card">Credit Card</option>

                                                <option value="Debit Card">Debit Card</option>

                                            </select>

                                        </div>

                                        <div class="col-md-4">

                                            <label>Last 4 Digits</label>

                                            <input type="text" class="form-control" name="card_number">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Transaction ID</label>

                                            <input type="text" class="form-control" name="transaction_id">

                                        </div>

                                    </div>


                                    <!-- UPI FIELDS -->

                                    <div class="row mt-2 payment-section" id="upi_fields" style="display:none;">

                                        <div class="col-md-4">

                                            <label>UPI App Name</label>

                                            <select class="form-control" name="UPI_Mode">

                                                <option value="">Select</option>

                                                <option value="Google Pay">Google Pay</option>

                                                <option value="PhonePe">PhonePe</option>

                                                <option value="Paytm">Paytm</option>

                                                <option value="BHIM">BHIM</option>

                                            </select>

                                        </div>

                                        <div class="col-md-4">

                                            <label>UPI Transaction ID</label>

                                            <input type="text" class="form-control" name="transaction_id">

                                        </div>

                                        <div class="col-md-4">

                                            <label>UPI ID</label>

                                            <input type="text" class="form-control" name="upi_id">

                                        </div>

                                    </div>



                                    <!-- BANK TRANSFER FIELDS -->

                                    <div class="row mt-2 payment-section" id="bank_fields" style="display:none;">

                                        <div class="col-md-4">

                                            <label>Bank Name</label>

                                            <input type="text" class="form-control" name="bank_name">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Account Number</label>

                                            <input type="text" class="form-control" name="account_number">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Transaction Reference Number</label>

                                            <input type="text" class="form-control" name="transaction_ref_no">

                                        </div>

                                    </div>



                                    <!-- CHEQUE FIELDS -->

                                    <div class="row mt-2 payment-section" id="cheque_fields" style="display:none;">

                                        <div class="col-md-4">

                                            <label>Bank Name</label>

                                            <input type="text" class="form-control" name="bank_name">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Cheque Number</label>

                                            <input type="text" class="form-control" name="cheque_number">

                                        </div>

                                        <div class="col-md-4">

                                            <label>Cheque Date</label>

                                            <input type="date" class="form-control" name="cheque_date">

                                        </div>

                                    </div>

                                    <!-- PAYMENT TYPE -->

                                    <div class="col-md-4">

                                        <label>Payment Type</label>

                                        <select class="form-control" id="payment_type" name="payment_type">

                                            <option value="Full Payment">

                                                Full Payment

                                            </option>

                                            <option value="Partial Payment">

                                                Partial Payment

                                            </option>

                                        </select>

                                    </div>

                                    <!-- PAID AMOUNT -->

                                    <div class="col-md-4" id="advance_amount_div" style="display:none;">

                                        <label>Advance Amount</label>

                                        <input type="text" class="form-control" id="paid_amount" name="paid_amount">

                                    </div>

                                    <!-- BALANCE -->

                                    <div class="col-md-4">

                                        <label>Balance Amount</label>

                                        <input type="text" class="form-control" id="balance_amount" name="pending_amount"
                                            readonly>

                                    </div>

                                </div>

                            </div>

                            <!-- FOOTER -->

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                    Close

                                </button>

                                <button type="submit" class="btn btn-success">

                                    Save

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <style>
        body {
            background: #eef2f7;
            overflow-x: hidden;
        }

        .custom-report-card {
            background: #fff;
            border-radius: 0px;
            overflow: hidden;
            box-shadow: none;
            border: 1px solid #dbe1ea;
        }

        .report-header {
            background: linear-gradient(90deg, #b8860b, #ffd700, #caa100);
            padding: 8px;
            text-align: center;
        }

        .report-header h3 {
            color: #000000;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .report-body {
            padding: 16px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #111827;
        }

        .custom-input {
            height: 34px !important;
            border-radius: 0px !important;
            border: 1px solid #cfd6dd !important;
            font-size: 13px;
            box-shadow: none !important;
        }

        .custom-input:focus {
            border-color: #3d2bff !important;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
            border-radius: 0px !important;
            border: 1px solid #cfd6dd !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 34px !important;
            font-size: 13px;
            padding-left: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 34px !important;
        }

        .custom-select {
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
            border: 1px solid #cfd6dd !important;
            border-radius: 0px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 34px !important;
        }

        .btn-view {
            background: #28a745;
            color: #fff;
            height: 34px;
            border: none;
            border-radius: 0px;
            font-size: 13px;
            font-weight: 600;
            padding: 0 10px;
            margin-top: 25px;
        }

        .btn-view:hover {
            background: #218838;
            color: #fff;
        }

        .custom-table-card {
            background: #fff;
            border-radius: 0px;
            padding: 14px;
            margin-top: 15px;
            border: 1px solid #dbe1ea;
            box-shadow: none;
        }

        .custom-table {
            margin-bottom: 0;
        }

        .custom-table thead th {
            background: #f8fafc;
            padding: 10px;
            font-size: 13px;
            font-weight: 700;
            border: 1px solid #dbe1ea;
            white-space: nowrap;
        }

        .custom-table tbody td {
            padding: 10px;
            font-size: 13px;
            border: 1px solid #e5e7eb;
        }
    </style>

    @push('scripts')

        <script>
            $('.select2').select2({
                width: '100%'
            });

            $(document).on('change', '#exchange_checkbox', function () {

                if ($(this).is(':checked')) {

                    $('.exchange-fields').show();

                } else {

                    $('.exchange-fields').hide();

                }

            });

            $(document).on('change', '#payment_type', function () {

                let paymentType = $(this).val();

                
                let finalPay =
                    parseFloat($('#final_pay_amount').val()) || 0;

                if (paymentType == 'Partial Payment') {

                    $('#advance_amount_div').show();

                    
                    $('#balance_amount').val(
                        finalPay.toFixed(2)
                    );

                } else {

                    $('#advance_amount_div').hide();

                    $('#paid_amount').val('');

                    
                    $('#balance_amount').val(
                        finalPay.toFixed(2)
                    );
                }

            });

            $(document).on('input', '#paid_amount', function () {

                
                let totalBalance =
                    parseFloat($('#final_pay_amount').val()) || 0;

                
                let advance =
                    parseFloat($(this).val()) || 0;
                
                let remaining =
                    totalBalance - advance;

                if (remaining < 0) {

                    remaining = 0;
                }

                $('#balance_amount').val(
                    remaining.toFixed(2)
                );

            });

            $(document).on('change', '#payment_mode', function () {

                $('.payment-section').hide();

                let paymentMode = $(this).val();

                if (paymentMode == 'Cash') {

                    $('#cash_fields').show();

                }

                else if (paymentMode == 'Card') {

                    $('#card_fields').show();

                }

                else if (paymentMode == 'UPI') {

                    $('#upi_fields').show();

                }

                else if (paymentMode == 'Bank Transfer') {

                    $('#bank_fields').show();

                }

                else if (paymentMode == 'Cheque') {

                    $('#cheque_fields').show();

                }

            });

        </script>

        <script>
            var Page_Name = "Sales_Details_Page";
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @endpush

@endsection