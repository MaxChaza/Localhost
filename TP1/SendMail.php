<?php 
    $to="contact@..."; 
    $subject="info"; 
    $message=$_POST['_message']; 
    $from=$_POST['_mail']; 
    $phone=$_POST['_tel']; 
    if(!empty($phone))
    {
        $message= $message . "\r\nMy phone number is " . $phone;
    } 
    
    $headers = "From:".$from; 
    $mail_status = mail($to,$subject,$message,$headers); 
    if($mail_status)
    {
        ?>     
        <script type="text/javascript">         // Print a message         
                window.alert("Your email...."); // Redirect to some page of the site. You can also specify full URL, e.g. http://templatehelp.com         
                window.location.href = 'index.php';     
        </script> 
        <?php 
    } 
    else 
    { 
        ?>     
        <script type="text/javascript">         // Print a message          
                window.alert('Votre message n''a pu etre envoy\351. SVP, blablabla'); // Redirect to some page of the site. You can also specify full URL, e.g. http://templatehelp.com         
                window.location.href = 'index.php';     
        </script> 
        <?php 
        
    }
    ?>