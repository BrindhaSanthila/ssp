<?php

$from = "udhayapriya@santhila.co";
$to ="udhayapriya@santhila.co";

$subject = "hai";
$message = "hello";

// To send HTML mail, the Content-type header must be set
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

if(mail($to, $subject, $message,$headers))
{
    echo 'Your mail has been sent successfully.';
}
else
{
    echo 'Unable to send email. Please try again.';
}

?>



