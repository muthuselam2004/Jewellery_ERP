@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        border-left: 4px solid #0d6efd;
        padding-left: 10px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        height: 42px;
        font-size: 14px;
    }

    textarea.form-control {
        height: auto;
    }

    .nav-tabs .nav-link {
        border: none;
        font-weight: 500;
        color: #555;
    }

    .nav-tabs .nav-link.active {
        background: #0d6efd;
        color: #fff;
        border-radius: 8px;
    }

    .btn-save {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        color: #fff;
        font-weight: 600;
    }

    .btn-reset {
        border-radius: 25px;
        padding: 10px 25px;
    }




    .custom-table thead {
        background: #f8fafc;
        color: #6b7280;
        font-size: 13px;
        text-transform: uppercase;
    }


    .custom-table tbody tr {
        border-bottom: 1px solid #eee;
    }


    .custom-table tbody tr:hover {
        background: #f9fafb;
    }


    .badge-type {
        background: #eef2ff;
        color: #6366f1;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
    }


    .badge.bg-light {
        border-radius: 20px;
        font-size: 12px;
    }


    .card {
        border-radius: 12px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 22px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        background-color: #ccc;
        border-radius: 34px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 2px;
        background-color: white;
        border-radius: 50%;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .bg-secondary {
        background-color: #f01b1b !important;
    }
</style>

<div class="container-fluid">

    <div class="card card-custom">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
            <!-- <h4 class="mb-0">💎 Supplier Master</h4> -->
            <h4 class="mb-0">Add Supplier</h4>
            <a href="" class="btn btn-outline-primary btn-sm">Back</a>
        </div>

        <div class="card-body">

            <form action="{{ route('Supplier.Add_Supplier') }}" method="POST">
                @csrf

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic">Basic Info</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#contact">Contact</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#address">Address</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#finance">Finance</button>
                    </li>
                </ul>

                <div class="tab-content">

                    <!-- BASIC -->
                    <div class="tab-pane fade show active" id="basic">

                        <div class="section-title">Basic Details</div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Supplier Code</label>
                                <input type="text" class="form-control bg-light" name="supplier_code" value="{{ $nextCode ?? '' }}" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Supplier Name *</label>
                                <input type="text" class="form-control" name="supplier_name" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Company</label>
                                <input type="text" class="form-control" name="company_name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Supplier Type</label>
                                <select name="supplier_type" class="form-control select2">
                                    <option value="">Select</option>
                                    <option>Local</option>
                                    <option>Outstation</option>
                                    <option>Import</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Metal Type</label>
                                <select name="metal_type" class="form-control select2">
                                    <option value="">Select</option>
                                    <option>Gold</option>
                                    <option>Silver</option>
                                    <option>Diamond</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control select2">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <!-- <button type="submit" class="btn-save">Save Supplier</button> -->
                            <button type="reset" class="btn btn-light btn-reset">Reset</button>
                        </div>


                    </div>

                    <!-- CONTACT -->
                    <div class="tab-pane fade" id="contact">

                        <div class="section-title">Contact Details</div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Mobile *</label>
                                <input type="text" name="mobile" class="form-control" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Alternate Mobile</label>
                                <input type="text" name="alt_mobile" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" class="form-control">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <!-- <button type="submit" class="btn-save">Save Supplier</button> -->
                            <button type="reset" class="btn btn-light btn-reset">Reset</button>
                        </div>


                    </div>

                    <!-- ADDRESS -->
                    <div class="tab-pane fade" id="address">

                        <div class="section-title">Address Details</div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <textarea name="per_address" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Alt Address</label>
                                <textarea name="alt_address" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>State</label>
                                <input type="text" name="state" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="India">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <!-- <button type="submit" class="btn-save">Save Supplier</button> -->
                            <button type="reset" class="btn btn-light btn-reset">Reset</button>
                        </div>

                    </div>

                    <!-- FINANCE -->
                    <div class="tab-pane fade" id="finance">

                        <div class="section-title">Finance Details</div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>GST</label>
                                <input type="text" name="gst" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>PAN</label>
                                <input type="text" name="pan" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Opening Balance</label>
                                <input type="number" name="opening_balance" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Balance Type</label>
                                <select name="balance_type" class="form-select">
                                    <option value="">Select</option>
                                    <option>Debit</option>
                                    <option>Credit</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Credit Limit</label>
                                <input type="number" name="credit_limit" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Payment Terms</label>
                                <select name="payment_terms" class="form-select">
                                    <option>Cash</option>
                                    <option>30 Days</option>
                                    <option>60 Days</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Bank Name</label>
                                <input type="text" name="bank_name" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Account No</label>
                                <input type="text" name="account_number" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>IFSC</label>
                                <input type="text" name="ifsc" class="form-control">
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn-save">Save Supplier</button>
                            <button type="reset" class="btn btn-light btn-reset">Reset</button>
                        </div>

                    </div>

                </div>

                <!-- Buttons -->


            </form>

        </div>
    </div>

    <div class="card mt-4 shadow-sm border-0" id="supplierCard" style="visibility:hidden;">
        <div class="card-body px-5">

            <table id="supplierTable" class="table table-bordered align-middle table-hover custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>GST</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($suppliers as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>

                        <td>
                            <span class="badge bg-light text-primary fw-semibold px-3 py-2">
                                {{ $s->Supplier_Code }}
                            </span>
                        </td>

                        <td class="fw-semibold">{{ $s->Supplier_Name }}</td>

                        <td>{{ $s->Company_Name }}</td>

                        <td>
                            <span class="badge badge-type">
                                {{ $s->Supplier_Type }}
                            </span>
                        </td>

                        <td>{{ $s->Mobile }}</td>

                        <td>{{ $s->City }}</td>

                        <td>{{ $s->GST }}</td>

                        <td>
                            <span class="badge status-badge 
                                     {{ $s->Status == 'Active' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $s->Status }}
                            </span>
                        </td>

                        <td>
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $s->id }}"
                                    {{ $s->Status == 'Active' ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {

            let table = $('#supplierTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true,
                autoWidth: false
            });


            $('#supplierCard').css('visibility', 'visible');


            table.columns.adjust().draw();

        });

        $(document).on('change', '.status-toggle', function() {

            var id = $(this).data('id');
            var status = $(this).is(':checked') ? 'Active' : 'Inactive';

            var row = $(this).closest('tr'); 

            $.ajax({
                url: "{{ route('Supplier.ChangeStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function(response) {

                   
                    let badge = row.find('.status-badge');

                    if (status == 'Active') {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('Active');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('Inactive');
                    }

                }
            });

        });
    </script>
    @endsection