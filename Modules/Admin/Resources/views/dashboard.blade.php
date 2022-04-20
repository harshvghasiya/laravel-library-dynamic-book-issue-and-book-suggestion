@extends('admin::layouts.master')
@section('content')
<div class="row margin-top-10">
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BANNER_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.banners.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
						<i class="fa fa-file-image-o" aria-hidden="true"></i> <small>{{trans('lang_data.banner_dashboard_label')}}</small>
					</div> 
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_EMAIL_TEMPLATE_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.email-template.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i> <small>{{trans('lang_data.email_template_label')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SOCIAL_MEDIA_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.social_medias.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-share-alt-square" aria-hidden="true"></i> <small>{{trans('lang_data.social_media_label')}}</small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CONTACT_US_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.contactus.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-phone-square" aria-hidden="true"></i> <small>{{trans('lang_data.contactus_label')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CATEGORY_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.category.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-list-alt" aria-hidden="true"></i> <small>{{trans('lang_data.total_category')}}</small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.cms.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-database" aria-hidden="true"></i> <small>{{trans('lang_data.pages_module_label')}}</small>
						</div>
						
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_NEWSLETTER_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.news-letter.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-paper-plane" aria-hidden="true"></i> <small>{{trans('lang_data.news_letter_label_single')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SETTINNG_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.settings.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-gear"></i> <small>{{trans('lang_data.setting_label')}}</small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BLOG_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.blogs.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-info-circle" aria-hidden="true"></i> <small>{{trans('lang_data.blog_label')}}</small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.modules.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-mars-stroke-v" aria-hidden="true"></i> <small>{{trans('lang_data.module_label')}}</small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ACL_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.acl.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-file-image-o" aria-hidden="true"></i> <small>{{trans('lang_data.acl')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_TAG_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.tag.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-tag" aria-hidden="true"></i> <small>{{trans('lang_data.tag')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
	@if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_TECHNOLOGY_MODULE))
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="{{route('admin.technology.index')}}">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-puzzle-piece" aria-hidden="true"></i> <small>{{trans('lang_data.technology')}}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	@endif
</div>
@endsection
