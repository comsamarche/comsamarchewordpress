function initMap() {


	var myLatlng = new google.maps.LatLng(47.333057, 5.010957);
	var maudLat = { lat: 47.33233, lng: 5.011643 },
		Clinic = { lat: 47.333922, lng: 5.01086 },
		Intermarche = { lat: 47.332591, lng: 5.010141 };

	var mapOptions = {
		zoom: 17,
		center: myLatlng,
		disableDefaultUI: false,
		mapTypeControlOptions: {
			mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
				'styled_map']
		}
	};

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);


	var image = {
		url: "wp-content/themes/maudtheme/assets/img/placeholder.svg",
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(40, 53),
		// The origin for this image is (0, 0).
		origin: new google.maps.Point(20, 26),
		// The anchor for this image is the base of the flagpole at (0, 32).
		anchor: new google.maps.Point(0, 43)
	};

	var marker = new google.maps.Marker({
		position: maudLat,
		map: map,
		//icon: image,
		title: 'Cabinet'
	});

	var mClinic = new google.maps.Marker({
		position: Clinic,
		map: map,
		label: 'Clinique Bénigne Joly'
	});

	var mIntermarche = new google.maps.Marker({
		position: Intermarche,
		map: map,
		title: 'Intermarché'
	});

	var contentString = '<div id=\"content\">' +
		'<div id=\"siteNotice\">' +
		'</div>' +
		'<h1 id=\"firstHeading\" class=\"firstHeading\">Maud Chenut-Briotet</h1>' +
		'<div id=\"bodyContent\">' +
		'<p><b>Podologue</b></p>' +
		'</div>' +
		'</div>';


	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});

	infowindow.open(map, marker);

	// To add the marker to the map, call setMap();
	mClinic.setMap(map);
	mIntermarche.setMap(map);

	var styledMapType = new google.maps.StyledMapType(
		[
			// {
			// 	elementType: 'geometry',
			// 	stylers: [{ color: '#f5f5f5' }]
			// },
			// {
			// 	elementType: 'labels.icon',
			// 	stylers: [{ visibility: 'off' }]
			// },
			{
				elementType: 'labels.text.fill',
				stylers: [{ color: '#616161' }]
			},
			{
				elementType: 'labels.text.stroke',
				stylers: [{ color: '#f5f5f5' }]
			},
			// {
			// 	featureType: 'administrative.land_parcel',
			// 	elementType: 'labels.text.fill',
			// 	stylers: [{ color: '#bdbdbd' }]
			// },
			// {
			// 	featureType: 'poi',
			// 	elementType: 'geometry',
			// 	stylers: [{ color: '#eeeeee' }]
			// },
			// {
			// 	featureType: 'poi',
			// 	elementType: 'labels.text.fill',
			// 	stylers: [{ color: '#757575' }]
			// },
			// {
			// 	featureType: 'poi.park',
			// 	elementType: 'geometry',
			// 	stylers: [{ color: '#e5e5e5' }]
			// },
			// {
			// 	featureType: 'poi.park',
			// 	elementType: 'labels.text.fill',
			// 	stylers: [{ color: '#9e9e9e' }]
			// },
			{
				featureType: 'road',
				elementType: 'geometry',
				stylers: [{ color: '#ffffff' }]
			},
			{
				featureType: 'road.arterial',
				elementType: 'labels.text.fill',
				stylers: [{ color: '#757575' }]
			},
			{
				featureType: 'road.highway',
				elementType: 'geometry',
				stylers: [{ color: '#dadada' }]
			},
			{
				featureType: 'road.highway',
				elementType: 'labels.text.fill',
				stylers: [{ color: '#616161' }]
			},
			{
				featureType: 'road.local',
				elementType: 'labels.text.fill',
				stylers: [{ color: '#9e9e9e' }]
			},
			{
				featureType: 'transit.line',
				elementType: 'geometry',
				stylers: [{ color: '#e5e5e5' }]
			},
			{
				featureType: 'transit.station',
				elementType: 'geometry',
				stylers: [{ color: '#eeeeee' }]
			},
			{
				featureType: 'water',
				elementType: 'geometry',
				stylers: [{ color: '#c9c9c9' }]
			},
			{
				featureType: 'water',
				elementType: 'labels.text.fill',
				stylers: [{ color: '#9e9e9e' }]
			}
		],
		{ name: 'Styled Map' });

	//Associate the styled map with the MapTypeId and set it to display.
	map.mapTypes.set('styled_map', styledMapType);
	map.setMapTypeId('styled_map');


};
