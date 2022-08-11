<?php

// Put contacting email here
$php_main_email = "mail@tim-feldmeyer.de";

//Fetching Values from URL
$php_name = $_POST['ajax_name'];
$php_email = $_POST['ajax_email'];
$php_subject = $_POST['ajax_subject'];
$php_message = $_POST['ajax_message'];



//Sanitizing email
$php_email = filter_var($php_email, FILTER_SANITIZE_EMAIL);


//After sanitization Validation is performed
if (filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
	
	
		$php_subject = "Nachricht über das Kontaktformulat - Tim Feldmeyer";
		
		// To send HTML mail, the Content-type header must be set
		$php_headers = 'MIME-Version: 1.0' . "\r\n";
		$php_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$php_headers .= 'From:' . $php_email. "\r\n"; // Sender's Email
		$php_headers .= 'Cc:' . $php_email. "\r\n"; // Carbon copy to Sender
		
		$php_template = '<div style="padding:50px;">Hallo ' . $php_name . ',<br/>'
		. 'Vielen Dank für deine Anfrage. Hier eine kurze Zusammenfassung deiner Anfrage:<br/><br/>'
		. '<strong style="color:#2b2e83;">Name:</strong>  ' . $php_name . '<br/>'
		. '<strong style="color:#2b2e83;">Email:</strong>  ' . $php_email . '<br/>'
		. '<strong style="color:#2b2e83;">Betreff:</strong>  ' . $php_subject . '<br/>'
		. '<strong style="color:#2b2e83;">Nachricht:</strong>  ' . $php_message . '<br/><br/>'
		. 'Hiermit bestätige ich, dass die Nachricht bei mir eingegangen ist.'
		. '<br/>'
		. 'Ich werde mich umgehend melden.</div>';
		$php_sendmessage = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
		
		// message lines should not exceed 70 characters (PHP rule), so wrap it
		$php_sendmessage = wordwrap($php_sendmessage, 70);
		
		// Send mail by PHP Mail Function
		mail($php_main_email, $php_subject, $php_sendmessage, $php_headers);
		echo "";
	
	
} else {
	echo "<span class='contact_error'>* Invalid email *</span>";
}

?>