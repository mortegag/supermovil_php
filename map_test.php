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
    <input type="text" id="search-input" placeholder="Buscar lugar">
    <button onclick="sendCoordinates()">Enviar coordenadas</button>

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
        echo "var map = L.map('map').setView([8.52446182139949, -82.62872376928289], 16);";
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

    // Función de autocomplete en PHP
    function autocomplete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $q = $_POST["q"];
            $url = "https://nominatim.openstreetmap.org/search?q=$q&format=json&limit=10";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            echo json_encode($data);
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
        function autocomplete(input, map) {
            let currentFocus;
            input.addEventListener("input", function(e) {
                let val = this.value;
                closeAllLists();
                if (!val) { return false; }
                currentFocus = -1;
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "?autocomplete", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let data = JSON.parse(this.responseText);
                        let a = document.createElement("DIV");
                        a.setAttribute("id", this.id + "autocomplete-list");
                        a.setAttribute("class", "autocomplete-items");
                        this.parentNode.appendChild(a);
                        for (let i = 0; i < data.length; i++) {
                            let b = document.createElement("DIV");
                            b.innerHTML = "<strong>" + data[i].display_name + "</strong>";
                            b.addEventListener("click", function(e) {
                                input.value = this.getElementsByTagName("strong")[0].innerHTML;
                                let lat = data[i].lat;
                                let lng = data[i].lon;
                                console.log(`Latitud: ${lat}, Longitud: ${lng}`);
                                map.setView([lat, lng], 13);
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                };
                xhr.send("q=" + val);
            });
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        // Función para cerrar la lista de sugerencias
        function closeAllLists(elmnt) {
            let x = document.getElementsByClassName("autocomplete-items");
            for (let i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != document.getElementById("search-input")) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        // Función para enviar las coordenadas al endpoint API
        function sendCoordinates() {
            let input = document.getElementById("search-input");
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

        // Inicializar el autocomplete
        let map = L.map('map').setView([8.52446182139949, -82.62872376928289], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        autocomplete(document.getElementById("search-input"), map);
    </script>
</body>
</html>