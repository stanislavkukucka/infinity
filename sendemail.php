<?php
  $email_from = "localhost";
			 $email_to =  $email;
			 $email_subject = "Account Confirmation";
			 $email_message = "\n\n";
			function clean_string($string) {
		 
			  $bad = array("content-type","bcc:","to:","cc:","href");
		 
			  return str_replace($bad,"",$string);
		 
			}
			$email_message .= "testujeme\n\n";
            $email_message .= "este raz\n";
			$headers = 'From: '.$email_from."\r\n".
			'Cc: '.clean_string($email_from)."\r\n".
			 
			'Reply-To: '.$email_from."\r\n" .
			 
			'X-Mailer: PHP/' . phpversion();
			 
			@mail($email_to, $email_subject, $email_message, $headers); 
			echo "Email confirmation is required!";