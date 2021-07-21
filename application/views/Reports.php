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
			<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="pills-add-tab" data-bs-toggle="pill" data-bs-target="#pills-add" type="button" role="tab" aria-controls="pills-add" aria-selected="true">Add Reports</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-view-tab" data-bs-toggle="pill" data-bs-target="#pills-view" type="button" role="tab" aria-controls="pills-view" aria-selected="false">View Reports</button>
				</li>
			</ul>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-add" role="tabpanel" aria-labelledby="pills-add-tab">
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
									<div class="col-sm-1 mb-3">
										<button type="button" name="predict" id="predict" class="btn btn-primary">Predict</button>
									</div>
									<div class="col-sm-2">
										<button type="button" id="addBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReportsModal">Add No. of Incidents</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab">

					<div class="card">
						<div class="card-header">
							<h4>Incident Report
							</h4>
							<form id="frmSearch">
								<div class="form-group row">
									<label for="colFormLabel" class="col-sm-1 col-form-label">From</label>
									<div class="col-sm-2">
										<select name="month" id="findMonthFrom"  class="form-select">
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
									<div class="col-sm-2">
										<select name="year" id="findYearFrom"  class="form-select">
										</select>
									</div>

									<label for="colFormLabel" class="col-sm-1 col-form-label">To</label>
									<div class="col-sm-2">
										<select name="monthTo" id="findMonthTo"  class="form-select">
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
									<div class="col-sm-2">
										<select name="yearTo" id="findYearTo"  class="form-select">
										</select>
									</div>
									<div class="col-sm-1">
										<button type="button" id="searchBtn" class="btn btn-primary">Search</button>
									</div>

									<div class="col-sm-1">
										<button type="button" id="generateBtn" class="btn btn-success"> Excel</button>
									</div>
								</div>
							</form>
						</div>
						<div class="card-body">
							<table id="tableReports" class="table display" style="width:100%">
								<thead>
								<tr>
									<th scope="col">Barangay</th>
									<th scope="col">Month</th>
									<th scope="col">Year</th>
									<th scope="col">Incidents</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
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
			$("select[name='yearTo']").append(`<option value="${date.getFullYear() - i}">${date.getFullYear() - i}</option>`)
		}
		$.ajax({
			url: "<?php echo site_url()?>/main/getBarangay",
			method: 'post',
			dataType: 'json',
			success: function (response) {
				$.each(response.data, function (index, value){
					$("select[name='barangay']").append(`<option value="${value.id}_${value.canonical_name}">${value.canonical_name}</option>`);
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

	$("#searchBtn").on('click', function (e){
		let formData = new FormData(document.getElementById('frmSearch'));
		$("#tableReports").DataTable().destroy();
		$("#tableReports").dataTable({
			lengthChange: true,
			responsive: true,
			"paging": true,
			"processing": true,
			"serverMethod": "post",
			"ajax": {
				"url": "<?php echo site_url()?>/main/get_report",
				"data": function (d){
					d.fromMonth = $("#findMonthFrom").val();
					d.fromYear = $("#findYearFrom").val();

					d.toMonth = $("#findMonthTo").val();
					d.toYear = $("#findYearTo").val();
				}
			},
			"columns":[
				{data: "barangay"},
				{data: "month"},
				{data: "year"},
				{data: "incidents"},
			]
		})
	})

	$("#generateBtn").on('click', function (e){
		let formData = new FormData(document.getElementById("frmSearch"));

		let data = {
			"from": `${formData.get('month')}_01_${formData.get('year')}`,
			"to": `${formData.get('monthTo')}_01_${formData.get('yearTo')}`
		}

		window.location.href = `<?php echo site_url()?>/excel/index?data=${JSON.stringify(data)}`
	})

	$("#predict").on('click', function (e){
		let data = {
			"date": `${$("#findMonth").val()}_01_${$("#findYear").val()}`,
			"barangay": `${$("#findBarangay").val()}`
		}
		window.location.href = `<?php echo site_url()?>/excel/csv?data=${JSON.stringify(data)}`
	})
</script>

</html>
