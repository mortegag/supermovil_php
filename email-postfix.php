<?php

$para = "mortegag@hotmail.com";
$asunto = "Asunto del correo";
$mensaje = "Hola,\n\nEste es un ejemplo de correo enviado desde PHP y Postfix.";

// Cabeceras del correo
$cabeceras = "From: soporte@supermovilapp.com\r\n";
$cabeceras .= "Reply-To: mortega@supermovilapp.com\r\n";
$cabeceras .= "X-Mailer: PHP/" . phpversion();

// Enviar el correo
if (mail($para, $asunto, $mensaje, $cabeceras)) {
    echo "Correo enviado con éxito a $para";
} else {
    echo "Error al enviar el correo.";
}

?>
