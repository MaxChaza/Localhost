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
         <link rel="stylesheet" type="text/css" href="../css/styleCss.css" />
       
        <?php include('../include/counter.php');?>
    </head>
    
    <body>
        <form enctype="multipart/form-data" name="myForm" action="../include/upload.php" method="post" >
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
        <form enctype="multipart/form-data" name="myFormAjax" onsubmit="return upload()" method="post" >
            <table>  
                <tr>
                    <td>
                        <input type="fileAjax" name="file1" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="fileAjax2" name="file2" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='submit' value='goAjax!'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="answerArea"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="image"></div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
