<div class="left_col scroll-view" style="width: 100%">
	<div class="navbar nav_title" style="border: 0;">
		<a href="{!! URL::to('/') !!}" class="site_title"><i class="fa fa-pagelines"></i> <span>agrimap</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile clearfix">
		<div class="profile_pic">
			<img id="profile-pic" src="{{ URL::asset('/images/logo.jpg') }}" class="img-circle profile_img">
		</div>

		<div class="profile_info">
			<span>Welcome</span>

			<h2>Hello {{ Auth::user()->name }}</h2>
		</div>

		<div class="clearfix"></div>
	</div>

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<div class="menu_section">
			<ul class="nav side-menu">
				<li><a href="{{ URL::to('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

				@if(Auth::user()->isSiteAdmin())
				<li><a href="{{ URL::to('/crops') }}"><i class="fa fa-pagelines"></i> Crops</a></li>
				<li><a href="{{ URL::to('/regions') }}"><i class="fa fa-globe"></i> Regions</a></li>
				<li><a href="{{ URL::to('/districts') }}"><i class="fa fa-home"></i> Districts</a></li>
				@endif
				
				@if(Auth::user()->isSystemAdmin())
				<li><a href="{{ URL::to('/users') }}"><i class="fa fa-group"></i>Users</a></li>
				<li><a href="{{ URL::to('/backup') }}"><i class="fa fa-download"></i>Backup and Restore</a></li>
				@endif
			</ul>		
		</div>

		<div class="menu_section">
			<ul class="nav side-menu">
				<li class="{{ Request::segment(1) === 'my_account' ? 'active' : null }}"><a href="{{ URL::to('/users/'.Auth::user()->id) }}"><i class="fa fa-user"></i>My Account</a></li>
				<li class="{{ Request::segment(1) === 'support' ? 'active' : null }}"><a href="{{ URL::to('/support') }}"><i class="fa fa-support"></i>Support</a></li>
			</ul>
		</div>
	</div>
</div>
