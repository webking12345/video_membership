				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-6">
								<!--begin:: Widgets/Quick Stats-->
								<div class="row m-row--full-height">
									<div class="col-sm-12 col-md-12 col-lg-6">
										<div class="m-portlet m-portlet--half-height m-portlet--border-bottom-brand" style="height:120px">
											<div class="m-portlet__body">
												<div class="m-widget26">
													<div class="m-widget26__number">
														<?php echo $totalUsers; ?> / <?php echo $totalMembers; ?>
														<small>Total Users / Members</small>
													</div>
													
												</div>
											</div>
										</div>
										<div class="m--space-30"></div>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6">
										<div class="m-portlet m-portlet--half-height m-portlet--border-bottom-danger " style="height:120px">
											<div class="m-portlet__body">
												<div class="m-widget26">
													<div class="m-widget26__number">
														<?php echo $totalContents; ?>
														<small>Total Contents</small>
													</div>
													
												</div>
											</div>
										</div>
										<div class="m--space-30"></div>
									</div>
									
								</div>
								<!--end:: Widgets/Top Products-->
							</div>
						</div>
						<!--End::Section-->

						<!--Begin::Section-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Payment History
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_balance">
									<thead>
										<tr>
											<th>No</th>
											<th>User Name</th>
											<th>User Email</th>
											<th>Amount</th>
											<th>Description</th>
											<th>Date</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<!--End::Section-->
					</div>
				</div>
			</div>
			<!-- end:: Body -->