<style>
	.dialog {
		display: none;
	}

	p {
		margin: 0;
		padding: 0;
	}
	
	#drop-movement {
		display: none;
	}
	
	#map-canvas {
		display: inline-block;
		height: 500px;
		width: 600px;
		margin: 0;
		padding: 0;
		border: solid 5px #ffffff;
		border-radius: 5px;
	}
	
	div.users.bars h1 {
		font: bold 2em "Trebuchet MS", Helvetica, sans-serif; 
		color: #000; 
		text-shadow: 1px 1px 0 #fff;
		background: transparent url('/img/preferred_bar_title_page_icon.png') no-repeat 0px 0px; 
		display: inline-block;
		width: 770px;
		margin: 0 0 25px 0;
		padding: 40px 0px 35px 100px;
		border-bottom: solid 1px #babbad;
	}
	
	div.users.bars h2 {
		color: #3da19b;
		margin: 15px 0;
		width: 100%;
	}
	
	div.users.bars h3 {
		margin-bottom: 5px;
	}
	/*
	#bar-type-list {
		display: inline-block;
		width: 175px;
		margin-right: 5px;
		vertical-align: top;
	}
	
	#bar-type-list .image-checkbox {
		margin-bottom: 5px;
		padding-bottom: 5px;
		border-bottom: solid 1px #babbad;
		background-size: 21px 21px; 
	}
	
	#bar-type-list .image-checkbox:last-child {
		border-bottom: none;
	}
	*/
	.image-checkbox {
		display: inline-block;
		width: 100%;
		background: transparent url('/img/preferred_bar_tag_off.png') no-repeat 0px 0px;
		background-position: right top;
	}
	
	.image-checkbox-checkbox {
		display: none;
	}
	/*
	#bar-list {
		display: inline-block;
		width: 100%;
		margin-top: 20px;
	}
	
	#bar-list li {
		display: inline-block;
		width: 263px;
		margin: 0 10px 10px 0;
		padding: 5px;
		background: #4d666d;
		border: solid 5px #ffffff;
		border-radius: 5px;
		color: #ffffff;
	}
	
	#bar-list li:nth-child(3n) {
		width: 262px;
		margin-right: 0px;
	}
	
	#bar-list li .image-checkbox {
		background-size: 44px 44px; 
	}
	*/
	#bar-list-container {
		display: inline-block;
		width: 235px;
		margin-right: 5px;
		vertical-align: top;
	}
	
	#bar-list li {
		display: inline-block;
		width: 215px;
		margin-bottom: 5px;
		padding: 5px;
		background: #4d666d;
		border: solid 5px #ffffff;
		border-radius: 5px;
		color: #ffffff;
	}
	
	#bar-list li .image-checkbox {
		background-size: 38px 38px; 
	}
	
	#submit {
		display: none;
		float: left;
		width: 235px;
		margin-right: 18px !important;
	}
