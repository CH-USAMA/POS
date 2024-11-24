<?php
include('../partials/header.php');

if (isset($_POST['Submit_Filter'])) {
    $fromDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $from_datetime = $fromDate . " 00:00:00";
    $end_datetime = $endDate . " 23:59:59";
    $export_query = "?start=" . $_POST['start_date'] . "&end=" . $_POST['end_date'];
} else {
    $fromDate = "";
    $endDate = "";
    $from_datetime = "";
    $end_datetime = "";
    $export_query = "";
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
                <a href="products/export_products.php?<?= $export_query; ?>" type="button" class="btn btn-light-success me-3">
                    <i class="ki-duotone ki-exit-up fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Export</a>
                <!--end::Export-->
                <!--begin::Add customer-->
                <a type="button" class="btn btn-primary add_product" data-bs-toggle="modal" data-bs-target="#kt_modal_1">Add product</a>
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

        <table class="table align-middle table-row-dashed fs-6 gy-5" id="product_datatable">
            <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">

                    <th class="min-w-125px"> Name</th>
                    <th class="min-w-125px"> Category </th>
                    <th class="min-w-125px">Created Date</th>
                    <th class="text-end min-w-70px">Actions</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">




            </tbody>
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
                <h3 class="modal-title">Add New product</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <!-- <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div> -->

            <form action="" method="POST" name="add_product_form" id="add_product_form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter product Name">
                        </div>
                        <input type="hidden" name="action" id="add_product_action" value="add_product_action">

                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Category</label>
                                <select id="category_id" name="category_id" class="form-select form-select-solid" data-control="select2">
                                    <option disabled value="">Choose Category</option>

                                        <?php
                                        
                                        $query = mysqli_query($connect, "select * from categories  order by id desc");
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
                    <input type="submit" name="add_product_submit" id="add_product_submit" value="Save changes" class="btn btn-primary">
                </div>
            </form>



        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="edit_product_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit product</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <!-- <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div> -->
            <form action="" method="POST" name="edit_product_form" id="edit_product_form">
                <div class="modal-body">
                    <div id="edit_product_modal_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <input type="submit" name="edit_product_submit" id="edit_product_submit" class="btn btn-primary" value="Save Changes">
                </div>
            </form>


        </div>
    </div>
</div>

<?php include('../partials/footer.php') ?>

<script>
    document.getElementById("breadcrumb").innerHTML = "products";
</script>



<script>
    let table;
    let fromDate = <?php echo json_encode($from_datetime); ?>;
    let endDate = <?php echo json_encode($end_datetime); ?>;

    $(document).ready(function() {
        table = $('#product_datatable').DataTable({
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
                    "targets": [2]
                },

            ],
            ajax: {
                type: "POST",
                url: "serverside_data/products.php",
                data: {
                    action: "fetch_products",
                    fromDate: fromDate,
                    endDate: endDate
                },

            }
        });

        $('#datatable_search').keyup(function() {
            // alert( $(this).val());

            table.search($(this).val()).draw();
        });

        $('[data-bs-toggle="tooltip"]').tooltip();
    });



    $(document).on('click', '.edit_btn', function() {
        var product_id = $(this).val();

        $('#edit_product_modal_body').html('');

        $.ajax({
            type: "POST",
            url: "serverside_data/products.php",
            async: false,
            data: {
                action: "edit_product_details_action",
                product_id: product_id
            },
            success: function(response) {
                // console.log(response);
                $('#edit_product_modal_body').html(response);
                alert("HERE");
                $('#category_id').select2();
                // Delay to ensure DOM is updated
        setTimeout(function() {
            $('#category_id').select2();
        }, 100); // Adjust time if needed
                $('#edit_product_modal').modal('show');
            }
        });


    });



    var validator_edit = $('#edit_product_form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            },
            category_id: {
                required: true,
            }

        },
        messages: {
            name: {
                required: "<span class='text-danger'>Name is required</span>",
            },
            category_id: {
                required: "<span class='text-danger'>Category is required</span>",
            }



        },


    });


    $('#edit_product_form').submit(function(e) {
        e.preventDefault();

        var form = $('#edit_product_form')[0];
        var data = new FormData(form);

        if (validator_edit.errorList.length == 0) {
            $.ajax({
                type: "POST",
                url: "serverside_data/products.php",
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
                        $('#edit_product_modal').modal('hide');
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
                        $('#edit_product_modal').modal('hide');
                        table.ajax.reload();
                    }
                }
            });
        }
    });


    var validator_add = $('#add_product_form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            },
            category_id: {
                required: true,
            }

        },
        messages: {
            name: {
                required: "<span class='text-danger'>Name is required</span>",
            },
            category_id: {
                required: "<span class='text-danger'>Category is required</span>",
            }
        },


    });

    $(document).on('click', '.add_product', function() {
        const form_details = $('#add_product_form');

        form_details.validate().resetForm();
    });


    $('#add_product_form').submit(function(e) {
        e.preventDefault();

        var form = $('#add_product_form')[0];
        var data = new FormData(form);

        if (validator_add.errorList.length == 0) {
            $.ajax({
                type: "POST",
                url: "serverside_data/products.php",
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

                        const form_details = $('#add_product_form');

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

                        const form_details = $('#add_product_form');

                        form_details.validate().resetForm();

                        $('#kt_modal_1').modal('hide');

                        table.ajax.reload();
                    }
                }
            });
        }
    });



    $(document).on('click', '.delete_product', function() {
        var product_id = $(this).attr("data-numberId");

        $('.delete_product').prop('disabled', true);


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
                    url: "serverside_data/products.php",
                    data: {
                        action: "delete_product_action",
                        product_id: product_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response) {


                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your product has been deleted.',
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
                $('.delete_product').prop('disabled', false);
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'You saved the product :)',
                    'error'
                )
            }
        })





    });
</script>
<script>
    $('.datepicker').flatpickr();
</script>