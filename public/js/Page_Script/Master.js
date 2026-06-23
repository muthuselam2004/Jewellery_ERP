$(document).ready(function () {

    let page = $("#Page_Name").val();




    $(document).on("change", 'select[name="Metel_Type"]', function () {

        let metel = $(this).val();

        $.ajax({
            url: APP_URL + "/get_category_type",
            type: "GET",
            data: { metel: metel },

            success: function (response) {

                let dropdown = $('select[name="Category_Type"]');

                dropdown.empty();
                dropdown.append('<option value="">Select</option>');

                $.each(response, function (key, value) {
                    dropdown.append(
                        `<option value="${value.Category_Type}">
                            ${value.Category_Type}
                        </option>`
                    );
                });

            }
        });
    });


    $(document).on("change", 'select[name="Manufacturing_Type"]', function () {

        let manufacturing = $(this).val();

        $.ajax({
            url: APP_URL + "/get_product_type",
            type: "GET",
            data: { manufacturing: manufacturing },

            success: function (response) {

                let dropdown = $('select[name="Product_Type"]');

                dropdown.empty();
                dropdown.append('<option value="">Select</option>');

                $.each(response, function (key, value) {
                    dropdown.append(
                        `<option value="${value.Product_Type}">
                            ${value.Product_Type}
                        </option>`
                    );
                });

            }
        });

    });

    $.ajax({
        url: APP_URL + "/get-metal-type",
        type: "GET",

        success: function (response) {

            let dropdown = $('#metal_type');

            dropdown.empty();
            dropdown.append('<option value="">Select Category</option>');

            $.each(response, function (key, value) {
                dropdown.append(
                    `<option value="${value.Metel_Type}">
                        ${value.Metel_Type}
                    </option>`
                );
            });

        }
    });

    if (page === "Add_Current_Rate") {

        $.ajax({
            url: APP_URL + "/get-metal-type",
            type: "GET",
            success: function (response) {

                let dropdown = $('#metal_type');

                dropdown.empty();
                dropdown.append('<option value="">Select Category</option>');

                $.each(response, function (key, value) {
                    dropdown.append(
                        `<option value="${value.Metel_Type}">
                        ${value.Metel_Type}
                    </option>`
                    );
                });
            }
        });

        $(document).on('change', '#metal_type', function () {

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
                            `<option value="${value.Value ? value.Value : value.Purity}">
                            ${value.Purity} ${value.Value ? '(' + value.Value + ')' : ''}
                        </option>`
                        );
                    });

                    dropdown.trigger('change');
                }
            });

        });

        $(document).on('keyup change', '#Gram, #metal_type, #purity_type', function () {

            let perGram = parseFloat($('#Gram').val());
            let metal = $('#metal_type option:selected').text().trim();
            let purity = parseFloat($('#purity_type').val());

            if (!perGram || !metal) {
                $('#Gram').val('');
                return;
            }

            let rate = 0;

            if (metal === "Gold") {
                rate = perGram * 8;
            }

            else if (metal === "Silver") {
                rate = perGram * 1000;
            }

            else if (metal === "Platinum") {
                rate = perGram * 10;
            }
            
            else if (metal === "Diamond") {
                rate = perGram;
            }

            $('#Rate').val(
                rate.toLocaleString('en-IN', { minimumFractionDigits: 0 })
            );
        });

        $('#Save_Current_Rate').on('submit', function (e) {
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

                    isSaved = true;

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

        $.ajax({
            url: APP_URL + "/get_current_rate_list",
            type: "GET",
            success: function (response) {

                console.log(response);

                $("#y_date").text(response.date);

                if (response.gold) {
                    $("#y_gold_gram").text(response.gold.Gram);
                    $("#y_gold_rate").text(response.gold.Rate);
                } else {
                    $("#y_gold_gram").text("--");
                    $("#y_gold_rate").text("--");
                }

                if (response.silver) {
                    $("#y_silver_gram").text(response.silver.Gram);
                    $("#y_silver_rate").text(response.silver.Rate);
                } else {
                    $("#y_silver_gram").text("--");
                    $("#y_silver_rate").text("--");
                }
            }
        });

        let count = 1;

        $("#addRow").click(function () {


            let date = $("input[name='Today_Date']").val();
            let metal = $("#metal_type option:selected").text();
            let metal_val = $("#metal_type").val();


            let purity = $("#purity_type option:selected").text();
            let purity_val = $("#purity_type").val();

            let Gram = $("#Gram").val();
            let rate = $("#Rate").val();

            if (!metal_val || !purity_val || !Gram) {
                alert("Fill all fields");
                return;
            }

            $("#data_table").show();

            let row = `
<tr>
    <td>${count}</td>
    <td>${date}</td>
    <td>${metal}</td>
    <td>${purity}</td>
    <td>${Gram}</td>
    <td>${rate}</td>

    
    <input type="hidden" name="data[${count}][Metal_Type]" value="${metal_val}">
    <input type="hidden" name="data[${count}][Purity]" value="${purity_val}">
    <input type="hidden" name="data[${count}][Gram]" value="${Gram}">
    <input type="hidden" name="data[${count}][Rate]" value="${rate}">
    <input type="hidden" name="data[${count}][Date]" value="${date}">

    <td>
        <button type="button" class="btn btn-danger btn-sm removeRow">X</button>
    </td>
</tr>`;

            $("#data_table tbody").append(row);

            count++;


            $("#metal_type").val('').trigger('change');
            $("#purity_type").val('').trigger('change');
            $("#Gram").val('');
            $("#Rate").val('');
        });

        $(document).on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });

    } else if (page === "Add_Category_Page") {

        let table = $('#data_table').DataTable();


        $('#table_card').hide();

        $('select[name="Metel_Type"]').on('change', function () {

            let metal = $(this).val();

            if (metal === '') {

                table.clear().draw();
                $('#table_card').hide();

                return;
            }

            $.ajax({

                url: APP_URL + "/get-category-by-metal",

                type: "GET",

                data: {
                    Metel_Type: metal
                },

                beforeSend: function () {

                    $('#table_card').hide();
                },

                success: function (response) {

                    console.log(response);

                    table.clear().draw();

                    if (response.length > 0) {

                        $.each(response, function (index, item) {

                            table.row.add([
                                index + 1,
                                item.Cat_Code,
                                item.Metel_ID,
                                item.Metel_Type,
                                item.Category_Type
                            ]);

                        });

                        table.draw();

                        // show card only if data exists
                        $('#table_card').show();

                    } else {

                        // no data na full card hide
                        $('#table_card').hide();
                    }
                },

                error: function () {

                    $('#table_card').hide();

                    alert("Something went wrong!");
                }

            });

        });

    } else if (page === "Add_Product_Page") {

        let table = $('#data_table').DataTable();

        
        $('#table_card').hide();

        $('select[name="Metel_Type"], select[name="Category_Type"], select[name="Manufacturing_Type"]').on('change', function () {

            let metal = $('select[name="Metel_Type"]').val();
            let category = $('select[name="Category_Type"]').val();
            let manufacturing = $('select[name="Manufacturing_Type"]').val();

            
            if (metal === '' || category === '' || manufacturing === '') {

                table.clear().draw();

                $('#table_card').hide();

                return;
            }

            $.ajax({

                url: APP_URL + "/get-product-by-filter",

                type: "GET",

                data: {
                    metal: metal,
                    category: category,
                    manufacturing: manufacturing
                },

                beforeSend: function () {

                    $('#table_card').hide();
                },

                success: function (response) {

                    table.clear().draw();

                    if (response.length > 0) {

                        $.each(response, function (index, item) {

                            table.row.add([
                                index + 1,
                                item.Item_Code,
                                item.Category_Name,
                                item.Category_Type,
                                item.Manufacturing_Type,
                                item.Product_Type
                            ]);

                        });

                        table.draw();

                        
                        $('#table_card').show();

                    } else {

                        
                        $('#table_card').hide();
                    }
                },

                error: function () {

                    $('#table_card').hide();

                    alert("Something went wrong!");
                }

            });

        });

    } else if (page === "Add_Item_Page") {

        $(document).ready(function () {


            $('#jwlCard').hide();
            $('#jwlEmpty').hide();


            $('select[name="Metel_Type"], select[name="Category_Type"], select[name="Manufacturing_Type"], select[name="Product_Type"]').on('change', function () {

                let metal = $('select[name="Metel_Type"]').val();
                let category = $('select[name="Category_Type"]').val();
                let manufacturing = $('select[name="Manufacturing_Type"]').val();
                let productype = $('select[name="Product_Type"]').val();


                if (
                    metal === '' ||
                    category === '' ||
                    manufacturing === '' ||
                    productype === ''
                ) {

                    $('#jwlBody').html('');
                    $('#jwlCard').hide();
                    $('#jwlEmpty').hide();

                    return;
                }

                $.ajax({

                    url: APP_URL + "/get-item-by-filter",
                    type: "GET",

                    data: {
                        metal: metal,
                        category: category,
                        manufacturing: manufacturing,
                        productype: productype
                    },

                    beforeSend: function () {

                        $('#jwlCard').hide();
                        $('#jwlEmpty').hide();
                    },

                    success: function (response) {


                        $('#jwlBody').html('');


                        if (response.length > 0) {


                            $('#jwlCard').show();


                            $('#jwlCount').text(response.length + ' Items');

                            $.each(response, function (index, row) {

                                let imageHtml = '';


                                if (row.Jwl_Image) {

                                    imageHtml = `
                                <img src="${APP_URL}/uploads/jewellery/${row.Jwl_Image}"
                                     class="img-thumb preview-image"
                                     data-img="${APP_URL}/uploads/jewellery/${row.Jwl_Image}">
                            `;

                                } else {

                                    imageHtml = `
                                <div class="img-placeholder">
                                    No<br>Image
                                </div>
                            `;
                                }

                                // Append Row
                                $('#jwlBody').append(`

                            <tr>

                                <td style="color:#adb5bd; font-size:12px;">
                                    ${index + 1}
                                </td>

                                <td>
                                    <span class="code-pill">
                                        ${row.Item_Code}
                                    </span>
                                </td>

                                <td>
                                    ${imageHtml}
                                </td>

                                <td>
                                    ${row.Category_Name}
                                </td>

                                <td>
                                    ${row.Category_Type}
                                </td>

                                <td>
                                    <span class="badge-mfg">
                                        ${row.Manufacturing_Type}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge-prod">
                                        ${row.Product_Type}
                                    </span>
                                </td>

                                <td>
                                    ${row.Item}
                                </td>

                                <td>
                                    ${row.Karat}
                                </td>

                            </tr>

                        `);

                            });

                        } else {

                            // No Data
                            $('#jwlCard').hide();
                            $('#jwlEmpty').show();
                        }
                    },

                    error: function () {

                        alert('Something went wrong!');
                    }
                });

            });

        });

    }
});