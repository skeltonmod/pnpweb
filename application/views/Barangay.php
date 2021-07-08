<?php ?>

<html lang="eng">
<head>
	<title>Barangay</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
	<div class="columns">
		<div class="column">
			<div class="card">

				<div class="card-header">
					<h4>Station Coverage

						<button type="button" class="btn btn-warning float-end mx-3">Reload</button>

						<?php

						if(isset($_SESSION)){
							if($_SESSION['type'] != "Standard"){
								echo '
					<button type="button" data-bs-toggle="modal" data-bs-target="#addBarangayModal" class="btn btn-success float-end">Add</button>';
							}
						}
						?>


						<a class="nav-link float-end mx-3" href="<?php echo site_url("main/index/StationMap")?>">Interactive Map</span></a>
					</h4>
				</div>
				<div class="card-body">
					<table class="table" id="barangayTable">
						<thead>
						<tr>
							<th scope="col">Barangay #</th>
							<th scope="col">Barangay Name</th>
							<th scope="col">Lat/Long</th>
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
	<div class="modal fade" id="addBarangayModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Barangay</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<iframe src="../../map.html" id="mapframe" width="470" height="320" seamless></iframe>
						</div>
					</div>
					<div class="row">

						<div class="col">
							<form id='frmBarangay'>
								<div class="mb-3">
									<label>
										Station ID
									</label>
									<select name="station_id" id="station_id"  class="form-select">
										<option value="1">Station 1</option>
										<option value="2">Station 2</option>
										<option value="3">Station 3</option>
										<option value="4">Station 4</option>
										<option value="5">Station 5</option>
										<option value="6">Station 6</option>
										<option value="7">Station 7</option>
										<option value="8">Station 8</option>
										<option value="9">Station 9</option>
										<option value="10">Station 10</option>
									</select>
								</div>

								<div class="mb-3">
									<label>
										Barangay Name
									</label>
									<input type="text" class="form-control" name="barangay_name" id="barangay_name" placeholder="Barangay Name" />
								</div>

								<div class="mb-3">
									<label>
										Canonical Name
									</label>
									<input type="text" class="form-control" name="canonical_name" id="location" placeholder="Canonical Name" />
								</div>

								<div class="mb-3">
									<label>
										Latitude
									</label>
									<input type="text" class="form-control input-sm" name="lat" id="latitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<label>
										Longitude
									</label>
									<input type="text" class="form-control input-sm" name="long" id="longitude" placeholder="Longitude" />
								</div>
								<div class="mb-3">
									<label>
										Remarks
									</label>
									<input type="text" class="form-control input-sm" name="remarks" id="remarks" placeholder="Remarks" />
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
	<div class="modal fade" id="editBarangayModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Barangay</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

						<!-- Other half of the modal-body div-->
						<div class="col">
							<form id='frmEditBarangay'>
								<div class="mb-3">
									<label>
										Station ID
									</label>
									<select name="station_id" id="editstation_id"  class="form-select">
										<option value="1">Station 1</option>
										<option value="2">Station 2</option>
										<option value="3">Station 3</option>
										<option value="4">Station 4</option>
										<option value="5">Station 5</option>
										<option value="6">Station 6</option>
										<option value="7">Station 7</option>
										<option value="8">Station 8</option>
										<option value="9">Station 9</option>
										<option value="10">Station 10</option>
									</select>
								</div>

								<div class="mb-3">
									<label>
										Barangay Name
									</label>
									<input type="text" class="form-control" name="barangay_name" id="editbarangay_name" placeholder="Barangay Name" />
								</div>

								<div class="mb-3">
									<label>
										Canonical Name
									</label>
									<input type="text" class="form-control" name="canonical_name" id="editlocation" placeholder="Canonical Name" />
								</div>

								<div class="mb-3">
									<label>
										Latitude
									</label>
									<input type="text" class="form-control input-sm" name="lat" id="editlatitude" placeholder="Latitude" />
								</div>
								<div class="mb-3">
									<label>
										Longitude
									</label>
									<input type="text" class="form-control input-sm" name="long" id="editlongitude" placeholder="Longitude" />
								</div>
								<div class="mb-3">
									<label>
										Remarks
									</label>
									<input type="text" class="form-control input-sm" name="remarks" id="editremarks" placeholder="Remarks" />
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
	$(document).ready(function (){
		$("#barangayTable").dataTable({
			lengthChange: true,
			"paging": true,
			"processing": true,
			"responsive": true,
			"serverMethod": "post",
			"order": [[ 0, "desc" ]],
			"ajax": {
				"url": "<?php echo site_url()?>/main/getBarangay",
			},
			"columns":[
				{data: "id"},
				{data: "barangay_name"},
				{data: "location"},
				{data: "id",
					render: function (data){
						return `<button type="button" onclick="manageData(${data}, 'edit')" data-bs-toggle="modal" data-bs-target="#editBarangayModal" class="btn btn-success">Edit</button>
								<button type="button" onclick="manageData(${data}, 'delete')" class="btn btn-danger">Remove</button>`;
					}},
			]
		})
	})

	function getBarangay(location, lat, long){
		$("#latitude").val(lat)
		$("#longitude").val(long)
		$("#location").val(location)
		$("#barangay_name").val(location)
	}

	$("#addBtn").on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmBarangay"));
		$.ajax({
			url: `<?php echo site_url()?>/main/insertBarangay`,
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
	$('#saveBtn').on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmEditBarangay"));
		formData.append("key", "update")
		formData.append("id", this.name)
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_barangay`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)
				alert("Barangay Edited Successfully")
			}, complete: function (e){
				$("#barangayTable").DataTable().ajax.reload()
				alert("Record Edited Successfully")
			}

		})
	})
	function manageData(id, key){

		$.ajax({
			url: `<?php echo site_url()?>/main/manage_barangay`,
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
						$("#editlocation").val(data.barangay_name)
						$("#editbarangay_name").val(data.canonical_name)
						$("#editlatitude").val(data.lat)
						$("#editlongitude").val(data.long)
						$("#editremarks").val(data.remarks)
						$("#editstation_id").val(data.station_id)
						$("#editstation_id").val(data.station_id)
						$("#saveBtn").attr('name', data.barangay_id)
						break;
					case "delete":
						alert("Deleted!")
						break;

				}
			},
			complete: function (e){
				$("#barangayTable").DataTable().ajax.reload()
			}
		})
	}
</script>
</html>
