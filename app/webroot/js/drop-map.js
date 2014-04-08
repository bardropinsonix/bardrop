function DropMap(latitude, longitude, zoom){
	this.map;
	this.markers = new Array();
	this.setCenter(latitude, longitude, zoom);
}

DropMap.prototype.setCenter = function(latitude, longitude, zoom){
	var latlng = new google.maps.LatLng(latitude, longitude);
	var id = 'map-canvas';

	mapEl = document.getElementById(id)
	
	var mapOptions = {
		id: id,
		zoom: zoom,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	this.map = new google.maps.Map(mapEl, mapOptions);
};

DropMap.prototype.addMarker = function(latitude, longitude, options){
	var latlng = new google.maps.LatLng(latitude, longitude);
	
	var id = options['id'];
	var icon = options['icon'];
	var title = options['title'];
	var address = options['address'];
	var url = options['url'];
	
	var marker = new google.maps.Marker({
		id: id,
		position: latlng,
	    map: this.map,
        icon: icon,
        title: title,
        address: address
  	});
	
	if (url){
     	google.maps.event.addListener(marker, 'click', function() {
     		window.open(url);
		});
	}
	
	this.markers[id] = marker;
};

DropMap.prototype.removeMarker = function(id){
	this.markers[id].setMap(null);
};

DropMap.prototype.showMarker = function(id, callback){
	var marker = this.markers[id];
	marker.setVisible(true);
	
	if (callback)
		callback();
};

DropMap.prototype.hideMarker = function(id, callback){
	var marker = this.markers[id];
	marker.setVisible(false);
	
	if (callback)
		callback();
};