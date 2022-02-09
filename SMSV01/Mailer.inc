<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Ibrahim Mohammed (ibrahim.mohammed@izybrand.com)
 *  All rights reserved
 *
 *  This script is part of the webleaves Portal project. The Webleaves Portal is
 *  COPYRIGHTED. The software may not be redistributed and/or modified
 *  without appropriate authorisation from Izy Brand ltd. The use of
 *  the software is subject to terms and conditons indicated
 *  in http://www.izybrand.com
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 *
 * Created on 07October 2009
 **************************************************************
 *
 * Description of Mailer Class
 * Compose and sent text and HTML e-mail messages 
 * based on workby jj harrison
 *
 * @co- authored Ibrahim
 *
 */

        
        
class Mailer
{  
	var $headers;      // An array of headers
	var $smtp_header;
	var $recipients;   // An array of recipients
	var $subject;      // The message subject
   	var $message;      // The message body
     
	function html()
    {
		$this->headers[]  = "MIME-Version: 1.0";
	   	$this->headers[]  = "Content-type: text/html; charset=iso-8859-1";
     }
     
     function from($email, $name)
     {   
	  		// Sets who the email was from
         @ini_set('sendmail_from', INSTITUTION_EMAIL );
         $this->headers[] = 'From: '.$email.' <'.$name.'>';
		 $this->smtp_headers['From'] = $email;
     }
     
   	 function add_recipient($email)
     {  // Adds a recipient in the to: field
        $this->recipients[] = $email;
		$this->smtp_headers['To'] = $email;
     }
     
     function add_cc($email)
     {  //Adds a carbon copy address
        $this->headers[] = 'CC: '.$email;
     }
     
     function add_bcc($email)
     {  //Adds a blind carbon copy address
        $this->headers[] = 'BCC: '.$email;
     }
     
     
     function subject($subject)
     {  //Sets the message subject
        $this->subject = $subject;
		$this->smtp_headers['Subject'] = $subject;
     }
     
     function message($message)
     {  //Sets the message body
        $this->message = $message;
     }
     
     function custom_header($headername, $headervalue)
     {  //Adds a custom header
            $this->headers[] = $headername.': '.$headervalue;
     }
     
     function send()
     {  //sends the email
		$recipients_separated = implode(",", $this->recipients);
        $headers = "";
            foreach($this->headers as $header)
            {
               $headers .= $header.';';
            }
			
		
			
            return mail($recipients_separated, $this->subject, $this->message, $headers);
     }
	 
	 function smtpsend()
	 {
		
		
		$smtp = & Mail::factory('smtp',
					array ('host' => 'localhost',
					 'auth' => true,
					 'username' => MAIL_USERNAME,
					 'password' => MAIL_PASSWORD ));
		
		/*
		$mail = $smtp->send( $this->smtp_headers[To], $this->smtp_headers, $this->message );
 
		if (PEAR::isError($mail)) {
		   //return $mail->getMessage();
		   print_r( 'c' );
		   return FALSE;
		} else {
			print_r( 'd' );
		   return TRUE;
		}
		*/		
	 
	 }
	 
     
     // queues up unsent emails or emails to send later
  	 function queueItUp()
  	 {
		
            $recipients_separated = implode(",", $this->recipients);
            $headers = "";
            foreach($this->headers as $header)
            {
               $headers .= $header.';';
            }
		
		$q = 'INSERT INTO '.EMAIL_QUEUE_TABLE.'(
				recipients, subject, message, headers
			 ) VALUES (';
			 
		$q .= '"'.addslashes( $recipients_separated ).'","'.addslashes( $this->subject ).
				'","'.addslashes( $this->message ).'","'.addslashes( $headers ).'")';
				
		$db = new MySQL();
		if (! $db->Open()) $db->Kill();
			
		return( $db->Query( $q ) );
					
	 }
	 
	 
     
}
?>