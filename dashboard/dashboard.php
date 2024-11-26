<?php 
include('../partials/header.php');

if (isset($_POST['Submit_Filter'])) {
    $fromDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];


    $from_datetime = $fromDate;
    $end_datetime = $endDate;
    $export_query = "?start=" . $_POST['start_date'] . "&end=" . $_POST['end_date'] . "&shop_id_filter=" . $_POST['shop_id_filter'] . "&type_filter=" . $_POST['type_filter'] . "&product_id_filter=" . $_POST['product_id_filter'];
} else {
    $fromDate = "";
    $endDate = "";
    $from_datetime = "";
    $end_datetime = "";
    $export_query = "";

}

$sql_select = "select SUM(quantity) as total_quantity_sold  from sales where type = 'sold' ";
$query_select = mysqli_query($connect, $sql_select);
$rc = mysqli_fetch_array($query_select);
// total stock_qty delivered to shops,
$total_quantity_sold = $rc['total_quantity_sold'];


$sql_select = "select SUM(quantity) as total_quantity_produced  from sales where type = 'produced' ";
$query_select = mysqli_query($connect, $sql_select);
$rc = mysqli_fetch_array($query_select);
// total stock_qty delivered to shops,
$total_quantity_produced = $rc['total_quantity_produced'];


$sql_select = "select  (SUM(CASE WHEN type = 'produced' THEN quantity ELSE 0 END) - 
     SUM(CASE WHEN type = 'sold' THEN quantity ELSE 0 END)) AS   total_quantity_remaining  from sales ";
$query_select = mysqli_query($connect, $sql_select);
$rc = mysqli_fetch_array($query_select);
// total stock_qty delivered to shops,
$total_quantity_remaining = $rc['total_quantity_remaining'];










?>
<!--begin::Row-->
<!--begin::Row-->
									<div class="row gy-5 gx-xl-10">
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-compass fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $total_quantity_produced; ?></span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Stock Available</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->
													<!--begin::Badge-->
													
													<!--end::Badge-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-chart-simple fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="path4"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $total_quantity_sold;?></span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Stock SOLD</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->
												
													<!--end::Badge-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $total_quantity_remaining;?></span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Total Stock Remaining</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->

												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-map fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">89M</span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">C APEX</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->
													<!--begin::Badge-->
													<span class="badge badge-light-success fs-base">
													<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>2.1%</span>
													<!--end::Badge-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-abstract-35 fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">72.4%</span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">OPEX</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->
													<!--begin::Badge-->
													<span class="badge badge-light-danger fs-base">
													<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>0.647%</span>
													<!--end::Badge-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
											<!--begin::Card widget 2-->
											<div class="card h-lg-100">
												<!--begin::Body-->
												<div class="card-body d-flex justify-content-between align-items-start flex-column">
													<!--begin::Icon-->
													<div class="m-0">
														<i class="ki-duotone ki-abstract-26 fs-2hx text-gray-600">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Icon-->
													<!--begin::Section-->
													<div class="d-flex flex-column my-7">
														<!--begin::Number-->
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">106M</span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Saving</span>
														</div>
														<!--end::Follower-->
													</div>
													<!--end::Section-->
													<!--begin::Badge-->
													<span class="badge badge-light-success fs-base">
													<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>2.1%</span>
													<!--end::Badge-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card widget 2-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
<div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
									
					
							
							
								<!--begin::Row-->
								<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
									<!--begin::Col-->
									<div class="col-xl-4">
									<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <div class="form-group d-flex align-items-center gap-2 mb-5">
                <label class="fs-6 fw-semibold">Search:</label>
                <input class="form-control form-control-solid w-250px" id="group_datatable_search">
            </div>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
   

        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->

        <table class="table align-middle table-row-dashed fs-6 gy-5" id="group_datatable">
            <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">

                    <th class="min-w-125px"> Shop</th>
                    <th class="min-w-125px">Total sold</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">




            </tbody>
           
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-8">
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
                    <th class="min-w-125px"> Total Produced </th>
                    <th class="min-w-125px">Total sold</th>
                    <th class="min-w-125px">Remaining</th>
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
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
</div>
<?php include('../partials/footer.php')?>					

<script>
	 let table;
    let fromDate = <?php echo json_encode($from_datetime); ?>;
    let endDate = <?php echo json_encode($end_datetime); ?>;

    

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
                }

            ],
            ajax: {
                type: "POST",
                url: "serverside_data/dashboard.php",
                data: {
                    action: "fetch_sales",
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


</script>

<script>
	 let tabled;


    

    $(document).ready(function() {
        tabled = $('#group_datatable').DataTable({
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
                }

            ],
            ajax: {
                type: "POST",
                url: "serverside_data/dashboard.php",
                data: {
                    action: "fetch_shops",
                    
                },

            }
        });

        $('#group_datatable_search').keyup(function() {
            // alert( $(this).val());

            tabled.search($(this).val()).draw();
        });

        $('[data-bs-toggle="tooltip"]').tooltip();
    });


</script>