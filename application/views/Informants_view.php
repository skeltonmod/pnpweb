<html lang="eng">
<head>
	<title>Incidents</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.unverified {
			background-color: gray !important;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">

				<div class="card-header">
					Manage Informants
					<button type="button" class="btn btn-warning float-end mx-3">Reload</button>
				</div>
				<div class="card-body">
					<table class="table display responsive nowrap" id="informantTable" style="width: 100%">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First Name</th>
							<th scope="col">Last Name</th>
							<th scope="col">Nickname</th>
							<th scope="col">Gender</th>
							<th scope="col">Mobile Number</th>
							<th scope="col">Email Address</th>
							<th scope="col">Actions</th>
						</tr>
						</thead>
						<tbody id="tbody_informants"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- INSERT MODAL -->
	<div class="modal fade" id="addInformants" tabindex="-1" role="dialog" aria-labelledby="AddLabel"
		 aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Informants</h5>
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
					<button type="button" id="addBtn" class="btn btn-primary">Add Informants</button>
				</div>
			</div>
		</div>
	</div>
	<!-- EDIT MODAL -->
	<div class="modal fade" id="editPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel"
		 aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Informant Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<center>
								<form id='frmEditIncident'>

								<div class="mb-3">
									 
									<img src="../../incident_images/no_image.png" id="edit_img_save_preview" width="120"
										 height="120">
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Full Name: </label>
									<p id="name">Full Name</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Nick-Name: </label>
									<p id="nname">Nick Name</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Citizenship: </label>
									<p id="citizenship">Citizenship</p>
								</div>


								<div class="mb-3">
									<label style="font-weight: bold;"> Contact: </label>
									<p id="contact">Contact </p>
								</div>


								<div class="mb-3">
									<label style="font-weight: bold;"> Email Address: </label>
									<p id="email">Email Address</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Birth Date: </label>
									<p id="bday"> Birth Date</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Place of Birth: </label>
									<p id="pob">Place of Birth</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Gender: </label>
									<p id="gender">Gender</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;"> Civil Status: </label>
									<p id="civil_status">Civil Status</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;">  Occupation: </label>
									<p id="occupation">Occupation</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;">  Home Address: </label>
									<p id="homeaddress"> Home Address</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;">  Permanent Address: </label>
									<p id="currentaddress">Permanent Address</p>
								</div>

								<div class="mb-3">
									<label style="font-weight: bold;">  Work Address: </label>
									<p id="workaddress">Work Address</p>
								</div>
							</form>
							</center>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$(document).ready(function () {

 		$("#informantTable").dataTable({
			lengthChange: true,
			"paging": true,
			"processing": true,
			"responsive": true,
			"serverMethod": "post",
			"order": [[ 0, "desc" ]],
			"ajax": {
				"url": "<?php echo site_url()?>/informants/get_all_informants",
			},
				"columns": [
				{data: "userid"},
				{data: "firstname"},
				{data: "lastname"},
				{data: "nickname"},
				{data: "gender"},
				{data: "mobilenumber"},
				{data: "email"},
				{data: {userid: "userid", verified:"verified"},
					render: function (data) {
							let isverified = Boolean(Number(data.verified));
							if(isverified){
								return `
								<button type="button" onclick="viewInformant(${data.userid})" data-bs-toggle="modal" data-bs-target="#editPersonnelModal" class="btn btn-success">View</button>
							<button type="button" onclick="verifyUser(${data.userid})" class="btn btn-primary" disabled>Verify</button>`
						}else{
							return `
							<button type="button" onclick="viewInformant(${data.userid})" data-bs-toggle="modal" data-bs-target="#editPersonnelModal" class="btn btn-success">View</button>
							<button type="button" onclick="verifyUser(${data.userid})" class="btn btn-primary">Verify</button>
							`
						}
				}
			},
			],
			"createdRow": function( row, data, dataIndex){
				// console.log(Boolean(Number(data.verified)))
                if(!Boolean(Number(data.verified))){
                	$(row).addClass('unverified')
                }
            }
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
				$("#informantTable").DataTable().ajax.reload()
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
				$("#informantTable").DataTable().ajax.reload()
				alert("Record Edited Successfully")
			}
		})
	})

	// function getAllInformants(){	    
	// 			$.ajax({
	// 				url: "http://localhost/pnpweb/informants/get_all_informants",
	// 				type: "POST",
	// 				dataType: "json",
	// 				success: function(data){
	// 					var tbody = "";
						
	// 					for(var key in data){
	// 						tbody += "<tr>";
	// 						tbody += "<td class='col-no'>" + data[key]['userid'] + "</td>";
	// 						tbody += "<td class='col-no'>" + data[key]['firstname'] + "</td>";
	// 						tbody += "<td class='col-date'>" + data[key]['lastname'] + "</td>";
	// 						tbody += "<td class='col-lat-long'>" + data[key]['nickname'] + "</td>";
	// 						tbody += "<td class='col-lat-long'>" + data[key]['gender'] + "</td>";
	// 						tbody += "<td>" + data[key]['mobilenumber'] + "</td>";
	// 						tbody += "<td>" + data[key]['email'] + "</td>";
												    
	// 						tbody += `<td> 
	// 									<button id="${data[key]['incident_no']}" class="btn btn-danger btn-sm edit"> Acknowledge </button>
	// 									<button id="${data[key]['incident_no']}" class="btn btn-danger btn-sm delete"> Delete </button>
	// 								 </td>`;
	// 						tbody += "</tr>";
	// 					}
	// 					$('#tbody_informants').html(tbody);
	// 				}
	// 			});
	// 	}

	function verifyUser(id){
		$.ajax({
			url: `<?php echo site_url()?>/informants/verify_user`,
			method: 'post',
			data: {
				id: id
			},
			success: function (response){
				alert("User Successfully Edited");
			}
		});
	}

	function viewInformant(id) {
		$.ajax({
			url: `<?php echo site_url()?>/informants/get_informant`,
			method: 'post',
			dataType: 'json',
			data: {
				userid: id
			},
			success: function (response) {
				let data = response[0]

				$("#name").text(`${data.firstname} ${data.middlename} ${data.lastname}`)
				$("#nname").text(data.nickname)
				$("#citizenship").text(data.citizenship)
				$("#contact").text(data.mobilenumber)
				$("#email").text(data.email);
				$("#bday").text(data.dob)
				$("#pob").text(data.pob)
				$("#gender").text(data.gender)
				$("#homeaddress").text(data.homeaddress)
				$("#currentaddress").text(data.currentaddress)
				$("#occupation").text(data.occupation)
				$("#civil_status").text(data.civilstatus)
				$("#workaddress").text(data.workaddress)
				$('#edit_img_save_preview').attr('src', `../../incident_images/${data.image}`)
			},
			complete: function (e) {
				$("#informantTable").DataTable().ajax.reload()
			}

		})
	}
</script>
</html>
