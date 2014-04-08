$(document).ready(function() {
	var body = $('body').width();
	adjustHeader(body);
	adjustNav(body);
	
	$('#login').click(function(){
		$('#register a img').trigger('click');
	});
	
	$('#login img').hover(
		function() {
			$(this).attr('src', '/img/btn_sign_in_hover.png');
		}, function() {
			$(this).attr('src', '/img/btn_sign_in_on.png');
		}
	);

	$('#logout img').hover(
		function() {
			$(this).attr('src', '/img/btn_sign_out_hover.png');
		}, function() {
			$(this).attr('src', '/img/btn_sign_out_on.png');
		}
	);
	
	$(window).resize(function() {
		var body = $('body').width();
		adjustHeader(body);
		adjustNav(body);
	});
	
	$("#nav a").button();
});

function adjustHeader(body) {
	var header = $('#header').width();
	var offset = ((body - header) / 2) - 70;
	
	$('#img_drinks').css('background-position', offset);
}

function adjustNav(body) {
	var nav = $('#nav').width();
	var offset = ((body - nav) / 2);
	
	$('#nav').css('left', offset);
}

function createDataBlock(dataBlockHeader, dataBlockRows){
	var html = '';
	html += '<div class="data-block">';
	html += dataBlockHeader;
	for (dataBlockRow in dataBlockRows){
		html += dataBlockRows[dataBlockRow];
	}
	html += '</div>';
	return html;
}

function createDataBlockRow(key, value){
	var html = '';
	html += '<div class="data-block-row">';
	if (key)
		html += '<span class="key">' + key + ':</span>';
	html += '<span class="value">' + value + '</span>';
	html += '</div>';
	return html;
}

function geocode(address, callback, options){
	var geocoder = new google.maps.Geocoder();
	
	geocoder.geocode({'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK){
			var location = results[0].geometry.location;
			
			if (options != null)
				callback(location, options);
			else
				callback(location);
		}
		else {
        	alert('Geocode was not successful for the following reason: ' + status);
        	return null;
      	}
    });
}


