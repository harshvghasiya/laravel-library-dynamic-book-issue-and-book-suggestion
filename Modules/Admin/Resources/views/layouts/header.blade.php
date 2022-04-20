<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="{{route('admin.dashboard')}}">
			<p class="logo-default" style="font-size: 24px">{{trans('lang_data.app_name')}}</p>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide">
					</li>
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						{{\Auth::user()->name}} </span>
						<img alt="{{\Auth::user()->name}}" class="img-circle" src="{{ \Auth::user()->getAdminUserImageUrl() }}"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="{{route('admin.settings.index')}}">
								<i class="icon-user"></i> {{trans('lang_data.setting_label')}} </a>
							</li>
							<li>
								<a href="{{route('admin.profile.edit_user_profile',\Crypt::encrypt(\Auth::user()->id))}}">
								<i class="icon-user"></i> {{trans('lang_data.edit_profile_label')}} </a>
							</li>
							<li>
								<a href="{{route('admin.logout')}}">
								<i class="icon-key"></i> {{trans('lang_data.logout_label')}} </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">
</div>