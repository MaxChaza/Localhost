/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function CreateAjaxObject(){//we test if AJAX supported and we create and object
    //syntax browser dependent;-)
    var ajax;
    if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
    {
        ajax= new XMLHttpRequest(); 
    }
    else
    {
        if (window.ActiveXObject) // code for IE6, IE5
        {
            ajax = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        else ajax=null;
              
    }
    return ajax;
}

//main function
function ajaxFunction() //this function does the job
{
    var ajax;
    ajax=new CreateAjaxObject(); 
    if (ajax==null) {
        alert("your browser does not support AJAX;-)");
        return 0;
    }
    else{
        ajax.onreadystatechange = 
            function(){ //what we do with the answer
                if(ajax.readyState == 4){
                    document.myForm.time.value = ajax.responseText;
                    document.getElementById('place').innerHTML= ajax.responseText;
                    //we display the content  
                }
            } //end of the function to be executed
            ajax.open("GET","./src/dateServer.php",true); //we prepare the request
            ajax.send();  //we send the request to the server
    }
} 