</style>
<script type='text/javascript'>
	var bars = new Array();
	var markers = new Array();
	var map;
	
	$(document).ready(function() {
		$('#error-dialog').dialog({
			autoOpen: false,
			closeOnEscape: true,
			draggable: false,
			modal: true,
			resizable: false,
		});
		
		var latitude = '<?php echo $userRecord['User']['lat']; ?>';
		var longitude = '<?php echo $userRecord['User']['long']; ?>';
		
		initialize(latitude, longitude);

		//Showing all bars by default.
		//TODO: Reimplement Bar Type code when more data is available.
		/*
		$('body').delegate('#bar-type-list .image-checkbox', 'click', function() {
			var checkbox = $(this).children(".image-checkbox-checkbox");
			var checked = !$(checkbox).is(':checked');
			var thisVal = $(checkbox).attr('value');
			
			$(checkbox).prop('checked', checked);

			if (checked){
				$(this).css('background-image','url(/img/preferred_bar_tag_select.png)');

				for(var bar in bars) {
					var barTypes = bars[bar]['barTypes'];
					if (barTypes.indexOf(thisVal) != -1){
						showMarker(bar);
					}
				}
			}
			else {
				$(this).css('background-image','url(/img/preferred_bar_tag_off.png)');

				for(var bar in bars) {
					var barTypes = bars[bar]['barTypes'];
					if (barTypes.indexOf(thisVal) != -1){
						var stillActive = 0;
						$('.bar-type-checkbox:checked').each(function() {
							var thatVal = $(this).attr('value');
							if (barTypes.indexOf(thatVal) != -1)
								stillActive = 1;
						});

						if (!stillActive)
							hideMarker(bar);
					}
				}
			}
		});
		*/
		
		$('body').delegate('#bar-list .image-checkbox', 'click', function() {
			var checkbox = $(this).children(".image-checkbox-checkbox");
			var checked = !$(checkbox).is(':checked');

			$(checkbox).prop('checked', checked);
			
			if (checked){
				var checkboxes = $('#bar-list .image-checkbox .image-checkbox-checkbox:checked');

				if (checkboxes.length < 4){
					$(this).css('background-image','url(/img/preferred_bar_tag_select.png)');
				}
				else {
					$(checkbox).prop('checked', !checked);
					$('#error-dialog-content').html('<p>You can only have three bars selected.</p>');
					$('#error-dialog').dialog('open');
				}

				if (checkboxes.length > 0)
					$('#submit').show();
				else
					$('#submit').hide();
			}
			else {
				$(this).css('background-image','url(/img/preferred_bar_tag_off.png)');
			}
		});
	});
	
	function initialize(latitude, longitude) {
		var latlng = new google.maps.LatLng(latitude, longitude);
		
		setCenter(latlng);

		//TODO: Limit this to a center radius set within the controller
		
		<?php foreach($bars as $bar): ?>
		bars['<?php echo $bar['Bar']['id'] ?>'] = {
			id: "<?php echo $bar['Bar']['id'] ?>",
			name: "<?php echo $bar['Bar']['name']; ?>",
			address: "<?php echo $bar['Bar']['address']; ?>",
			latitude: "<?php echo $bar['Bar']['lat']; ?>",
			longitude: "<?php echo $bar['Bar']['long']; ?>",
			icon: "http://maps.google.com/mapfiles/marker.png",
			shadow: "http://maps.google.com/mapfiles/shadow50.png",
			url: "<?php echo $bar['Bar']['url']; ?>",
			barTypes: [
				<?php 
				foreach($bar['BarType'] as $barType):
					echo '"' . $barType['id'] . '", ';
				endforeach; 
				?>
			]
		};
		<?php endforeach; ?>

		for(var bar in bars) {
			var latlng = new google.maps.LatLng(bars[bar]['latitude'], bars[bar]['longitude']);
			var icon = bars[bar]['icon'];
			var shadow = bars[bar]['shadow'];
			var title = bars[bar]['name'];
			var address = bars[bar]['address'];
			var url = bars[bar]['url'];

			var options = {
				id: bar,
				icon: icon,
				shadow: shadow,
				title: title,
				address: address,
				url: url
			};
			
			addMarker(latlng, options);
		}
	}

	function setCenter(latlng){
		id = 'map-canvas';
		
		var mapOptions = {
			id: id,
    		zoom: 13,
    		center: latlng,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
  		};

		map = new google.maps.Map(document.getElementById(id), mapOptions);

		google.maps.event.addListener(map, 'zoom_changed', function () {
		    google.maps.event.addListenerOnce(map, 'bounds_changed', function (e) {
				updateBarList();
		    });
		});
		
		google.maps.event.addListener(map, 'dragend', function() {
			updateBarList();
	    });

		google.maps.event.addListenerOnce(map, 'idle', function(){
			updateBarList();
		});
	}

	function addMarker(latlng, options){
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

		//TODO: Reimplement Bar Type code when more data is available.
		//marker.setVisible(false);

     	google.maps.event.addListener(marker, 'click', function() {
     		window.open(url);
		});

		this.markers[id] = marker;
	}

	function showMarker(id){
		var marker = markers[id];
		marker.setVisible(true);
		updateBarList();
	}
	
	function hideMarker(id){
		var marker = markers[id];
		marker.setVisible(false);
		updateBarList();
	}

	function updateBarList(){
		var bounds = map.getBounds();
		for(var key in markers) {
			var marker = markers[key];
			if ((bounds.contains(marker.getPosition()) && marker.visible == true) && $('#bar-list').find('#' + marker.id).length == 0)
				$('#bar-list').append('<li id="' + marker.id + '"><div class="image-checkbox"><p><b>' + marker.title + '</b></p><p>' + marker.address + '</p><input id="UserUserBar' + marker.id + '" class="image-checkbox-checkbox" type="checkbox" value="' + marker.id + '" name="data[UserBar][]"></input></div></li>');
			else if ((!bounds.contains(marker.getPosition()) || marker.visible == false) && $('#bar-list').find('#' + marker.id).length > 0)
				$('#' + marker.id).remove();
		}
		
		if ($('#bar-list').children().length == 0)
			$('#bar-list').append('<li id="no-bars"><div class="no-bars"><p>No bars nearby</p><p>Try zooming out</p></div></li>');
		else if ($('#bar-list').children().length > 1 && $('#no-bars').length > 0)
			$('#no-bars').remove();
			
	}
</script>
<div class="users bars form">
<?php 
	echo $this->Form->create('UserBar');
	echo '<h1>My Bars</h1>';
	echo '<h2>Select your three favorite bars...</h2>';
	//TODO: Reimplement Bar Type code when more data is available.
	/*
	echo '<div id="bar-type-list">';
	echo '<h3>Bar Types</h3>';
	foreach($barTypes as $key => $value):
?>
	<div class='image-checkbox'>
		<label><?php echo $value; ?></label>
		<input type="checkbox" id="bar-type-checkbox-<?php echo $key; ?>" name="bar-type-checkbox" class="image-checkbox-checkbox" value="<?php echo $key; ?>"/><br/>
	</div>
<?php
	endforeach;
	echo '</div>';
	*/
	echo '<div id="bar-list-container"></ul>';
	echo '<ul id="bar-list"></ul>';
	echo '</div>'; 
    echo '<div id="map-canvas"></div>';
	echo '<div class="button-row">';
	echo $this->Form->button('Submit', array('type' => 'submit', 'id' => 'submit'));
	echo '</div>';
	echo '<br/><br/><br/>';
	echo '<h3>These enlightened establishments "get" that groups of like-minded, young adults enjoy a night on the town, and they are willing to bend over backwards to make your experience pleasurable.</h3>';
	echo $this->Form->end();
?>	
</div>
<div id='error-dialog' class='dialog' title='Error'>
	<div id='error-dialog-content'></div>
</div>