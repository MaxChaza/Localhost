<?php function calc($txt){ 
    $file = fopen($txt, "r"); 
    //we read 
    $counter = fread($file , filesize($txt)) ; 
    fclose($file) ; $file = fopen ($txt , "w"); 
    $counter = $counter + 1 ;             
    fwrite($file , $counter ) ;            
    //we update //we write 
    fclose($file) ; return $counter; 

} ?>
