<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validar Codigo</title>
  </head>
  <body>
    <div>
    <?php
		
			$host = '{mail.supermovilapp.com:993/imap/ssl/novalidate-cert}INBOX';	
			$user = 'ventas@supermovilapp.com';
			$password = 'Coco.1961';

			$conn = imap_open($host, $user, $password)
				or die('unable to connect mail: ' . imap_last_error());
	
			$mails = imap_search($conn, 'ALL');

			
			if ($mails) {

	            rsort($mails);

            }
			
			foreach ($mails as $email_number) {
                    
            
                $headers = imap_fetch_overview($conn, $email_number, 0);

           
                $message = imap_fetchbody($conn, $email_number, '1');
           
                 //$pos =$message.substr(strpos($message, 'Cliente:') , strpos($message, 'Confirmaci:'));
                 $pos1 =strrpos($message,'Cliente:');
                 $pos2 =strrpos($message,'Monto:');
                 $pos3 =strrpos($message,'Comentario:');
                 $pos4 =strrpos($message,'Fecha:');
                 $pos5 =strrpos($message,'Confirmaci');

                 //echo "posicion es : ".$pos1;
                // echo "posicion es : ".$pos2;

        
                //$subMessage = substr($message, $pos1, 130);
                //$finalMessage = trim(quoted_printable_decode($subMessage));
                $cliente =str_replace("*","",substr($message, $pos1+8, $pos2-$pos1-8));
                $monto = str_replace("*","",substr($message, $pos2+7, $pos3-$pos2-7));  
                $comentario = str_replace("*","",substr($message, $pos3+11, $pos4-$pos3-11)); 
                $fecha = str_replace("*","",substr($message, $pos4+6, $pos5-$pos4-6));
                $codigo = str_replace("*","",substr($message, $pos5+18,14));                    
              
                //echo "Contenido total : " .$finalMessage;
                echo "Cliente : " .trim(quoted_printable_decode($cliente));
                echo '<br>';
                echo "Monto : " .trim(quoted_printable_decode($monto));
                echo '<br>';
                echo "Comentario : " .trim(quoted_printable_decode($comentario));
                echo '<br>';
                echo "Fecha : " .trim(quoted_printable_decode($fecha));
                echo '<br>';
                echo "Codigo : " .trim(quoted_printable_decode($codigo));
                echo '<br>';


            }
            imap_close($conn);

	?>
    </div>
   
  </body>
</html>
