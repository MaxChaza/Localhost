/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
            function checkParam(){
                var ok = true;
                // Test de la validité du prenom
                if(document.myForm.prenom.value==""){
                    ok=false;
                    document.getElementById('colorPrenom').style.color = 'red';
                }
                else
                    document.getElementById("colorPrenom").style.color = 'black';
                
                // Test de la validité du nom
                if(document.myForm.nom.value==""){
                    ok=false;
                    document.getElementById('colorNom').style.color = 'red';
                }
                else
                    document.getElementById("colorNom").style.color = 'black';
                
                
                // Test de la validité du téléphone 
                if(document.myForm.telephone.value==""){
                    ok=false;
                    document.getElementById('colorTelephone').style.color = 'red';
                }
                else{
                    tel = document.myForm.telephone.value;
                    if(!/^[0-9]{10}$/.test(tel)){ 
                        ok=false;
                        document.getElementById("formatTelephone").style.color = 'red';
                        document.getElementById("formatTelephone").innerHTML="Le numero de t&eacute;l&eacute;phone doit &ecirc;tre compos&eacute; de 10 chiffres.";
                    }
                    else 
                        document.getElementById("formatTelephone").innerHTML="";
                   
                    document.getElementById("colorTelephone").style.color = 'black';
                }
                
                // Test de la validité du mail
                if(document.myForm.mail.value==""){
                    ok=false;
                    document.getElementById('colorMail').style.color = 'red';
                }
                else
                    document.getElementById("colorMail").style.color = 'black';
                
                return ok;
            }