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
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light menu" style="margin-bottom: 1em">
	<a class="navbar-brand" href="#">COCPO Web Dashboard</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
		<?php echo base_url()?>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo site_url("main/index/Home")?>">Home</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Incidents')?>">Incidents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Personnel')?>">Personnel</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Barangay')?>">Barangay</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Station')?>">Station</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Report</a>
			</li>
		</ul>
	</div>
</nav>
</html>
