@extends('layouts.app')

@section('content')
    <style>
        .custom-header {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            text-align: center;
            padding: 15px;
            border-bottom: none;
        }

        .custom-header h5 {
            margin: 0;
            width: 100%;
            text-align: center;
            font-weight: 600;
        }

        .btn-back {
            background: #e3f2fd;
            color: #0d47a1;
            border: 1px solid #bbdefb;
        }

        .btn-back:hover {
            background: #bbdefb;
            color: #0d47a1;
        }

        /* .custom-header {
                                                                        background: #f2c200 !important;
                                                                    }

                                                                    .card {
                                                                        background: #fff5cc !important;
                                                                        border: 1px solid #e6d48f;
                                                                    } */


        .btn-save {
            background: linear-gradient(135deg, #d4af37, #ffd700);
            color: #4e342e;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.4);
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #c5a100, #ffcc00);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(212, 175, 55, 0.6);
        }


        .btn-reset {
            background: linear-gradient(135deg, #bdc3c7, #ecf0f1);
            color: #2c3e50;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: linear-gradient(135deg, #a6acaf, #d5dbdb);
        }


        .btn-back {
            background: linear-gradient(135deg, #90caf9, #42a5f5);
            color: #0d47a1;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #64b5f6, #1e88e5);
        }


        /* .form-control,
                                                                    .form-select {
                                                                        background-color: #ffffff !important;
                                                                        border: 1px solid #e6d48f;
                                                                        border-radius: 6px;
                                                                        box-shadow: none;
                                                                        transition: all 0.3s ease;
                                                                    }


                                                                    .form-control::placeholder {
                                                                        color: #999;
                                                                    }

                                                                    .form-control:focus,
                                                                    .form-select:focus {
                                                                        border-color: #d4af37;
                                                                        box-shadow: 0 0 6px rgba(212, 175, 55, 0.5);
                                                                        background-color: #fffdf5;
                                                                    }

                                                                    .form-control:disabled {
                                                                        background-color: #f5f5f5;
                                                                    }

                                                                    label {
                                                                        font-weight: 500;
                                                                        color: #5c4b00;
                                                                    } */

        .file-modern {
            position: relative;
            border: 1px solid #e6d48f;
            border-radius: 8px;
            background: #fffdf5;
            height: 38px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }


        .file-modern:hover {
            border-color: #ffffff;
            box-shadow: 0 0 6px rgba(212, 175, 55, 0.4);
        }

        .file-modern input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }


        .file-text {
            color: #8a6d00;
            font-size: 14px;
        }

        .file-modern input[type="file"]:valid+.file-text {
            color: #4e342e;
            font-weight: 500;
        }
    </style>
    <div class="container-fluid px-4 py-4">
        <div class="card shadow-sm border-0 rounded-3">

            <input type="hidden" id="Page_Name" value="Stock_Inward_Page">


            <div class="card-header custom-header">
                <h5 class="mb-0">Stock Inward</h5>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('Save_Stock_Inward') }}" id="stockInwardForm">
                    @csrf

                    <div class="row g-4 mb-5">

                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Inward No</label>
                                    <input type="text" name="inward_no" class="form-control" value="{{ $inward_no }}"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Inward Date</label>
                                    <input type="date" name="inward_date" class="form-control" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label>Supplier ID</label>
                                    <select id="supplier_id" name="supplier_code" class="form-control select2">
                                        <option value="">Select Supplier</option>
                                        @foreach($suppliers as $sup)
                                            <option value="{{ $sup->Supplier_Code }}">
                                                {{ $sup->Supplier_Code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label>Supplier Name</label>
                                    <input type="text" id="supplier_name" name="supplier_name" class="form-control"
                                        placeholder="Supplier Name" readonly>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Invoice No</label>
                                    <input type="text" name="invoice_no" class="form-control" value="{{ $invoice_no }}"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Location</label>
                                    <select name="location" class="form-control select2">
                                        <option>Shelf-1</option>
                                        <option>Shelf-2</option>
                                        <option>Shelf-3</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label>Category</label>
                            <select name="items[0][category_name]" class="form-control select2" id="metal_type">
                                <option value="">Select Category</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Category Type</label>
                            <select name="items[0][category_type]" class="form-control select2" id="category_type">
                                <option value="">Select Type</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Manufacturing</label>
                            <select name="items[0][manufacturing_type]" class="form-control select2"
                                id="manufacturing_type">
                                <option value="">Select Manufacturing</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Product Type</label>
                            <select name="items[0][product_type]" class="form-control select2" id="product_type">
                                <option value="">Select Product</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Item</label>
                            <select name="items[0][item_name]" class="form-control select2">
                                <option value="">Select Item</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Gross Weight</label>
                            <input type="number" step="0.001" name="items[0][gross_weight]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label>Stone Weight</label>
                            <input type="number" step="0.001" name="items[0][stone_weight]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label>Net Weight</label>
                            <input type="number" step="0.001" name="items[0][net_weight]" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Purity Type</label>
                            <select name="items[0][purity_type]" id="purity_type" class="form-control select2">
                                <option value="">Select</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Purity</label>
                            <input type="text" name="items[0][Purity]" id="purity" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Rate</label>
                            <input type="number" name="items[0][rate]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label>Wastage%</label>
                            <input type="number" name="items[0][wastage]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label>Making Charges</label>
                            <input type="number" name="items[0][making_charges]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label>Qty</label>
                            <input type="number" value="1" name="items[0][qty]" class="form-control calc">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">GST</label>

                            <input type="text" class="form-control custom-input" id="gst" name="items[0][gst]" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">SGST</label>

                            <input type="text" class="form-control custom-input" id="sgst" name="items[0][sgst]" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">CGST</label>

                            <input type="text" class="form-control custom-input" id="cgst" name="items[0][cgst]" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Total Amount</label>
                            <input type="text" name="items[0][amount]" class="form-control amount" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Upload Image</label>

                            <div class="file-modern">
                                <input type="file" name="items[0][jewellery_image]" accept="image/*">
                                <span class="file-text">Click to upload image</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>QC</label>
                            <select name="items[0][qc]" class="form-control select2">
                                <option value="">Select</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Hold">Hold</option>
                            </select>
                        </div>


                        <div class="col-md-3" id="barcode_section" style="display:none;">
                            <label>Barcode Number</label>
                            <input type="text" id="barcode_number_input" class="form-control" readonly>
                        </div>

                        <div class="col-md-3" id="barcode_img_section" style="display:none;">
                            <label>Barcode</label><br>
                            <img id="barcode_img" style="height:80px;
                            width:80px;
                            border:1px solid #ccc;
                            padding:5px;" alt="QR Code">


                            <input type="hidden" id="barcode_hidden" name="items[0][bar_code]">
                            <input type="hidden" id="barcode_number_hidden" name="items[0][bar_code_number]">



                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-save">
                                <i class="fas fa-save me-1"></i> Save Inward
                            </button>
                            <button type="reset" class="btn btn-reset">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                            <button type="button" class="btn btn-back"
                                onclick="window.location.href='{{ route('Stock.Stock_Inward') }}'">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </button>
                        </div>
                </form>

                @push('scripts')

                    @push('scripts')

                        <script>
                            var Page_Name = "Stock_Inward_Page";
                        </script>

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>

                            $(document).ready(function () {

                                // =========================================
                                // SUPPLIER FETCH
                                // =========================================

                                let supplierCode = '';

                                $('#supplier_id').on('select2:select', function (e) {

                                    supplierCode = e.params.data.id;

                                    if (supplierCode !== '') {

                                        fetch(`/get-supplier?supplier_code=${supplierCode}`)
                                            .then(response => response.json())
                                            .then(data => {

                                                if (data.length > 0) {

                                                    $('#supplier_name').val(data[0].Supplier_Name);

                                                } else {

                                                    $('#supplier_name').val('');
                                                }

                                            });

                                    } else {

                                        $('#supplier_name').val('');
                                    }

                                });

                                // =========================================
                                // BARCODE GENERATE
                                // =========================================

                                // =========================================
                                // QR CODE GENERATE
                                // =========================================

                                $('select[name="items[0][qc]"]').on('change', function () {

                                    let qcValue = $(this).val();

                                    if (qcValue === 'Approved') {

                                        // ✅ Small 4 digit random
                                        let randomNo =
                                            Math.floor(1000 + Math.random() * 9000);

                                        // ✅ Final QR Number
                                        let barcodeNumber =
                                            'JW' + randomNo;

                                        $('#barcode_number_input')
                                            .val(barcodeNumber);

                                        $('#barcode_number_hidden')
                                            .val(barcodeNumber);

                                        $('#barcode_hidden')
                                            .val(barcodeNumber);

                                        // ✅ QR IMAGE
                                        $('#barcode_img')
                                            .attr(
                                                'src',
                                                '/generate-barcode/' + barcodeNumber
                                            )
                                            .show();

                                        $('#barcode_section').show();

                                        $('#barcode_img_section').show();

                                    } else {

                                        $('#barcode_section').hide();

                                        $('#barcode_img_section').hide();

                                        $('#barcode_number_input').val('');

                                        $('#barcode_hidden').val('');

                                        $('#barcode_number_hidden').val('');

                                        $('#barcode_img').attr('src', '');

                                    }

                                });

                            });


                            // =========================================
                            // MAIN CALCULATION
                            // =========================================

                            $(document).on('input change', '.calc, #metal_type, #gst, #sgst, #cgst', function () {

                                // =========================================
                                // BASIC VALUES
                                // =========================================

                                let gross =
                                    parseFloat($('[name="items[0][gross_weight]"]').val()) || 0;

                                let stone =
                                    parseFloat($('[name="items[0][stone_weight]"]').val()) || 0;

                                let wastage =
                                    parseFloat($('[name="items[0][wastage]"]').val()) || 0;

                                let making =
                                    parseFloat($('[name="items[0][making_charges]"]').val()) || 0;

                                let qty =
                                    parseFloat($('[name="items[0][qty]"]').val()) || 1;

                                // =========================================
                                // NET WEIGHT
                                // =========================================

                                let net = gross - stone;

                                if (net < 0) {
                                    net = 0;
                                }

                                $('[name="items[0][net_weight]"]')
                                    .val(net.toFixed(3));

                                // =========================================
                                // RATE INPUT
                                // =========================================

                                let enteredRate =
                                    parseFloat($('[name="items[0][rate]"]').val()) || 0;

                                // =========================================
                                // METAL TYPE
                                // =========================================

                                let metal =
                                    $('#metal_type option:selected').text().trim();

                                // =========================================
                                // FINAL RATE
                                // =========================================

                                let finalRate = 0;

                                // GOLD
                                if (metal === "Gold") {

                                    finalRate = enteredRate * 8;
                                }

                                // SILVER
                                else if (metal === "Silver") {

                                    finalRate = enteredRate * 1000;
                                }

                                // PLATINUM
                                else if (metal === "Platinum") {

                                    finalRate = enteredRate * 10;
                                }

                                // DIAMOND
                                else if (metal === "Diamond") {

                                    finalRate = enteredRate;
                                }

                                // OTHER
                                else {

                                    finalRate = enteredRate;
                                }

                                // =========================================
                                // WASTAGE CALCULATION
                                // =========================================

                                let wastageWeight =
                                    net * (wastage / 100);

                                let totalWeight =
                                    net + wastageWeight;

                                // =========================================
                                // METAL AMOUNT
                                // =========================================

                                let metalAmount =
                                    totalWeight * finalRate;

                                // =========================================
                                // SUBTOTAL
                                // =========================================

                                let subtotal =
                                    metalAmount + making;

                                // =========================================
                                // GST VALUES
                                // =========================================

                                let gst =
                                    parseFloat($('#gst').val()) || 0;

                                let sgst =
                                    parseFloat($('#sgst').val()) || 0;

                                let cgst =
                                    parseFloat($('#cgst').val()) || 0;

                                // =========================================
                                // GST AMOUNTS
                                // =========================================

                                let gstAmount =
                                    subtotal * (gst / 100);

                                let sgstAmount =
                                    subtotal * (sgst / 100);

                                let cgstAmount =
                                    subtotal * (cgst / 100);

                                // =========================================
                                // FINAL AMOUNT
                                // =========================================

                                let finalAmount =
                                    subtotal +
                                    gstAmount +
                                    sgstAmount +
                                    cgstAmount;

                                // =========================================
                                // QTY MULTIPLY
                                // =========================================

                                finalAmount =
                                    finalAmount * qty;

                                // =========================================
                                // DISPLAY TOTAL
                                // =========================================

                                $('[name="items[0][amount]"]')
                                    .val(finalAmount.toFixed(2));

                            });

                            // =========================================
                            // IMAGE PREVIEW TEXT
                            // =========================================

                            $(document).on('change', 'input[type="file"]', function () {

                                let fileName = this.files[0]?.name || 'Click to upload image';

                                $(this).siblings('.file-text').text(fileName);

                            });


                            // =========================================
                            // IMAGE MODAL
                            // =========================================

                            function showImage(src) {

                                $('#popupImage').attr('src', src);

                                $('#imageModal').modal('show');

                            }

                        </script>

                    @endpush

                @endpush
@endsection