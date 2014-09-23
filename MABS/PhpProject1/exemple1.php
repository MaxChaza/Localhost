<?php function calc(){ 
    $file = fopen("counter.txt", "r"); 
    //we read 
    $counter = fread($file , filesize("counter.txt")) ; 
    fclose($file) ; $file = fopen ("counter.txt" , "w"); 
    $counter = $counter + 1 ;             
    fwrite($file , $counter ) ;            
    //we update //we write 
    fclose($file) ; return $counter; 

} ?>
</head> 
    <body> hello.<br> You are the 
        <?php  echo calc() ?> visitor. 
<!-- we display  --> 
    </body>