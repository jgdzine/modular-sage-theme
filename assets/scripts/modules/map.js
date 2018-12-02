/**
 *
 * 	Map
 *
 * 		If we want to be cautious about hitting out 50k limit we can instantiate
 * 		the map right before it's scrolled into view. Might help eliminate some
 * 		page bounce counts.
 *
 */

;(function( $ ){

	var Map = function( map ){
		var _this = this;

		// Map Container Element
		this.mapEl = map;

		// Mapbox map object
		this.map = null;

		this.locations = window.officeLocations;

		// Create a LngLatBounds obj to set the bounds of the map on load
		this.mapBounds = new mapboxgl.LngLatBounds();

		// Add all coordinates to this.mapBounds
		this.locations.forEach(function( location ) {
			_this.mapBounds.extend( location.coordinates );
		});

		// Token and style URL from mapbox studio
		this.token = 'pk.eyJ1IjoiY29kZTQyd2ViIiwiYSI6ImNpemthb3liMTA0Yncyd21rcGV5bndwNnoifQ.iC_tkLIK1IXBcyrkpaeg_Q';
		this.style = 'mapbox://styles/code42web/cizkc06qc000b2so906xidg64';

		this.init()
			.plotLocations()
			.fitBounds()
			.bindEvents();
	};


	Map.prototype.init = function(){
		var map;

		mapboxgl.accessToken = this.token;

		map = new mapboxgl.Map({
			container: this.mapEl.attr('id'),
			style: this.style,
			scrollZoom: false,
			attributionControl: false
		});

		// Add zoom and rotation controls to the map.
		map.addControl(new mapboxgl.NavigationControl());

		// disable map rotation using right click + drag
		map.dragRotate.disable();

		// disable map rotation using touch rotation gesture
		map.touchZoomRotate.disableRotation();

		this.map = map;

		return this;
	};


	Map.prototype.plotLocations = function(){
		var _this = this;

		// Go through all the locations set on window in the template and plot them
		// to the map
		this.locations.forEach(function(location, index){
			var markerElement = document.createElement("div");

			// The class that's styled in _map.scss
			markerElement.className = "map__marker";

			// Set the name in a data-attribute to display in a pseudo-element in CSS
			markerElement.setAttribute("data-location-name", location.name);

			var marker = new mapboxgl.Marker( markerElement )
				.setLngLat( location.coordinates )
				.addTo( _this.map );
		});

		return this;
	};


	Map.prototype.fitBounds = function(){

		this.map.fitBounds( this.mapBounds, { padding: '100' } );

		return this;
	};


	Map.prototype.bindEvents = function() {
		var _this = this;

		// Update map positioning when window is resized.
		$(window).on('resize', function(){
			$.proxy( _this.fitBounds(), _this );
		});

	};


	/**
	 * Instantiate the Map object on document ready
	 */
	$(function(){
		var $map = $('#map');

		if( $map.length ) {
			if ( "undefined" !== typeof(mapboxgl) ){
				if (mapboxgl.supported()){
					new Map( $map );
				}else{
					console.log('mapboxgl not supported!');
					$map.hide();
				}
			}else{
				console.log('mapboxgl not loaded!');
				$map.hide();
			}
		}
	});
}( jQuery ));
