<?php 
	$userOneFacebookTokens = array();
	foreach($users as $user){
		$userOneFacebookTokens[] = '"' . $user['User']['facebook_token'] . '"';
	}
?>
<style>
	.container {
		display: inline-block;
		width: 100%;
	}
	
	.loading img {
  		position: absolute;
  		margin: auto;
  		top: 0; left: 0; bottom: 0; right: 0;
	}

	#user-one-container {
		position: relative;
		float: left;
		width: 370px;
		min-height: 160px;
		margin: 0;
		padding: 40px 20px;
		background: #4d666d;
		border: solid 5px #ffffff;
		border-radius: 5px;
		color: #ffffff;
	}
	
	#user-two-container {
		position: relative;
		float: right;
		width: 370px;
		min-height: 160px;
		margin: 0;
		padding: 40px 20px;
		background: #4d666d;
		border: solid 5px #ffffff;
		border-radius: 5px;
		color: #ffffff;
	}
	
	.user-image {
		float: left;
		margin: 0;
		padding: 0;
		border: solid 3px #ffffff;
		border-radius: 5px;
	}
	
	.user-image img {
		display: inherit;
		margin: 0;
		padding: 0;
	}
	
	.user-profile {
		float: left;
		margin-left: 10px;
	}
	
	.user-profile-link {
		position: absolute;
		top: 40px;
		right: 5px;
	}	
	
	.left-arrow {
		position: absolute;
		top: 0;
		left: 5px;
		height: 32px;
		width: 32px;
		background: transparent url('/img/left_arrow.png') no-repeat 0px 0px; 
	}
	
	.right-arrow {
		position: absolute;
		top: 0;
		right: 5px;
		height: 32px;
		width: 32px;
		background: transparent url('/img/right_arrow.png') no-repeat 0px 0px; 
	}
	
	.user-count {
		position: absolute;
		top: 5px;
		right: 47px;
	}
	
	
	
	.user-bars-item label, .drop-dates-item label {
		float: left;
	}
	
	.user-bars-item input, .drop-dates-item input {
		float: right;
		width: auto;
		margin: 5px 0 0 0;
	}
	
	#user-bars, #drop-dates {
		display: inline-block;
		width: 100%;
	}
	
	.user-bars-item, .drop-dates-item {
		display: inline-block;
		width: 263px;
		margin: 0 10px 10px 0;
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
	var userOneFacebookTokens = new Array(<?php echo implode(', ', $userOneFacebookTokens); ?>);
	var userTwoFacebookTokens = new Array();

	var latitude = '<?php echo DEFAULT_LATITUDE; ?>';
	var longitude = '<?php echo DEFAULT_LONGITUDE; ?>';
	var zoom = '<?php echo DEFAULT_ZOOM; ?>';
	
	var dropMap = new DropMap(latitude, longitude, zoom);
	
	var bars = new Array();
	
	$(document).ready(function() {
		$('body').delegate('#user-one-left-arrow', 'click', function() {
			var facebookToken = $(this).parent().find('#user-one').val();
			facebookToken = getPreviousUser(userOneFacebookTokens, facebookToken);
			getAccessToken(facebookToken, loadUserOne);
		});

		$('body').delegate('#user-one-right-arrow', 'click', function() {
			var facebookToken = $(this).parent().find('#user-one').val();
			facebookToken = getNextUser(userOneFacebookTokens, facebookToken);
			getAccessToken(facebookToken, loadUserOne);
		});

		$('body').delegate('#user-two-left-arrow', 'click', function() {
			var facebookToken = $(this).parent().find('#user-two').val();
			facebookToken = getPreviousUser(userTwoFacebookTokens, facebookToken);
			getAccessToken(facebookToken, loadUserTwo);
		});

		$('body').delegate('#user-two-right-arrow', 'click', function() {
			var facebookToken = $(this).parent().find('#user-two').val();
			facebookToken = getNextUser(userTwoFacebookTokens, facebookToken);
			getAccessToken(facebookToken, loadUserTwo);
		});
	});

	$(window).load(function() {
		if (userOneFacebookTokens.length > 0){
			var facebookToken = userOneFacebookTokens[0];
			getAccessToken(facebookToken, loadUserOne);
		}
		else {
			// TODO: Alert that there are no matches to be made
		}
	});

	function getAccessToken(facebookToken, callback){
		$.ajax({
		    url : '/admin/users/getAccessToken/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var accessToken = data['accessToken'];
				queryFacebook(facebookToken, accessToken, callback);
		    }
		});
	}

	function queryFacebook(facebookToken, accessToken, callback){
		FB.api(
	        {
	        	access_token : accessToken,
	            method: 'fql.query',
	            query: 'SELECT uid, name, pic, birthday, hometown_location, political, religion' + 
		            ' FROM user' +  
		            ' WHERE uid = ' + facebookToken
	        },
	        function(response) {
	        	callback(response);
	        }
		);
	}

	function loadUserOne(response){
		$('#data-one').html('');

		var response = response['0'];
		
		var facebookToken = response['uid'];
		var name = response['name'];
		
		var pic = response['pic'];

		var birthday = response['birthday'] ? response['birthday'] : 'N/A';

		var hometown_location = 'N/A';
		if (response['hometown_location'])
			hometown_location = response['hometown_location']['name'];

		var political = response['political'] ? response['political'] : 'N/A';
		var religion = response['religion'] ? response['religion'] : 'N/A';
		
		var html = '';

		html += '<div id="user-one-left-arrow" class="left-arrow"></div>';
		html += '<div id="user-one-right-arrow" class="right-arrow"></div>';
		html += '<div class="user-count">User ' + (userOneFacebookTokens.indexOf(facebookToken) + 1) + ' of ' + userOneFacebookTokens.length + '</div>';
		
		html += '<img class="profile-image" src="' + pic + '"/>';
		
		dataBlockHeader = '<h3>Basic Information</h3>';
		dataBlockRows = new Array();
		dataBlockRows.push(createDataBlockRow('Name', name));
		dataBlockRows.push(createDataBlockRow('Birthday', birthday));
		dataBlockRows.push(createDataBlockRow('Home Town', hometown_location));
		dataBlockRows.push(createDataBlockRow('Gender', '<?php echo $user['User']['sex'] == 1 ? 'Male' : 'Female';?>'));
		dataBlockRows.push(createDataBlockRow('Interested In', '<?php echo $user['User']['sex'] == 1 ? 'Men' : 'Women';?>'));
		dataBlockRows.push(createDataBlockRow('Religion', religion));
		dataBlockRows.push(createDataBlockRow('Political', political));
		html += createDataBlock(dataBlockHeader, dataBlockRows);

		html += '<input type="hidden" id="user-one" name="user-one" value="' + facebookToken + '" />';
        
        $('#data-one').html(html);

		$('.user-profile-link a').button();

        $.ajax({
		    url : '/admin/users/getLocation/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var icon = '/img/<?php echo $user['User']['sex'] == 1 ? 'male' : 'female';?>.png';
				var latitude = '<?php echo $user['User']['lat'];?>';
				var longitude = '<?php echo $user['User']['long'];?>';
				var zoom = <?php echo CITY_ZOOM; ?>;
			    
				var latitude = data['lat'];
				var longitude = data['long'];
			    
		    	var options = {
					id: name,
					icon: '/img/<?php echo $user['User']['sex'] == 1 ? 'male' : 'female';?>.png',
					title: name
				};

		    	dropMap.setCenter(latitude, longitude, 13);
		    	dropMap.addMarker(latitude, longitude, options);
		    }
        });
        
        userTwoFacebookTokens = [];

        $.ajax({
		    url : '/admin/users/findMatches/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var eligbleUsers = data['eligibleUsers'];

				for (eligbleUser in eligbleUsers){
					var eligbleUserData = eligbleUsers[eligbleUser]['User'];
					userTwoFacebookTokens.push(eligbleUserData['facebook_token']);
				}

				if (userTwoFacebookTokens.length > 0){
					var facebookToken = userTwoFacebookTokens[0];
					getAccessToken(facebookToken, loadUserTwo);
				}
				else {
					 $('#user-two-container').html('No eligible users');
				}
		    }
		});
    }

    function loadUserTwo(response){
		$('#user-two-container').html('');
		
		var response = response['0'];
		
		var facebookToken = response['uid'];
		var pic = response['pic'];
		var name = response['name'];
        
		var html = '';

		html += '<div id="user-two-left-arrow" class="left-arrow"></div>';
		html += '<div id="user-two-right-arrow" class="right-arrow"></div>';
		html += '<div class="user-count">User ' + (userTwoFacebookTokens.indexOf(facebookToken) + 1) + ' of ' + userTwoFacebookTokens.length + '</div>';

		html += '<div class="user-image"><img src="' + pic + '"/></div>';
		html += '<div class="user-profile">' + name + '</div>';
		html += '<div class="user-profile-link"><a href="/admin/users/data/' + facebookToken + '" target="_blank">Profile</a></div>';
		
		html += '<input type="hidden" id="user-two" name="user-two" value="' + facebookToken + '" />';
        
        $('#user-two-container').html(html);

		$('.user-profile-link a').button();

        $.ajax({
		    url : '/admin/users/getLocation/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var latitude = data['lat'];
				var longitude = data['long'];
			    
		    	var options = {
					id: name,
					icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
					shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
					title: name
				};

				addMarker(latitude, longitude, options);

				var userOne = $('#user-one').val();
				var userTwo = $('#user-two').val();
				
				getUserBars(userOne);
				getUserBars(userTwo);
		    }
        });
    }

    function getUserBars(facebookToken){
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
					var icon = 'http://labs.google.com/ridefinder/images/mm_20_yellow.png';
					var shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
					var url = userBarData['url'];

					var options = {
						id: id,
						icon: icon,
						shadow: shadow,
						title: name,
						address: address,
						url: url
					};
					
					addMarker(latitude, longitude, options);

					$('#user-bars').append('<div class="user-bars-item"><label for="' + id + '">' + name + '<br/>' + address + '</label><input type="radio" id="' + id + '" name="user-bar" class="bar-item" value="' + id + '" /></div>');
				}
		    }
        });
    }
		
		/*
		$.ajax({
		    url : '/admin/users/getEligibleUsers/' + facebookToken,
		    type: 'POST',
		    dataType: 'json',
		    success: function(data, textStatus, jqXHR) {
				var selectedUserData = data['selectedUser']['User'];

		    	var id = selectedUserData['facebook_token'];
		    	var name = selectedUserData['name'];
		    	var latitude = selectedUserData['lat'];
				var longitude = selectedUserData['long'];

				setCenter(latitude, longitude, 13);

				var options = {
					id: name,
					icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
					shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
					title: name
				};
				
				addMarker(latitude, longitude, options);

				$('#user-bars').html('');
				var selectedUserBars = data['selectedUser']['UserBar'];
				for (selectedUserBar in selectedUserBars){
					var selectedUserBarData = selectedUserBars[selectedUserBar]['Bar'];

					var id = selectedUserBarData['id'];
					var name = selectedUserBarData['name'];
					var address = selectedUserBarData['address'];
					var latitude = selectedUserBarData['lat'];
					var longitude = selectedUserBarData['long'];
					var icon = 'http://labs.google.com/ridefinder/images/mm_20_yellow.png';
					var shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
					var url = selectedUserBarData['url'];

					var options = {
						id: id,
						icon: icon,
						shadow: shadow,
						title: name,
						address: address,
						url: url
					};
					
					addMarker(latitude, longitude, options);

					$('#user-bars').append('<div class="user-bars-item"><label for="' + id + '">' + name + '<br/>' + address + '</label><input type="radio" id="' + id + '" name="user-bar" class="bar-item" value="' + id + '" /></div>');
				}

				$('#user-two').html('');
				var eligbleUsers = data['eligibleUsers'];
				for (eligbleUser in eligbleUsers){
					var eligbleUserData = eligbleUsers[eligbleUser]['User'];

					id = eligbleUserData['facebook_token'];
			    	name = eligbleUserData['name'];
			    	latitude = eligbleUserData['lat'];
					longitude = eligbleUserData['long'];

					var options = {
						id: name,
						icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
						shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
						title: name
					};
					
					addMarker(latitude, longitude, options);

					$('#user-two').append('<div class="user"><label for="' + id + '">' + name + '</label><input type="radio" id="' + id + '" name="user-two" class="user-item two" value="' + id + '" /></div>');
				}
		    }
		});
		*/

	function getPreviousUser(tokens, token){
		var index = tokens.indexOf(token);

		if(index > 0)
			token = tokens[index - 1];
		else if (index == 0)
			token = tokens[tokens.length - 1]; 

		return token;
	}

	function getNextUser(tokens, token){
		var index = tokens.indexOf(token);

		if(index >= 0 && index < tokens.length - 1)
			token = tokens[index + 1];
		else if (index == tokens.length - 1)
			token = tokens[0]; 

		return token;
	}
