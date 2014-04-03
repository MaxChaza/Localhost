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

        <link rel="stylesheet" type="text/css" href="./css/styleCss.css" />
        <?php include('./include/counter.php');?>         
    </head>
    
    <body>
        <div id="ligneNoir" >
	</div>
        
	<div id="ligne" >
	</div>


        <!--<div id="home">-->
        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        <div id='content'>
            Welcome on our website
        </div>


        <?php 
            include("./include/footer.php");
        ?> 
        
            
    </body>
</html>
