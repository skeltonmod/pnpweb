<html lang="eng">
<head>
	<title>Incidents</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">

				<div class="card-header">
					Manage Incident
					<button type="button" class="btn btn-warning float-end mx-3">Reload</button>
					<button type="button" data-bs-toggle="modal" data-bs-target="#addIncidentModal" class="btn btn-success float-end">Add</button>
				</div>
				<div class="card-body">
					<table class="table display responsive nowrap" id="incidentTable" style="width: 100%">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Incident Date</th>
							<th scope="col">Latitude</th>
							<th scope="col">Longitude</th>
							<th scope="col">Remarks</th>
							<th scope="col">Suspect</th>
							<th scope="col">Victim</th>
							<th scope="col">Image</th>
							<th scope="col">Actions</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<!-- INSERT MODAL -->
	<div class="modal fade" id="addIncidentModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Incident</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<iframe src="../../map.html" id="mapframe" width="470" height="320" seamless></iframe>
						</div>
					</div>
					<div class="row">

						<div class="col">
							<form id='frmIncident' >
								<div class="mb-3">
									<label> Incident Date </label>
									<input type="date" class="form-control" name="incident_date" id="incident_date "/>
								</div>

								<div class="mb-3">
									<label> Incident Time </label>
									<input type="time" class="form-control" name="incident_time" id="incident_time"/>
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="suspect" id="suspect" placeholder="Suspect" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="victim" id="victim" placeholder="Victim" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="remarks" id="remarks" placeholder="Remarks" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="latitude" id="latitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude"/>
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="location" id="location" placeholder="Location"/>
								</div>
								<div class="mb-3">
									<img src="../../incident_images/no_image.png" id="img_save_preview" width="120" height="120">
									<input type="file" onchange="getImage(this, 'add')" id="file_save_img" name="file_save_img"/>
								</div>

							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" id="addBtn" class="btn btn-primary">Add Incident</button>
				</div>
			</div>
		</div>
	</div>
<!-- EDIT MODAL -->
	<div class="modal fade" id="editIncidentModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Incident</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<iframe src="../../map.html" id="mapframe" width="470" height="320" seamless></iframe>
						</div>
					</div>
					<div class="row">

						<!-- Other half of the modal-body div-->
						<div class="col">
							<form id='frmEditIncident' >
								<div class="mb-3">
									<label> Incident Date </label>
									<input type="date" class="form-control" name="incident_date" id="edit_incident_date"/>
								</div>
								<div class="mb-3">
									<label> Incident Time </label>
									<input type="time" class="form-control" name="incident_time" id="edit_incident_time"/>
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="suspect" id="edit_suspect" placeholder="Suspect" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="victim" id="edit_victim" placeholder="Victim" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="remarks" id="edit_remarks" placeholder="Remarks" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="latitude" id="edit_latitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="longitude" id="edit_longitude" placeholder="Longitude"/>
								</div>
								<div class="mb-3">
									<input type="text" class="form-control" name="location" id="edit_location" placeholder="Location"/>
								</div>
<!--								<div class="form-group">-->
<!--									<img src="../../incident_images/no_image.png" id="edit_img_save_preview" width="120" height="120">-->
<!--									<input type="file" onchange="getImage(this, 'edit')" id="edit_file_save_img" name="file_save_img"/>-->
<!--								</div>-->

							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" id="saveBtn" class="btn btn-primary">Save Changes</button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$(document).ready(function (){
		$("#incidentTable").dataTable({
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			lengthChange: true,
			responsive: true,
			"paging": true,
			"processing": true,
			"serverMethod": "post",
			"order": [[ 0, "desc" ]],
			"ajax": {
				"url": "<?php echo site_url()?>/main/getIncidents",
			},
			"columns":[
				{data: "id"},
				{data: "date"},
				{data: "lat"},
				{data: "long"},
				{data: "remarks"},
				{data: "suspect"},
				{data: "victim"},
				{data: "image",
					render: function (data){
						let isEmpty = (data === "" ? "no_image.png" : data)
						return `<img width=50 height=50 src='../../incident_images/${isEmpty}' alt="">`;
					}},
				{data: "id",
					render: function (data){
						return `<button type="button" onclick="manageData(${data}, 'edit')" data-bs-toggle="modal" data-bs-target="#editIncidentModal" class="btn btn-primary">Edit</button>
								<button type="button" onclick="manageData(${data}, 'delete')" class="btn btn-primary">Remove</button>`;
					}},
			]
		})
	})

	function getBarangay(location, lat, long){
		$("#latitude").val(lat)
		$("#longitude").val(long)
		$("#location").val(location)
	}

	$("#addBtn").on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmIncident"));
		formData.append("image", $("#file_save_img")[0].files[0])
		$.ajax({
			url: `<?php echo site_url()?>/main/insertIncident`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)

			}

		})
	})


	function getImage(input, key){
		if (input.files && input.files[0]) {
			let reader = new FileReader();
			reader.onload = function (e) {
				$(`${key === 'edit' ? '#edit_img_save_preview' : '#img_save_preview'}`)
						.attr('src', e.target.result)
						.width(200)
						.height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#saveBtn').on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmEditIncident"));
		formData.append("key", "update")
		formData.append("id", this.name)
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_incident`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)
				alert("Incident Edited Successfully")
			}

		})
	})

	function manageData(id, key){
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_incident`,
			method: 'post',
			dataType: 'json',
			data: {
				id: id,
				key: key
			},
			success: function (response){
				switch (key){
					case "edit":
						let data = response[0]
						console.log(data.incident_date)

						$("#edit_incident_date").val(data.incident_date)
						$("#edit_incident_time").val(data.incident_time)
						$("#edit_suspect").val(data.suspect)
						$("#edit_victim").val(data.victim)
						$("#edit_remarks").val(data.remarks)
						$("#edit_latitude").val(data.latitude)
						$("#edit_longitude").val(data.longitude)
						$("#edit_location").val(data.location)
						//$("#edit_img_save_preview").attr('src',`<?php //echo base_url('incident_images')?>///${data.picture}`)
						$("#saveBtn").attr('name', data.incident_no)

						break;

					case "delete":
						alert("Incident Deleted Successfully")
						break;
				}



			}

		})
	}
</script>
</html>
