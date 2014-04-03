<?php
//    if(!ini_set("SMTP","ssl://smtp.gmail.com"))
//            echo 'SMTP ca passe pas'; 
//    if(!ini_set("smtp_port","465"))
//            echo 'port ca passe pas'; 

    $to="maxime.chazalviel@hotmail.fr"; 
    $subject="info";
    $message=$_POST['message'];
    $from=$_POST['mail'];
    $phone=$_POST['telephone'];
    if(!empty($phone))
    {
        $message=$message."\r\nMy phone number is ".$phone;
    }
    $headers = "From:".$from;
    $mail_status=mail($to,$subject,$message,$headers);
    if($mail_status)
    {
        ?>
        <script language="javascript" type="text/javascript">
            window.alert("Your email...."); // Redirect to some page of the site. You can also specify full URL, e.g. http://templatehelp.com
            window.location.href = 'index.php';
        </script>
        <?php 
    }
    else 
    {
        ?>
        <script language="javascript" type="text/javascript">       // Print a message          
            window.alert('Votre message n\a pu etre envoy\351. SVP, blablabla'); // Redirect to some page of the site. You can also specify full URL, e.g. http://templatehelp.com         
            window.location.href = 'index.php';     
        </script> 
        <?php 
    }
    ?>