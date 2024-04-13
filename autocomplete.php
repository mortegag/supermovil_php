<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocomplete Test</title>
</head>
<body>

<form id="autocomplete-form" onsubmit="return submitAutocomplete()">
    <input type="text" id="search-input" placeholder="Buscar lugar...">
    <button type="submit">Buscar</button>
</form>

<script>
function submitAutocomplete() {
    const form = document.getElementById("autocomplete-form");
    const searchInput = document.getElementById("search-input").value;

    fetch('', {
        method: 'POST',
        body: JSON.stringify({ q: searchInput }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Imprimir la respuesta en la consola del navegador
    })
    .catch(error => console.error('Error:', error));

    return false; // Evitar que el formulario se envíe de manera tradicional
}
</script>

<?php
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

// Llamar a la función autocomplete
autocomplete();
?>

</body>
</html>
