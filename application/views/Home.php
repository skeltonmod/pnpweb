<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to PNP Incident Reporting Dashboard</title>

</head>
<body>

<div class="container">
	<div class="row">

		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-warning-tab" data-bs-toggle="pill" data-bs-target="#pills-warning" type="button" role="tab" aria-controls="pills-warning" aria-selected="true">Warning</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-incident-tab" data-bs-toggle="pill" data-bs-target="#pills-incident" type="button" role="tab" aria-controls="pills-incident" aria-selected="false">User Incidents</button>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-warning" role="tabpanel" aria-labelledby="pills-warning-tab">
				<div class="card">
					<div class="card-header">
						<h4>Welcome to COCPO Incident Reporting</h4>

					</div>
					<div class="card-body">

						<p>This page contains a highly confidential information of a person, intended only for the Cagayan de Oro Police Office. If you are not in-charge and responsible to handle this kind of information please exit the page.</p>

						<code>Republic Act No. 10175 Chapter II Sec. 4 of Cybercrime Offenses (1) Illegal Access - The access to the whole or any part of a computer system without right is an punishable act. </code>
						<p>
							But if you are under Cagayan de Oro Police Office, responsible to handle this kind of information please ignore this message.
						</p>
					</div>

				</div>

			</div>
			<div class="tab-pane fade" id="pills-incident" role="tabpanel" aria-labelledby="pills-incident-tab">

				<div class="card">
					<div class="card-header">
						<h4>User Incidents
						<button class="btn btn-success float-end checked" onclick="moveIncident('accept')" style="margin-left: 1em; margin-right: 1em; display: none">Accept Checked</button>
						<button class="btn btn-danger float-end checked" onclick="moveIncident('reject')" style="display: none" >Reject Checked</button>
						</h4>
					</div>
					<div class="card-body">
						<table id="tableTempIncident" class="table display" style="width:100%">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">User ID</th>
								<th scope="col">Location</th>
								<th scope="col">Barangay</th>
								<th scope="col">Station</th>
								<th scope="col">Date</th>
								<th scope="col">Time</th>
								<th scope="col">Action</th>
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
	let checked_items = []
	$(document).ready(function (){

		$("#tableTempIncident").dataTable({
			lengthChange: true,
			responsive: true,
			"paging": true,
			"processing": true,
			"serverMethod": "post",
			"ajax": {
				"url": "<?php echo site_url()?>/main/get_temp_incident",
			},
			"columns":[
				{data: "id"},
				{data: "userid"},
				{data: "location"},
				{data: "barangay"},
				{data: "station"},
				{data: "date"},
				{data: "time"},
				{data: "id",
					render: function (data){
						return `<div class="form-check"><input class="form-check-input" name="checkbox" type="checkbox" value="${data}" id="${data}"></div>`
					}

				}
			]
		})

	})

	$(document).on('click','.form-check-input', function (e){
		if (this.checked){
			checked_items.push(this.value)
			console.log(checked_items)
		}else{
			checked_items.splice(checked_items.indexOf(this.value), 1)
			console.log(checked_items)
		}

		if(document.querySelectorAll('input[name=checkbox]:checked').length > 0){
			$(".checked").show()
		}else{
			$(".checked").hide()
		}
	})

	function moveIncident(mode){

		if(checked_items.length > 0){
			$.ajax({
				url: "<?php echo site_url()?>/main/move_incident",
				method: 'post',
				dataType: 'json',
				data:{
					items: checked_items,
					mode: mode,
				},
				success: function (response) {
					console.log(response)
				},
				complete: function (response){
					alert("Query Successful!")
					$("#tableTempIncident").DataTable().ajax.reload()
					checked_items = []
				}

			})
		}
	}



</script>
</html>
