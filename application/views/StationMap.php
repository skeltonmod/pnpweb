<?php ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>CDO GeoJSON Map</title>
	<script src="../../js/jquery-3.6.0.js"></script>
	<link rel="stylesheet" href="../../css/leaflet.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	<script src="https://unpkg.com/@mapbox/leaflet-pip@latest/leaflet-pip.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js" integrity="sha512-Abr21JO2YqcJ03XGZRPuZSWKBhJpUAR6+2wH5zBeO4wAw4oksr8PRdF+BKIRsxvCdq+Mv4670rZ+dLnIyabbGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<style>
		html {
			height: 100%;
			overflow: hidden;
		}
		body {
			margin: 0;
			padding: 0;
			height: 100%;
		}
		#map_canvas {
			height: 100%;
		}
	</style>
</head>
<body>
<div id="map_canvas"></div>
<input type="text" id="data" value="">
<script type='text/javascript'>
	let polyname = ""
	$(document).ready(function () {
		let map = L.map('map_canvas').setView([8.4542, 124.6319], 13);
		let geojson = new L.GeoJSON.AJAX("../../map.geojson",{
			onEachFeature: onEachFeature
		})
		geojson.addTo(map)

		function onLocationError(e) {
			alert(e.message);
		}
		function onEachFeature(feature,layer){
			layer.on('click',function (event){
				// window.parent.getBarangay(feature.properties.NAME_3,event.latlng.lat,event.latlng.lng)
				console.log(event.latlng.lng+' '+event.latlng.lat)

			})

			layer.bindPopup(feature.properties.NAME_3)
			//this one goes to the other page
		}

		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		map.on('locationerror', onLocationError);

		let url = new URL(window.location.href);
		let params = new URLSearchParams(url.search);
		let lat = params.get('lat');
		let long = params.get('long');

		if(params.has('lat') && params.has('long')){
			let lat = params.get('lat');
			let long = params.get('long');
			L.marker([Number(lat), Number(long)], {
			}).addTo(map).bindPopup(`${value.station_name}`)
			L.circle([Number(lat), Number(long)], {
				color: 'red',
				fillOpacity: 0.01,
				radius: 600
			}).addTo(map)
		}else{
			$.ajax({
				url: "<?php echo site_url()?>/main/getStation",
				method: 'post',
				dataType: 'json',
				success: function (response){
					$.each(response.data, function (index, value){
						let lat = String(value.location).split('/')[0]
						let long = String(value.location).split('/')[1]
						L.marker([Number(lat), Number(long)], {
						}).addTo(map).bindPopup(`${value.station_name}`)
						L.circle([Number(lat), Number(long)], {
							color: 'red',
							fillOpacity: 0.01,
							radius: 600
						}).addTo(map)
					})
				}
			})
		}



	})


	$(document).on('load', function (){
		navigator.geolocation.getCurrentPosition(position => {
			const {coords: { latitude, longitude }} = position;
			let marker = new L.marker([latitude, longitude], {
			}).addTo(map);

			console.log(marker);
			let result = leafletPip.pointInLayer([marker._latlng.lng, marker._latlng.lat],geojson)
			console.log(result[0].feature.properties.NAME_3)
			window.parent.getBarangay(result[0].feature.properties.NAME_3,marker._latlng.lat,marker._latlng.lng)
		})
	})


</script>
</body>
</html>


