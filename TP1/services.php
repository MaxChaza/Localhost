<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link rel="stylesheet" type="text/css" href="./css/style.css" />
       
        <?php include('./include/counter.php');?>
    </head>
    
    <body>
        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        <?php
        // put your code here
        echo "toto"
        ?>
         <div id="footer">
             <?php  echo calc("./counter/counterService.txt") ?> visitor. 
        </div>
    </body>
</html>
