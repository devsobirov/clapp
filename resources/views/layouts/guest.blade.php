<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
		<title>CLAPP - LOGIN</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/css/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">


</head>

<body class="vh-100"
    data-typography="poppins"
    data-theme-version="dark"
    data-layout="vertical"
    data-nav-headerbg="color_4"
    data-headerbg="color_4"
    data-sidebar-style="full"
    data-sibebarbg="color_1"
    data-sidebar-position="fixed"
    data-header-position="fixed"
    data-container="wide" direction="ltr"
    data-primary="color_1" data-secondary="color_1">

    <div class="authincation ">
        @yield('content')
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
</body>
</html>
