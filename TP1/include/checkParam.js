/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
            function checkParam(){
                var ok = true;
                prenomIsSet=true;
                nomIsSet=true;
                mailIsSet=true;
                telephoneIsSet=true;
                
                // Test de la validité du prenom
                if(document.myForm.prenom.value==""){
                    ok=false;
                    prenomIsSet=false;
                    document.getElementById('colorPrenom').style.color = 'red';
                    var keyPrenom = document.getElementById('prenom');
                    keyPrenom.focus();
                    keyPrenom.select();
                }
                else
                {
                    document.getElementById("colorPrenom").style.color = 'black';
                    prenomIsSet=true;
                }
                // Test de la validité du nom
                if(document.myForm.nom.value==""){
                    ok=false;
                    nomIsSet=false;
                    document.getElementById('colorNom').style.color = 'red';
                    if(prenomIsSet){
                        var keyNom = document.getElementById('nom');
                        keyNom.focus();
                        keyNom.select();
                    }
                }
                else{     
                    document.getElementById("colorNom").style.color = 'black';
                    nomIsSet=true;
                }
                
                
                // Test de la validité du téléphone 
                if(document.myForm.telephone.value==""){
                    ok=false;
                    telephoneIsSet=false;
                    document.getElementById('colorTelephone').style.color = 'red';
                    if(prenomIsSet && nomIsSet){
                        var keyTelephone = document.getElementById('telephone');
                        keyTelephone.focus();
                        keyTelephone.select();
                    }
                }
                else{
                    tel = document.myForm.telephone.value;
                    if(!/^[0-9]{10}$/.test(tel)){ 
                        ok=false;
                        telephoneIsSet=false;
                        document.getElementById("formatTelephone").style.color = 'red';
                        document.getElementById("formatTelephone").innerHTML="Le numero de t&eacute;l&eacute;phone doit &ecirc;tre compos&eacute; de 10 chiffres.";
                        if(prenomIsSet && nomIsSet){
                            var keyTelephone = document.getElementById('telephone');
                            keyTelephone.focus();
                            keyTelephone.select();
                        }
                    }
                    else{
                        document.getElementById("formatTelephone").innerHTML="";
                        telephoneIsSet=true;
                    }
                   
                    document.getElementById("colorTelephone").style.color = 'black';
                }
                
                // Test de la validité du mail
                if(document.myForm.mail.value==""){
                    ok=false;
                    mailIsSet=false;
                    document.getElementById('colorMail').style.color = 'red';
                    if(prenomIsSet && nomIsSet && telephoneIsSet){
                        var keyEmail = document.getElementById('mail');
                        keyEmail.focus();
                        keyEmail.select();
                    }
                }
                else{
                    email = document.myForm.mail.value;
                    if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email)){ 
                        ok=false;
                        mailIsSet=false;
                        document.getElementById("formatMail").style.color = 'red';
                        document.getElementById("formatMail").innerHTML="Adresse mail &eacute;ronée.";
                        if(prenomIsSet && nomIsSet && telephoneIsSet){
                            var keyEmail = document.getElementById('mail');
                            keyEmail.focus();
                            keyEmail.select();
                        }
                    }
                    else{
                        document.getElementById("formatMail").innerHTML="";
                        mailIsSet=true;
                    }
                    document.getElementById("colorMail").style.color = 'black';
                }
                return ok;
            }