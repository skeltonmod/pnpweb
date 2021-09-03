<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="eng">
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" crossorigin="anonymous"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/cr-1.5.4/kt-2.6.2/r-2.2.9/sp-1.3.0/sl-1.3.3/datatables.min.css"/>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/cr-1.5.4/kt-2.6.2/r-2.2.9/sp-1.3.0/sl-1.3.3/datatables.min.js"></script>

	<title>COCPO Web Dashboard</title>
	<style>
		.bg-light{
			background-color: red !important;
		}

		.btn-danger{
			color: #fff;
			background-color: #ff0000;
			border-color: #000000;
		}

		.navbar-light .navbar-nav .nav-link {
			color: rgb(255 255 255);
		}

		.card-header {
			padding: .5rem 1rem;
			margin-bottom: 0;
			background-color: rgb(230 0 0 / 100%);
			border-bottom: 1px solid rgb(146 0 0 / 100%);
			color: white;
		}

		.card-body {
			flex: 1 1 auto;
			padding: 1rem 1rem;
			background-color: #e0e0e0;
			border-color: antiquewhite;
		}

		.btn-warning {
			color: #fff;
			background-color: #ff0000;
			border-color: #000000;
		}

		.btn-warning:hover {
			color: #fff;
			background-color: #ff5757;
			border-color: #c34c13;
		}

		.btn-success {
			color: #fff;
			background-color: #ff0000;
			border-color: #000000;
		}
		.btn-success:hover {
			color: #fff;
			background-color: #ff5757;
			border-color: #c34c13;
		}

		.btn-primary:hover {
			color: #fff;
			background-color: #ff5757;
			border-color: #c34c13;
		}

		.btn-primary {
			color: #fff;
			background-color: #ff0000;
			border-color: #000000;
		}

		.modal-content {
			position: relative;
			display: flex;
			flex-direction: column;
			width: 100%;
			pointer-events: auto;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid rgba(0,0,0,.2);
			border-radius: .3rem;
			outline: 5px;
			box-shadow: 1px 1px 9px black;
		}
		.h4, h4 {
				font-size: 1.5rem;
				color: white;
			}
		.nav-link {
			display: block;
			padding: .5rem 1rem;
			color: #ffffff;
			text-decoration: none;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
		}

		.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
			color: #fff;
			background-color: #b32808;
		}

		.nav-link {
			display: block;
			padding: .5rem 1rem;
			color: #c31414;
			text-decoration: none;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
		}

		.card {
			position: relative;
			display: flex;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 1px solid rgba(0,0,0,.125);
			border-radius: .25rem;
			outline: 5px;
			box-shadow: 1px 1px 5px black;
		}


		.accordion-button:not(.collapsed) {
			color: #ffffff;
			background-color: #e7f1ff;
			box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
		}


		.accordion-button:not(.collapsed) {
			padding: .5rem 1rem;
			margin-bottom: 0;
			background-color: rgb(230 0 0);
			border-bottom: 1px solid rgb(146 0 0 / 100%);
		}

		 .accordion-button.collapsed {
			padding: .5rem 1rem;
			margin-bottom: 0;
			 color: #ffffff;
			background-color: rgb(230 0 0 / 100%);
			border-bottom: 1px solid rgb(146 0 0 / 100%);
		}
	</style>
</head>

	<body>
	<?php
	if(count($_SESSION) > 0){
		include 'NavBody.php';
	}
	?>
	</body>
<script>
  		$("#logout").on('click', function (e){
			$.ajax({
				url: `<?php echo site_url()?>/main/logout_personnel`,
				method: 'post',
				dataType: 'json',
				complete: function (response){
					window.location.replace("<?php echo site_url()?>main/index/Login");
				}
			})
		}) 
	</script>
</html>
