var map;
var marker;
let counter = 0;
var initialLat = 8.524461821399495;
var initialLng = -82.62872376928289;

var markers = {};
var ruta_new = "";

//
document.querySelector('table tbody').addEventListener('click', function (event) {
    if (event.target.tagName === 'INPUT') {
        event.preventDefault();
        var row = event.target.closest('tr');
        var loc = row.querySelector('.location-input').value;

        moveToCoordinatesFromInput(loc);
    }
});
//
function moveToCoordinatesFromInput(input) {
    // Parse the input string to extract latitude and longitude
    var coordinatesString = input;
    var input = coordinatesString;
    let filtered = input.replace(/[{()}]/g, '');
    let [lat, lng] = filtered.split(',');

    if (filtered) {
        var newCoordinates = [parseFloat(lat), parseFloat(lng)];

        map.panTo(newCoordinates); // Move the map to the new coordinates
        marker.setLatLng(newCoordinates); // Update the marker's position
    }
}
//

function addOrUpdateMarker(userId, location, Description,vehiclePlate,driverName) {
    var isMove = true;
    var userData = null;
    var customIcon = L.icon({
        iconUrl: '/icon/bus.png',
        iconSize: [20, 20], // Tamaño del icono
        iconAnchor: [10, 10] // Punto de anclaje del icono
    });

    var latLng = [location[0], location[1]];
    if (userId in markers) {
        // Actualizar la posición del marcador existente
        markers[userId].setLatLng(latLng);
        fillTableData(userId, userData, location,Description ,isMove);
    } else {
        // Crear un nuevo marcador para el usuario
        markers[userId] = L.marker(latLng, { icon: customIcon }).addTo(map);

        // Obtener los datos del usuario desde la tabla "buses"
        fetchUserDataFromBusesTable(userId, location,driverName,vehiclePlate,Description);
    }
}

function fetchUserDataFromBusesTable(userId, location,driverName,vehiclePlate,Description) {
    // Obtener los datos del usuario desde la fuente de datos correspondiente
    // ...
    var userData = {
        name: "Bus " + vehiclePlate,
        route: "Ruta " + driverName
    };

    displayUserDataInInfoWindow(userId, userData);
    fillTableData(userId, userData, location, Description,false);
}

function displayUserDataInInfoWindow(userId, userData) {
    var marker = markers[userId];

    var popupContent = `<p>${userData.name}</p><p>${userData.route}</p>`;
    marker.bindPopup(popupContent).openPopup();
}

function fillTableData(key, userData, location, Description,isMove) {
    var latLng = [location[0], location[1]];
    var places = Description;

    if (isMove) {
        updateCellByUniqueKey(key, latLng.toString(), places);
    } else {0
        let keyCell = `<td>${counter += 1}</td>`;
        let countCell = `<td hidden>${key}</td>`;
        let placesCell = `<td>${Description}</td>`;
        let coordinatesCell = `<td><input type="text" class="location-input" id="location" value="${latLng}" ></td>`;
        let nameCell = `<td>${userData.name}</td>`;
        let routeCell = `<td>${userData.route}</td>`;

        let tableBody = document.getElementById('tbody');
        tableBody.innerHTML += `<tr>${countCell + keyCell + placesCell + coordinatesCell + nameCell + routeCell}</tr>`;
    }
}

function updateCellByUniqueKey(Key, location, places) {
    var table = document.getElementById("tbody");
    var rows = table.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cell = rows[i].getElementsByTagName("td")[0]; // Assuming unique key is in the first cell

        if (cell.textContent === Key) {
            var targetCellPlaces = rows[i].getElementsByTagName("td")[1]; // Places
            targetCellPlaces.innerText = places;

            var targetCellLocation = rows[i].getElementsByTagName("td")[2]; // Location
            targetCellLocation.querySelector("input").value = location;
            break;
        }
    }
}

// Obtener los datos de MongoDB
fetch("https://supermovilapp.com:3001/api/collections/GeoPoints/data")
    .then(response => response.json())
    .then(data => {
        // Iterar sobre los documentos y agregar o actualizar los marcadores
        data.forEach(doc => {

            var userId = doc.GeoPoint.id;
            var Description = doc.GeoPoint.Description;
            var location = [doc.GeoPoint.lat, doc.GeoPoint.Lng];
            var driverId = doc.Driver.id;
            var driverName = doc.Driver.name;
            var vehiclePlate = doc.Driver.vehiclePlate;
            // Acceder a otros datos de Driver si es necesario
            console.log(driverId,driverName, Description,vehiclePlate);
            addOrUpdateMarker(userId, location, Description,vehiclePlate,driverName);


        });
    })
    .catch(error => console.error(error));