<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown " data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item <?php echo $page=='Dashboard'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/dashboard" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">Dashboard</span></a></li>
			<li class="m-menu__item <?php echo $page=='Users'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/users/" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-users-1"></i><span class="m-menu__link-text">Users</span></a></li>
			<li class="m-menu__item <?php echo $page=='Setting'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/setting" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-interface-7"></i><span class="m-menu__link-text">Setting</span></a></li>
			<li class="m-menu__item <?php echo $page=='Category'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/category" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Category</span></a></li>
			<li class="m-menu__item <?php echo $page=='Introduction'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/Introduction" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-presentation-1"></i><span class="m-menu__link-text">Introduction Videos</span></a></li>
			<!-- <li class="m-menu__item <?php echo $page=='Features'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/features" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-eye"></i><span class="m-menu__link-text">Features</span></a></li> -->
			<li class="m-menu__item <?php echo $page=='Membership'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/membership" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-medal"></i><span class="m-menu__link-text">Membership</span></a></li>
			<li class="m-menu__item <?php echo $page=='Contents'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/contents" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-folder-1"></i><span class="m-menu__link-text">Contents</span></a></li>
			<!-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--bottom-1" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-folder-1"></i><span class="m-menu__link-text">Contents</span><i
					 class="m-menu__ver-arrow la la-angle-right"></i></a>
				<div class="m-menu__submenu m-menu__submenu--up"><span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent m-menu__item--bottom-1" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Contents</span></span></li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">All Cotents</span></a></li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Add Content</span></a></li>
					</ul>
				</div>
			</li> -->
			<li class="m-menu__item <?php echo $page=='Profile'?'m-menu__item--active':''; ?>" aria-haspopup="true"><a href="<?php echo base_url(); ?>admin/profile" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-lock"></i><span class="m-menu__link-text">Change Password</span></a></li>
			<li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>home" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-reply"></i><span class="m-menu__link-text">Go Home</span></a></li>
		</ul>
	</div>

	<!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->