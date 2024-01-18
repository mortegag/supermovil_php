<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
  </head>
  <body>
  <h1>Gmail</h1>
<?php
    if (! function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
        ?>
<div id="listData" class="list-form-container">
    <?php
        
        /* Connecting Gmail server with IMAP */
        $connection = imap_open('{mail.supermovilapp.com:993/imap/ssl/novalidate-cert}INBOX', 'ventas@supermovilapp.com', 'nopassword') or die('Cannot connect to Gmail: '.print_r(imap_errors())); 
        
        /* Search Emails having the specified keyword in the email subject */
        $emailData = imap_search($connection, 'ALL');
        echo "Datos de email " . $emailData;
        
        if (! empty($emailData)) {
            ?>
    <table>
        <?php
            foreach ($emailData as $emailIdent) {
                
                $overview = imap_fetch_overview($connection, $emailIdent, 0);
                $message = imap_fetchbody($connection, $emailIdent, '1.1');
                $messageExcerpt = substr($message, 0, 150);
                $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                $date = date("d F, Y", strtotime($overview[0]->date));
                ?>
        <tr>
            <td><span class="column">
                    <?php echo $overview[0]->from; ?>
            </span></td>
            <td class="content-div"><span class="column">
                    <?php echo $overview[0]->subject; ?> - <?php echo $partialMessage; ?>
            </span><span class="date">
                    <?php echo $date; ?>
            </span></td>
        </tr>
        <?php
            } // End foreach
            ?>
    </table>
    <?php
        } // end if
        
        imap_close($connection);
    }
    ?>
</div>

  </body>
</html>
