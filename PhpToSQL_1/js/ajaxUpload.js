/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function upload(){
    var ok;
    document.getElementById("image").innerHTML = document.getElementById("myFormAjax");
    var fd;
    fd = new FormData();
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4){
            document.getElementById("answerArea").innerHTML=ajax.responseText;
        }
    }
    ok = false;
    return ok;
}
