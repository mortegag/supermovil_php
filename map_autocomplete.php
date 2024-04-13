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
        .search-container {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        #search-input {
            width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        #autocomplete-list {
            width: 300px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: white;
            position: absolute;
            z-index: 1001;
        }
        #autocomplete-list div {
            padding: 5px;
            cursor: pointer;
        }
        #autocomplete-list div:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Buscar lugar">
        <div id="autocomplete-list"></div>
    </div>

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
        // Agregar puntos al mapa
        foreach ($puntos as $punto) {
            $popupContent = "ID: $punto->id <br> Descripción: $punto->Description";
            echo "L.marker([$punto->lat, $punto->Lng]).bindPopup('$popupContent').addTo(map);";
        }
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

    // Función de autocomplete en PHP
    function autocomplete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $q = $_POST["q"];
            $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($q) . "&format=json&limit=10";
            $response = file_get_contents($url);
            header('Content-Type: application/json'); // Establecer el tipo de contenido de la respuesta
            echo $response;
        }
    }

    // Función para enviar las coordenadas al endpoint API
    function sendCoordinates()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lat = $_POST["lat"];
            $lng = $_POST["lng"];
            $data = array(
                "lat" => $lat,
                "Lng" => $lng
            );
            $url = "http://supermovilapp.com:3001/api/collections/GeoPoints/documents";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }
    }
    ?>

    <script>
        // Función de autocomplete en JavaScript
        let searchInput = document.getElementById("search-input");
        let autocompleteList = document.getElementById("autocomplete-list");

        searchInput.addEventListener("input", function() {
            let val = this.value;
            autocompleteList.innerHTML = "";
            if (val.trim() === "") {
                return;
            }
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "?autocomplete", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    try {
                        let data = JSON.parse(this.responseText);
                        for (let i = 0; i < data.length; i++) {
                            let div = document.createElement("div");
                            div.textContent = data[i].display_name;
                            div.addEventListener("click", function() {
                                searchInput.value = this.textContent;
                                let lat = data[i].lat;
                                let lng = data[i].lon;
                                console.log(`Latitud: ${lat}, Longitud: ${lng}`);
                                map.setView([lat, lng], 13);
                                autocompleteList.innerHTML = "";
                            });
                            autocompleteList.appendChild(div);
                        }
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON:", error);
                        // Manejar el error de análisis JSON aquí
                    }
                }
            };
            xhr.send("q=" + val);
        });

        // Función para enviar las coordenadas al endpoint API
        function sendCoordinates() {
            let lat = map.getCenter().lat;
            let lng = map.getCenter().lng;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "?sendCoordinates", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhr.send("lat=" + lat + "&lng=" + lng);
        }
    </script>
</body>
</html>
