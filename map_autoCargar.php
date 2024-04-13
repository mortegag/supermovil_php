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
    </style>
</head>

<body>
    <div id="map"></div>
    <?php
    // Función para obtener los datos desde el servidor
    function obtenerDatos()
    {
        $data = file_get_contents("http://supermovilapp.com:3001/api/collections/GeoPoints/documents");
        return json_decode($data);
    }

    // Función para cargar el mapa con los nuevos datos
    function cargarMapa($puntos)
    {
        // Crear un mapa centrado en una ubicación específica
        echo "<script>";
        echo "var map = L.map('map').setView([ 8.52446182, -82.62872376], 15);";
        // Agregar una capa de mapa base
        echo "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);";
        // Agregar puntos al mapa
        foreach ($puntos as $punto) {
            $popupContent = "ID: $punto->id <br> Descripción: $punto->Description";
            echo "L.marker([$punto->lat, $punto->Lng]).bindPopup('$popupContent').addTo(map);";
        }
        echo "</script>";
    }

    // Obtener los datos
    $nuevosPuntos = obtenerDatos();

    // Comparar con los datos anteriores, si existen
    if (isset($puntosAnteriores) && !empty($puntosAnteriores)) {
        if ($puntosAnteriores !== $nuevosPuntos) {
            // Si hay diferencias, cargar el mapa con los nuevos datos
            cargarMapa($nuevosPuntos);
            // Actualizar los datos anteriores
            $puntosAnteriores = $nuevosPuntos;
        }
    } else {
        // Si es la primera vez, simplemente cargar el mapa con los datos actuales
        cargarMapa($nuevosPuntos);
        // Actualizar los datos anteriores
        $puntosAnteriores = $nuevosPuntos;
    }
    ?>
</body>

</html>