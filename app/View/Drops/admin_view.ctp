<style>
	#drop-data {
		display: inline-block;
		width: 175px;
		vertical-align: top;
	}
	
	.data-row {
		display: inline-block;
		width: 100%;
		margin-bottom: 5px;
		padding-bottom: 5px;
		border-bottom: solid 1px #babbad;
	}
	
	.data-row:last-child {
		border-bottom: none;
	}
	
	.data-row label {
		display: inline-block;
		width: 100%;
		font-weight: bold;
	}
	
	#map-canvas {
		display: inline-block;
		height: 500px;
		width: 680px;
		margin: 0;
		padding: 0;
		border: solid 5px #ffffff;
		border-radius: 5px;
	}
</style>

<script type='text/javascript'>
	var users = new Array();
	var bars = new Array();
	var markers = new Array();
	var map;

	$(document).ready(function() {
		initialize();

		//User One
    	var name = '<?php echo $drop['UserOne']['name']; ?>';
    	var latitude = <?php echo $drop['UserOne']['lat']; ?>;
		var longitude = <?php echo $drop['UserOne']['long']; ?>;

		var options = {
			id: name,
			icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
			shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
			title: name
		};
		
		addMarker(latitude, longitude, options);

		//User Two
    	name = '<?php echo $drop['UserTwo']['name']; ?>';
    	latitude = <?php echo $drop['UserTwo']['lat']; ?>;
		longitude = <?php echo $drop['UserTwo']['long']; ?>;

		var options = {
			id: name,
			icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
			shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
			title: name
		};
		
		addMarker(latitude, longitude, options);

		//Bar
		var id = '<?php echo $drop['Bar']['id']; ?>';
		var name = '<?php echo $drop['Bar']['name']; ?>';
		var address = '<?php echo $drop['Bar']['address']; ?>';
		var latitude = <?php echo $drop['Bar']['lat']; ?>;
		var longitude = <?php echo $drop['Bar']['long']; ?>;
		var icon = 'http://labs.google.com/ridefinder/images/mm_20_yellow.png';
		var shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
		var url = '<?php echo $drop['Bar']['url']; ?>';

		var options = {
			id: id,
			icon: icon,
			shadow: shadow,
			title: name,
			address: address,
			url: url
		};
		
		addMarker(latitude, longitude, options);
	});

	function initialize() {
		var latitude = <?php echo $drop['Bar']['lat']; ?>;
		var longitude = <?php echo $drop['Bar']['long']; ?>;
		
		setCenter(latitude, longitude, 13);
	}

	function setCenter(latitude, longitude, zoom){
		var latlng = new google.maps.LatLng(latitude, longitude);
		var id = 'map-canvas';
		
		var mapOptions = {
			id: id,
    		zoom: zoom,
    		center: latlng,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
  		};

		map = new google.maps.Map(document.getElementById(id), mapOptions);
	}

	function addMarker(latitude, longitude, options){
		var latlng = new google.maps.LatLng(latitude, longitude);
		
		var id = options['id'];
		var icon = options['icon'];
		var shadow = options['shadow'];
		var title = options['title'];
		var address = options['address'];
		var url = options['url'];
		
		var marker = new google.maps.Marker({
			id: id,
			position: latlng,
		    map: map,
	        icon: icon,
	        shadow: shadow,
	        title: title,
	        address: address
	  	});

		if (url){
	     	google.maps.event.addListener(marker, 'click', function() {
	     		window.open(url);
			});
		}
		
		this.markers[id] = marker;
	}
</script>
<div class='drops view'>
	<div id='drop-data'>
		<div class='data-row'>
			<label>Who:</label>
			<span>
				<?php echo $drop['UserOne']['name']; ?><br/>
				<?php echo $drop['UserTwo']['name']; ?>
			</span>
		</div>
		<div class='data-row'>
			<label>Where:</label>
			<span>
				<?php echo $drop['Bar']['name']; ?><br/>
				<?php echo $drop['Bar']['address']; ?><br/>
				<?php echo $drop['Bar']['city']; ?>
			</span>
		</div>
		<div class='data-row'>
			<label>When:</label>
			<span><?php echo date('m/d/y h:i A', strtotime($drop['Drop']['drop_date'])); ?></span>
		</div>
	</div>
    <div id='map-canvas'></div>
</div>