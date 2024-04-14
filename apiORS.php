<?php
// Reemplaza con tu token de acceso de OpenRouteService
$ors_api_key = '5b3ce3597851110001cf624814ab2cd7d2ee480c9f7a79416538787f';

// Coordenadas de origen y destino
$origin_lat = 8.52106435;
$origin_lng = -82.62965255;
$destination_lat = 8.513241299999999;
$destination_lng = -82.6196176;


// Calcular la ruta usando OpenRouteService

$url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$ors_api_key&start=$origin_lng,$origin_lat&end=$destination_lng,$destination_lat&format=geojson";

//$url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf624814ab2cd7d2ee480c9f7a79416538787f&start=8.681495,49.41461&end=8.687872,49.420318";

// Mostrar el mapa y la ruta
echo "<a href='$url'>OpenRouteService</a>"; 