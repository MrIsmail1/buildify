                    // function smtpmailer($to, $from, $from_name, $subject, $body)
                    // {
                    //     $mail = new PHPMailer();
                    //     /* $mail = new PHPMailer\PHPMailer\PHPMailer(); */
                    //     $mail->IsSMTP();
                    //     $mail->SMTPAuth = true; 
                
                    //     $mail->SMTPSecure = 'ssl'; 
                    //     $mail->Host = 'smtp.gmail.com';
                    //     $mail->Port = 465;  
                    //     $mail->Username = 'hamzamahmood93150@gmail.com';
                    //     $mail->Password = 'tmaakvgtnmffcylp';   
                        
                    //     $mail->IsHTML(true);
                    //     $mail->From="hamzamahmood93150@gmail.com";
                    //     $mail->FromName=$from_name;
                    //     $mail->Sender=$from;
                    //     $mail->AddReplyTo($from, $from_name);
                    //     $mail->Subject = $subject;
                    //     $mail->Body = $body;
                    //     $mail->AddAddress($to);
                    //     if(!$mail->Send())
                    //         {
                    //             $error ="Please try Later, Error Occured while Processing...";
                    //             return $error; 
                    //         }
                    //     else 
                    //         {
                    //             $error = "Thanks You !! Your email is sent.";  
                    //             return $error;
                    //         }
                    // }
                    
                    // $to   = $email;
                    // $from = 'hamzamahmood93150@gmail.com';
                    // $name = 'Hamza Mahmood';
                    // $subj = 'Email de confirmation d\'inscription';
                    // $msg = 'Lien vers la page de redirection comme quoi tout est bon';
                    
                    // $error=smtpmailer($to,$from, $name ,$subj, $msg);