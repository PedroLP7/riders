<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" type="text/css">
@vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
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
<link rel="stylesheet" href="../resources/css/styles.css">
</head>
<body>
<style>
    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }

</style>

<div id="mapbox"></div>
<div id="navbar"></div>


</body>
</html>