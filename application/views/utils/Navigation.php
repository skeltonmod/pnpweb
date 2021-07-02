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
