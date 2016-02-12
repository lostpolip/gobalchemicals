<?php

class mail {
	public function sendmail($body,$sendTo){
		require_once('PHPMailer_v5.0.2/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
		$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
		$mail->Port = 465; // set the SMTP port for the GMAIL server
		$mail->Username = "porzipper@gmail.com"; // GMAIL username
		$mail->Password = "01422537"; // GMAIL password
		$mail->From = "porzipper@gmail.com"; // "name@yourdomain.com";
		$mail->FromName = "The GolbalChemicals CO.,LTD";  // set from Name
		$mail->Subject = "Purchase Order"; 
		$mail->Body = $body;
		 
		$mail->AddAddress($sendTo); // to Address
		 
		$mail->set('X-Priority', '3'); //Priority 1 = High, 3 = Normal, 5 = low
		if(!$mail->Send()) 
		{
		    echo 'Mailer Error: ' . $mail->ErrorInfo.'<br />';
		} 
		else 
		{
		    echo 'Message has been sent<br />';
		}
	}
}
?>