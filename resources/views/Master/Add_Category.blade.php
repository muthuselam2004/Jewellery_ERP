@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- =========================
                FORM
            ========================== -->

        <form method="POST" action="{{ route('category.store') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="custom-report-card mb-3">

                <!-- Header -->
                <div class="report-header">
                    <h3>Add Category</h3>
                </div>

                <!-- Body -->
                <div class="report-body">

                    <input type="hidden" id="Page_Name" value="Add_Category_Page">

                    <div class="row align-items-end">

                        <!-- Category Code -->
                        <div class="col-md-3">
                            <label>Category Code</label>

                            <input type="text" name="Cat_Code" class="form-control custom-input" value="{{ $nextCode }}"
                                readonly>
                        </div>

                        <!-- Category Name -->
                        <div class="col-md-3">
                            <label>Category Name</label>

                            <select name="Metel_Type" class="form-control select2 custom-input">

                                <option value="">Select</option>

                                @foreach($metalTypes as $item)

                                    <option value="{{ $item->Metel_Type }}">
                                        {{ $item->Metel_Type }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <!-- Category Type -->
                        <div class="col-md-3">
                            <label>Category Type</label>

                            <input type="text" name="Category_Type" class="form-control custom-input"
                                placeholder="Enter Category Type">
                        </div>

                        <!-- Button -->
                        <div class="col-md-3">
                            <button type="submit" class="btn-view">
                                + Add Category
                            </button>
                        </div>

                    </div>

                </div>

            </div>

        </form>


        <!-- =========================
                TABLE
            ========================== -->

        <div class="custom-table-card" id="table_card" style="display:none;">

            <table class="table custom-table" id="data_table">

                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Code</th>
                        <th>Metel Code</th>
                        <th>Metel Type</th>
                        <th>Category</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($categories as $key => $cat)

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cat->Cat_Code }}</td>
                            <td>{{ $cat->Metel_ID }}</td>
                            <td>{{ $cat->Metel_Type }}</td>
                            <td>{{ $cat->Category_Type }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


    <style>
        body {
            background: #eef2f7;
        }

        /* =========================
                REPORT CARD
            ========================== */

        .custom-report-card {
            background: #fff;
            border-radius: 0px;
            overflow: hidden;
            box-shadow: none;
            border: 1px solid #dbe1ea;
            padding: 0px !important;
        }

        .report-header {
            background: linear-gradient(90deg, #b8860b, #ffd700, #caa100);
            padding: 10px;
            text-align: center;
        }

        .report-header h3 {
            color: #000000;
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .report-body {
            padding: 18px;
        }

        /* =========================
                FORM
            ========================== */

        .row.align-items-end {
            align-items: end;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #111827;
        }

        .custom-input {
            height: 38px !important;
            border-radius: 0px !important;
            border: 1px solid #cfd6dd !important;
            font-size: 13px;
            box-shadow: none !important;
        }

        .custom-input:focus {
            border-color: #b8860b !important;
            box-shadow: none !important;
        }

        /* =========================
                SELECT2
            ========================== */

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

        /* =========================
                BUTTON
            ========================== */

        .btn-view {
            background: #28a745;
            color: #fff;
            height: 38px;
            border: none;
            border-radius: 0px;
            font-size: 13px;
            font-weight: 600;
            padding: 0 10px;
            width: 50%;
            margin-top: 0px;
        }

        .btn-view:hover {
            background: #218838;
            color: #fff;
        }

        /* =========================
                TABLE CARD
            ========================== */

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

        .select2-container {
            width: 100% !important;
        }

        .select2-dropdown {
            z-index: 9999 !important;
        }

        .select2-container--open {
            z-index: 9999 !important;
        }

        body {
            overflow-x: hidden;
        }

        /* =========================
                MOBILE
            ========================== */

        @media (max-width: 768px) {

            .report-body {
                padding: 14px;
            }

            .btn-view {
                margin-top: 10px;
            }

        }
    </style>


    @push('scripts')

        <script>
            var Page_Name = "Add_Category_Page";
        </script>

    @endpush

@endsection