<style>
	#drop-movement {
		display: none;
	}
	
	div.users.reserve h1 {
		font: bold 2em "Trebuchet MS", Helvetica, sans-serif; 
		color: #000; 
		text-shadow: 1px 1px 0 #fff;
		background: transparent url('/img/paymenttitle_page_icon_.png') no-repeat 0px 0px; 
		display: inline-block;
		width: 770px;
		margin: 0 0 25px 0;
		padding: 40px 0px 35px 120px;
		border-bottom: solid 1px #babbad;
	}
	div.users.reserve h2 {
		color: #3da19b;
		margin: 15px 0;
		width: 100%;
	}
</style>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type='text/javascript'>
	Stripe.setPublishableKey('<?php echo STRIPE_P_KEY; ?>');
	
	$(document).ready(function() {
		$('#reserve').click(function() {
			if($('#UserReserveForm').valid()){
			    var form = $('#UserReserveForm');
	
			    form.find('button').prop('disabled', true);
	
			    Stripe.card.createToken(form, stripeResponseHandler);
			}
		});

		$('#UserReserveForm').validate({
			rules: {
				'data[User][number]': {
					required: true,
					creditcard: true
				},
				'data[User][cvc]': {
					required: true,
				    digits: true,
				    rangelength: [3, 4]
				}
			},
			messages: {
				'data[User][number]': {
					required: 'Please enter your credit card number',
					creditcard: 'Please enter your credit card number'
				},
				'data[User][cvc]': {
					required: 'Please enter your cvc',
					rangelength: 'Your cvc must be 3 to 4 characters',
					digits: 'Your cvc must be numeric'
				}
			}
		});
	});

	function stripeResponseHandler(status, response) {
		var token = response.id;
		var form = $('form');
	    form.append($('<input type="hidden" name="stripeToken" />').val(token));
		$('form').submit();
	};
</script>
<div class='users reserve form'>
<?php 
	echo $this->Form->create('User');
	echo '<h1>Reserve Your BarDrop</h1>';
	echo '<h2>Please make payment to confirm your BarDrop reservation.</h2>';
	echo '<br/><br/>';
	echo $this->Form->input('number', array('label' => 'Credit Card Number', 'data-stripe' => 'number'));
	echo $this->Form->input('cvc', array('label' => 'CVC', 'data-stripe' => 'cvc'));
	echo $this->Form->input('exp-month', array(
		'type' => 'date',
		'label' => 'Expiration Month',
		'dateFormat' => 'M',
		'data-stripe' => 'exp-month'));
	echo $this->Form->input('exp-year', array(
		'type' => 'date',
		'label' => 'Expiration Year',
		'dateFormat' => 'Y',
		'minYear' => date('Y'),
		'maxYear' => date('Y') + 7,
		'data-stripe' => 'exp-year'));
	echo '<div class="button-row">';
	echo $this->Form->button('Reserve', array('type' => 'button', 'id' => 'reserve', 'name' => 'reserve'));
	echo '</div>';
	echo '<br/><br/>';
	echo '<h3>We offer the utmost in protection to ensure secure payment for our services.<br/>  Thank you for your reservation!</h3>';
	echo $this->Form->end();
?>
</div>
