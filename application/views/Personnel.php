<?php ?>

<html lang="eng">
<head>
	<title>Incidents</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
	<div class="columns">
		<div class="column">
			<div class="card">

				<div class="card-header">
					Manage Personnel
					<button type="button" class="btn btn-warning float-end mx-3">Reload</button>
					<button type="button" data-bs-toggle="modal" data-bs-target="#addPersonnelModal" class="btn btn-success float-end">Add</button>
				</div>
				<div class="card-body">
					<table class="table" id="personnelTable">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Personnel Name</th>
							<th scope="col">Address</th>
							<th scope="col">Date of Birth</th>
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
	<div class="modal fade" id="addPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="AddLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Personnel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col">
							<form id='frmPersonnel' >

								<div class="mb-3">
									<input type="text" class="form-control" name="fname" id="firstname" placeholder="First Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="mname" id="middlename" placeholder="Middle Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="lname" id="lastname" placeholder="Last Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="address" id="address" placeholder="Address" />
								</div>

								<div class="mb-3">
									<label> Birthdate Date </label>
									<input type="date" class="form-control" name="dob" id="dob "/>
								</div>

								<div class="mb-3">
									<input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
								</div>
								<div class="mb-3">
									<input type="button" class="form-control" id="generatePassword" value="Generate Password"/>
									<h6>Generated Password: <span id="generated"></span> </h6>
								</div>



							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" id="addBtn" class="btn btn-primary">Register Personnel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- EDIT MODAL -->
	<div class="modal fade" id="editPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Personnel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">

						<!-- Other half of the modal-body div-->
						<div class="col">
							<form id='frmEditPersonnel' >
								<div class="mb-3">
									<input type="text" class="form-control" name="fname" id="editfirstname" placeholder="First Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="mname" id="editmiddlename" placeholder="Middle Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="lname" id="editlastname" placeholder="Last Name" />
								</div>

								<div class="mb-3">
									<input type="text" class="form-control input-sm" name="address" id="editaddress" placeholder="Address" />
								</div>


								<div class="mb-3">
									<label> Birthdate </label>
									<input type="date" class="form-control" name="dob" id="editdob"/>
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
	$("#generatePassword").on('click', function (e){
		e.preventDefault();
		let salt = "0123456789abcdefhijklmnopqrsuvwxwyz"
		let hashed = ""
		for(let i = 0; i <= 15; ++i){
			hashed += salt[Math.floor(Math.random() * (salt.length))]
		}
		console.log(hashed)
		$("#password").val(hashed)
		$("#generated").text(hashed)
	})


	$("#addBtn").on("click", function (e){
		let formData = new FormData(document.getElementById("frmPersonnel"));
		$.ajax({
			url: `<?php echo site_url()?>/main/insertPersonnel`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)

			},
			complete: function (e){
				$("#personnelTable").DataTable().ajax.reload()
			}

		})
	})

	$(document).ready(function (){
		$("#personnelTable").DataTable({
			lengthChange: true,
			"paging": true,
			"processing": true,
			"responsive": true,
			"serverMethod": "post",
			"order": [[ 0, "desc" ]],
			"ajax": {
				"url": "<?php echo site_url()?>/main/getPersonnel",
			},
			"columns":[
				{data: "id"},
				{data: "name"},
				{data: "address"},
				{data: "dob"},
				{data: 'id',
					render: function (data){
						return `<button type="button" onclick="manageData(${data}, 'edit')" data-bs-toggle="modal" data-bs-target="#editPersonnelModal" class="btn btn-success">Edit</button>
								<button type="button" onclick="manageData(${data}, 'delete')" class="btn btn-danger">Remove</button>`;
					}},
			]
		})
	})

	$('#saveBtn').on("click", function (e){
		e.preventDefault();
		let formData = new FormData(document.getElementById("frmEditPersonnel"));
		formData.append("key", "update")
		formData.append("id", this.name)
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_personnel`,
			method: 'post',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: formData,
			success: function (response){
				console.log(response)
				alert("Incident Edited Successfully")
			},
			complete: function (e){
				$("#personnelTable").DataTable().ajax.reload()
				alert("Record Edited Successfully")
			}

		})
	})
	function manageData(id, key, element){
		if(key === "delete"){
			if(!confirm(`Are you sure you want to delete ${id}`)){
				return
			}
		}
		$.ajax({
			url: `<?php echo site_url()?>/main/manage_personnel`,
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
						$("#editfirstname").val(data.fname)
						$("#editlastname").val(data.lname)
						$("#editmiddlename").val(data.mname)
						$("#editaddress").val(data.address)
						$("#editdob ").val(data.dob)
						$("#saveBtn").attr('name', data.personnel_id)
						break;

				}
			},
			complete: function (e){
				$("#personnelTable").DataTable().ajax.reload()
				if(key === 'delete'){
					alert('Delete Success')
				}
			}


		})
	}
</script>
</html>
