<style>
	#drop-movement {
		display: none;
	}
	
	.dialog {
		display: none;
	}
	
	.info-icon {
		display: inline-block;
		height: 25px;
		width: 25px;
		margin: 1px 0 0 -30px;
		cursor: pointer;
	}
</style>
<script type='text/javascript'>
	$(document).ready(function() {
		$('#info-dialog').dialog({
			autoOpen: false,
			closeOnEscape: true,
			draggable: false,
			modal: true,
			resizable: false,
		});
		
		$('#UserPostalCode').parent().append('<img src="/img/info.png" class="info-icon"/>');

		$('body').delegate('.info-icon', 'click', function() {
			$('#info-dialog-content').html('<p>This is used for a radius search</p>');
			$('#info-dialog').dialog('open');
		});
		
		$('#update').click(function(e){
			e.preventDefault();
			if($('#UserProfileForm').valid()){
				var userPostalCode = $('#UserPostalCode').val();

				geocode(userPostalCode, submit);
			}
		});
		
		$('#UserProfileForm').validate({
			rules: {
				'data[User][name]': {
					required: true,
					minlength: 2
				},
				'data[User][email_address]': {
					email: true
				},
				'data[User][postal_code]': {
					required: true,
					rangelength: [4, 5],
				    digits: true
				}
			},
			messages: {
				'data[User][name]': {
					required: 'Please enter your name',
					minlength: 'Your name must consist of at least 2 characters'
				},
				'data[User][email_address]': 'Please enter a valid email address',
				'data[User][postal_code]': {
					required: 'Please enter your postal code',
					rangelength: 'Your postal code must be 4 to 5 characters',
					digits: 'Your postal code must be numeric'
				}
			}
		});
	});

	function submit(location){
		$('#UserLat').val(location.lat());
		$('#UserLong').val(location.lng());

		/*
		FB.api(
	        {
	            method: 'fql.query',
	            query: 'SELECT uid, first_name, last_name FROM user WHERE uid = 7921994'
	        },
	        function(data) {
				alert('Test');
	        }
		);
		*/
		
		$('form').submit();
	}
</script>
<div class='users form'>
<?php 
	echo $this->Form->create('User');
	echo '<h1>Edit My Profile</h1>';
	echo $this->Form->input('name');
	echo $this->Form->input('email_address');
	echo $this->Form->input('birthday', array('minYear' => date('Y') - 60, 'maxYear' => date('Y')-21, 'empty' => array('- -'), 'separator' => '' ));
	echo $this->Form->input('postal_code', array('type' => 'text'));
	echo $this->Form->hidden('lat');
	echo $this->Form->hidden('long');
	echo $this->Form->input('sex', array('type' => 'select', 'options' => array(0 => 'Female', 1 => 'Male')));
	echo $this->Form->input('interested_in', array('type' => 'select', 'options' => array(0 => 'Women', 1 => 'Men')));
	echo '<div class="button-row">';
	echo $this->Form->button('Update', array('type' => 'button', 'id' => 'update', 'name' => 'update'));
	echo '</div>';
	echo '<br/><br/><br/>';
	
	echo '<h3>We want you to have the best experience imaginable.  Although we use data from Facebook to make an ideal group match, more information is necessary to make your BarDrop a smooth and enjoyable event.  NEVER fear, we keep this data strictly confidential.  </h3>';
	echo $this->Form->end();
?>
</div>

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'1422482651333715',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
FB.ui({
method: 'apprequests',
message: 'Your Vision Our Passion'
});
}
</script>

<div id="fb-root"></div>
<a href='#' onclick="FacebookInviteFriends();"> 
Facebook Invite Friends Link
</a>
<script type='text/javascript'>
if (top.location!= self.location)
{
top.location = self.location
}
</script>
<div id='info-dialog' class='dialog' title='Info'>
	<div id='info-dialog-content'></div>
</div>
