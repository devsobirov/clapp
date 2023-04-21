<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- PAGE TITLE HERE -->
    <title>CLAPP</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
	<link href="{{asset('assets/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/css/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">


</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
   <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('includes.nav-header')

        @include('includes.header')

        @include('includes.sidebar')

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @include('includes.messages')
            <!-- row -->
			<div class="container">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
           <div class="copyright border-top">
                <p>Copyright © {{date('Y')}}</p>
            </div>
        </div>
        <form action="{{route('logout')}}" method="post" class="d-none" id="logout-form">
            @csrf
        </form>
	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
	<script src="{{asset('assets/js/dlabnav-init.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/js/swiper-bundle.min.js')}}"></script>
	<script src="{{asset('assets/js/demo.js')}}"></script>

    @yield('scripts')
</body>
</html>
