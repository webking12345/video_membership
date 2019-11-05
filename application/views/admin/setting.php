				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<!--begin::Section-->
						<div class="m-portlet m-portlet--tabs">
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs-line m-tabs-line--danger m-tabs-line--2x m-tabs-line--right" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#tab_header_footer" role="tab">
												Header & Footer
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_home" role="tab">
												Home Page
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_register" role="tab">
												Register
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_login" role="tab">
												Login
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_join" role="tab">
												Join
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<div class="tab-pane active" id="tab_header_footer" role="tabpanel">
										<form id="frm_header_footer" method="POST" autocomplete="off"> 
											<div class="form-group mb-3">
												<label for="title" class="font-color-light-blue mb-0 font-color-gray mb-2">Site Title :</label>
												<input type="text" name="title" id="title" class="form-control" value="<?php echo isset($title) ?  $title : ''; ?>" required>
											</div>
											<div class="form-group mb-1">
												<label for="copyright" class="font-color-light-blue mb-0 font-color-gray mb-2">Copyright :</label>
												<input type="text" name="copyright" id="copyright" class="form-control" value="<?php echo isset($copyright) ? $copyright : ''; ?>" required>
											</div>

											<div class="form-group mb-1 mt-3" align="right">
												<button type="submit" class="btn btn-success pl-5 pr-5">Save</button>
											</div>                           
										</form>
									</div>
									<div class="tab-pane" id="tab_home" role="tabpanel">
										<form id="frm_home" method="POST" autocomplete="off"> 
											<div class="form-group mb-1">
												<label for="welcome" class="font-color-light-blue mb-0 font-color-gray mb-2">Welcome Texts :</label>
												<textarea name="welcome" id="welcome" rows="10" style="width:100%"><?php echo isset($welcome) ?  $welcome : ''; ?></textarea> 
											</div>

											<div class="form-group mb-1 mt-3" align="right">
												<button type="submit" class="btn btn-success pl-5 pr-5">Save</button>
											</div>                           
										</form>
									</div>
									<div class="tab-pane" id="tab_register" role="tabpanel">
										<form id="frm_register" method="POST" autocomplete="off"> 
											<div class="form-group mb-3">
												<label for="register_description1" class="font-color-light-blue mb-0 font-color-gray mb-2">Description :</label>
												<textarea name="register_description1" id="register_description1" rows="7" style="width:100%"><?php echo isset($register_description1) ?  $register_description1 : ''; ?></textarea> 
											</div>

											<div class="form-group mb-3">
												<label for="register_description2" class="font-color-light-blue mb-0 font-color-gray mb-2">Bottom Description :</label>
												<textarea name="register_description2" id="register_description2" rows="7" style="width:100%"><?php echo isset($register_description2) ?  $register_description2 : ''; ?></textarea> 
											</div>

											<div class="form-group mb-1 mt-3" align="right">
												<button type="submit" class="btn btn-success pl-5 pr-5">Save</button>
											</div>                           
										</form>
									</div>
									<div class="tab-pane" id="tab_login" role="tabpanel">
										<form id="frm_login" method="POST" autocomplete="off"> 
											<div class="form-group mb-1">
												<label for="login_description" class="font-color-light-blue mb-0 font-color-gray mb-2">Description :</label>
												<textarea name="login_description" id="login_description" rows="10" style="width:100%"><?php echo isset($login_description) ?  $login_description : ''; ?></textarea> 
											</div>

											<div class="form-group mb-1 mt-3" align="right">
												<button type="submit" class="btn btn-success pl-5 pr-5">Save</button>
											</div>                           
										</form>
									</div>
									<div class="tab-pane" id="tab_join" role="tabpanel">
										<form id="frm_join" method="POST" autocomplete="off"> 
											<div class="form-group mb-1">
												<label for="join_description" class="font-color-light-blue mb-0 font-color-gray mb-2">Description :</label>
												<textarea name="join_description" id="join_description" rows="10" style="width:100%"><?php echo isset($join_description) ?  $join_description : ''; ?></textarea> 
											</div>

											<div class="form-group mb-1 mt-3" align="right">
												<button type="submit" class="btn btn-success pl-5 pr-5">Save</button>
											</div>                           
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--end::Section-->
					</div>
				</div>
			</div>
			
			<!-- end:: Body -->