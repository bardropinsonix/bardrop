<script type='text/javascript'>
	$(document).ready(function() {
		$('#add').click(function(){
			var barAddress = $('#BarAddress').val();
			var barCity = $('#BarCity').val();
			var barState = $('#BarStateId option:selected').text();
			var barCountry = $('#BarCountryId option:selected').text();
			var barPostalCode = $('#BarPostalCode').val();
			var address = barAddress + ' ' + barCity + ' ' + barState + ' ' + barCountry + ' ' + barPostalCode;

			geocode(address, submit);
		});
		
		$('#BarCountryId').change(function(){
			$.ajax({
			    url : "/admin/states/getByCountry",
			    type: "POST",
			    data : { countryId: $('#BarCountryId').val() },
			    dataType: "json",
			    success: function(data, textStatus, jqXHR) {
			    	var $el = $("#BarStateId");
			    	$el.empty();
			    	$.each(data, function(value, key) {
						$el.append($("<option></option>").attr("value", value).text(key));
			    	});
			    }
			});
		});

		$('#BarCountryId').trigger('change');

		function submit(location){
			$('#BarLat').val(location.lat());
			$('#BarLong').val(location.lng());
			
			$('form').submit();
		}
	});
</script>
<div class="bars form">
<?php 
	echo $this->Form->create('Bar');
	echo '<h1>Add Bar</h1>';
	echo $this->Form->input('name');
	echo $this->Form->input('url', array('label' => 'Website'));
	echo $this->Form->input('address');
	echo $this->Form->input('city');
	echo $this->Form->input('state_id');
	echo $this->Form->input('country_id');
	echo $this->Form->input('postal_code');
	echo $this->Form->hidden('lat');
	echo $this->Form->hidden('long');
	echo '<div class="checkbox-select">';
	echo $this->Form->input('Bar.BarType', array(
		'label' => __('Bar Types',true),
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $barTypes
	));
	echo '</div>';
	echo '<div class="button-row">';
	echo $this->Form->button('Add', array('type' => 'button', 'id' => 'add', 'name' => 'add'));
	echo '</div>';
	echo $this->Form->end();
?>
</div>