<?php
 
    $to="maxime.chazalviel@gmail.com"; 
    $subject="info";
    $message=  htmlentities($_POST['message']);
    $from=htmlentities($_POST['mail']);
    $phone=htmlentities($_POST['telephone']);
    ?>
        
        <?php 
    
    if(!empty($phone))
    {
        $message=$message."\r\nMy phone number is ".$phone;
    }
    $headers = "From:".$from;

   
    $mail_status=mail($to,$subject,$message,$headers);
?>