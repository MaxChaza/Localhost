<?php 
function resetCom(){ 
    $file = fopen ("../counter/counterContact.txt" , "w"); 
    $counter = 0;             
    fwrite($file , $counter ) ;            
    //we update //we write 
    fclose($file) ; 
} 
    
    resetCom();
    header('location: ../contact_us.php');
?>

