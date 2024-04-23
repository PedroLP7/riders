<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../../resources/css/loading.css">  
<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/90b0b64f-4607-4ba9-a543-41d7b7a589ed/webchat/config.js"
    defer></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

@vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js', 'resources/css/styles.css'])
<title>Display a popup on click</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
<!-- Mapbox Assembly -->
<link
href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css"
rel="stylesheet"
/>

<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
<link rel="stylesheet" href="../../resources/css/styles.css">
<style>
    #mapbox{
        position: absolute;
    z-index: -10;
    }
    #bp-web-widget-container{
        position: relative;
        top: 10px;
    }
    .bpw-floating-button {
    /* Aligns the button to the right side of the container */
    float: left;
    background-color: red;
    
    /* Sets the fill color of the button icon */
    fill: rgb(255, 255, 255);
    /* Changes the cursor to a pointer when hovering over the button */
    cursor: pointer;
    /* Removes the outline around the button when clicked */
    outline: none;
 
    /* Centers the icon inside the button element */
    display: flex;
    align-items: center;
    justify-content: center;
 
    /* Sets the z-index to ensure the button is on top of other elements */
    z-index: 10;
    /* Sets the width and height of the button */
    width: 152px;
    height: 52px;
    /* Changes the cursor to a pointer when hovering over the button */
    cursor: pointer;
    /* Rounds the corners of the button */
    border-radius: 50%;
    /* Adds a shadow effect to the button */
    box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.4);
    /* Clips any content that overflows the button */
    overflow: hidden;
 
    /* Removes padding and borders from the button */
    padding: 0;
    border: none;
    background-clip: padding-box;
 
    /* Adds a transition effect to the button when its size changes */
    transition: width 1s, height 1s;
}

.bp-widget-widget {
    bottom: 85% !important;
    right: 3em !important;
}

</head>
<body>
    
<style>
    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }
    
</style>
<script src="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.js"></script>

  
<div id="mapbox"></div>






</body>
</html>
