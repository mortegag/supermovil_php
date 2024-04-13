<?php
// Reemplaza con tu token de acceso de OpenRouteService
$ors_api_key = '5b3ce3597851110001cf624814ab2cd7d2ee480c9f7a79416538787f';

// Coordenadas de origen y destino
$origin_lat = 40.730610;
$origin_lng = -73.935242;
$destination_lat = 40.73061;
$destination_lng = -73.935242;

// Calcular la ruta usando OpenRouteService
$url = "https://api.openrouteservice.org/v2/directions?api_key=$ors_api_key&start=$origin_lng,$origin_lat&end=$destination_lng,$destination_lat&profile=driving-car&format=geojson";
$response = file_get_contents($url);
$data = json_decode($response, true);

// Extraer la información de la ruta
$distance = $data['features'][0]['properties']['summary']['distance'];
$duration_car = $data['features'][0]['properties']['summary']['duration'];
$duration_pedestrian = $data['features'][0]['properties']['summary']['duration_pedestrian'];
$duration_bicycle = $data['features'][0]['properties']['summary']['duration_bicycle'];
$coordinates = $data['features'][0]['geometry']['coordinates'];

// Mostrar el mapa y la ruta
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mapa de Ruta</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <div id="map" style="height: 500px;"></div>
    <script>
        // Inicializar el mapa
        var map = L.map('map').setView([<?php echo $origin_lat; ?>, <?php echo $origin_lng; ?>], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Dibujar la ruta en el mapa
        var routeCoordinates = [
            <?php
            foreach ($coordinates as $coordinate) {
                echo "[" . $coordinate[1] . ", " . $coordinate[0] . "],";
            }
            ?>
        ];
        var polyline = L.polyline(routeCoordinates, { color: 'blue' }).addTo(map);
        map.fitBounds(polyline.getBounds());

        // Mostrar la distancia y la duración
        console.log('Distancia: ' + (<?php echo $distance; ?> / 1000).toFixed(2) + ' km');
      //  console.log('Duración en auto: ' + Math.floor(<?php echo $duration_car; ?> / 60) + ' min');
      //  console.log('Duración a pie: ' + Math.floor(<?php echo $duration_pedestrian; ?> / 60) + ' min');
      //  console.log('Duración en bicicleta: ' + Math.floor(<?php echo $duration_bicycle; ?> / 60) + ' min');
    </script>
</body>

</html>