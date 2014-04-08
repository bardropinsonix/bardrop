<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
	<?php echo $this->Facebook->html(); ?>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			BarDrop
		</title>
		<?php
			echo $this->Html->meta('icon');
	
			//CSS
			echo $this->Html->css("main");
			echo $this->Html->css("body");
			echo $this->Html->css("footer");
			echo $this->Html->css("form");
			echo $this->Html->css("view");
			echo $this->Html->css("header");
			echo $this->Html->css("navigation");
			echo $this->Html->css("fullcalendar.css");
			echo $this->Html->css("jquery-ui-1.10.3.custom.css");
			echo $this->Html->css("demo_page.css");
			echo $this->Html->css("demo_table_jui.css");
			echo $this->Html->css("demo_table.css");
			echo $this->Html->css("jquery.dataTables_themeroller.css");
			echo $this->Html->css("jquery.dataTables.css");
			
			//JavaScript
			echo $this->Html->script("jquery-1.9.1.js");
			echo $this->Html->script("jquery-ui-1.10.3.custom.js");
			echo $this->Html->script("fullcalendar.js");
			echo $this->Html->script("gcal.js");
			echo $this->Html->script("jquery.dataTables.js");
			echo $this->Html->script("jquery.dataTables.min.js");
			echo $this->Html->script("jquery.validate.js");
			echo $this->Html->script("additional-methods.js");
			echo $this->Html->script("https://maps.googleapis.com/maps/api/js?key=AIzaSyDQp7z_0Xnaj5SaeejcBfCUGcs0r7ZPWPA&sensor=true");
			//echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false);
			
			echo $this->Html->script("main.js");
			echo $this->Html->script("drop-map.js");
	
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
	
			$Facebook = new FB();
			$Facebook->api('/me');
			//$friends = $Facebook->api('/me/friends');
			//$me = $Facebook->api('/me');
			//print_r($me);
		?>
		<?php if (isset($userRecord) && ROLE_ADMIN == $userRecord['UserRole']['id']){ ?>
		<style>
			#join-movement, #drop-movement {
				display: none !important;
			}
		</style>
		<?php } ?>
	</head>
	<body>
		<!-- HEADER -->
		<div id="header-container">
			<div id="header">	
				<div id="logo">
					<h1><a href="/" title="Bar Drop Social Club">Bar Drop Social Club</a></h1>
					<?php if (isset($userRecord) && $userRecord['User']['facebook_token'] != 0) { ?>
						<a href="/users/logout" id="logout"><img src="/img/btn_sign_out_on.png" width="129" height="41" alt="Sign Out" /></a>
					<?php } else { ?>
						<a href="/users/facebook_request" id="login"><img src="/img/btn_sign_in_on.png" width="129" height="41" alt="Sign In" /></a>
					<?php } ?>
				</div>
				<!-- <p id="join-movement">Join the movement...</p> -->
				<div id="join-movement">
					<img src="/img/header_join_the_movement.png" width="461" height="113" alt="Join the movement..." />
				</div>
				
				<div id="drop-movement">
					<img src="/img/home_big_drop.png" width="411" height="491" alt="Groupe of people meet together, and they have fun." />
				</div>
			</div>
					
			<div id="img_drinks"></div>
		</div>		
		<!-- END: HEADER -->
		
		<!-- WRAPPER -->
		<div id="wrapper">
			<?php if (isset($userRecord) && $userRecord['User']['facebook_token'] != 0) { ?>
				<div id="nav">
				<?php if (ROLE_ADMIN == $userRecord['UserRole']['id']){
						/* Hiding for now
						if ($Facebook->getUser())
							echo $this->Facebook->logout(array('img' => 'facebook-logout.png', 'redirect' => array('controller' => 'users', 'action' => 'logout')));
						else 
							echo $this->Facebook->login(array('perms' => 'user_about_me, user_activities, user_birthday, user_education_history, user_friends, user_hometown, user_interests, user_location, user_religion_politics, email, read_friendlists', 'img' => 'connectwithfacebook.gif', 'redirect' => array('controller' => 'users', 'action' => 'login')));
						*/
						
						echo '<ul>';
						echo '<li><a href="/admin/home">Home</a></li>';
						echo '<li><a href="/admin/drops/">Drops</a></li>';
						echo '<li><a href="/admin/bars/">Bars</a></li>';
						echo '<li><a href="/admin/users/">Users</a></li>';
						echo '</ul>';
					}
					else {
						echo '<ul>';
						echo '<li><a href="/home">Home</a></li>';
						echo '<li><a href="/users/profile/">My Profile</a></li>';
						echo '<li><a href="/users/bars/">My Bars</a></li>';
						echo '</ul>'; 
					}
				?>
				</div>
				<div id="body-container">
					<div id="body">
						<?php echo $content_for_layout; ?>
					</div>
				</div>
			<?php } else { ?>
				<div id="body-container" class="anon">
					<?php echo $content_for_layout; ?>
				</div>
			<?php } ?>
		</div>
		<!-- END: WRAPPER -->
		
		<!-- FOOTER -->
		<div id="footer-container">	
			<div id="footer">
				<ul id="footer-icons">
					<li><a href="#"><img src="/img/facebook-square-32.png"/></a></li>
					<li><a href="#"><img src="/img/twitter2-square-32.png"/></a></li>
					<li><a href="#"><img src="/img/instagram-square-32.png"/></a></li>
				</ul>
				<ul class="footer-links upper">
					<li><a href="faq">FAQ</a></li>
					<li><a href="help">Contact</a></li>
					<li><a href="privacy">Privacy Policy</a></li>
					<li><a href="terms">Terms of Use</a></li>
				</ul>
				<br/>
				<ul class="footer-links lower">
				
				</ul>
			</div>
		</div>
		<!-- END: FOOTER -->
		<?php //echo $this->element('sql_dump'); ?>
	</body>
	<?php echo $this->Facebook->init(); ?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  	ga('create', 'UA-15592567-12', 'bardrop.com');
	  	ga('send', 'pageview');
	</script>
</html>