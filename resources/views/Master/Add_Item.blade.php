@extends('layouts.app')

@section('content')

    <style>
        body {
            background: #eef2f7;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* =========================================
        MAIN FORM CARD
    ========================================= */

        .card {
            border-radius: 0px !important;
            border: 1px solid #dbe1ea !important;
            box-shadow: none !important;
            overflow: hidden;
            background: #fff;
        }

        /* =========================================
        GOLD HEADER
    ========================================= */

        .card::before {
            content: "Add Item";
            display: block;
            width: 100%;
            background: linear-gradient(90deg, #b8860b, #ffd700, #caa100);
            color: #000;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            padding: 10px;
        }

        /* =========================================
        CARD BODY
    ========================================= */

        .card-body {
            padding: 18px !important;
        }


        .form-control {
            height: 38px !important;
            border-radius: 0px !important;
            border: 1px solid #cfd6dd !important;
            font-size: 13px !important;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #b8860b !important;
            box-shadow: none !important;
        }

        /* =========================================
        SELECT2
    ========================================= */

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            border-radius: 0px !important;
            border: 1px solid #cfd6dd !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
            font-size: 13px;
            padding-left: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }

        .select2-dropdown {
            z-index: 9999 !important;
        }

        .select2-container--open {
            z-index: 9999 !important;
        }

        /* =========================================
        BUTTON
    ========================================= */

        .btn-success {
            background: #28a745 !important;
            border: none !important;
            border-radius: 0px !important;
            height: 38px;
            font-size: 13px;
            font-weight: 600;
            padding: 0 18px;
            width: 100%;
        }

        .btn-success:hover {
            background: #218838 !important;
        }

        /* =========================================
        BUTTON ALIGN
    ========================================= */

        .mt-4 {
            margin-top: 30px !important;
        }

        /* =========================================
        IMAGE PREVIEW
    ========================================= */

        #preview {
            border-radius: 4px;
            border: 1px solid #dbe1ea;
            padding: 2px;
        }

        /* =========================================
        JEWELLERY WRAP
    ========================================= */

        .jwl-wrap {
            padding: 1.5rem 0;
        }

        /* =========================================
        JEWELLERY CARD
    ========================================= */

        .jwl-card {
            border-radius: 0px;
            background: #ffffff;
            padding: 14px;
            border: 1px solid #dbe1ea;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        /* =========================================
        HEADER
    ========================================= */

        .jwl-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .jwl-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }

        .jwl-count {
            font-size: 12px;
            color: #6c757d;
            background: #f1f3f5;
            padding: 4px 10px;
            border-radius: 3px;
            border: 1px solid #dee2e6;
        }

        /* =========================================
        TOOLBAR
    ========================================= */

        .jwl-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .jwl-toolbar input,
        .jwl-toolbar select {
            font-size: 13px;
            padding: 7px 12px;
            border-radius: 0px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #212529;
            outline: none;
            transition: border-color 0.2s;
        }

        .jwl-toolbar input:focus,
        .jwl-toolbar select:focus {
            border-color: #b8860b;
            box-shadow: none;
        }

        .jwl-toolbar input {
            width: 220px;
        }

        /* =========================================
        TABLE
    ========================================= */

        .jwl-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .jwl-table thead tr {
            background: #f8fafc;
        }

        .jwl-table thead th {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            padding: 10px;
            text-align: left;
            white-space: nowrap;
            border: 1px solid #dbe1ea;
        }

        .jwl-table thead th.text-right {
            text-align: right;
        }

        .jwl-table tbody tr {
            border-bottom: 1px solid #f1f3f5;
            transition: background 0.15s;
        }

        .jwl-table tbody tr:hover {
            background: #f8f9ff;
        }

        .jwl-table tbody tr:last-child {
            border-bottom: none;
        }

        .jwl-table tbody td {
            font-size: 13px;
            color: #212529;
            padding: 10px;
            vertical-align: middle;
            border: 1px solid #e5e7eb;
        }

        .jwl-table tbody td.text-right {
            text-align: right;
        }

        /* =========================================
        ITEM CODE
    ========================================= */

        .code-pill {
            font-size: 11px;
            font-weight: 600;
            background: #eeedfe;
            color: #3c3489;
            padding: 3px 9px;
            border-radius: 4px;
            font-family: monospace;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        /* =========================================
        IMAGE
    ========================================= */

        .img-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e9ecef;
            display: block;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .img-thumb:hover {
            transform: scale(1.08);
        }

        .img-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 4px;
            background: #f8f9fa;
            border: 1px dashed #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 10px;
            text-align: center;
            line-height: 1.3;
        }

        /* =========================================
        BADGES
    ========================================= */

        .badge-mfg,
        .badge-prod {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 4px;
            white-space: nowrap;
        }

        /* =========================================
        WEIGHT
    ========================================= */

        .weight-val {
            font-variant-numeric: tabular-nums;
        }

        .weight-unit {
            font-size: 11px;
            color: #adb5bd;
            margin-left: 2px;
        }

        .net-bold {
            font-weight: 600;
            color: #1a1a2e;
        }

        /* =========================================
        EMPTY
    ========================================= */

        .jwl-empty {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
            font-size: 14px;
            display: none;
        }

        /* =========================================
        IMAGE MODAL
    ========================================= */

        .img-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: 99999;
            align-items: center;
            justify-content: center;
        }

        .img-modal-overlay.active {
            display: flex;
        }

        .img-modal-box {
            background: #fff;
            border-radius: 6px;
            padding: 16px;
            max-width: 420px;
            width: 90%;
            text-align: center;
            position: relative;
        }

        .img-modal-box img {
            width: 100%;
            border-radius: 4px;
            max-height: 380px;
            object-fit: contain;
        }

        .img-modal-close {
            position: absolute;
            top: 10px;
            right: 14px;
            font-size: 20px;
            cursor: pointer;
            color: #6c757d;
            background: none;
            border: none;
            line-height: 1;
        }

        /* =========================================
        MOBILE
    ========================================= */

        @media(max-width:768px) {

            .card-body {
                padding: 14px !important;
            }

            .btn-success {
                margin-top: 10px;
            }

        }
    </style>

    <div class="container-fluid">

        <input type="hidden" id="Page_Name" value="Add_Item_Page">


        <form method="POST" action="{{ route('Add_Item.Add_Item') }}" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">

                        <!-- Item Code -->
                        <div class="col-md-3">
                            <label>Item Code</label>
                            <input type="text" name="Item_Code" class="form-control" value="{{ $nextCode }}" readonly>
                        </div>

                        <!-- Category Name -->
                        <div class="col-md-3">
                            <label>Category Name</label>
                            <select name="Metel_Type" id="metal_type" class="form-control select2">
                                <option value="">Select</option>
                                @foreach($metalTypes as $item)
                                    <option value="{{ $item->Metel_Type }}"> {{ $item->Metel_Type }}
                                </option> @endforeach
                            </select>
                        </div>

                        <!-- Category Type -->
                        <div class="col-md-3">
                            <label>Category Type</label>
                            <select name="Category_Type" class="form-control select2">
                                <option value="">Select</option>
                            </select>
                        </div>

                        <!-- Manufacturing Type -->
                        <div class="col-md-3">
                            <label>Manufacturing Type</label>
                            <select name="Manufacturing_Type" class="form-control select2">
                                <option value="">Select</option>
                                @foreach($manufacturingTypes as $m)
                                    <option value="{{ $m->Manufacturing_Type }}">
                                        {{ $m->Manufacturing_Type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Type (FIXED) -->
                        <div class="col-md-3">
                            <label>Product Type</label>
                            <select name="Product_Type" class="form-control select2">
                                <option value="">Select</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Item</label>
                            <input type="text" name="Item" class="form-control" placeholder="Enter Item">
                        </div>

                        <div class="col-md-3">
                            <label>Purity Type</label>
                            <select name="Karat" id="purity_type" class="form-control select2">
                                <option value="">Select</option>
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label>Purity</label>
                            <input type="text" name="Purity" id="purity" class="form-control" readonly>
                        </div>


                        <!-- <div class="col-md-3">
                                            <label>Gross Weight</label>
                                            <input type="number" step="0.001" name="Gross_Weight" class="form-control">
                                        </div>


                                        <div class="col-md-3">
                                            <label>Stone Weight</label>
                                            <input type="number" step="0.001" name="Stone_Weight" class="form-control">
                                        </div>


                                        <div class="col-md-3">
                                            <label>Net Weight</label>
                                            <input type="number" step="0.001" name="Net_Weight" class="form-control" readonly>
                                        </div> -->

                        <!-- Image Upload -->
                        <div class="col-md-3">
                            <label>Jewellery Image</label>
                            <input type="file" name="Jwl_Image" class="form-control" accept="image/*">

                            <!-- 👇 ADD HERE -->
                            <img id="preview" src="" width="80" style="display:none; margin-top:10px;">
                        </div>

                        <!-- Button -->
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-success">
                                + Add Item
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="jwl-wrap">

            <!-- <div class="jwl-header">
                    <div class="jwl-title">Jewellery Items</div>
                    <span class="jwl-count" id="jwlCount">{{ count($Item) }} items</span>
                </div> -->


            <!-- <div class="jwl-toolbar">
                        <input type="text" id="jwlSearch" placeholder="&#128269; Search items..." oninput="jwlFilter()">
                        <select class="select2" id="jwlCatFilter" onchange="jwlFilter()">
                            <option value="">All Categories</option>
                            @foreach($Item->pluck('Category_Name')->unique()->sort() as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <select class="select2" id="jwlMfgFilter" onchange="jwlFilter()">
                            <option value="">All Manufacturing Types</option>
                            @foreach($Item->pluck('Manufacturing_Type')->unique()->sort() as $mfg)
                                <option value="{{ $mfg }}">{{ $mfg }}</option>
                            @endforeach
                        </select>
                    </div> -->

            {{-- Table Card --}}
            <div class="jwl-card" id="jwlCard" style="display:none;">

                <!-- Header -->
                <div class="jwl-header">
                    <div class="jwl-title">Jewellery Items</div>

                    <span class="jwl-count" id="jwlCount">
                        0 Items
                    </span>
                </div>

                <!-- Table -->
                <div style="overflow-x:auto;">

                    <table class="jwl-table" id="jwlTable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Code</th>
                                <th>Design</th>
                                <th>Category</th>
                                <th>Category Type</th>
                                <th>Manufacturing</th>
                                <th>Product Type</th>
                                <th>Item</th>
                                <th>Purity</th>
                            </tr>
                        </thead>

                        <tbody id="jwlBody"></tbody>

                    </table>

                </div>

            </div>

            <!-- Empty Message -->
            <div class="jwl-empty" id="jwlEmpty" style="display:none;">
                No items match your search.
            </div>
        </div>


        <div class="img-modal-overlay" id="imgModal">
            <div class="img-modal-box">
                <button class="img-modal-close">&times;</button>
                <img id="imgModalSrc" src="" alt="Jewellery Image">
            </div>
        </div>

        <!-- <script>
                                                        $(document).ready(function(){
                                                            $('.select2').select2();
                                                        });
                                                        </script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        @push('scripts')
            <script>
                var Page_Name = "Add_Item_Page";
            </script>
            <script>

                $(document).on("change", "#metal_type", function () {

                    let metal = $(this).val();
                    $.ajax({
                        url: APP_URL + "/get_purity_by_metal",
                        type: "GET",
                        data: { metal: metal },

                        success: function (response) {

                            let dropdown = $('#purity_type');

                            dropdown.empty();
                            dropdown.append('<option value="">Select</option>');

                            $.each(response, function (key, value) {

                                dropdown.append(
                                    `<option 
                                                                                value="${value.Purity}" 
                                                                                data-value="${value.Value}">
                                                                                ${value.Purity}
                                                                            </option>`
                                );
                            });

                            $('#purity').val('');
                        }
                    });

                });

                $(document).on('change', '#purity_type', function () {

                    let value = $(this).find(':selected').attr('data-value');

                    $('#purity').val(value ? value : '');

                });

                function showImage(url) {
                    document.getElementById('imgModalSrc').src = url;
                    document.getElementById('imgModal').classList.add('active');
                }

                function closeImage(e) {
                    if (e.target.id === 'imgModal') {
                        document.getElementById('imgModal').classList.remove('active');
                    }
                }

                function jwlFilter() {
                    const search = document.getElementById('jwlSearch').value.toLowerCase();
                    const cat = document.getElementById('jwlCatFilter').value.toLowerCase();
                    const mfg = document.getElementById('jwlMfgFilter').value.toLowerCase();
                    const rows = document.querySelectorAll('#jwlBody tr');
                    let visible = 0;

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        const catCell = row.cells[3] ? row.cells[3].textContent.toLowerCase() : '';
                        const mfgCell = row.cells[5] ? row.cells[5].textContent.toLowerCase() : '';

                        const ok = (!search || text.includes(search)) &&
                            (!cat || catCell.includes(cat)) &&
                            (!mfg || mfgCell.includes(mfg));

                        row.style.display = ok ? '' : 'none';
                        if (ok) visible++;
                    });

                    document.getElementById('jwlCount').textContent = visible + ' item' + (visible !== 1 ? 's' : '');
                    document.getElementById('jwlEmpty').style.display = visible === 0 ? 'block' : 'none';
                }

                $(document).ready(function () {

                    $(document).on('click', '.preview-image', function () {
                        let url = $(this).data('img');
                        $('#imgModalSrc').attr('src', url);
                        $('#imgModal').addClass('active');
                    });

                    $(document).on('click', '#imgModal', function (e) {
                        if (e.target.id === 'imgModal') {
                            $('#imgModal').removeClass('active');
                        }
                    });

                    $(document).on('click', '.img-modal-close', function () {
                        $('#imgModal').removeClass('active');
                    });

                });

                $(document).ready(function () {

                    let colors = [
                        ['#e3f2fd', '#0d47a1'],
                        ['#fce4ec', '#880e4f'],
                        ['#e8f5e9', '#1b5e20'],
                        ['#fff3e0', '#e65100'],
                        ['#ede7f6', '#4527a0'],
                        ['#e0f7fa', '#006064']
                    ];

                    let typeColorMap = {};

                    $('.badge-mfg').each(function () {

                        let type = $(this).text().trim();

                        // assign color if not already assigned
                        if (!typeColorMap[type]) {
                            let randomIndex = Object.keys(typeColorMap).length % colors.length;
                            typeColorMap[type] = colors[randomIndex];
                        }

                        let selectedColor = typeColorMap[type];

                        $(this).css({
                            'background': selectedColor[0],
                            'color': selectedColor[1]
                        });

                    });
                });

                $(document).ready(function () {

                    let colors = [
                        ['#e3f2fd', '#0d47a1'],
                        ['#fce4ec', '#880e4f'],
                        ['#e8f5e9', '#1b5e20'],
                        ['#fff3e0', '#e65100'],
                        ['#ede7f6', '#4527a0'],
                        ['#e0f7fa', '#006064']
                    ];

                    let typeColorMap = {};

                    function applyColors(selector) {
                        $(selector).each(function () {

                            let type = $(this).text().trim();

                            if (!typeColorMap[type]) {
                                let index = Object.keys(typeColorMap).length % colors.length;
                                typeColorMap[type] = colors[index];
                            }

                            let selectedColor = typeColorMap[type];

                            $(this).css({
                                'background': selectedColor[0],
                                'color': selectedColor[1]
                            });

                        });
                    }


                    applyColors('.badge-mfg');
                    applyColors('.badge-prod');

                });

                $(document).on('input', '[name="Gross_Weight"], [name="Stone_Weight"]', function () {

                    let gross = parseFloat($('[name="Gross_Weight"]').val()) || 0;
                    let stone = parseFloat($('[name="Stone_Weight"]').val()) || 0;

                    let net = gross - stone;

                    $('[name="Net_Weight"]').val(net.toFixed(3));
                });


                function showImage(src) {
                    $('#popupImage').attr('src', src);
                    $('#imageModal').modal('show');
                }
            </script>


        @endpush

@endsection