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
					<button type="button" data-bs-toggle="modal" data-bs-target="#addIncidentModal"
							class="btn btn-success float-end">Add
					</button>
				</div>
				<div class="card-body">
					<table class="table display responsive nowrap" id="incidentTable" style="width: 100%">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Incident Date</th>
							<th scope="col">Location</th>
							<th scope="col">Status</th>
							<!--							<th scope="col">Remarks</th>-->
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
	<div class="modal fade" id="addIncidentModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel"
		 aria-hidden="true">
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
							<form id='frmIncident'>
								<div class="mb-3">
									<label> Incident Date </label>
									<input type="date" class="form-control" name="incident_date" id="incident_date "/>
								</div>

								<div class="mb-3">
									<label> Incident Time </label>
									<input type="time" class="form-control" name="incident_time" id="incident_time"/>
								</div>

								<div class="mb-3">
									<label> Incident Suspect </label>
									<input type="text" class="form-control" name="suspect" id="suspect"
										   placeholder="Suspect"/>
								</div>
								<div class="mb-3">
									<label> Incident Victim </label>
									<input type="text" class="form-control" name="victim" id="victim"
										   placeholder="Victim"/>
								</div>
								<div class="mb-3">
									<label> Incident Remarks </label>
									<input type="text" class="form-control input-sm" name="remarks" id="remarks"
										   placeholder="Remarks"/>
								</div>
								<div class="mb-3">
									<label> Incident Latitude </label>
									<input type="text" class="form-control input-sm" name="latitude" id="latitude"
										   placeholder="Latitude"/>
								</div>
								<div class="mb-3">
									<label> Incident Longitude </label>
									<input type="text" class="form-control" name="longitude" id="longitude"
										   placeholder="Longitude"/>
								</div>
								<div class="mb-3">
									<label> Incident Location </label>
									<input type="text" class="form-control" name="location" id="location"
										   placeholder="Location"/>
								</div>
								<div class="mb-3">
									<label> Incident Image </label>
									<img src="../../incident_images/no_image.png" id="img_save_preview" width="120"
										 height="120">
									<input type="file" onchange="getImage(this, 'add')" id="file_save_img"
										   name="file_save_img"/>
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
	<div class="modal fade" id="editIncidentModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel"
		 aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Incident</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">

						<!-- Other half of the modal-body div-->
						<div class="col">
							<form id='frmEditIncident'>
								<iframe src="../../map.html" id="mapframe" width="470" height="320" seamless></iframe>
								<div class="mb-3">
									<label for="temp_id"></label><input type="text" name="temp_id" id="temp_id" value="0" hidden>
								</div>
								<div class="mb-3">
									<label> Incident Date </label>
									<label for="edit_incident_date"></label><input type="date" class="form-control" name="incident_date"
								id="edit_incident_date" /><!-- <?php //if ($_SESSION['type'] == "Standard") echo "readonly"; ?> -->
								</div>
								<div class="mb-3">
									<label> Incident Time </label>
									<label for="edit_incident_time"></label><input type="time" class="form-control" name="incident_time"
									id="edit_incident_time" /> <!-- <?php //if ($_SESSION['type'] == "Standard") echo "readonly"; ?> -->
								</div>
								<div class="mb-3">
									<label for="edit_remarks">Status</label>
									<label for="edit_status"></label><select name="status" id="edit_status" class="form-select">
										<option value="ACKNOWLEDGED">ACKNOWLEDGED</option>
										<option value="PENDING">PENDING</option>
										<option value="FOR INVESTIGATION">INVESTIGATION</option>
										<option value="SETTLED">SETTLED</option>
									</select>
								</div>

								<div class="mb-3">
									<label for="edit_suspect">Remarks</label><input type="text" class="form-control"
																name="remarks" id="edit_remarks"
																					placeholder="Remarks"/>
								</div>

								<div class="mb-3">
									<label for="edit_suspect">Suspect</label><input type="text" class="form-control"
																					name="suspect" id="edit_suspect"
																					placeholder="Suspect"/>
								</div>

								<div class="mb-3">
									<label for="edit_victim">Victim</label><input type="text" class="form-control"
									name="victim" id="edit_victim"
									placeholder="Victim" /> <!-- <?php //if ($_SESSION['type'] == "Standard") echo "readonly"; ?> -->
								</div>

								<div class="mb-3">
									<label for="edit_latitude">Latitude</label><input type="text"
																					  class="form-control input-sm"
																					  name="latitude" id="edit_latitude"
																					  placeholder="Latitude" <?php if ($_SESSION['type'] == "Standard") echo "readonly"; ?>/>


								</div>
								<div class="mb-3">
									<label for="edit_longitude">Longitude</label><input type="text" class="form-control"
																						name="longitude"
																						id="edit_longitude"
																						placeholder="Longitude" <?php if ($_SESSION['type'] == "Standard") echo "readonly"; ?>/>
								</div>
								<div class="mb-3">
									<label for="edit_location">Location</label><input type="text" class="form-control"
																					  name="location" id="edit_location"
																					  placeholder="Location" <?php if ($_SESSION['type'] == "Standard") echo "readonly"; ?>/>
								</div>
								<div class="mb-3">
									<label> Incident Image </label>
									<img src="../../incident_images/no_image.png" id="edit_img_save_preview" width="120"
										 height="120">
									<input type="file" onchange="getImage(this, 'edit')" id="edit_file_save_img"
										   name="file_save_img"/>
								</div>
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
	$(document).ready(function () {

		$("#incidentTable").dataTable({
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			lengthChange: true,
			responsive: true,
			"paging": true,
			"processing": true,
			"serverMethod": "post",
			"order": [[0, "desc"]],
			"ajax": {
				"url": "<?php echo site_url()?>/main/getIncidents",
			},
			"columns": [
				{data: "id"},
				{data: "date"},
				{data: "location"},
				{data: "status"},
				// {data: "remarks"},
				{data: "suspect"},
				{data: "victim"},
				{
					data: "image",
					render: function (data) {
						let isEmpty = (data === "Empty Data!" ? "no_image.png" : data)
						return `<img width=50 height=50 src='../../incident_images/${isEmpty}' alt="">`;
					}
				},
				{
					data: {id: "id", "status": status},
					render: function (data) {
						if(data !== "Empty Data!"){
							console.log(data);
							if(data.status !== "ON-GOING"){
								return `<button type="button" onclick="manageData(${data.id}, 'edit')" data-bs-toggle="modal" data-bs-target="#editIncidentModal" class="btn btn-primary">Edit</button>
								<button type="button" onclick="manageData(${data.id}, 'acknowledge')" class="btn btn-primary" disabled>Acknowledge</button>
								<?php if ($_SESSION['type'] == "SuperAdmin") {
								echo '<button type="button" onclick="manageData(${data.id}, \'delete\')" class="btn btn-primary">Delete</button>';
							}
							?>`
						}else{
							return `<button type="button" onclick="manageData(${data.id}, 'edit')" data-bs-toggle="modal" data-bs-target="#editIncidentModal" class="btn btn-primary" disabled>Edit</button>
								<button type="button" onclick="manageData(${data.id}, 'acknowledge')" class="btn btn-primary">Acknowledge</button>
								<?php if ($_SESSION['type'] == "SuperAdmin") {
								echo '<button type="button" onclick="manageData(${data.id}, \'delete\')" class="btn btn-primary">Delete</button>';
							}
							?>`
						}
						}else{
							return 'Empty!'
						}
					}

				},
			]
		})
	})

	function getBarangay(location, lat, long) {
		$("[name='latitude']").val(lat)
		$("[name='longitude']").val(long)
		$("[name='location']").val(location)
	}

	$("#addBtn").on("click", function (e) {
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
			success: function (response) {
				console.log(response)

			},
			complete: function(e){
				$("#incidentTable").DataTable().ajax.reload()
			}

		})
	})


	function getImage(input, key) {
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

	$('#saveBtn').on("click", function (e) {
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmEditIncident"));
		formData.append("key", "update")
		formData.append("id", this.name)
		formData.append("image", $('#edit_file_save_img')[0].files[0])
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_incident`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response) {
				//console.log(response)
				alert("Incident Edited Successfully")
			},

			complete: function (e) {
				$("#incidentTable").DataTable().ajax.reload()
				alert("Record Edited Successfully")
			}

		})
	})

	function manageData(id, key) {

		if(key == "delete"){
			if(!confirm('Are you sure you want to delete this barangay?')){
				return
			}
		}

		$.ajax({
			url: `<?php echo site_url()?>/main/manage_incident`,
			method: 'post',
			dataType: 'json',
			data: {
				id: id,
				key: key
			},
			success: function (response) {
				switch (key) {
					case "edit":
						let data = response[0]
						console.log(data.status)
						$("#edit_incident_date").val(data.incident_date)
						$("#edit_incident_time").val(data.incident_time)
						$("#edit_suspect").val(data.suspect)
						$("#edit_victim").val(data.victim)
						$("#edit_status").val(data.status).change()
						// document.getElementById('edit_status').value = data.status;
						$("#edit_remarks").val(data.remarks)
						$("#edit_latitude").val(data.latitude)
						$("#edit_longitude").val(data.longitude)
						$("#edit_location").val(data.location)
						$("#temp_id").val(data.temp_id)
						$("#saveBtn").attr('name', data.incident_no)
						$('#edit_img_save_preview').attr('src', `../../incident_images/${data.picture}`)
						break;

					case "delete":
						alert("Incident Deleted Successfully")
						break;

					case "acknowledge":
						alert("Incident Acknowledged!")
						break;
				}


			},
			complete: function (e) {
				$("#incidentTable").DataTable().ajax.reload()
			}

		})
	}
</script>
</html>
