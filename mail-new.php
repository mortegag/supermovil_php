<?php
$hostname = '{localhost:143/novalidate-cert}INBOX'; // Cambia localhost y 143 según tu configuración de servidor IMAP
$username = 'ventas'; // Cambia esto al nombre de usuario de tu cuenta de correo
$password = 'cococito.1961'; // Cambia esto a tu contraseña de correo

// Conectarse al servidor IMAP
$inbox = imap_open($hostname, $username, $password) or die('No se pudo conectar al servidor IMAP');

// Obtener el número total de mensajes en el buzón
$totalMessages = imap_num_msg($inbox);

echo "Número total de mensajes: $totalMessages<br><br>";

// Iterar a través de los mensajes
for ($i = 1; $i <= $totalMessages; $i++) {
    // Obtener la información del encabezado del mensaje
    $header = imap_headerinfo($inbox, $i);
    
    // Mostrar información del encabezado del mensaje
    echo "Asunto: " . $header->subject . "<br>";
    echo "De: " . $header->fromaddress . "<br>";
    echo "Fecha: " . $header->date . "<br>";
    
    // Obtener el cuerpo del mensaje
    $body = imap_fetchbody($inbox, $i, 1); // 1 indica el texto del cuerpo del mensaje
    
    // Mostrar el cuerpo del mensaje
    echo "Cuerpo del mensaje:<br>$body<br><hr><br>";
}

// Cerrar la conexión con el servidor IMAP
imap_close($inbox);
?>

