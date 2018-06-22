<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	@yield('stylesheets')

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	@include('layouts.nav')
	
	@include('layouts.master_sidebar')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@yield('header')</h1>
				@yield('create_button')
			</div>
		</div><!--/.row-->
		@yield('content')
	</div>	<!--/.main-->
	
	<script src="{{ asset('js/app.js') }}"></script>

	@yield('scripts')
	@yield('scriptu')
</body>
</html>