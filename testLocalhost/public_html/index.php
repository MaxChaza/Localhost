<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>First JS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <script language="javascript" type="text/javascript">
            function go(){
                document.getElementById("myarea3").innerHTML="Ca va?";
            }
            function affiche(){
                alert("Bonjour "+ document.myForm.prenom.value+ " " + document.myForm.nom.value);
            }
            function affiche2(){
                alert("Bonjour "+ document.myForm2.prenom2.value+ " " + document.myForm2.nom2.value);
            }
            function affiche3(){
                alert("Bonjour "+ document.myForm3.prenom3.value+ " " + document.myForm3.nom3.value);
            }
            function checkParam(){
                var ok = true;
                if(document.myForm3.prenom3.value==""){
                    ok=false;
                    document.getElementById("starPrenom").innerHTML="*";
                }
                if(document.maForm3.nom3.value==""){
                    ok=false;
                    document.getElementById("starNom").innerHTML="*";
                }
                return ok;
            }
        </script>
    </head>
    <body>
        <table>
            <tr>
                <div>
                        <script language="javascript" type="text/javascript">
                                document.write("hello");
                                document.close();
                        </script>
                </div>
            </tr> 
            <hr>
            <tr>
                <div id="myarea">
                        <script language="javascript" type="text/javascript">
                                document.getElementById("myarea").innerHTML="ca va?";
                                document.close();
                        </script>
                </div>
            </tr>
            <hr>
            <tr>
                <div id="myarea2">
                        <input type="button" value="vas y"
                               onclick='document.getElementById("myarea2").innerHTML="Ca va?"'
                               />
                </div>
            </tr>
            <hr>
            <tr>
                <div id="myarea3">
                        <input type="button" value="vas y2"
                               onMouseOver="go()"
                               />
                </div>
            </tr>
            <hr>
            <tr>
                <form name="myForm">
                    entrez prenom : <input type="text" name="prenom"/><br/>
                    entrez nom : <input type="text" name="nom"/><br/>
                    <input type="button" value="go" onclick="affiche()"/><br/>
                </form>
            </tr>
            <hr>
            <tr>
            <form name="myForm2" action="mailto:maxime.chazalviel@hotmail.fr">
                entrez prenom : <input type="text" name="prenom2"/><br/>
                entrez nom : <input type="text" name="nom2"/><br/>
                <input type="submit" value="go2" onclick="affiche2()"/><br/>
            </form>
        </tr>
        <hr>
           <tr>
                <form name="myForm3" action="mailto:maxime.chazalviel@hotmail.fr" onsubmit="return checkParam()">
                    entrez prenom : <input type="text" name="prenom3"/><br/>
                    <div id="starPrenom"></div>
                    entrez nom : <input type="text" name="nom3"/><br/>
                    <div id="starNom"></div>
                    <input type="submit" value="go3" /><br/>
                </form>
            </tr>
            <hr>
        </table>
    </body>
</html>
