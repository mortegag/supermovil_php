<?php
    // Obtener los datos desde la URL del servidor
    $data = file_get_contents("http://supermovilapp.com:3001/api/collections/GeoPoints/documents");

    // Decodificar los datos JSON
    $datos = json_decode($data);

    // Coordenadas de los puntos
    $puntos = array();
    foreach ($datos as $documento) {
        $puntos[] = array(
            'latitud' => floatval($documento->lat),
            'longitud' => floatval($documento->Lng)
        );
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Leaflet.js</title>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Incluir la biblioteca Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script>
        // Coordenadas de los puntos obtenidos desde PHP
        var puntos = <?php echo json_encode($puntos); ?>;

        // Crear un mapa centrado en una ubicación específica
        var map = L.map('map').setView([40.7128, -74.0060], 3);

        // Agregar una capa de mapa base
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Agregar puntos al mapa
        puntos.forEach(function(punto) {
            L.marker([punto.latitud, punto.longitud]).addTo(map);
        });

        // Función para actualizar continuamente las posiciones cada 5 segundos
        function cargarDatos() {
            location.reload(); // Recargar la página para obtener datos actualizados
        }

        // Actualizar continuamente las posiciones cada 5 segundos
        setInterval(cargarDatos, 5000);
    </script>
</body>

</html>
