$(document).ready(function () {

    let page = $("#Page_Name").val();


    if (page === "Stock_Inward_Page") {

        $(document).on("change", "#metal_type", function () {

            let metal = $(this).val();

            $.ajax({
                url: APP_URL + "/get-category-type",
                type: "GET",
                data: { metal: metal },

                success: function (response) {

                    let dropdown = $('#category_type');

                    dropdown.empty();
                    dropdown.append('<option value="">Select Type</option>');

                    $.each(response, function (key, value) {
                        dropdown.append(
                            `<option value="${value.Category_Type}">
                            ${value.Category_Type}
                        </option>`
                        );
                    });

                    if (metal == 'Gold') {

                        $('#gst').val('3%');
                        $('#sgst').val('1.5%');
                        $('#cgst').val('1.5%');

                    }

                    else if (metal == 'Silver') {

                        $('#gst').val('3%');
                        $('#sgst').val('1.5%');
                        $('#cgst').val('1.5%');

                    }

                    else {

                        $('#gst').val('');
                        $('#sgst').val('');
                        $('#cgst').val('');
                    }

                }
            });

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

                    dropdown.trigger('change');
                }
            });

            $(document).on('change', '#purity_type', function () {

                let selected = $(this).find(':selected');

                let value = selected.data('value');
                let purity = selected.val();

                $('#purity').val(value ? value : '');

            });

        });

        $.ajax({
            url: APP_URL + "/get-manufacturing-type",
            type: "GET",

            success: function (response) {

                let dropdown = $('#manufacturing_type');

                dropdown.empty();
                dropdown.append('<option value="">Select Manufacturing</option>');

                $.each(response, function (key, value) {
                    dropdown.append(
                        `<option value="${value.Manufacturing_Type}">
                        ${value.Manufacturing_Type}
                    </option>`
                    );
                });

            }
        });

        $.ajax({
            url: APP_URL + "/get-product-type",
            type: "GET",

            success: function (response) {

                let dropdown = $('#product_type');

                dropdown.empty();
                dropdown.append('<option value="">Select Product</option>');

                $.each(response, function (key, value) {
                    dropdown.append(
                        `<option value="${value.Product_Type}">
                        ${value.Product_Type}
                    </option>`
                    );
                });

            }
        });

        $(document).on("change", "#metal_type, #category_type, #manufacturing_type, #product_type", function () {

            let category_name = $('#metal_type').val();
            let category_type = $('#category_type').val();
            let manufacturing_type = $('#manufacturing_type').val();
            let product_type = $('#product_type').val();

            if (category_name && category_type && manufacturing_type && product_type) {

                $.ajax({
                    url: APP_URL + "/get-items",
                    type: "GET",
                    data: {
                        category_name: category_name,
                        category_type: category_type,
                        manufacturing_type: manufacturing_type,
                        product_type: product_type
                    },

                    success: function (response) {

                        let dropdown = $('select[name="items[0][item_name]"]');

                        dropdown.empty();
                        dropdown.append('<option value="">Select Item</option>');

                        $.each(response, function (key, value) {
                            dropdown.append(
                                `<option value="${value.Item}">
                            ${value.Item}
                        </option>`
                            );
                        });

                    }

                });

            }

        });

        $('#stockInwardForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    Swal.fire({
                        title: 'Saving...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },

                success: function (res) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: res.message,
                        confirmButtonColor: '#28a745'
                    }).then(() => {
                        location.reload();
                    });

                },

                error: function () {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to save data',
                        confirmButtonColor: '#dc3545'
                    });

                }
            });
        });

    } else if (page === "Sales_Details_Page") {

        let table = $('#data_table').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10
        });

        function calculateAmount() {

            let currentRate =
                parseFloat($('#current_rate').val()) || 0;

            let gross =
                parseFloat($('#gross_weight').val()) || 0;

            let stone =
                parseFloat($('#stone_weight').val()) || 0;

            let qty =
                parseFloat($('#quantity').val()) || 1;

            let wastage =
                parseFloat($('#wastage').val()) || 0;

            let makingCharges =
                parseFloat($('#making_charges').val()) || 0;

            let net = gross - stone;

            if (net < 0) {

                net = 0;
            }

            $('#net_weight').val(
                net.toFixed(3)
            );

            let baseAmount =
                currentRate * gross;

            let wastageAmount =
                baseAmount * (wastage / 100);


            let rateAmount =
                baseAmount +
                wastageAmount +
                makingCharges;


            $('#gram').val(
                rateAmount.toFixed(2)
            );

            let gst =
                parseFloat(
                    ($('#gst').val() || '0').replace('%', '')
                ) || 0;

            let sgst =
                parseFloat(
                    ($('#sgst').val() || '0').replace('%', '')
                ) || 0;

            let cgst =
                parseFloat(
                    ($('#cgst').val() || '0').replace('%', '')
                ) || 0;


            let gstAmount =
                rateAmount * (gst / 100);

            let sgstAmount =
                rateAmount * (sgst / 100);

            let cgstAmount =
                rateAmount * (cgst / 100);



            let finalAmount =
                rateAmount +
                gstAmount +
                sgstAmount +
                cgstAmount;

            finalAmount =
                finalAmount * qty;


            $('#amount').val(
                finalAmount.toFixed(2)
            );


            calculateExchangeAmount();

        }


        $(document).on(
            'input change',
            '#current_rate, #gross_weight, #stone_weight, #quantity, #wastage, #making_charges, #gst, #sgst, #cgst',
            function () {

                calculateAmount();
            }
        );

        function calculateExchangeAmount() {

            // Main Ornament Amount
            let newAmount =
                parseFloat($('#amount').val()) || 0;

            // Exchange Amount
            let exchangeAmount =
                parseFloat($('#exchange_amount').val()) || 0;

            // Final Payable Amount
            let finalPay =
                newAmount - exchangeAmount;

            if (finalPay < 0) {

                finalPay = 0;
            }

            // Show Final Pay
            $('#final_pay_amount').val(
                finalPay.toFixed(2)
            );

            // Default Balance Amount
            $('#balance_amount').val(
                finalPay.toFixed(2)
            );
        }

        $(document).on(
            'input',
            '#exchange_amount',
            function () {

                calculateExchangeAmount();
            }
        );



        $('#view_btn').click(function () {

            let barcode = $('#barcode_number').val();

            if (barcode == '') {

                alert('Enter Barcode Number');

                return;
            }

            $.ajax({

                url: APP_URL + "/get_barcode_details",

                type: "GET",

                data: {
                    barcode: barcode
                },

                success: function (response) {

                    $('#data_table tbody').empty();

                    if (response.status == 1) {

                        $('#table_card').show();

                        $('#category_name').val(response.category_name);
                        $('#category_type').val(response.category_type);
                        $('#manufacturing_type').val(response.manufacturing_type);
                        $('#product_type').val(response.product_type);

                        $('#current_rate').val(response.current_rate);

                        $('#item_name').val(response.data.Item_Name);

                        $('#gross_weight').val(response.data.Gross_Weight);

                        $('#stone_weight').val(response.data.Stone_Weight);

                        $('#net_weight').val(response.data.Net_Weight);

                        $('#purity_type').val(response.data.Purity_Type);

                        $('#purity').val(response.data.Purity);

                        $('#quantity').val(response.data.Quantity);

                        $('#wastage').val(response.data.Wastage);

                        $('#making_charges').val(response.data.Making_Charges);

                        $('#gst').val(response.data.GST);

                        $('#cgst').val(response.data.CGST);

                        $('#sgst').val(response.data.SGST);

                        $('#stock_amount').val(response.stock_amount);



                        calculateAmount();

                        let row = `
                    <tr>
                        <td>1</td>
                        <td>${response.data.Inward_Date}</td>
                        <td>${response.data.Supplier_Name}</td>
                        <td>${response.data.Category_Name}</td>
                        <td>${response.data.Category_Type}</td>
                        <td>${response.data.Manufacturing_Type}</td>
                        <td>${response.data.Product_Type}</td>
                        <td>${response.data.Item_Name}</td>
                        <td>${response.data.Purity_Type}</td>
                        <td>${response.data.Gross_Weight}</td>
                        <td>${response.data.Amount}</td>
                    </tr>
                    `;

                        $('#data_table tbody').append(row);

                    } else {

                        alert('No Data Found');

                        $('#current_rate').val('');

                        $('#table_card').hide();
                    }
                }

            });

        });

        $(document).on("change", "#metal_type", function () {

            let metal = $(this).val();

            $.ajax({
                url: APP_URL + "/get-category-type",
                type: "GET",
                data: { metal: metal },

                success: function (response) {

                    let dropdown = $('#category_type');

                    dropdown.empty();
                    dropdown.append('<option value="">Select Type</option>');

                    $.each(response, function (key, value) {
                        dropdown.append(
                            `<option value="${value.Category_Type}">
                            ${value.Category_Type}
                        </option>`
                        );
                    });

                    if (metal == 'Gold') {

                        $('#gst').val('3%');
                        $('#sgst').val('1.5%');
                        $('#cgst').val('1.5%');

                    }

                    else if (metal == 'Silver') {

                        $('#gst').val('3%');
                        $('#sgst').val('1.5%');
                        $('#cgst').val('1.5%');

                    }

                    else {

                        $('#gst').val('');
                        $('#sgst').val('');
                        $('#cgst').val('');
                    }

                }
            });

            $.ajax({
                url: APP_URL + "/get_purity_by_metal",
                type: "GET",
                data: {
                    metal: metal
                },

                success: function (response) {

                    let dropdown = $('#display_purity_type');


                    dropdown.empty();


                    dropdown.append('<option value="">Select</option>');


                    $.each(response, function (key, value) {

                        dropdown.append(`
                <option 
                    value="${value.Purity}" 
                    data-value="${value.Value}">
                    ${value.Purity}
                </option>
            `);

                    });


                    dropdown.trigger('change.select2');

                }
            });

        });

        $(document).on('change', '#display_purity_type', function () {

            let selected = $(this).find(':selected');

            let value = selected.data('value');
            let purity = selected.val();

            $('#display_purity').val(value ? value : '');

        });

        $('#SalesForm').on('submit', function (e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: $(this).attr('action'),

                type: "POST",

                data: formData,

                contentType: false,
                processData: false,

                beforeSend: function () {

                    Swal.fire({
                        title: 'Saving...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                },

                success: function (res) {

                    Swal.fire({

                        icon: 'success',
                        title: 'Saved!',
                        text: res.message,
                        confirmButtonColor: '#28a745'

                    }).then(() => {

                        window.open(res.invoice_url, '_blank');

                        // ✅ Reload Page
                        location.reload();

                    });

                },

                error: function (xhr) {

                    console.log(xhr.responseText);

                    Swal.fire({

                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to save data',
                        confirmButtonColor: '#dc3545'

                    });

                }

            });

        });

    }
});