<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script>
		function getEmails() {
			document.getElementById('dataDivID')
				.style.display = "block";
		}
	</script>
</head>

<body>
	<h2>List Emails from Gmail using PHP and IMAP</h2>

	<div id="btnContainer">
		<button class="btn active" onclick="getEmails()">
			<i class="fa fa-bars"></i>Click to get gmail mails
		</button>
	</div>
	<br>
	
	<div id="dataDivID" class="form-container" style="display:none;">
		<?php
			/* gmail connection,with port number 993 */
			$host = '{mail.supermovilapp.com:993/imap/ssl/novalidate-cert}INBOX';
			/* Your gmail credentials */
			$user = 'ventas@supermovilapp.com';
			$password = 'Coco.1961';

			/* Establish a IMAP connection */
			$conn = imap_open($host, $user, $password)
				or die('unable to connect mail: ' . imap_last_error());

			/* Search emails from gmail inbox*/
			$mails = imap_search($conn, 'ALL');

			/* loop through each email id mails are available. */
			if ($mails) {

				/* Mail output variable starts*/
				$mailOutput = '';
				$mailOutput.= '<table><tr><th>Subject </th><th> From </th>
						<th> Date Time </th> <th> Content </th></tr>';

				/* rsort is used to display the latest emails on top */
				rsort($mails);

				/* For each email */
				foreach ($mails as $email_number) {

					/* Retrieve specific email information*/
					$headers = imap_fetch_overview($conn, $email_number, 0);

					/* Returns a particular section of the body*/
					$message = imap_fetchbody($conn, $email_number, '1');
               
                     //$pos =$message.substr(strpos($message, 'Cliente:') , strpos($message, 'Confirmaci:'));
                     $pos1 =strrpos($message,'Cliente');
					 $pos2 =strrpos($message,'Monto');
                     echo "posicion es : ".$pos1;
					 echo "posicion es : ".$pos2;

			
					$subMessage = substr($message, strrpos($message,'Cliente'), 130);
					$finalMessage = trim(quoted_printable_decode($subMessage));

					$mailOutput.= '<div class="row">';

					/* Gmail MAILS header information */				
					$mailOutput.= '<td><span class="columnClass">' .
								$headers[0]->subject . '</span></td> ';
					$mailOutput.= '<td><span class="columnClass">' .
								$headers[0]->from . '</span></td>';
					$mailOutput.= '<td><span class="columnClass">' .
								$headers[0]->date . '</span></td>';
					$mailOutput.= '</div>';

					/* Mail body is returned */
					$mailOutput.= '<td><span class="column">' .
					$finalMessage . '</span></td></tr></div>';
				}// End foreach
				$mailOutput.= '</table>';
				echo $mailOutput;
			}//endif

			/* imap connection is closed */
			imap_close($conn);
			?>
	</div>
</body>

</html>
