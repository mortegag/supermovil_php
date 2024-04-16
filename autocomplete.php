<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocompletar Ubicaciones</title>
</head>
<body>

<h1>Autocompletar Ubicaciones</h1>

<form action="" method="GET">
    <label for="location">Ingrese una ubicación:</label><br>
    <input type="text" id="location" name="location" required><br><br>
    <button type="submit">Buscar</button>
</form>

<?php
if (isset($_GET['location'])) {
    // Funciones para hacer una solicitud GET al API y obtener coordenadas
    function requestAutocomplete($text) {
        $apiKey = "5b3ce3597851110001cf624814ab2cd7d2ee480c9f7a79416538787f";
        $url = "https://api.openrouteservice.org/geocode/autocomplete?api_key=$apiKey&size=25&focus.point.lat=8.52106435&focus.point.lon=-82.62965255&text=$text";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    function requestCoordinates($place_id) {
        $apiKey = "MI_LLAVE";
        $url = "https://api.openrouteservice.org/geocode/details?api_key=$apiKey&id=$place_id";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data['features'][0]['geometry']['coordinates'];
    }

    // Obtener sugerencias de autocompletado
    $location = $_GET['location'];
    $suggestions = requestAutocomplete($location);

    // Mostrar sugerencias
    echo "<h2>Sugerencias de autocompletado para '$location':</h2>";
    if (isset($suggestions['features'])) {
        echo "<ul>";
        foreach ($suggestions['features'] as $key => $suggestion) {
            $place_id = $suggestion['properties']['id'];
            $name = $suggestion['properties']['name'];
            $country = $suggestion['properties']['country'];
            $region = $suggestion['properties']['region'];
            echo "<li>$name, $region, $country <a href='?place_id=$place_id'>Obtener Coordenadas</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se encontraron sugerencias para '$location'.</p>";
    }
}

// Obtener coordenadas si se hace clic en un enlace
if (isset($_GET['place_id'])) {
    $place_id = $_GET['place_id'];
    $coordinates = requestCoordinates($place_id);
    echo "<br>Coordenadas seleccionadas: Latitud: {$coordinates[1]}, Longitud: {$coordinates[0]}";
}
?>

</body>
</html>
