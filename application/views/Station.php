<html lang="eng">
<head>
	<title>Stations</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
	<div class="columns">
		<div class="column">
			<div class="card">

				<div class="card-header">
					Station Coverage
					<button type="button" class="btn btn-warning float-end mx-3">Reload</button>
					<?php

					if(isset($_SESSION)){
						if($_SESSION['type'] != "Standard"){
							echo '
					<button type="button" data-bs-toggle="modal" data-bs-target="#addStationModal" class="btn btn-success float-end">Add</button>';
						}
					}
					?>

				</div>
				<div class="card-body">
					<table class="table" id="stationTable">
						<thead>
						<tr>
							<th scope="col">Station #</th>
							<th scope="col">Station Name</th>
							<th scope="col">Lat/Long</th>
							<th scope="col">Remarks</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- INSERT MODAL -->
	<div class="modal fade" id="addStationModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Station</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="row">
							<div class="col">
								<iframe src="../../map.html" id="mapframe" width="470" height="320" seamless></iframe>
							</div>
						</div>
						<div class="col">
							<form id='frmStation'>

								<div class="mb-3">
									<label for="station_name">Station Name</label><input type="text" class="form-control" name="station_name" id="station_name" placeholder="Station Name" />
								</div>

								<div class="mb-3">
									<label for="latitude">Latitude</label><input type="text" class="form-control input-sm" name="lat" id="latitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<label for="longitude">Longitude</label><input type="text" class="form-control input-sm" name="long" id="longitude" placeholder="Longitude" />
								</div>
								<div class="mb-3">
									<label for="remarks">Remarks</label><input type="text" class="form-control input-sm" name="remarks" id="remarks" placeholder="Remarks" />
								</div>

							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" id="addBtn" class="btn btn-primary">Add Barangay</button>
				</div>
			</div>
		</div>
	</div>
	<!-- EDIT MODAL -->
	<div class="modal fade" id="editStationModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Station</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

						<!-- Other half of the modal-body div-->
						<div class="col">
							<form id='frmEditStation'>

								<div class="mb-3">
									<label for="editstation_name">Station Name</label><input type="text" class="form-control" name="station_name" id="editstation_name" placeholder="Station Name" />
								</div>

								<div class="mb-3">
									<label for="editlatitude">Latitude</label><input type="text" class="form-control input-sm" name="lat" id="editlatitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<label for="editlongitude">Longitude</label><input type="text" class="form-control input-sm" name="long" id="editlongitude" placeholder="Longitude" />
								</div>
								<div class="mb-3">
									<label for="editremarks">Remarks</label><input type="text" class="form-control input-sm" name="remarks" id="editremarks" placeholder="Remarks" />
								</div>
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

	function getBarangay(location, lat, long){
		$("#latitude").val(lat)
		$("#longitude").val(long)
		$("#station_name").val(location)
	}

	$(document).ready(function (){
		$("#stationTable").dataTable({
			lengthChange: true,
			"paging": true,
			"processing": true,
			"responsive": true,
			"serverMethod": "post",
			"order": [[ 0, "desc" ]],
			"ajax": {
				"url": "<?php echo site_url()?>/main/getStation",
			},
			"columns":[
				{data: "id"},
				{data: "station_name"},
				{data: "location"},
				{data: "remarks"},
				{data: "id",
					render: function (data){
						return `<button type="button" onclick="manageData(${data}, 'edit')" data-bs-toggle="modal" data-bs-target="#editStationModal" class="btn btn-success">Edit</button>
								<button type="button" onclick="manageData(${data}, 'delete')" class="btn btn-danger">Remove</button>`;
					}},
			]
		})
	})
	function manageData(id, key){

		$.ajax({
			url: `<?php echo site_url()?>/main/manage_station`,
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
						$("#editstation_name").val(data.station_name)
						$("#editlatitude").val(data.latitude)
						$("#editlongitude").val(data.longitude)
						$("#editremarks").val(data.remarks)
						$("#saveBtn").attr('name', data.station_id)
						break;
					case "delete":
						alert("Deleted!")
						break;

				}
			},
			complete: function (e){
				$("#stationTable").DataTable().ajax.reload()

			}
		})
	}

	$("#addBtn").on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmStation"));
		$.ajax({
			url: `<?php echo site_url()?>/main/insertStation`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)

			}

		})
		$("#stationTable").DataTable().ajax.reload()
	})

	$('#saveBtn').on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmEditStation"));
		formData.append("key", "update")
		formData.append("id", this.name)
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_station`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)
			}, complete: function (e){
				$("#stationTable").DataTable().ajax.reload()
				alert("Record Edited Successfully")
			}

		})
	})
</script>
</html>
