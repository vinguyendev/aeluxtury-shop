/**
 * Constructor
 * @author AlvinTran
 * Modified by Cong Luong
 * 07/03/2014
 */
function StoreBubble(key, data, map, colorIcon) {
	this.key		= key;
	this.store	= data;

   this.setMap(map);

   if(typeof colorIcon == 'undefined') colorIcon = 'yellow';
   this.colorIcon = colorIcon;
};

//
StoreBubble.prototype = new google.maps.OverlayView();

StoreBubble.prototype.onAdd = function() {
   var store_data = this.store;

   // Tạo icon trên map
   var bubble = $('<div>').attr({
   	'id' : 'store-location-' + this.key,
   	'class' : 'icon-store-location'
   }).css({
   	'position' : 'absolute',
   	// 'z-index' : 999
   });

   var icon = $('<i>').attr({
   	'class' : 'jmapcontrol map-icons map-icon-location map-icon-location-' + this.colorIcon
   }).text(this.key);

   var html_hover = [
   	 '<div class="info-store-inmap">',
			 '<div class="info fl">',
				 '<div class="name">'+ store_data.sto_name +'</div>',
				 '<div class="address"><b>ĐC: </b>'+ store_data.sto_address + '</div>',
				 '<div class="phone"><b>ĐT: </b>'+ store_data.sto_phone +'</div>',
			 '</div>',
			 '<div class="store-avatar fr"><div class="st-avatar" style="background-image:url('+ store_data.sto_avatar +')"></div></div>',
			 '<div class="clear"></div>',
	   '</div>'
   ].join('');

   bubble.append(icon);
   bubble.append(html_hover);

   $(bubble).on('mouseover', function(ev) {
   	$(this).find('.info-store-inmap').show();
   })
   .on('mouseout', function(ev) {
   	$(this).find('.info-store-inmap').hide();
   });

	$(bubble).find('.bottom-intro-road').click(function() {
		var $this = $(this);
		$($this.data('target')).trigger('click');
	})

   this.getPanes().overlayMouseTarget.appendChild($(bubble).get(0));
}

StoreBubble.prototype.onRemove = function(item) {
	this.store = item;

}

StoreBubble.prototype.draw = function() {
   var gPoint = new google.maps.LatLng(this.store.sto_latitude, this.store.sto_longitude);
   var bubblePosition = this.getProjection().fromLatLngToDivPixel(gPoint);
   $('#store-location-' + this.key).css({
      'top'   : (bubblePosition.y) + 'px',
      'left'  : (bubblePosition.x) + 'px'
   });
}