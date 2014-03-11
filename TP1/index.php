<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fisrt php</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <?php include('./include/counter.php');?>
    </head>
    <div id="header">
        <?php 
            include("./include/header.php");
        ?> 
    </div>
    <body>
        Coucou
        
        
        <div id="footer">
            <?php 
                echo calc("./counter/counterIndex.txt"); 
            ?> visitor. 
        </div>
    </body>
</html>
