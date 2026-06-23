@extends('Layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">

        <!-- DASHBOARD CARD -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget shadow-sm">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Total</h6>
                                <h2>1,245</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-users"></i>
                            </div>
                        </div>
                        <small class="text-muted">Updated today</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= MODAL ================= -->
    <div class="modal fade" id="rateModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">

                <!-- HEADER -->
                <div class="modal-header custom-header">
                    <h5>✨ Update Current Market Rate</h5>

                </div>

                <!-- BODY -->
                <div class="modal-body">

                    <input type="hidden" id="Page_Name" value="Add_Current_Rate">

                    <form method="POST" action="{{ route('Save_Current_Rate') }}" id="Save_Current_Rate">
                        @csrf

                        <div class="row g-4">

                            <!-- DATE -->
                            <div class="col-md-6">
                                <label class="form-label">📅 Today Date</label>
                                <input type="date" name="Today_Date" class="form-control modern-input"
                                    value="{{ date('Y-m-d') }}">
                            </div>

                            <!-- METAL -->
                            <div class="col-md-6">
                                <label class="form-label">🪙 Metal Type</label>
                                <select name="Metal_Type" class="form-control modern-input select2" id="metal_type">
                                    <option value="">Select Category</option>
                                </select>
                            </div>

                            <!-- PURITY -->
                            <div class="col-md-6">
                                <label class="form-label">💎 Purity / Karat</label>
                                <select name="Purity" class="form-control modern-input select2" id="purity_type">
                                    <option value="">Select Purity</option>
                                </select>
                            </div>

                            <!-- PER GRAM -->
                            <div class="col-md-6">
                                <label class="form-label">₹ Rate per Gram</label>
                                <input type="number" name="Gram" id="Gram" class="form-control modern-input"
                                    placeholder="e.g. 5200">
                                <small class="text-muted">Auto calculates total</small>
                            </div>

                            <!-- TOTAL -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold">💰 Total Rate (₹ per gm)</label>
                                <input type="text" name="Rate" id="Rate" class="form-control modern-input text-center"
                                    placeholder="Auto-calculated" readonly>
                            </div>

                        </div>

                        <!-- BUTTONS -->
                        <div class="text-center mt-4">

                            <button type="button" id="addRow" class="btn btn-success px-5 rounded-pill">
                                ➕ Add
                            </button>
                            <button type="submit" class="btn btn-dark px-5 rounded-pill">
                                💾 Save Rate
                            </button>

                        </div>

                        <table class="table table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Metal</th>
                                    <th>Purity</th>
                                    <th>Per Gram</th>
                                    <th>Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </form>



                    <div class="mt-5 p-3 rounded-3 bg-light border">

                        <h6 class="mb-3 text-center">
                            📊 Yesterday Rate (<span id="y_date"></span>)
                        </h6>

                        <div class="row text-center">

                            <!-- GOLD -->
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 shadow-sm">
                                    <h6 class="text-warning fw-bold">Gold</h6>
                                    <p class="mb-1">Per Gram: <b id="y_gold_gram">--</b></p>
                                    <p class="mb-0">Rate: <b id="y_gold_rate">--</b></p>
                                </div>
                            </div>

                            <!-- SILVER -->
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 shadow-sm">
                                    <h6 class="text-secondary fw-bold">Silver</h6>
                                    <p class="mb-1">Per Gram: <b id="y_silver_gram">--</b></p>
                                    <p class="mb-0">Rate: <b id="y_silver_rate">--</b></p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- FOOTER INFO -->
                    <div class="d-flex justify-content-between mt-4 small text-muted">
                        <span>ⓘ Rates reflect today's jewellery market standard.</span>
                        <span class="text-danger">⏱ Last sync: {{ date('d M, h:i A') }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('styles')

        <style>
            .custom-modal {
                border-radius: 15px;
                overflow: hidden;
            }

            .custom-header {
                background: #2f3640;
                color: #fff;
                padding: 15px 20px;
            }

            /* INPUT STYLE */
            .modern-input {
                height: 48px;
                border-radius: 10px;
                padding: 10px 12px;
                border: 1px solid #ddd;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                font-size: 14px;
            }


            .select2-container .select2-selection--single {
                height: 48px !important;
                border-radius: 10px !important;
                border: 1px solid #ddd !important;
                display: flex;
                align-items: center;
                padding: 0 10px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: normal !important;
                padding-left: 5px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 100% !important;
                right: 10px;
            }

            .select2-container {
                width: 100% !important;
            }

            .select2-container--default .select2-selection--single {
                height: 48px !important;
                display: flex !important;
                align-items: center !important;
            }

            .select2-selection__rendered {
                line-height: 48px !important;
                padding-left: 10px !important;
            }

            .select2-selection__arrow {
                height: 48px !important;
            }

            .form-label {
                font-weight: 500;
                margin-bottom: 6px;
            }

            small.text-muted {
                display: block;
                margin-top: 5px;
            }
        </style>

    @endpush


    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            var Page_Name = "Add_Current_Rate";
        </script>


        <script>
            $(document).ready(function () {

                $(document).ready(function () {

                    @if(session('showRatePopup'))
                        $('#rateModal').modal('show');
                    @endif

                            });

                $('.select2').select2({
                    width: '100%',
                    dropdownParent: $('#rateModal')
                });
            });

        </script>

    @endpush

@endsection