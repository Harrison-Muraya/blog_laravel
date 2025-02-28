<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Global Header -->
		@include("$theme_dir.includes.global._head")
		<!-- End Global Header -->

		<!-- Main Header -->
		@include("$theme_dir.includes.head")
		<!-- End Main Header -->
	</head>

	<body class="index-page">

		<header id="header" class="header d-flex align-items-center sticky-top">
		  <div class="container position-relative d-flex align-items-center">
	  
			<a href="index.html" class="logo d-flex align-items-center me-auto">
			  <!-- Uncomment the line below if you also wish to use an image logo -->
			  <!-- <img src="assets/img/logo.png" alt=""> -->
			  <h1 class="sitename">Company</h1><span>.</span>
			</a>
	  
			<nav id="navmenu" class="navmenu">
			  <ul>
				<li><a href="/" class="active">Home</a></li>
				<li><a href="{{route('blogs')}}">Blog</a></li>
				<li><a href="contact.html">Contact</a></li>
			  </ul>
			  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
			</nav>
	  
		  </div>
		</header>

		<!-- Main Page -->
		@yield('content')
		<!-- End Main Page -->

		<!-- Global Footer -->
		@include("$theme_dir.includes.global._footer")
		<!-- End Global Footer -->

		<!-- Main Footer -->
		@include("$theme_dir.includes.footer")
		<!-- End Main Footer -->
	</body>

</html>
