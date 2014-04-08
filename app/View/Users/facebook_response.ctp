<?php
	if (isset($userRecord) && $userRecord['User']['facebook_token'] != 0) {
?>
	<script>
		$(window).load(function() {
		    window.location.href = '/users/login';
		});
	</script>
	
	<div class='container'>
		<div class='loading' style='text-align: center;'><img src='/img/loader.gif'/></div>
	</div>
	
<?php } else { ?>

	<script>
		$(window).load(function() {
			FB.Event.subscribe('auth.login', function(response) {
			    window.location.href = '/users/login';
			});
		});
	</script>
	
	<div id="body" class="anon">
		<div class='container'>
			<div class='loading' style='text-align: center;'><img src='/img/loader.gif'/></div>
		</div>
	</div>
<?php } ?>