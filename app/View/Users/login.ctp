<?php
	$Facebook = new FB();
	$Facebook->api('/me');
?>

<script type="text/javascript">
	$(document).ready(function() {
		setInterval(function(){
			fbLogout();
		}, 5000);

		function fbLogout(){
			//$('#logout img').trigger('click');
		}
	});
</script>

<div id="message">
	<h1>Thank you for pre-registering.</h1>
</div>
<div id="logout" style="display: none;">
	<?php 
		if ($Facebook->getUser())
			echo $this->Facebook->logout(array('img' => 'facebook-logout.png', 'redirect' => array('controller' => 'home', 'action' => 'index')));
	?>
</div>