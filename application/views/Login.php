<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(count($_SESSION) > 0){
	redirect('/main/index/Home');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to PNP Incident Reporting Dashboard</title>

</head>
<body>

<div class="container my-5">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4>Authentication Required</h4>

				</div>
				<div class="card-body">

					<p>This page contains a highly confidential information of a person, intended only for the Cagayan de Oro Police Office. If you are not in-charge and responsible to handle this kind of information please exit the page.</p>

					<code>Republic Act No. 10175 Chapter II Sec. 4 of Cybercrime Offenses (1) Illegal Access - The access to the whole or any part of a computer system without right is an punishable act. </code>
					<hr>
					<h5>Please Login Below!</h5>
					<hr>
					<form id="frmLogin">
						<div class="mb-3 row">
							<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="email" id="email">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="password" id="password">
							</div>
						</div>
						<div class="mb-3 row">
							<button type="submit" id="loginBtn" class="btn btn-primary">Login</button>
						</div>

					</form>


				</div>

			</div>

		</div>
	</div>

</div>

</body>

<script>
	$("#frmLogin").on('submit', function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById('frmLogin'))
		$.ajax({
			url: `<?php echo site_url()?>/main/login_personnel`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				if(!$.isEmptyObject(response.data)){
					window.location.replace("<?php echo site_url()?>main/index/Home");
				}else{
					alert("User does not Exist!")
				}
			}
		})
	})
</script>
</html>
