
<?php 
// Esto es para activar la visualización de errores en el servidor, por si los hubiese
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$subject = $_POST['subject'];// El valor entre corchetes son los atributos name del formulario html
$msg = $_POST['message'];
$from = $_POST['from'];

// El from DEBE corresponder a una cuenta de correo real creada en el servidor
$headers = "From: ventas@supermovilapp.com\r\n"; 
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n"; 
	
if(mail($from, $subject, $msg,$headers)){
	echo "mail enviado";
	}else{
	$errorMessage = error_get_last()['msg'];
	echo $errorMessage;
}
?>