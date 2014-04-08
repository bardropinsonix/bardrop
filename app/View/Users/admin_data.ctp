<style>
	.users h1 {
		font: bold 2em "Trebuchet MS", Helvetica, sans-serif; 
		color: #000; 
		text-shadow: 1px 1px 0 #fff;
		background: transparent url('/img/confirmation_title_page_icon.png') no-repeat 0px 0px; 
		display: inline-block;
		width: 770px;
		margin: 0 0 25px 0;
		padding: 40px 0px 35px 100px;
		border-bottom: solid 1px #babbad;
	}

	.container {
		display: inline-block;
		width: 100%;
		margin-bottom: 20px;
		padding-bottom: 20px;
		border-bottom: solid 1px #babbad;	
	}
		
	.container.data {
		padding: 10px;
		background: #ffffff;
		border-radius: 5px;
	}
	
	.container.scrollable {
		max-height: 500px;
		overflow-y: scroll;
	}
	
	.container:last-child {
		border-bottom: none;
		margin-bottom: 0;
		padding-bottom: 0;
	}
	
	.column {
		float: left;
		width: 50%;
	}
	
	.data-block {
		display: inline-block;
		width: 95%;
		margin-bottom: 10px;
		padding-bottom: 10px;
		border-bottom: solid 1px #babbad;
	}
	
	.data-block:last-child {
		border-bottom: none;
		margin-bottom: 0;
		padding-bottom: 0;
	}
	
	.data-block-row .key {
		float: left;
		margin-right: 10px;
		font-weight: bold;
	}
	
	.data-block-row .value {
		float: left;
		width: 100%;
	}
	
	#image {
		float: left;
		margin: 0;
		padding: 0;
	}
	
	#image img {
		display: inherit;
		margin: 0;
		padding: 0;
		border: solid 3px #ffffff;
		border-radius: 5px;
	}
	
	#bars {
		float: left;
		width: 160px;
		margin-right: 20px;
	}
	
	.bars-item {
		display: inline-block;
		width: 140px;
		margin-bottom: 20px;
		padding: 5px;
		background: #4d666d;
		border: solid 5px #ffffff;
		border-radius: 5px;
		color: #ffffff;
	}
	
	.user-bars-item:nth-child(3n), .drop-dates-item:nth-child(3n) {
		margin-right: 0px;
	}
	
	#map-canvas {
		float: left;
		height: 500px;
		width: 680px;
		margin: 0;
		padding: 0;
		border: solid 5px #ffffff;
		border-radius: 5px;
	}
</style>

