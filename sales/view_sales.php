<?php
include('../partials/header.php');

if (isset($_POST['Submit_Filter'])) {
    $fromDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $shop_id_filter = $_POST['shop_id_filter'];
    $type_filter = $_POST['type_filter'];
    $product_id_filter = $_POST['product_id_filter'];

    $from_datetime = $fromDate;
    $end_datetime = $endDate;
    $export_query = "?start=" . $_POST['start_date'] . "&end=" . $_POST['end_date'] . "&shop_id_filter=" . $_POST['shop_id_filter'] . "&type_filter=" . $_POST['type_filter'] . "&product_id_filter=" . $_POST['product_id_filter'];
} else {
    $fromDate = "";
    $endDate = "";
    $from_datetime = "";
    $end_datetime = "";
    $export_query = "";
    $shop_id_filter = "";
    $type_filter = "";
    $product_id_filter= "";
}


?>
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <div class="form-group d-flex align-items-center gap-2 mb-5">
                <label class="fs-6 fw-semibold">Search:</label>
                <input class="form-control form-control-solid w-250px" id="datatable_search">
            </div>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filter</button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-4 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Form-->
                    <form action="" method="POST">
                        <div class="px-7 py-5" data-select2-id="select2-data-121-t5qw">
                            <!--begin::Input group-->
                            <div class="mb-5 row">
                                <!--begin::Label-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-semibold">Start Date:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="card-toolbar">
                                        <input class="form-control datepicker" placeholder="Pick a date" id="start_date" name="start_date" value="<?= $fromDate; ?>" />

                                    </div>
                                    <!--end::Input-->
                                </div>

                                <!--begin::Label-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-semibold">End Date:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="card-toolbar">

                                        <input class="form-control datepicker" placeholder="Pick a date" id="end_date" name="end_date" value="<?= $endDate; ?>" />

                                    </div>
                                    <!--end::Input-->
                                </div>

                            </div>

                            <div class="mb-5 row">
                                <!--begin::Label-->
                                <div class="col-xl-12">
                                    <label class="form-label fw-semibold">Type</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div id="sale_parent_filter" class="card-toolbar">
                                        <select id="type_filter" name="type_filter" class="form-select form-select-solid" data-dropdown-parent="#sale_parent_filter" data-control="select2">
                                            <option value="">Choose type</option>
                                            <option <?php echo ($type_filter == 'produced') ? "selected" : ""; ?> value="produced">Produced</option>
                                            <option <?php echo ($type_filter == 'sold') ? "selected" : ""; ?> value="sold">Sold</option>



                                        </select>

                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="mb-5 row">

                                <!--begin::Label-->
                                <div class="col-xl-12">
                                    <label class="form-label fw-semibold">Shops</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div id="shop_parent_filter" class="card-toolbar">

                                        <select id="shop_id_filter" name="shop_id_filter" class="form-select  form-select-solid" data-dropdown-parent="#shop_parent_filter" data-control="select2">
                                            <option value="">Choose Shop</option>

                                            <?php

                                            $query = mysqli_query($connect, "select * from shops order by id desc");
                                            while ($r = mysqli_fetch_array($query)) {
                                                $selected = ($r['id'] == $shop_id_filter) ? 'selected' : '';

                                                echo "<option ' . $selected . ' value='$r[id]'>$r[name]</option>";
                                            }
                                            ?>
                                        </select>


                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>

                            <div class="mb-5 row">

                                <!--begin::Label-->
                                <div class="col-xl-12">
                                    <label class="form-label fw-semibold">Products</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div id="filter_product" class="card-toolbar">

                                    <select id="product_id_filter" name="product_id_filter" class="form-select form-select-solid" data-dropdown-parent="#filter_product" data-control="select2">
                                        <option value="">Choose Product</option>

                                        <?php

                                        $query = mysqli_query($connect, "select products.id as id,products.name as product_name,categories.name as category_name from products,categories where products.category_id = categories.id order by id desc");
                                        while ($r = mysqli_fetch_array($query)) {
                                            $selected = ($r['id'] == $product_id_filter) ? 'selected' : '';

                                            echo "<option ' . $selected . ' value='$r[id]'>$r[product_name] - $r[category_name]</option>";
                                        }
                                        ?>
                                    </select>


                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>



                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <!-- <button id="reset" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button> -->
                                <input type="submit" name="Reset_Filter" id="Reset_Filter" class="btn btn-sm btn-light btn-active-light-primary me-2" value="Reset">
                                <!-- <button id="filter" type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button> -->
                                <input type="submit" name="Submit_Filter" id="Submit_Filter" class="btn btn-sm btn-light btn-active-light-primary me-2" value="Apply">
                            </div>
                            <!--end::Actions-->
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Export-->
                <a href="sales/export_sales.php?<?= $export_query; ?>" type="button" class="btn btn-light-success me-3">
                    <i class="ki-duotone ki-exit-up fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Export</a>
                <!--end::Export-->
                <!--begin::Add customer-->
                <a type="button" class="btn btn-primary add_sale" data-bs-toggle="modal" data-bs-target="#kt_modal_1">Add sale</a>
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->

        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->

        <table class="table align-middle table-row-dashed fs-6 gy-5" id="sale_datatable">
            <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">

                    <th class="min-w-125px"> Product</th>
                    <th class="min-w-125px"> Quantity </th>
                    <th class="min-w-125px">Type</th>
                    <th class="min-w-125px">Delivered To</th>
                    <th class="min-w-125px">Date</th>
                    <th class="text-end min-w-70px">Actions</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">




            </tbody>
            <tfoot>
                <tr>
                    <th> Total</th>
                    <th id="total_sale"> </th>

                </tr>
            </tfoot>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New sale</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <!-- <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div> -->

            <form action="" method="POST" name="add_sale_form" id="add_sale_form">
                <div class="modal-body">

                    <div id="sale_parent" class="row">

                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Products</label>
                            <select id="product_id" name="product_id" class="form-select form-select-solid" data-dropdown-parent="#sale_parent" data-control="select2">
                                <option value="">Choose Product</option>

                                <?php

                                $query = mysqli_query($connect, "select products.id as id,products.name as product_name,categories.name as category_name from products,categories where products.category_id = categories.id order by id desc");
                                while ($r = mysqli_fetch_array($query)) {

                                    echo "<option value='$r[id]'>$r[product_name] - $r[category_name]</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control form-control-solid" placeholder="Enter sale quantity">
                        </div>

                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Type of sales</label>
                            <select id="type" name="type" class="form-select form-select-solid" data-dropdown-parent="#sale_parent" data-control="select2">
                                <option disabled value="">Choose type</option>
                                <option value="produced">Produced</option>
                                <option value="sold">Sold</option>



                            </select>
                        </div>


                        <input type="hidden" name="action" id="add_sale_action" value="add_sale_action">



                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Shops</label>
                            <select id="shop_id" name="shop_id" class="form-select  form-select-solid" data-dropdown-parent="#sale_parent" data-control="select2">
                                <option value="">Choose Shop</option>

                                <?php

                                $query = mysqli_query($connect, "select * from shops order by id desc");
                                while ($r = mysqli_fetch_array($query)) {

                                    echo "<option value='$r[id]'>$r[name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>






                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <input type="submit" name="add_sale_submit" id="add_sale_submit" value="Save changes" class="btn btn-primary">
                </div>
            </form>



        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="edit_sale_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit sale</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <!-- <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div> -->
            <form action="" method="POST" name="edit_sale_form" id="edit_sale_form">
                <div class="modal-body">
                    <div id="edit_sale_modal_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <input type="submit" name="edit_sale_submit" id="edit_sale_submit" class="btn btn-primary" value="Save Changes">
                </div>
            </form>


        </div>
    </div>
</div>

<?php include('../partials/footer.php') ?>

<script>
    document.getElementById("breadcrumb").innerHTML = "sales";
</script>



<script>
    let table;
    let fromDate = <?php echo json_encode($from_datetime); ?>;
    let endDate = <?php echo json_encode($end_datetime); ?>;
    let shop_id_filter = <?php echo json_encode($shop_id_filter); ?>;
    let type_filter = <?php echo json_encode($type_filter); ?>;
    let product_id_filter = <?php echo json_encode($product_id_filter); ?>;

    

    $(document).ready(function() {
        table = $('#sale_datatable').DataTable({
            "language": {
                "infoFiltered": "",
                "processing": "Processing"
            },
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "columnDefs": [{
                    className: "text-center",
                    "targets": [1]
                },
                {
                    className: "text-center",
                    "targets": [2]
                },
                {
                    className: "text-center",
                    "targets": [3]
                },

            ],
            ajax: {
                type: "POST",
                url: "serverside_data/sales.php",
                data: {
                    action: "fetch_sales",
                    fromDate: fromDate,
                    endDate: endDate,
                    shop_id_filter: shop_id_filter,
                    type_filter: type_filter,
                    product_id_filter:product_id_filter
                },

            },
            "initComplete": function(settings, json) {
                $('#total_sale').text(json.total_sale);

                var link = $('#post-link_sub');
                // link.attr('href', `usage_statistics_export.html?subData=1&traffic=${traffic}&rate=${rate}&date=${date}&fromDate=${fromDate}&toDate=${toDate}`);
            }
        });

        $('#datatable_search').keyup(function() {
            // alert( $(this).val());

            table.search($(this).val()).draw();
        });

        $('[data-bs-toggle="tooltip"]').tooltip();
    });



    $(document).on('click', '.edit_btn', function() {
        var sale_id = $(this).val();

        $('#edit_sale_modal_body').html('');

        $.ajax({
            type: "POST",
            url: "serverside_data/sales.php",
            async: false,
            data: {
                action: "edit_sale_details_action",
                sale_id: sale_id
            },
            success: function(response) {
                // console.log(response);
                $('#edit_sale_modal_body').html(response);
                $('#edit_sale_modal').modal('show');
                $('.product_id').select2();
            }
        });


    });



    var validator_edit = $('#edit_sale_form').validate({ // initialize the plugin
        rules: {
            product_id: {
                required: true,
            },
            quantity: {
                required: true,
            },
            type: {
                required: true,
            }

        },
        messages: {
            product_id: {
                required: "<span class='text-danger'>Product is required</span>",
            },
            quantity: {
                required: "<span class='text-danger'>Quantity is required</span>",
            },
            type: {
                required: "<span class='text-danger'>Quantity Sold is required</span>",
            }
        },


    });


    $('#edit_sale_form').submit(function(e) {
        e.preventDefault();

        var form = $('#edit_sale_form')[0];
        var data = new FormData(form);

        if (validator_edit.errorList.length == 0) {
            $.ajax({
                type: "POST",
                url: "serverside_data/sales.php",
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.success == true) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.success(response.message, "Success!");
                        $('#edit_sale_modal').modal('hide');
                        table.ajax.reload();


                    } else if (response.success == false) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.error(response.message, "Error!");
                        $('#edit_sale_modal').modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }
    });


    var validator_add = $('#add_sale_form').validate({ // initialize the plugin
        rules: {
            product_id: {
                required: true,
            },
            quantity: {
                required: true,
            },
            type: {
                required: true,
            }

        },
        messages: {
            product_id: {
                required: "<span class='text-danger'>Product is required</span>",
            },
            quantity: {
                required: "<span class='text-danger'>Quantity is required</span>",
            },
            type: {
                required: "<span class='text-danger'>Quantity Sold is required</span>",
            }
        },


    });

    $(document).on('click', '.add_sale', function() {
        const form_details = $('#add_sale_form');

        form_details.validate().resetForm();
    });


    $('#add_sale_form').submit(function(e) {
        e.preventDefault();

        var form = $('#add_sale_form')[0];
        var data = new FormData(form);

        if (validator_add.errorList.length == 0) {
            $.ajax({
                type: "POST",
                url: "serverside_data/sales.php",
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.success == true) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.success(response.message, "Success!");

                        const form_details = $('#add_sale_form');

                        form_details.validate().resetForm();

                        $('#kt_modal_1').modal('hide');

                        table.ajax.reload();

                    } else if (response.success == false) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.error(response.message, "Error!");

                        const form_details = $('#add_sale_form');

                        form_details.validate().resetForm();

                        $('#kt_modal_1').modal('hide');

                        table.ajax.reload();
                    }
                }
            });
        }
    });



    $(document).on('click', '.delete_sale', function() {
        var sale_id = $(this).attr("data-numberId");

        $('.delete_sale').prop('disabled', true);


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "serverside_data/sales.php",
                    data: {
                        action: "delete_sale_action",
                        sale_id: sale_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response) {


                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your sale has been deleted.',
                                'success'
                            )

                            table.ajax.reload();
                        }
                    }
                });




            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                $('.delete_sale').prop('disabled', false);
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'You saved the sale :)',
                    'error'
                )
            }
        })





    });
</script>
<script>
    $('.datepicker').flatpickr();
</script>