<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" type="text/css">
<title>Display a popup on click</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
<!-- Mapbox Assembly -->
<link
href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css"
rel="stylesheet"
/>
<script src="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<style>
    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }

</style>
<div id="map"></div>

 
<div class="absolute fl my24 mx24 py24 px24 bg-gray-faint round" style="top: 70%;">
<form id="params">
<h4 class="txt-m txt-bold mb6">Choose a travel mode:</h4>
<div class="mb12 mr12 toggle-group align-center">
<label class="toggle-container">
<input name="profile" type="radio" value="walking" />
<div class="toggle toggle--active-null toggle--null">Walking</div>
</label>
<label class="toggle-container">
<input name="profile" type="radio" value="cycling" checked />
<div class="toggle toggle--active-null toggle--null">Cycling</div>
</label>
<label class="toggle-container">
<input name="profile" type="radio" value="driving" />
<div class="toggle toggle--active-null toggle--null">Driving</div>
</label>
</div>
<h4 class="txt-m txt-bold mb6">Choose a maximum duration:</h4>
<div class="mb12 mr12 toggle-group align-center">
<label class="toggle-container">
<input name="duration" type="radio" value="10" checked />
<div class="toggle toggle--active-null toggle--null">10 min</div>
</label>
<label class="toggle-container">
<input name="duration" type="radio" value="20" />
<div class="toggle toggle--active-null toggle--null">20 min</div>
</label>
<label class="toggle-container">
<input name="duration" type="radio" value="30" />
<div class="toggle toggle--active-null toggle--null">30 min</div>
</label>
</div>
</form>
</div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
    const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/isaacruiiiz/clsup1pso003d01po8s6nf9ut',
        center: [2.173296,41.388002],
        zoom: 17
    });

    const nav = new mapboxgl.NavigationControl();
    map.addControl(nav);

    var directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
    });

    map.addControl(directions, 'top-left');

    // Create a default Marker and add it to the map.
    const marker1 = new mapboxgl.Marker()
    .setLngLat([2.173066,41.388712])
    .addTo(map);

    map.on('load', () => {
        map.addSource('places', {
            // This GeoJSON contains features that include an "icon"
            // property. The value of the "icon" property corresponds
            // to an image in the Mapbox Streets style's sprite.
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': [
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<h3>Alex Cuc</h3>',
                            'icon': 'dot-9'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [2.173066,41.388712]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Mad Men Season Five Finale Watch Party</strong><p>Head to Lounge 201 (201 Massachusetts Avenue NE) Sunday for a <a href="http://madmens5finale.eventbrite.com/" target="_blank" title="Opens in a new window">Mad Men Season Five Finale Watch Party</a>, complete with 60s costume contest, Mad Men trivia, and retro food and drink. 8:00-11:00 p.m. $10 general admission, $20 admission and two hour open bar.</p>',
                            'icon': 'theatre'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.003168, 38.894651]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Big Backyard Beach Bash and Wine Fest</strong><p>EatBar (2761 Washington Boulevard Arlington VA) is throwing a <a href="http://tallulaeatbar.ticketleap.com/2012beachblanket/" target="_blank" title="Opens in a new window">Big Backyard Beach Bash and Wine Fest</a> on Saturday, serving up conch fritters, fish tacos and crab sliders, and Red Apron hot dogs. 12:00-3:00 p.m. $25.grill hot dogs.</p>',
                            'icon': 'bar'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.090372, 38.881189]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Ballston Arts & Crafts Market</strong><p>The <a href="http://ballstonarts-craftsmarket.blogspot.com/" target="_blank" title="Opens in a new window">Ballston Arts & Crafts Market</a> sets up shop next to the Ballston metro this Saturday for the first of five dates this summer. Nearly 35 artists and crafters will be on hand selling their wares. 10:00-4:00 p.m.</p>',
                            'icon': 'art-gallery'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.111561, 38.882342]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Seersucker Bike Ride and Social</strong><p>Feeling dandy? Get fancy, grab your bike, and take part in this year\'s <a href="http://dandiesandquaintrelles.com/2012/04/the-seersucker-social-is-set-for-june-9th-save-the-date-and-start-planning-your-look/" target="_blank" title="Opens in a new window">Seersucker Social</a> bike ride from Dandies and Quaintrelles. After the ride enjoy a lawn party at Hillwood with jazz, cocktails, paper hat-making, and more. 11:00-7:00 p.m.</p>',
                            'icon': 'bicycle'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.052477, 38.943951]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Capital Pride Parade</strong><p>The annual <a href="http://www.capitalpride.org/parade" target="_blank" title="Opens in a new window">Capital Pride Parade</a> makes its way through Dupont this Saturday. 4:30 p.m. Free.</p>',
                            'icon': 'rocket'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.043444, 38.909664]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Muhsinah</strong><p>Jazz-influenced hip hop artist <a href="http://www.muhsinah.com" target="_blank" title="Opens in a new window">Muhsinah</a> plays the <a href="http://www.blackcatdc.com">Black Cat</a> (1811 14th Street NW) tonight with <a href="http://www.exitclov.com" target="_blank" title="Opens in a new window">Exit Clov</a> and <a href="http://godsilla.bandcamp.com" target="_blank" title="Opens in a new window">Gods’illa</a>. 9:00 p.m. $12.</p>',
                            'icon': 'music'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.031706, 38.914581]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>A Little Night Music</strong><p>The Arlington Players\' production of Stephen Sondheim\'s  <a href="http://www.thearlingtonplayers.org/drupal-6.20/node/4661/show" target="_blank" title="Opens in a new window"><em>A Little Night Music</em></a> comes to the Kogod Cradle at The Mead Center for American Theater (1101 6th Street SW) this weekend and next. 8:00 p.m.</p>',
                            'icon': 'music'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.020945, 38.878241]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'description':
                                '<strong>Truckeroo</strong><p><a href="http://www.truckeroodc.com/www/" target="_blank">Truckeroo</a> brings dozens of food trucks, live music, and games to half and M Street SE (across from Navy Yard Metro Station) today from 11:00 a.m. to 11:00 p.m.</p>',
                            'icon': 'music'
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-77.007481, 38.876516]
                        }
                    }
                ]
            }
        });
        // Add a layer showing the places.
        map.addLayer({
            'id': 'places',
            'type': 'symbol',
            'source': 'places',
            'layout': {
                'icon-image': ['get', 'icon'],
                'icon-allow-overlap': true
            }
        });

        // When a click event occurs on a feature in the places layer, open a popup at the
        // location of the feature, with description HTML from its properties.
        map.on('click', 'places', (e) => {
            // Copy coordinates array.
            const coordinates = e.features[0].geometry.coordinates.slice();
            const description = e.features[0].properties.description;

            // Ensure that if the map is zoomed out such that multiple
            // copies of the feature are visible, the popup appears
            // over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }

            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML(description)
                .addTo(map);
        });

        // Change the cursor to a pointer when the mouse is over the places layer.
        map.on('mouseenter', 'places', () => {
            map.getCanvas().style.cursor = 'pointer';
        });

        // Change it back to a pointer when it leaves.
        map.on('mouseleave', 'places', () => {
            map.getCanvas().style.cursor = '';
        });
    });

    // Add geolocate control to the map.
    map.addControl(
    new mapboxgl.GeolocateControl({
    positionOptions: {
    enableHighAccuracy: true
    },
    // When active the map will receive updates to the device's location as it changes.
    trackUserLocation: true,
    // Draw an arrow next to the location dot to indicate which direction the device is heading.
    showUserHeading: true
    })
    );


    // Add expected travel time to the map
    // Target the params form in the HTML
        const params = document.getElementById('params');
        
        // Create variables to use in getIso()
        const urlBase = 'https://api.mapbox.com/isochrone/v1/mapbox/';
        let lon, lat;

        // Get the current position of the user
        navigator.geolocation.getCurrentPosition((position) => {
            lon = position.coords.longitude;
            lat = position.coords.latitude;

            // Rest of your code here
            let profile = 'cycling';
            let minutes = 10;

            // Set up a marker that you can use to show the query's coordinates
            const marker = new mapboxgl.Marker({
                'color': '#314ccd'
            });

            // Create a LngLat object to use in the marker initialization
            // https://docs.mapbox.com/mapbox-gl-js/api/#lnglat
            const lngLat = {
                lon: lon,
                lat: lat
            };

            // Create a function that sets up the Isochrone API query then makes a fetch call
            async function getIso() {
                const query = await fetch(
                    `${urlBase}${profile}/${lon},${lat}?contours_minutes=${minutes}&polygons=true&access_token=${mapboxgl.accessToken}`,
                    { method: 'GET' }
                );
                const data = await query.json();
                // Set the 'iso' source's data to what's returned by the API query
                map.getSource('iso').setData(data);
            }

            // Rest of your code here
        });
        let profile = 'cycling';
        let minutes = 10;
        
        // Set up a marker that you can use to show the query's coordinates
        const marker = new mapboxgl.Marker({
        'color': '#314ccd'
        });
        
        // Create a LngLat object to use in the marker initialization
        // https://docs.mapbox.com/mapbox-gl-js/api/#lnglat
        const lngLat = {
        lon: lon,
        lat: lat
        };
        
        // Create a function that sets up the Isochrone API query then makes a fetch call
        async function getIso() {
        const query = await fetch(
        `${urlBase}${profile}/${lon},${lat}?contours_minutes=${minutes}&polygons=true&access_token=${mapboxgl.accessToken}`,
        { method: 'GET' }
        );
        const data = await query.json();
        // Set the 'iso' source's data to what's returned by the API query
        map.getSource('iso').setData(data);
        }
        
        // When a user changes the value of profile or duration by clicking a button, change the parameter's value and make the API query again
        params.addEventListener('change', (event) => {
        if (event.target.name === 'profile') {
        profile = event.target.value;
        } else if (event.target.name === 'duration') {
        minutes = event.target.value;
        }
        getIso();
        });
        
        map.on('load', () => {
        // When the map loads, add the source and layer
        map.addSource('iso', {
        type: 'geojson',
        data: {
        'type': 'FeatureCollection',
        'features': []
        }
        });
        
        map.addLayer(
        {
        'id': 'isoLayer',
        'type': 'fill',
        'source': 'iso',
        'layout': {},
        'paint': {
        'fill-color': '#5a3fc0',
        'fill-opacity': 0.3
        }
        },
        'poi-label'
        );
        
        // Initialize the marker at the query coordinates
        marker.setLngLat(lngLat).addTo(map);
        
        // Make the API call
        getIso();
        });
</script>

</body>
</html>