<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa eudoo</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Incluir la biblioteca Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <style>
        #map {
            height: 400px;
        }

        body {
            padding: 0;
            margin: 0;
        }

        html,
        body,
        #map {
            height: 100%;
            width: 100vw;
        }

        .custom-div-icon {
            display: inline;
            background-color: yellow;
            margin: auto;
            width: 50%;
            border: 3px solid green;
            padding-top: 5px;
            padding-right: 30px;
            padding-bottom: 35px;
            padding-left: 1px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <?php
    // Requerimientos: Obtener datos desde la URL
    function obtenerDatos()
    {
        // Verificar si hay valores en la URL para el origen
        if (isset($_GET['origin_lng'], $_GET['origin_lat']) && !empty($_GET['origin_lng']) && !empty($_GET['origin_lat'])) {
            // Obtener valores de origen de la URL
            $origin_lng = $_GET['origin_lng'];
            $origin_lat = $_GET['origin_lat'];
            $origin_description = $_GET['origin_description'];
            $origin_id = $_GET['origin_id'];
        } else {
            // No se proporcionaron valores para el origen, retornar un array vacío
            return [];
        }

        // Verificar si hay valores en la URL para el destino
        if (isset($_GET['destination_lng'], $_GET['destination_lat']) && !empty($_GET['destination_lng']) && !empty($_GET['destination_lat'])) {
            // Obtener valores de destino de la URL
            $destination_lng = $_GET['destination_lng'];
            $destination_lat = $_GET['destination_lat'];
            $destination_description = $_GET['destination_description'];
            $destination_id = $_GET['destination_id'];

            // Retornar los datos con el origen y destino
            return [
                (object) ['id' => $origin_id, 'lat' => $origin_lat, 'Lng' => $origin_lng, 'Description' => $origin_description],
                (object) ['id' =>  $destination_id, 'lat' => $destination_lat, 'Lng' => $destination_lng, 'Description' => $destination_description]
            ];
        } else {
            // Retornar solo los datos del origen
            return [(object) ['id' => $origin_id, 'lat' => $origin_lat, 'Lng' => $origin_lng, 'Description' => $origin_description]];
        }
    }
    // Requerimientos: Cargar el mapa con los nuevos datos de los puntos y dibujar la ruta si es posible
    function cargarMapa($puntos)
    {
        $origin_lat = $puntos[0]->lat;
        $origin_lng = $puntos[0]->Lng;
        // Crear un mapa centrado en una ubicación específica
        echo "<script>";
        echo "var map = L.map('map').setView([$origin_lat, $origin_lng], 15);";
        // Agregar una capa de mapa base
        echo "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);";
        // Bandera para controlar si se dibuja la ruta
        $dibujarRuta = false;
        // Variables para coordenadas de origen y destino
        $origin_lat = null;
        $origin_lng = null;
        $destination_lat = null;
        $destination_lng = null;
        // Contador para determinar el número de puntos
        $puntosCount = count($puntos);
        // Iterar sobre los puntos
        foreach ($puntos as $index => $punto) {
            $popupContent = "ID: $punto->id <br> Descripción: $punto->Description";
            echo "L.marker([$punto->lat, $punto->Lng], {icon: L.icon({
                iconUrl: '" . ($index === 0 ? 'origin-icon.png' : 'destination-icon.png') . "', // URL del icono personalizado
                iconSize: [38, 95], // Tamaño del icono
                iconAnchor: [22, 94], // Punto de anclaje del icono
                popupAnchor: [-3, -76] // Punto de anclaje del popup
            })}).bindPopup('$popupContent').addTo(map);";
            if ($index === 0) {
                // Primer punto encontrado, establecer como origen
                $origin_lat = $punto->lat;
                $origin_lng = $punto->Lng;
            } elseif ($index === $puntosCount - 1) {
                // Último punto encontrado, establecer como destino
                $destination_lat = $punto->lat;
                $destination_lng = $punto->Lng;
                // Se encontraron coordenadas de origen y destino, marcar para dibujar la ruta
                $dibujarRuta = true;
            }
        }
        echo "</script>";

        // Si hay coordenadas de origen y destino, dibujar la ruta
        if ($dibujarRuta) {
            // Reemplaza con tu token de acceso de OpenRouteService
            $ors_api_key = '5b3ce3597851110001cf624814ab2cd7d2ee480c9f7a79416538787f';

            // Calcular la ruta usando OpenRouteService
            $url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$ors_api_key&start=$origin_lng,$origin_lat&end=$destination_lng,$destination_lat&format=geojson";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            // Extraer la información de la ruta
            $coordinates = $data['features'][0]['geometry']['coordinates'];

            // Dibujar la ruta en el mapa
            echo "<script>";
            echo "var routeCoordinates = [";
            foreach ($coordinates as $coordinate) {
                echo "[" . $coordinate[1] . ", " . $coordinate[0] . "],";
            }
            echo "];";
            echo "var polyline = L.polyline(routeCoordinates, {color: 'blue'}).addTo(map);";

            // Ajustar los límites del mapa a la ruta, si es válido
            echo "if (polyline.getBounds().isValid()) {
                map.fitBounds(polyline.getBounds());
            } else {
                // Establecer una vista inicial del mapa sin ajustar a la ruta
                map.setView([$origin_lat, $origin_lng], 13);
            }";
            // Mostrar la distancia y la duración
            echo "var distanceMarker = L.marker(polyline.getCenter(), {icon: L.divIcon({ className: 'custom-div-icon', html: '"
                . round($data['features'][0]['properties']['summary']['distance'] / 1000, 2) . " km' })}).addTo(map);";
            echo "var durationMarker = L.marker(polyline.getLatLngs()[0], {icon: L.divIcon({ className: 'custom-div-icon', html: '"
                . floor($data['features'][0]['properties']['summary']['duration'] / 60) . " min' })}).addTo(map);";

            echo "</script>";
        }
    }

    // Obtener los datos
    $nuevosPuntos = obtenerDatos();

    // Cargar el mapa con los nuevos datos
    cargarMapa($nuevosPuntos);
    ?>
</body>

</html>
