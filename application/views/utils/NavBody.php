<nav class="navbar navbar-expand-lg navbar-light bg-light menu" style="margin-bottom: 1em">
	<a class="navbar-brand" href="#">COCPO Web Dashboard</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
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
				<a class="nav-link" href="<?php echo site_url('main/index/Reports')?>">Report</a>
			</li>
		</ul>
	</div>
	<div class="d-flex">
		<button class="btn btn-outline-danger mx-6" id="logout" type="button">Logout</button>
	</div>
</nav>
