<?php
include_once("../../../wp-load.php");
$api_key = 'AIzaSyCB8T03ecuTp9K5Q3Mi82RMyCeaLhhVYus';
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		html, body, #map-canvas
		{
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$api_key?>"></script>
	<script type="text/javascript">
		var map, marker = {}, bounds = new google.maps.LatLngBounds();

		function initialize()
		{
			var mapOptions = {
				/*center: { lat: 51.1788823, lng: -1.8262155},*/
				zoom: 2
			};
			map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

			var markers = [];
			<?php
			$counter = 0;
			$row = 0;
			$file = fopen("google_map_data.csv","r");

			while(!feof($file))
			{
				$row_data = fgetcsv($file);
				if($row > 0 && !empty($row_data))
				{
					echo 'markers["m'.($row-1).'"] = {};'."\n";
					echo "markers['m".($row-1)."'].name = '".$row_data[0]."';\n";
					echo "markers['m".($row-1)."'].content = '".$row_data[1]."';\n";
					echo "markers['m".($row-1)."'].lat = '".$row_data[2]."';\n";
					echo "markers['m".($row-1)."'].lon = '".$row_data[3]."';\n";
					echo "markers['m".($row-1)."'].icon = '".$row_data[4]."';\n";

					$counter++;
				}
				$row++;
			}
			fclose($file);
			?>
			var totalMarkers = <?=$counter?>, i = 0, infowindow, contentString;

			for (var i = 0; i<totalMarkers; i++)
			{
				contentString = '<div class="content">'+
									'<h1 class="firstHeading">'+markers['m'+i].name+'</h1>'+
									'<div class="bodyContent">'+
										'<p>'+markers['m'+i].content+'</p>'+
									'</div>'+
								'</div>';
				infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				var image = '';
				if(markers['m'+i].icon != "" && markers['m'+i].icon != null)
				{
					image = "<?php echo get_template_directory_uri(); ?>/images/google-map-icons/"+markers['m'+i].icon;
				}
				marker['c'+i] = new google.maps.Marker({
					position: new google.maps.LatLng(markers['m'+i].lat,markers['m'+i].lon),
					map: map,
					title: markers['m'+i].name,
					infowindow: infowindow,
					icon: image
				});

				bounds.extend(marker['c'+i].position);

				google.maps.event.addListener(marker['c'+i], 'click', function() {
					for (var key in marker)
					{
						marker[key].infowindow.close();
					}
					this.infowindow.open(map, this);
				});
			}
			map.fitBounds(bounds);
			map.panToBounds(bounds);
		}
		function panMap(la,lo)
		{
			map.panTo(new google.maps.LatLng(la,lo));
		}
		function openMarker(mName)
		{
			//console.log(marker);
			for (var key in marker)
			{
				marker[key].infowindow.close();
			}
			for (var key in marker)
			{
				if (marker[key].title.search(mName) != -1)
				{
					marker[key].infowindow.open(map,marker[key]);
				}
			}
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>
	<div id="map-canvas"></div>
</body>
</html>