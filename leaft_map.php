
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
        // Función para cargar los datos desde el servidor API
        async function cargarDatos() {
            try {
                const response = await fetch('http://supermovilapp.com:3001/api/collections/GeoPoints/documents');
                referrerPolicy: "unsafe_url"
                const datos = await response.json();

                // Coordenadas de los puntos
                var puntos = datos.map(function(documento) {
                    return {
                        latitud: parseFloat(documento.lat),
                        longitud: parseFloat(documento.Lng)
                    };
                });

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

                // Actualizar continuamente las posiciones cada 5 segundos
                setTimeout(cargarDatos, 5000);
            } catch (error) {
                console.error('Error al cargar los datos:', error);
            }
        }


        // Llamar a la función para cargar los datos cuando se cargue la página
        cargarDatos();
    </script>
</body>

</html>
