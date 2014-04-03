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
         <link rel="stylesheet" type="text/css" href="./css/styleCss.css" />
       
        <?php include('./include/counter.php');?>
    </head>
    
    <body>
        <div id="header">
            <?php 
                include("./include/header.php");
            ?> 
        </div>
        <div id="formulaire"> 
            
            <form enctype="multipart/form-data" name="myForm" action="./include/upload.php" method="post" >
                <table>  
                    <tr>
                        <td>
                            <input type="file" name="file1" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="file" name="file2" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='submit' value='go!'/>
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        // put your code here
        ?>
         <div id="footer">
             <?php  echo calc("./counter/counterService.txt") ?> visitor. 
        </div>
    </body>
</html>
