<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> ATAH</title>
		<link rel="shortcut icon" href="/images/atah_logo.ico">
		<link rel="stylesheet" href="/css/style.css">
		<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
		<!--[if lt IE 9]>
		  <script src="/js/html5shiv.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="/js/sidebar.js"></script>

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Scripts -->
		<script>
			window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?>
		</script>

	@yield('content')

	</body>
</html>