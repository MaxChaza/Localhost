/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function upload(){
    document.getElementById("image").innerHTML("<img src='./image/fox.jpg'");
    var fd = new FormData(document.getElementById("myFormAjax"));
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4){
            document.getElementById("answerArea").innerHTML=ajax.responseText;
        }
    }
    document.getElementById("");
}


