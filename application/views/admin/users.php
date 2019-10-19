				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<!--Begin::Section-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Registered Users
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_users">
									<thead>
										<tr>
											<th>No</th>
											<th>username</th>
											<th>email</th>
											<th>role</th>
											<th>membership</th>
											<th>status</th>
											<th>registered date</th>
											<th>last visit date</th>
											<th>actions</th>
										</tr>
									</thead>
									<tbody>
									
										<?php 
											$i=0;
											$str='';
											foreach ($users as $user) {
												$i++;
												$str .= '<tr id="'.$user->id.'">';
													$str .= '<td>'.$i.'</td>';
													$str .= '<td>'.$user->username.'</td>';
													$str .= '<td>'.$user->email.'</td>';
													$str .= '<td>'.$user->role.'</td>';
													$str .= '<td>'.$user->membership_id.'</td>';
													$str .= '<td>'.$user->allow.'</td>';
													$str .= '<td>'.$user->reg_datetime.'</td>';
													$str .= '<td>'.$user->last_datetime.'</td>';
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
			<div class="modal fade" id="m_modal_user" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!--begin::Form-->
							<form class="m-form m-form--fit m-form--label-align-right" id="m_frm_user">
								<div class="m-portlet__body">
									<div class="m-form__content">
										<div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_frm_user_msg">
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
											<input type="hidden" class="form-control m-input" id="edit_user_id">
											<input type="text" class="form-control m-input" id="name" name="name" placeholder="Enter name">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">email *</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<input type="text" class="form-control m-input" id="email" name="email" placeholder="Enter email address">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">password</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<input type="password" class="form-control m-input" id="password" name="password" placeholder="Enter new password">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">confirm password</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<input type="password" class="form-control m-input" id="confirm_password" name="confirm_password" placeholder="Enter confirm password">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">membership</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<select class="form-control m-input" id="membership" name="membership">
												<option value=""></option>
												<?php 
													foreach ($membership_levels as $level) {
														echo '<option value="'.$level->id.'">'.$level->level_name.'</option>';
													} 
												?>
											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">role *</label>
										<div class="col-lg-8 col-md-9 col-sm-12">
											<select class="form-control m-input" id="role" name="role">
												<option value="1">Administrator</option>
												<option value="2">User</option>
											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">allow</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class="m-checkbox-inline">
												<label class="m-checkbox">
													<input type="checkbox" id="allow" name="allow">
													<span></span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</form>

							<!--end::Form-->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="m_frm_user_submit">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				let membership_levels=<?php echo json_encode($membership_levels); ?>
			</script>
			<!-- end:: Body -->