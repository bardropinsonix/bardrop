<?php
	if (isset($userRecord) && $userRecord['User']['facebook_token'] != 0) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			var phase = <?php echo $userRecord['UserPhase']['id']; ?>;
			var phaseWaitTime = {'1':'24 hours', '2':'24 hours', '3':'7-10 Days', '4':'48 hours before match expires', '5':'24 hours'};
			
			for (var i = 1; i <= phase; i++) {
				if (i < phase) {
					$('#statusList .statusItem:nth-child(' + i + ')').addClass('complete');
					$('#statusList .statusItem:nth-child(' + i + ')').append('<div class="current-wait"><h3>Step ' + i + ':</h3><br/><h2>Complete!</h2></div>');

					switch (i) {
						case 1:
							$('#statusList .statusItem:nth-child(' + i + ') img').attr('src', '/img/status_icon_step1_completed.png'); 
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Profile Complete');
							break;
						case 2:
							$('#statusList .statusItem:nth-child(' + i + ') img').attr('src', '/img/status_icon_step2_completed.png');
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Profile Approved');
							break;
						case 3:
							$('#statusList .statusItem:nth-child(' + i + ') img').attr('src', '/img/status_icon_step3_completed.png');
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Match Found');
							break;
						case 4:
							$('#statusList .statusItem:nth-child(' + i + ') img').attr('src', '/img/status_icon_step4_completed.png');
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Reservation sent');
							break;
						case 5:
							$('#statusList .statusItem:nth-child(' + i + ') img').attr('src', '/img/status_icon_step5_completed.png');
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('BarDrop Reserved');
							break;
					}
				}
				else {
					$('#statusList .statusItem:nth-child(' + i + ')').addClass('current');
					$('#statusList .statusItem:nth-child(' + i + ')').append('<div class="current-wait"><h3>Estimated wait time:</h3><br/><h2>' + phaseWaitTime[i] + '</h2></div>');
					$('#statusList .statusItem:nth-child(' + i + ')').append('<div class="current-marker"></div>');

					switch (i) {
						case 2:
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Waiting for approval...<br/>We are confirming your eligibility for BarDrop.');
							break;
						case 3:
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Finding a match...<br/>We are matching you with another compatible user.');
							break;
						case 4:
							var parent = $('#statusList .statusItem:nth-child(' + i + ')');
							parent.attr('id', 'reserve-container');
							parent.children('h3:first').html('Reserve a BarDrop...<br/>Do not lose out on a GREAT opportunity.<br/>Click the button below to meet your match:<br/><img src="/img/btn_reserve_bardrop_on.png" id="reserve" width="442" height="81" alt="Reserve a BarDrop..."/>');
							
							$('#reserve-container').hover(
								function() {
									$('#reserve').attr('src', '/img/btn_reserve_bardrop_hover.png');
								}, function() {
									$('#reserve').attr('src', '/img/btn_reserve_bardrop_on.png');
								}
							);

							//height = parent.height();
							//parent.children('.current-wait').height((height - 32) + 'px');
							parent.children('.current-wait').height('139px');
							
							break;
						case 5:
							$('#statusList .statusItem:nth-child(' + i + ') h3:first').html('Awaiting confirmation...<br/>Thank you for your reservation!');
							break;
					}
				}
			}

			switch (phase) {
				case 1:
				case 4:
				case 6:
					$('.current').click(function(){
						window.location.replace('users/route/' + phase);
					});		
					break;
				case 2:
				case 3:
				case 5:
					$('.current').click(function(){
						
					});
			}
			
		});
	</script>

	<div id='statusHeader'>
		<img src='/img/status_title_page_icon.png'/>
		<h1>Status Page</h1>
	</div>
	<div id='statusInstructions'>
		<h1>Welcome to BarDrop!</h1>
		<h2>Check the status of your account below...</h2>
	</div>
	<ul id='statusList'>
		<li class='statusItem one'>
			<img src='/img/status_icon_step1.png'/>
			<h3>Complete your profile...<br/>You have not completed your user profile <br/> or chosen your favorite bars yet!</h3><br/>
		</li>
		<li class='statusItem two'>
			<img src='/img/status_icon_step2.png'/>
			<h3>Wait for approval...</h3>
		</li>
		<li class='statusItem three'>
			<img src='/img/status_icon_step3.png'/>
			<h3>Find a match...</h3>
		</li>
		<li class='statusItem four'>
			<img src='/img/status_icon_step4.png'/>
			<h3>Reserve a BarDrop...</h3>
		</li>
		<li class='statusItem five'>
			<img src='/img/status_icon_step5.png'/>
			<h3>Enjoy your BarDrop...</h3>
		</li>
	</ul>