<script type='text/javascript'>
	var facebookToken = '<?php echo $user['User']['facebook_token'];?>';
	var accessToken = '<?php echo $user['User']['access_token'];?>';
	var bars = new Array();
	
	$(document).ready(function() {
		var name = '<?php echo $user['User']['name'];?>';
		var icon = '/img/<?php echo $user['User']['sex'] == 1 ? 'male' : 'female';?>.png';
		var latitude = '<?php echo $user['User']['lat'];?>';
		var longitude = '<?php echo $user['User']['long'];?>';
		var zoom = <?php echo CITY_ZOOM; ?>;
		
		var dropMap = new DropMap(latitude, longitude, zoom);

		var options = {
			id: name,
			icon: icon,
			title: name
		};
		
		dropMap.addMarker(latitude, longitude, options);

		getUserBars(dropMap, facebookToken);
	});

	$(window).load(function() {
		queryFacebook(facebookToken, accessToken, loadUser);
	});

	function getUserBars(map, facebookToken){
    	$.ajax({
		    url : '/admin/users/getUserBars/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var userBars = data['userBars'];

				for (var userBar in userBars){
					var userBarData = userBars[userBar]['Bar'];

					var id = userBarData['id'];
					var name = userBarData['name'];
					var address = userBarData['address'];
					var latitude = userBarData['lat'];
					var longitude = userBarData['long'];
					var icon = '/img/icon_drop.png';
					var url = userBarData['url'];

					var options = {
						id: id,
						icon: icon,
						title: name,
						address: address,
						url: url
					};
					
					map.addMarker(latitude, longitude, options);

					$('#bars').append('<div class="bars-item">' + name + '<br/>' + address + '</div>');
				}
		    }
        });
	}
	
	function queryFacebook(facebookToken, accessToken, callback){
		FB.api(
	        {
	        	access_token : accessToken,
	            method: 'fql.query',
	            query: 'SELECT uid, pic, birthday, about_me, activities, books, education, hometown_location, interests, movies, music, political, profile_blurb, religion, tv, work' + 
		            ' FROM user' +  
		            ' WHERE uid = ' + facebookToken
	        },
	        function(response) {
	        	callback(response);
	        }
	        // Query to get photos
			// SELECT src, src_height, src_width, src_small, src_small_height, src_small_width FROM photo WHERE pid IN (SELECT pid FROM photo_tag WHERE subject='8211335') OR pid IN (SELECT pid FROM photo WHERE aid IN (SELECT aid FROM album WHERE owner='8211335' AND type='profile'))
		);
	}

	function loadUser(response){
		var response = response['0'];
		
		var facebookToken = response['uid'];

		var pic = response['pic'];
		
		var birthday = response['birthday'] ? response['birthday'] : 'N/A';

		var hometown_location = 'N/A';
		if (response['hometown_location'])
			hometown_location = response['hometown_location']['name'];

		var political = response['political'] ? response['political'] : 'N/A';
		var religion = response['religion'] ? response['religion'] : 'N/A';

		var education = response['education'];
        var work = response['work'];
		
		var activities = response['activities'] ? response['activities'] : 'N/A';
		var books = response['books'] ? response['books'] : 'N/A';
		var interests = response['interests'] ? response['interests'] : 'N/A';
        var movies = response['movies'] ? response['movies'] : 'N/A';
        var music = response['music'] ? response['music'] : 'N/A';
        var tv = response['tv'] ? response['tv'] : 'N/A';
        
		var aboutMe = response['about_me'] ? response['about_me'] : 'N/A';

		var profile_blurb = response['profile_blurb'] ? response['profile_blurb'] : 'N/A';

		 $('#image').html('<img src="' + pic + '"/>');
        
		var html = '';
		// Column One
		html += '<div class="column">';

		// Meta Data
		dataBlockHeader = '<h3>Meta Data</h3>';
		dataBlockRows = new Array();
		dataBlockRows.push(createDataBlockRow('Email', '<?php echo $user['User']['email_address']; ?>'));
		dataBlockRows.push(createDataBlockRow('Phase', '<?php echo $user['User']['user_phase_id'] + 1; ?>'));
		dataBlockRows.push(createDataBlockRow('Created', '<?php echo $user['User']['created']; ?>'));
		dataBlockRows.push(createDataBlockRow('Modified', '<?php echo $user['User']['modified']; ?>'));
		html += createDataBlock(dataBlockHeader, dataBlockRows);
		
		// Basic Information 
		dataBlockHeader = '<h3>Basic Information</h3>';
		dataBlockRows = new Array();
		dataBlockRows.push(createDataBlockRow('Birthday', birthday));
		dataBlockRows.push(createDataBlockRow('Home Town', hometown_location));
		dataBlockRows.push(createDataBlockRow('Gender', '<?php echo $user['User']['sex'] == 1 ? 'Male' : 'Female';?>'));
		dataBlockRows.push(createDataBlockRow('Interested In', '<?php echo $user['User']['sex'] == 1 ? 'Men' : 'Women';?>'));
		dataBlockRows.push(createDataBlockRow('Religion', religion));
		dataBlockRows.push(createDataBlockRow('Political', political));
		html += createDataBlock(dataBlockHeader, dataBlockRows);

		// Work and Education
		dataBlockHeader = '<h3>Work and Education</h3>';
		dataBlockRows = new Array();
		for (history in work){
			var employer = 'N/A';
			if (work[history]['employer'])
				employer = work[history]['employer']['name'];

			var position = 'N/A';
			if (work[history]['position'])
				position = work[history]['position']['name'];
			
			dataBlockRows.push(createDataBlockRow('Work', employer + ' - ' + position));
		}
		for (history in education){
			var school = 'N/A';
			if (education[history]['school'])
				school = education[history]['school']['name'];

			var year = 'N/A';
			if (education[history]['year'])
				year = education[history]['year']['name'];
			
			dataBlockRows.push(createDataBlockRow(education[history]['type'], school + ' - ' + year));
		}
		html += createDataBlock(dataBlockHeader, dataBlockRows);		
		html += '</div>';

		// Column Two
		html += '<div class="column">';

		// Interests
		dataBlockHeader = '<h3>Interests</h3>';
		dataBlockRows = new Array();
		dataBlockRows.push(createDataBlockRow('Activities', activities));
		dataBlockRows.push(createDataBlockRow('Books', books));
		dataBlockRows.push(createDataBlockRow('Interests', interests));
		dataBlockRows.push(createDataBlockRow('Movies', movies));
		dataBlockRows.push(createDataBlockRow('Music', music));
		dataBlockRows.push(createDataBlockRow('TV', tv));
		html += createDataBlock(dataBlockHeader, dataBlockRows);

		// About Me		
		dataBlockHeader = '<h3>About Me</h3>';
		dataBlockRows = new Array();
		dataBlockRows.push(createDataBlockRow('', aboutMe));
		html += createDataBlock(dataBlockHeader, dataBlockRows);
		html += '</div>';
		
        $('#data').html(html);
    }
</script>
<div class='users data'>
	<h1>Data for <?php echo $user['User']['name'];?></h1>
	<div class='container'>
		<div id='image'></div>
	</div>
	<div class='container data scrollable'>
		<div id='data'></div>
	</div>
	<div class='container'>
		<div id='bars'></div>
    	<div id='map-canvas'></div>
    </div>
</div>