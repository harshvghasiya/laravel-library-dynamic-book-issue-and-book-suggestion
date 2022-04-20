@extends('layouts.app')
@section('title')
<title>404 - Page Not Found</title>
@endsection
@section('style')

@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="content-page-404">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<h4 class="title">404</h4>
							<div class="subtitle">Sorry! The Page Not Found ;(</div>
							<p class="text">The Link You Folowed Probably Broken, or the page has been removed.</p>
							<a href="{{ route('front.home') }}" class="btn btn-small btn--primary btn-hover-shadow">
								<span class="text">Return to Home</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')

@endsection
