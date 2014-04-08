<style>
	#drop-movement {
		display: none;
	}
	
	.drop-dates-item label {
		float: left;
	}
	
	.drop-dates-item input {
		display: none;
	}
	
	#drop-dates {
		display: inline-block;
		width: 100%;
	}
	
	.drop-dates-item {
		position: relative;
		display: inline-block;
		width: 169px;
		margin: 0 10px 10px 0;
		padding: 10px;
		background: #4dbab4;
		border: solid 1px #ffffff;
		border-radius: 5px;
		color: #ffffff;
		cursor: pointer;
	}
	
	.drop-dates-item:nth-child(3n) {
		margin-right: 0px;
	}
	
	.drop-dates-item:hover {
		background: #eb541b;
	}
	
	.drop-dates-item.active {
		background: #eb541b;
		z-index: 1;
	}
	
	.drop-dates-item .current-marker {
		position: absolute;
		top: -35px;
		right: 10px;
		height: 67px;
		width: 69px;
		background: url('/img/calendar_tag_select.png') no-repeat;
	}
	
	.drop-date-item-day {
		display: inline-block;
		width: 100%;
		margin-bottom: 5px;
		padding-bottom: 5px;
		border-bottom: solid 1px #ffffff;
		font-weight: bold;
	}
	
	div.users.calendar h1 {
		font: bold 2em "Trebuchet MS", Helvetica, sans-serif; 
		color: #000; 
		text-shadow: 1px 1px 0 #fff;
		background: transparent url('/img/calendar_title_page_icon.png') no-repeat 0px 0px; 
		display: inline-block;
		width: 770px;
		margin: 0 0 25px 0;
		padding: 40px 0px 35px 120px;
		border-bottom: solid 1px #babbad;
	}
	div.users.calendar h2 {
		color: #3da19b;
		margin: 15px 0;
		width: 100%;
	}
	
</style>
<script type='text/javascript'>
	$(document).ready(function() {
		$('#continue').click(function(e){
			submit();
		});

		$('.drop-dates-item').click(function(){
			$('.drop-dates-item').removeClass('active');
			$('.current-marker').remove();
			$(this).addClass('active');
			$(this).find('input:radio').prop('checked', true);
			$(this).append('<div class="current-marker"></div>');
		});
	});

	function submit(){
		$('form').submit();
	}
</script>
<div class='users calendar form'>
<?php 
	echo $this->Form->create('User');
	echo '<h1>Calendar</h1>';
	echo '<h2>Please choose the date you and two friends are available for a BarDrop.</h2>';
	echo '<br/><br/>';
	
	echo '<h3>AVAILABLE EVENING HAPPY HOUR TIMES</h3>';
	echo '<br/><br/>';
	echo '<div id="drop-dates">';
	$today = date('w');
	$nextThursday = strtotime('next thursday');
	$nextThursdayNumber = date('w', $nextThursday);
		
	if (($nextThursdayNumber - $today) > 0)
		$nextThursday = strtotime("+7 day", $nextThursday);
		
	$nextThursday = strtotime("+19 hour", $nextThursday);
	
	$nextThursdayDay = date('l', $nextThursday);
	$nextThursdayDate = date('F jS', $nextThursday);
	$nextThursdayTime = date('g:i a', $nextThursday);
		
	echo '<div class="drop-dates-item"><input type="radio" id="' . $nextThursday . '" name="drop-date" value="' . $nextThursday . '" /><span class="drop-date-item-day">' . $nextThursdayDay . '</span><br/>Date: ' . $nextThursdayDate . '<br/>Time: ' . $nextThursdayTime . '</div>';
		
	$nextThursday = strtotime("+7 day", $nextThursday);
	$nextThursdayDay = date('l', $nextThursday);
	$nextThursdayDate = date('F jS', $nextThursday);
	$nextThursdayTime = date('g:i a', $nextThursday);
	
	echo '<div class="drop-dates-item"><input type="radio" id="' . $nextThursday . '" name="drop-date" value="' . $nextThursday . '" /><span class="drop-date-item-day">' . $nextThursdayDay . '</span><br/>Date: ' . $nextThursdayDate . '<br/>Time: ' . $nextThursdayTime . '</div>';
	echo '</div>';
	echo '<br/><br/>';
	
	echo '<h3>AVAILABLE BRUNCH TIMES</h3>';
	echo '<br/><br/>';
	echo '<div id="drop-dates">';
	$today = date('w');
	$nextSunday = strtotime('next sunday');
	$nextSundayNumber = date('w', $nextSunday);
		
	if (($nextSundayNumber - $today) > 0)
		$nextSunday = strtotime("+7 day", $nextSunday);
		
	$nextSunday = strtotime("+13 hour", $nextSunday);
	
	$nextSundayDay = date('l', $nextSunday);
	$nextSundayDate = date('F jS', $nextSunday);
	$nextSundayTime = date('g:i a', $nextSunday);
		
	echo '<div class="drop-dates-item"><input type="radio" id="' . $nextSunday . '" name="drop-date" value="' . $nextSunday . '" /><span class="drop-date-item-day">' . $nextSundayDay . '</span><br/>Date: ' . $nextSundayDate . '<br/>Time: ' . $nextSundayTime . '</div>';
		
	$nextSunday = strtotime("+7 day", $nextSunday);
	$nextSundayDay = date('l', $nextSunday);
	$nextSundayDate = date('F jS', $nextSunday);
	$nextSundayTime = date('g:i a', $nextSunday);
	
	echo '<div class="drop-dates-item"><input type="radio" id="' . $nextSunday . '" name="drop-date" value="' . $nextSunday . '" /><span class="drop-date-item-day">' . $nextSundayDay . '</span><br/>Date: ' . $nextSundayDate . '<br/>Time: ' . $nextSundayTime . '</div>';
	echo '</div>';	
	
	echo '<div class="button-row">';
	echo $this->Form->button('Continue', array('type' => 'button', 'id' => 'continue', 'name' => 'continue'));
	echo '</div>';
	echo $this->Form->end();
?>
</div>
