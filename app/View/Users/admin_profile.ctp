<script type='text/javascript'>
	$(document).ready(function() {
		$('#update').click(function(e){
			e.preventDefault();
			if($('#UserAdminProfileForm').valid()){
				var userPostalCode = $('#UserPostalCode').val();

				geocode(userPostalCode, submit);
			}
		});
		
		$('#UserAdminProfileForm').validate({
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
		
		$('form').submit();
	}
</script>
<div class='users form'>
<?php 
	echo $this->Form->create('User');
	echo '<h1>Edit Profile</h1>';
	echo $this->Form->hidden('facebook_token');
	echo $this->Form->input('name');
	echo $this->Form->input('email_address');
	echo $this->Form->input('birthday', array('minYear' => date('Y') - 60, 'maxYear' => date('Y')-21, 'empty' => array('- -'), 'separator' => '' ));
	echo $this->Form->input('postal_code', array('type' => 'text'));
	echo $this->Form->hidden('lat');
	echo $this->Form->hidden('long');
	echo $this->Form->input('sex', array('type' => 'select', 'options' => array(0 => 'Female', 1 => 'Male')));
	echo $this->Form->input('interested_in', array('type' => 'select', 'options' => array(0 => 'Women', 1 => 'Men')));
	echo $this->Form->input('user_phase_id');
	echo '<div class="button-row">';
	echo $this->Form->button('Update', array('type' => 'button', 'id' => 'update', 'name' => 'update'));
	echo '</div>'; 
	echo $this->Form->end();
?>
</div>