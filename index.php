<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localisation sites | Styve App</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/> -->
    <!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script> -->
    <link rel="stylesheet" href="libs/leaflet/leaflet.css">
    <script src="libs/leaflet/leaflet-src.js"></script>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        #map { height: 100vh; }
        .for-btn{
            position: absolute;;
            bottom: 0;
            left: 10;
            width: 200px;
            kerning: 45px;
            background-color: #fff;
            z-index: 1988888;
            padding-left: 20px;
            padding-right: 20px;
        }
        .btn-m{

        }
    </style>
</head>
<body>
    <div class="for-btn">
        <h4>Coordonnées Selectionnées</h4>
        <p>latitude : <span id="lat"></span></p>
        <p>longitude : <span id="lon"></span></p>
        <div class="btn-m">

        </div>
    </div>
    <div id="map"></div>

    <script>
        (() => {

            const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };
            const map = L.map('map').setView([-1.658501, 29.2204548], 13);

            const tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a> by <a href="https://davidmaene.reitecinfo.net">David Maene</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);

            const popup = L.popup();
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(map);
                
            }
            function success(pos) {
            var crd = pos.coords;

                console.log('Votre position actuelle est :');
                console.log(`Latitude : ${crd.latitude}`);
                console.log(`Longitude : ${crd.longitude}`);
                console.log(`La précision est de ${crd.accuracy} mètres.`);

                document.getElementById("lat").innerHTML = crd.latitude;
                document.getElementById("lon").innerHTML = crd.longitude;

                const marker = L.marker([crd.latitude, crd.longitude])
                    .on('click', onMapClick)
                    .addTo(map);
            }
            function error(err) {
                console.warn(`ERREUR (${err.code}): ${err.message}`);
            }
            function location(){
                navigator.geolocation.getCurrentPosition(success, error, options);
            }
            location()
            // map.on('click', onMapClick);

            // var circle = L.circle([51.508, -0.11], {
            //     color: 'red',
            //     fillColor: '#f03',
            //     fillOpacity: 0.5,
            //     radius: 500
            // }).addTo(map);

            // var polygon = L.polygon([
            //     [51.509, -0.08],
            //     [51.503, -0.06],
            //     [51.51, -0.047]
            // ]).addTo(map);
        })()
    </script>
</body>
</html>