@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- 🔷 FORM -->
        <form method="POST" action="{{ route('Save_Current_Rate') }}" id="Save_Current_Rate">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-body">

                    <div class="row">


                        <div class="col-md-3">
                            <label>Today Date</label>
                            <input type="date" name="Today_Date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>


                        <div class="col-md-3">
                            <label>Metal Type</label>
                            <select name="Metal_Type" class="form-control select2" id="metal_type">
                                <option value="">Select Category</option>
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label>Purity Type</label>
                            <select name="Purity" class="form-control select2" id="purity_type">
                                <option value="">Select Purity</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Per Gram</label>
                            <input type="number" name="Unit" id="Unit" class="form-control" placeholder="Enter rate (e.g. 5000)">
                        </div>

                        <div class="col-md-3">
                            <label>Total Rate</label>
                            <input type="text" name="Gold_Rate" id="Rate" class="form-control" readonly>
                        </div>

                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-body px-5">
                <table class="table table-bordered" id="data_table" style="display:none;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Today Date</th>
                            <th>Metal Type</th>
                            <th>Purity Type</th>
                            <th>Per Gram</th>
                            <th>Gold Rate</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

        @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                var Page_Name = "Add_Current_Rate";
            </script>

            <script>
                $(document).ready(function () {

                    let table = $('#data_table').DataTable();

                    $('#data_table').show();

                });
            </script>
        @endpush

@endsection