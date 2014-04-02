/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function checkParamRegister(){
    var ok = true;
    usernameIsSet=true;
    passwordIsSet=true;
    password2IsSet=true;
    samePassword=true;
    // Test de la validité du login
    if(document.log.username.value==""){
        ok=false;
        usernameIsSet=false;
        document.getElementById('colorUsername').style.color = 'red';
        var keyUsername = document.getElementById('username');
        keyUsername.focus();
        keyUsername.select();
    }
    else
    {
        document.getElementById("colorUsername").style.color = 'black';
        usernameIsSet=true;
    }
    // Test de la validité du 1er password
    if(document.log.password.value==""){
        ok=false;
        passwordIsSet=false;
        document.getElementById('colorPassword').style.color = 'red';
        if(usernameIsSet){
            var keyPassword = document.getElementById('password');
            keyPassword.focus();
            keyPassword.select();
        }
    }
    else{     
        document.getElementById("colorPassword").style.color = 'black';
        passwordIsSet=true;
    }


    // Test de la validité du 2eme password
    if(document.log.password2.value==""){
        ok=false;
        password2IsSet=false;
        document.getElementById('colorPassword2').style.color = 'red';
        if(passwordIsSet && usernameIsSet){
            var keyPassword2 = document.getElementById('password2');
            keyPassword2.focus();
            keyPassword2.select();
        }
    }
    else{
        password2IsSet=true;
        document.getElementById("colorPassword2").style.color = 'black';
    }
       
    // Test de la correspondance des 2 passwords
    if(!(document.log.password.value==document.log.password2.value)){
        ok=false;
        samePassword=false;
        document.log.password.value="";
        document.log.password2.value="";
        document.getElementById("erreurPassword").style.color = 'red';
        document.getElementById("erreurPassword").innerHTML="Password mal confirm&eacute;!";
                       
        var keyPassword = document.getElementById('password');
            keyPassword.focus();
            keyPassword.select();
    }
    else
    {
        if(passwordIsSet){
            samePassword=true;
            document.getElementById("colorPassword").style.color = 'black';
            document.getElementById("colorPassword2").style.color = 'black';
        }
    }
    
    return ok;
}


function checkParamLogin(){
    var ok = true;
    usernameIsSet=true;
    passwordIsSet=true;
    
    // Test de la validité du prenom
    if(document.log.username.value==""){
        ok=false;
        usernameIsSet=false;
        document.getElementById('colorUsername').style.color = 'red';
        var keyUsername = document.getElementById('username');
        keyUsername.focus();
        keyUsername.select();
    }
    else
    {
        document.getElementById("colorUsername").style.color = 'black';
        usernameIsSet=true;
    }
    // Test de la validité du nom
    if(document.log.password.value==""){
        ok=false;
        passwordIsSet=false;
        document.getElementById('colorPassword').style.color = 'red';
        if(usernameIsSet){
            var keyPassword = document.getElementById('pass');
            keyPassword.focus();
            keyPassword.select();
        }
    }
    else{     
        document.getElementById("colorPassword").style.color = 'black';
        passwordIsSet=true;
    }
 
    return ok;
}