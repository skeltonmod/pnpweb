<nav class="navbar navbar-expand-lg navbar-light bg-light menu" style="margin-bottom: 1em">
	<a class="navbar-brand" href="#">COCPO Web Dashboard</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo site_url("main/index/Home")?>">Home</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Incidents')?>">Incidents <span id="incident_notif" style="color: red;">(n)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Personnel')?>">Personnel </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Barangay')?>">Barangay</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Station')?>">Station</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('main/index/Reports')?>">Report</a>
			</li>
		</ul>
	</div>
	<div class="d-flex">
		<button class="btn btn-outline-danger mx-6" id="logout" type="button">Logout</button>
	</div>
</nav>


<script>
//global incident counter

let incident_count = 0;

// get the initial incident count to check for alert
$(document).ready(function (){
  $.ajax({
				url: `<?php echo site_url()?>/main/count_incidents`,
				method: 'post',
				dataType: 'json',
				success: function (response){
				  incident_count = response.incidents;
          document.getElementById('incident_notif').innerText = incident_count
        }
			}) 
})

// Add number of incidents for every nth interval
  setInterval(function(){
      /* console.log(incident_count) */
    $.ajax({
				url: `<?php echo site_url()?>/main/count_incidents`,
				method: 'post',
				dataType: 'json',
        success: function (response){
          if(incident_count !== response.incidents){
              console.log(incident_count);
              alert(`You have ${response.incidents} new incidents`)
              incident_count = response.incidents
              document.getElementById('incident_notif').innerText = incident_count
          }
				}
			})
  }, 5000)    



</script>