<?php } else { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#register a img').hover(
				function() {
					$(this).attr('src', '/img/btn_bardropnow_hover.png');
				}, function() {
					$(this).attr('src', '/img/btn_bardropnow_on.png');
				}
			);

		});
		
		setInterval(function(){
			$('.body-photo img').stop().fadeToggle('slow', function(){
				var val = $('#body-photos').attr('value');
				
				switch(val) {
					case '1':
						$('.body-photo.guys img').attr('src', '/img/img_02_a.jpg');
						$('.body-photo.girls img').attr('src', '/img/img_02_b.jpg');
						$('.body-photo.all img').attr('src', '/img/img_02_c.jpg');
						$('#body-photos').attr('value', '2');
				  		break;
					case '2':
						$('.body-photo.guys img').attr('src', '/img/img_03_a.jpg');
						$('.body-photo.girls img').attr('src', '/img/img_03_b.jpg');
						$('.body-photo.all img').attr('src', '/img/img_03_c.jpg');
						$('#body-photos').attr('value', '3');
				  		break;
					case '3':
						$('.body-photo.guys img').attr('src', '/img/img_04_a.jpg');
						$('.body-photo.girls img').attr('src', '/img/img_04_b.jpg');
						$('.body-photo.all img').attr('src', '/img/img_04_c.jpg');
						$('#body-photos').attr('value', '4');
						break;
					default:
						$('.body-photo.guys img').attr('src', '/img/img_01_a.jpg');
						$('.body-photo.girls img').attr('src', '/img/img_01_b.jpg');
						$('.body-photo.all img').attr('src', '/img/img_01_c.jpg');
						$('#body-photos').attr('value', '1');
						break;
				}

				$('.body-photo img').stop().fadeToggle('slow');
			});
		}, 5000);
	</script>
	<div id="info-container">
		<h1>We arrange the hangout.<br/>All you have to do is drop in!<br/><br/></h1>
		<div id="info">
			<iframe width="500" height="281" src="//www.youtube.com/embed/AWWzvbzOqB0?rel=0" frameborder="0" allowfullscreen></iframe>
			<div id="register">
				<a href="/users/facebook_request"><img src="/img/btn_bardropnow_on.png" /></a>
				<?php 
					//echo $this->Facebook->login(array('perms' => 'user_about_me, user_activities, user_birthday, user_education_history, user_friends, user_hometown, user_interests, user_likes, user_location, user_photos, user_religion_politics, user_work_history, email, read_friendlists, user_photos', 'img' => 'btn_bardropnow_on.png', 'redirect' => array('controller' => 'users', 'action' => 'login')));
				?>
				<div id="register-disclaimer" style="font-size: 0.8em;">
					We won’t post anything to your wall<br/>Ain’t nobody got time for that
				</div>
			</div>
		</div>
	</div>
	<div id="body" class="anon">
		<h2>With exciting 3-on-3 meet ups, BarDrop makes connecting comfortable.</h2>
		<div id="body-photos" value="1">
			<div class="body-photo guys">
				<img src="/img/img_01_a.jpg" />
				<h3>3 Guys</h3>
			</div>
			<div class="body-spacer">
				<img src="/img/symbol_plus.png" />
			</div>
			<div class="body-photo girls">
				<img src="/img/img_01_b.jpg" />
				<h3>3 Girls</h3>
			</div>
			<div class="body-spacer">
				<img src="/img/symbol_egual.png" />
			</div>
			<div class="body-photo all">
				<img src="/img/img_01_c.jpg" />
				<h3>BarDrop</h3>
			</div>
		</div>
		<h3>Here is how it works:</h3>
		<ul id="body-drops">
			<li><img src="/img/home_step1.png" /><br/><span>APPLY WITH<br/>FACEBOOK</span></li>
			<li><img src="/img/home_step2.png" /><br/><span>WE'LL FIND<br/>YOU A MATCH</span></li>
			<li><img src="/img/home_step3.png" /><br/><span>CHOOSE YOUR<br/>PREFERRED BAR</span></li>
			<li><img src="/img/home_step4.png" /><br/><span>INVITE YOUR<br/>FRIENDS</span></li>
			<li><img src="/img/home_step5.png" /><br/><span>MEET THE OTHER<br/>GROUP & HAVE FUN</span></li>
		</ul>
		<div id="body-map">
			<h1>BarDrop is available in the following cities...</h1>
			<img src="/img/map_usa.png" />
		</div>
	</div>
<?php } ?>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?1vfV468wTBniKykGmu2GQxplNGRJKpyn';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->