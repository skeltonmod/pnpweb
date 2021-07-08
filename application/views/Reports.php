<html lang="eng">

<head>
	<title>Barangay</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<div class="container">
		<div class="modal fade" id="addReportsModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Number of Incidents Entry Form</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

							<div class="col">
								<form id='frmAddReports'>

									<div class="mb-3">
										<label for="findMonth">
											Month
										</label>
										<select name="month" id="addMonth"  class="form-select">
											<option value="January">January</option>
											<option value="February">February</option>
											<option value="March">March</option>
											<option value="April">April</option>
											<option value="May">May</option>
											<option value="June">June</option>
											<option value="July">July</option>
											<option value="August">August</option>
											<option value="September">September</option>
											<option value="October">October</option>
											<option value="November">November</option>
											<option value="December">December</option>
										</select>
									</div>

									<div class="mb-3">
										<label for="findYear">Year</label><select name="year" id="addYear" class="form-select">
										</select>
									</div>

									<div class="mb-3">
										<label for="findBarangay">
											Barangay
										</label>
										<select name="barangay" id="addBarangay"  class="form-select">
										</select>
									</div>
									<div class="mb-3">
										<label for="addIncidents">
											Number of Incidents
										</label>
										<input name="incidents" id="addIncidents" class="form-control" type="number">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" id="saveBtn" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Reports</h4>
					</div>
					<div class="card-body">
						<form id="frmGetReports">

							<div class="mb-3">
								<label for="findMonth">
									Month
								</label>
								<select name="month" id="findMonth"  class="form-select">
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="December">December</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="findYear">Year</label><select name="year" id="findYear" class="form-select">
								</select>
							</div>

							<div class="mb-3">
								<label for="findBarangay">
									Barangay
								</label>
								<select name="barangay" id="findBarangay"  class="form-select">
								</select>
							</div>
							<div class="mb-3 row">
								<div class="col-md-2">
									<button type="button" id="predict" class="btn btn-primary">Predict</button>
								</div>
								<div class="col-md-2">
									<button type="button" id="addBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReportsModal">Add No. of Incidents</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

<script>

	$(document).ready(function(){
		let date = new Date();
		for(let i = 0; i <= 11; ++i){
			$("select[name='year']").append(`<option value="${date.getFullYear() - i}">${date.getFullYear() - i}</option>`)
		}
		$.ajax({
			url: "<?php echo site_url()?>/main/getBarangay",
			method: 'post',
			dataType: 'json',
			success: function (response) {
				$.each(response.data, function (index, value){
					$("select[name='barangay']").append(`<option value="${value.canonical_name}">${value.canonical_name}</option>`);
				});
			}

		})
	})

	$("#saveBtn").on('click', function (e){
		let formData = new FormData(document.getElementById('frmAddReports'));

		$.ajax({
			url: `<?php echo site_url()?>/main/insert_report`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){

			}
		})
	});

</script>

</html>
