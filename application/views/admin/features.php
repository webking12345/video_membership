<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<!--Begin::Section-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Membership Features
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="#" data-toggle="modal"  data-target="#m_modal" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air" id="new_feature">
												<span>
													<i class="la la-plus"></i>
													<span>Add Feature</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_users">
									<thead>
										<tr>
											<th>No</th>
											<th>feature</th>
											<th>description</th>
											<th>tag</th>
											<th>actions</th>
										</tr>
									</thead>
									<tbody>
									
										<?php 
											$i=0;
											$str='';
											foreach ($features as $feature) {
												$i++;
												$str .= '<tr id="'.$feature->id.'">';
													$str .= '<td>'.$i.'</td>';
													$str .= '<td>'.$feature->feature.'</td>';
													$str .= '<td>'.$feature->feature_description.'</td>';
													$str .= '<td>'.$feature->tag.'</td>';
													$str .= '<td nowrap></td>';
												$str .= '</tr>';
											}
											echo $str;
										?>
									</tbody>
								</table>
							</div>
						</div>
						<!--End::Section-->
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Add Feature</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!--begin::Form-->
							<form class="m-form m-form--fit m-form--label-align-right" id="m_frm">
								<div class="m-portlet__body">
									<div class="m-form__content">
										<div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_frm_msg">
											<div class="m-alert__icon">
												<i class="la la-warning"></i>
											</div>
											<div class="m-alert__text">
												Oh snap! Change a few things up and try submitting again.
											</div>
											<div class="m-alert__close">
												<button type="button" class="close" data-close="alert" aria-label="Close">
												</button>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">name *</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<input type="hidden" class="form-control m-input" id="edit_id">
											<input type="text" class="form-control m-input" id="feature_name" name="feature_name" placeholder="Enter feature name">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">description</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<textarea class="form-control m-input" id="feature_description" name="feature_description" placeholder="Enter description"></textarea>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">tags</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<input type="text" class="form-control m-input" id="feature_tag" name="feature_tag" placeholder="Enter tags">
										</div>
									</div>
								</div>
							</form>

							<!--end::Form-->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="m_frm_submit">Save</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end:: Body -->