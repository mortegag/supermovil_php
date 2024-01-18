<?php

// Configuración de Firebase
$firebaseConfig = [
    'apiKey' => "AIzaSyAJrCTUngkzFngBkcy01_OtnbbJimu03fM",
    'authDomain' => "supermovil-da749-default-rtdb.firebaseio.com",
    'databaseURL' => "https://supermovil-da749-default-rtdb.firebaseio.com/",
    'projectId' =>  "supermovil-da749",
    'storageBucket' => 'tu_storage_bucket',
    'messagingSenderId' => 'tu_messaging_sender_id',
    'appId' => 'tu_app_id',
];





// Cargar la biblioteca de Firebase
require 'firebase/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('ruta_a_tu_archivo_json_de_credenciales');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri($firebaseConfig['databaseURL'])
    ->create();

$auth = $firebase->getAuth();
$database = $firebase->getDatabase();

// Manejar la solicitud para eliminar la cuenta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST["telefono"];
    $pin = $_POST["pin"];

    // Verificar el teléfono y el PIN (realiza validaciones adicionales según sea necesario)
    // ...

    try {
        // Autenticar con Firebase usando el número de teléfono
        $user = $auth->getUserByPhoneNumber($telefono);

        // Verificar el PIN (realiza las validaciones adicionales según sea necesario)
        if ($user && verificarPIN($pin, $user->uid)) {
            // Eliminar el usuario de Firebase Authentication
            $auth->deleteUser($user->uid);

            // Eliminar información adicional del usuario de la base de datos en tiempo real
            $database->getReference('usuarios/' . $user->uid)->remove();

            echo "Cuenta eliminada con éxito.";
        } else {
            echo "Autenticación fallida. Verifica tu número de teléfono y PIN.";
        }
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        echo "Usuario no encontrado. Verifica tu número de teléfono.";
    }
}

// Función para verificar el PIN
function verificarPIN($pin, $uid) {
    // Implementa tu propia lógica de verificación del PIN aquí
    // Puedes almacenar el PIN en la base de datos y compararlo con la entrada del usuario
    // Asegúrate de implementar medidas de seguridad adecuadas
    return true;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta</title>
</head>
<body>
    <form method="post" action="">
        <label for="telefono">Número de Teléfono:</label>
        <input type="text" name="telefono" required>

        <label for="pin">PIN:</label>
        <input type="password" name="pin" required>

        <button type="submit">Eliminar Cuenta</button>
    </form>
</body>
</html>
