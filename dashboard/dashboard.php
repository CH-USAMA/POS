<?php 
include('../partials/header.php');

$sql_select = "select SUM(stock_qty) as total_quantity,SUM(stock_sold) as total_sold,SUM(stock_qty - stock_sold) as stock_left  from stocks ";
$query_select = mysqli_query($connect, $sql_select);
$rc = mysqli_fetch_array($query_select);
// total stock_qty delivered to shops,
$total_quantity = $rc['total_quantity'];
$total_sold = $rc['total_sold'];
$stock_left = $rc['stock_left'];
// $total_sold = $rc['total_sold'];



// total stocks with delivery status
$sql_stocks = "select SUM(stock_qty) as total_quantity,SUM(stock_sold) as total_sold,SUM(stock_qty - stock_sold) as stock_left,products.name as name,product_id,'Delivered' as status  from stocks,products where stocks.product_id = products.id and stocks.shop_id <> 0  GROUP BY product_id
union
select SUM(stock_qty) as total_quantity,SUM(stock_sold) as total_sold,SUM(stock_qty - stock_sold) as stock_left,products.name as name,product_id,'NOt Delivered' as status  from stocks,products where stocks.product_id = products.id and stocks.shop_id = 0   GROUP BY product_id";
$query_stocks = mysqli_query($connect, $sql_stocks);




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
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $stock_left; ?></span>
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
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $total_quantity;?></span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Stock Produced</span>
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
														<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $total_sold;?></span>
														<!--end::Number-->
														<!--begin::Follower-->
														<div class="m-0">
															<span class="fw-semibold fs-6 text-gray-500">Total Stock Sold</span>
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
										<!--begin::Chart Widget 35-->
										<div class="card card-flush h-md-100">
											<!--begin::Header-->
											<div class="card-header pt-5 mb-6">
												<!--begin::Title-->
												<h3 class="card-title align-items-start flex-column">
													<!--begin::Statistics-->
													<div class="d-flex align-items-center mb-2">
														<!--begin::Currency-->
														<span class="fs-3 fw-semibold text-gray-500 align-self-start me-1">$</span>
														<!--end::Currency-->
														<!--begin::Value-->
														<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,274.94</span>
														<!--end::Value-->
														<!--begin::Label-->
														<span class="badge badge-light-success fs-base">
															<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>9.2%</span>
														<!--end::Label-->
													</div>
													<!--end::Statistics-->
													<!--begin::Description-->
													<span class="fs-6 fw-semibold text-gray-500">Avg. Agent Earnings</span>
													<!--end::Description-->
												</h3>
												<!--end::Title-->
											
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body py-0 px-0">
												<!--begin::Nav-->
												<ul class="nav d-flex justify-content-between mb-3 mx-9">
													<!--begin::Item-->
													<li class="nav-item mb-3">
														<!--begin::Link-->
														<a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px active" data-bs-toggle="tab" id="kt_charts_widget_35_tab_1" href="#kt_charts_widget_35_tab_content_1">1d</a>
														<!--end::Link-->
													</li>
													<!--end::Item-->
													<!--begin::Item-->
													<li class="nav-item mb-3">
														<!--begin::Link-->
														<a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_2" href="#kt_charts_widget_35_tab_content_2">5d</a>
														<!--end::Link-->
													</li>
													<!--end::Item-->
													<!--begin::Item-->
													<li class="nav-item mb-3">
														<!--begin::Link-->
														<a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_3" href="#kt_charts_widget_35_tab_content_3">1m</a>
														<!--end::Link-->
													</li>
													<!--end::Item-->
													<!--begin::Item-->
													<li class="nav-item mb-3">
														<!--begin::Link-->
														<a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_4" href="#kt_charts_widget_35_tab_content_4">6m</a>
														<!--end::Link-->
													</li>
													<!--end::Item-->
													<!--begin::Item-->
													<li class="nav-item mb-3">
														<!--begin::Link-->
														<a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_5" href="#kt_charts_widget_35_tab_content_5">1y</a>
														<!--end::Link-->
													</li>
													<!--end::Item-->
												</ul>
												<!--end::Nav-->
												<!--begin::Tab Content-->
												<div class="tab-content mt-n6">
													<!--begin::Tap pane-->
													<div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1">
														<!--begin::Chart-->
														<div id="kt_charts_widget_35_chart_1" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
														<!--end::Chart-->
														<!--begin::Table container-->
														<div class="table-responsive mx-9 mt-n6">
															<!--begin::Table-->
															<table class="table align-middle gs-0 gy-4">
																<!--begin::Table head-->
																<thead>
																	<tr>
																		<th class="min-w-100px"></th>
																		<th class="min-w-100px text-end pe-0"></th>
																		<th class="text-end min-w-50px"></th>
																	</tr>
																</thead>
																<!--end::Table head-->
																<!--begin::Table body-->
																<tbody>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-danger">-139.34</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">3:10 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$3,207.03</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-success">+576.24</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">3:55 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$3,274.94</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-success">+124.03</span>
																		</td>
																	</tr>
																</tbody>
																<!--end::Table body-->
															</table>
															<!--end::Table-->
														</div>
														<!--end::Table container-->
													</div>
													<!--end::Tap pane-->
													<!--begin::Tap pane-->
													<div class="tab-pane fade" id="kt_charts_widget_35_tab_content_2">
														<!--begin::Chart-->
														<div id="kt_charts_widget_35_chart_2" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
														<!--end::Chart-->
														<!--begin::Table container-->
														<div class="table-responsive mx-9 mt-n6">
															<!--begin::Table-->
															<table class="table align-middle gs-0 gy-4">
																<!--begin::Table head-->
																<thead>
																	<tr>
																		<th class="min-w-100px"></th>
																		<th class="min-w-100px text-end pe-0"></th>
																		<th class="text-end min-w-50px"></th>
																	</tr>
																</thead>
																<!--end::Table head-->
																<!--begin::Table body-->
																<tbody>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,345.45</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-success">+134.02</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">11:35 AM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-primary">-124.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">3:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-danger">+144.04</span>
																		</td>
																	</tr>
																</tbody>
																<!--end::Table body-->
															</table>
															<!--end::Table-->
														</div>
														<!--end::Table container-->
													</div>
													<!--end::Tap pane-->
													<!--begin::Tap pane-->
													<div class="tab-pane fade" id="kt_charts_widget_35_tab_content_3">
														<!--begin::Chart-->
														<div id="kt_charts_widget_35_chart_3" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
														<!--end::Chart-->
														<!--begin::Table container-->
														<div class="table-responsive mx-9 mt-n6">
															<!--begin::Table-->
															<table class="table align-middle gs-0 gy-4">
																<!--begin::Table head-->
																<thead>
																	<tr>
																		<th class="min-w-100px"></th>
																		<th class="min-w-100px text-end pe-0"></th>
																		<th class="text-end min-w-50px"></th>
																	</tr>
																</thead>
																<!--end::Table head-->
																<!--begin::Table body-->
																<tbody>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">3:20 AM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$3,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-primary">+185.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">12:30 AM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-danger">+124.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-success">-154.03</span>
																		</td>
																	</tr>
																</tbody>
																<!--end::Table body-->
															</table>
															<!--end::Table-->
														</div>
														<!--end::Table container-->
													</div>
													<!--end::Tap pane-->
													<!--begin::Tap pane-->
													<div class="tab-pane fade" id="kt_charts_widget_35_tab_content_4">
														<!--begin::Chart-->
														<div id="kt_charts_widget_35_chart_4" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
														<!--end::Chart-->
														<!--begin::Table container-->
														<div class="table-responsive mx-9 mt-n6">
															<!--begin::Table-->
															<table class="table align-middle gs-0 gy-4">
																<!--begin::Table head-->
																<thead>
																	<tr>
																		<th class="min-w-100px"></th>
																		<th class="min-w-100px text-end pe-0"></th>
																		<th class="text-end min-w-50px"></th>
																	</tr>
																</thead>
																<!--end::Table head-->
																<!--begin::Table body-->
																<tbody>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-warning">+124.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">5:30 AM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-info">+144.65</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,085.25</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-primary">+154.06</span>
																		</td>
																	</tr>
																</tbody>
																<!--end::Table body-->
															</table>
															<!--end::Table-->
														</div>
														<!--end::Table container-->
													</div>
													<!--end::Tap pane-->
													<!--begin::Tap pane-->
													<div class="tab-pane fade" id="kt_charts_widget_35_tab_content_5">
														<!--begin::Chart-->
														<div id="kt_charts_widget_35_chart_5" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
														<!--end::Chart-->
														<!--begin::Table container-->
														<div class="table-responsive mx-9 mt-n6">
															<!--begin::Table-->
															<table class="table align-middle gs-0 gy-4">
																<!--begin::Table head-->
																<thead>
																	<tr>
																		<th class="min-w-100px"></th>
																		<th class="min-w-100px text-end pe-0"></th>
																		<th class="text-end min-w-50px"></th>
																	</tr>
																</thead>
																<!--end::Table head-->
																<!--begin::Table body-->
																<tbody>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$2,045.04</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-warning">+114.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">3:30 AM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-primary">-124.03</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<a href="#" class="text-gray-600 fw-bold fs-6">10:30 PM</a>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="text-gray-800 fw-bold fs-6 me-1">$1.756.26</span>
																		</td>
																		<td class="pe-0 text-end">
																			<span class="fw-bold fs-6 text-info">+165.86</span>
																		</td>
																	</tr>
																</tbody>
																<!--end::Table body-->
															</table>
															<!--end::Table-->
														</div>
														<!--end::Table container-->
													</div>
													<!--end::Tap pane-->
												</div>
												<!--end::Tab Content-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Chart Widget 35-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-8">
										<!--begin::Table widget 14-->
										<div class="card card-flush h-md-100">
											<!--begin::Header-->
											<div class="card-header pt-7">
												<!--begin::Title-->
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label fw-bold text-gray-800">Products Stats</span>
													<!-- <span class="text-gray-500 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span> -->
												</h3>
												<!--end::Title-->
												
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-6">
												<!--begin::Table container-->
												<div class="table-responsive">
													<!--begin::Table-->
													<table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
														<!--begin::Table head-->
														<thead>
															<tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
																<th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
																<th class="p-0 pb-3 min-w-100px text-end">SOLD</th>
																<th class="p-0 pb-3 min-w-100px text-end">PRODUCED</th>
																<th class="p-0 pb-3 min-w-175px text-end pe-12">LEFT</th>
																<th class="p-0 pb-3 w-125px text-end pe-7">DELIVERED</th>
															</tr>
														</thead>
														<!--end::Table head-->
														<!--begin::Table body-->
														<tbody>

														<?php while($row = mysqli_fetch_array($query_stocks))
														{	$status = $row['status'];
															$total_quantity = $row['total_quantity'];
															$status = $row['status'];
															$status = $row['status'];
															$status = $row['status'];
															?>
															

														
															<tr>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="symbol symbol-50px me-3">
																			<img src="assets/media/stock/600x600/img-49.jpg" class="" alt="" />
																		</div>
																		<div class="d-flex justify-content-start flex-column">
																			<a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mivy App</a>
																			<span class="text-gray-500 fw-semibold d-block fs-7">Jane Cooper</span>
																		</div>
																	</div>
																</td>
																<td class="text-end pe-0">
																	<span class="text-gray-600 fw-bold fs-6">$32,400</span>
																</td>
																<td class="text-end pe-0">
																	<!--begin::Label-->
																	<span class="badge badge-light-success fs-base">
																		<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>9.2%</span>
																	<!--end::Label-->
																</td>
																<td class="text-end pe-12">
																	<span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
																</td>
																<td class="text-end pe-0">
																	<div id="kt_table_widget_14_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
																</td>
																<td class="text-end">
																	<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
																		<i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
																	</a>
																</td>
															</tr>
															<?php }?>
														</tbody>
														<!--end::Table body-->
													</table>
												</div>
												<!--end::Table-->
											</div>
											<!--end: Card Body-->
										</div>
										<!--end::Table widget 14-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
</div>
<?php include('../partials/footer.php')?>					