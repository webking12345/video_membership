<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<!--Begin::Section-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Introduction Videos
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_contents">
									<thead>
										<tr>
											<th>No</th>
											<th>Category</th>
											<th>Video</th>
											<th>Thumbnail</th>
											<th>Actions</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<!--End::Section-->
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Upload Content</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!--begin::Form-->
							<form class="m-form m-form--fit m-form--label-align-right" id="m_frm" enctype="multipart/form-data">
								<div class="m-portlet__body">
									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-2 col-sm-12">Category *</label>
										<div class="col-lg-10 col-md-9 col-sm-12">
											<input type="hidden" class="form-control m-input" id="edit_id" name="edit_id">
											<input type="hidden" class="form-control m-input" id="category_id" name="category_id">											
											<select class="form-control m-input" id="category" name="category">
												<option value="" selected>Select a category</option>
												<?php 
													$str='';
													$str .= '<option value="0" class="m--font-boldest">Home</option>';
													foreach ($categories as $cate) {
														$str .= '<option value="'.$cate->id.'" class="'.($cate->is_leaf==0?"m--font-boldest":"").'" '.($cate->is_leaf==0?'disabled':'').' data-leaf="'.$cate->is_leaf.'">';
														for($i=1; $i<count(explode(".", $cate->class)); $i++)
														{
															$str .= "&nbsp;&nbsp;&nbsp;";
														}
														$str .= $cate->name.'</option>';
													}
													echo $str;
												?>
											</select>
										</div>
									</div>
									
									<div class="form-group m-form__group row">										
										<div class="col-lg-5 col-md-9 col-sm-12">
											<div class="m-radio-inline">
												<label class="m-radio m-radio--success">
													<input type="radio" name="source" value="1" checked> By URL
													<span></span>
												</label>
												<label class="m-radio m-radio--success">
													<input type="radio" name="source" value="2"> By File
													<span></span>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row url_row">
										<label class="col-form-label col-lg-2 col-sm-12">URL *</label>
										<div class="col-lg-5 col-md-9 col-sm-12">
											<input type="text" class="form-control m-input" id="source_url" name="source_url" placeholder="Enter Source URL">
										</div>
										<div class="col-lg-5 col-md-9 col-sm-12">
											<input type="text" class="form-control m-input" id="thumb_url" name="thumb_url" placeholder="Enter Thumbnail URL">
										</div>
									</div>
									
									<div class="form-group m-form__group row file_row" style="display:none">
										<label class="col-form-label col-lg-2 col-sm-12">File *</label>
										<div class="col-lg-5 col-md-9 col-sm-12">
											<a href="#" class="btn btn-warning m-btn m-btn--custom m-btn--icon btn-block" id="btn_source_file">
												<span>
													<i class="fa flaticon-interface"></i>
													<span>Source File</span>
												</span>
											</a>
											<input type="file" class="form-control m-input" id="source_file" name="source_file" accept="video/*" style="display:none">
										</div>
										<div class="col-lg-5 col-md-9 col-sm-12">
											<a href="#" class="btn btn-info m-btn m-btn--custom m-btn--icon btn-block" id="btn_thumb_file">
												<span>
													<i class="fa flaticon-interface"></i>
													<span>Thumbnail Image</span>
												</span>
											</a>
											<input type="file" class="form-control m-input" id="thumb_file" name="thumb_file" accept="image/*" style="display:none">
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
			<script>
				let categories=<?php echo json_encode($categories);?>
			</script>
			<!-- end:: Body -->