</script>
<div class='drops form'>
<?php 
	echo $this->Form->create('Drop');
	echo '<h1>Add Drop</h1>';
?>
	<div class='container'>
		<div id='data-one'>
			<div class='loading'><img src='/img/loader.gif'/></div>
		</div>
		<div id='data-two'>
			<div class='loading'><img src='/img/loader.gif'/></div>
		</div>
	</div>
	<div class='container'>
		<div id='bars'></div>
    	<div id='map-canvas'></div>
    </div>
	<div class='container'>
		<h3>Dates</h3>
		<div id='drop-dates'>
		<?php
			$today = date('w');
			$nextThursday = strtotime('next thursday');
			$nextThursdayNumber = date('w', $nextThursday);
			
			if (($nextThursdayNumber - $today) > 0)
				$nextThursday = strtotime("+7 day", $nextThursday);
			
			$nextThursday = strtotime("+19 hour", $nextThursday);
			$nextThursdayDisplay = date('M d, Y h:i a', $nextThursday);
			
			echo '<div class="drop-dates-item"><label for="date-one">' . $nextThursdayDisplay . '</label><input type="radio" id="' . $nextThursday . '" name="drop-date" value="' . $nextThursday . '" /></div>';
			
			$nextThursday = strtotime("+7 day", $nextThursday);
			$nextThursdayDisplay = date('M d, Y  h:i a', $nextThursday);
			
			echo '<div class="drop-dates-item"><label for="date-one">' . $nextThursdayDisplay . '</label><input type="radio" id="' . $nextThursday . '" name="drop-date" value="' . $nextThursday . '" /></div>';
		?>
		</div>
	</div>
<?php 
	echo '<div class="button-row">';
	echo $this->Form->button('Submit', array('type' => 'submit', 'id' => 'submit'));
	echo $this->Form->end();
	echo '</div>';
?>
</div>