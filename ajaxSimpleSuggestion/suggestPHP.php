<?php
// Fill up an array with names to speed up the process
//the best would be to have a database of names;-)
$a[]="Anna";$a[]="Brittany";$a[]="Cinderella";$a[]="Diana";$a[]="Eva";
$a[]="Fiona";$a[]="Gunda";$a[]="Hege";$a[]="Inga";$a[]="Johanna";
$a[]="Kitty";$a[]="Linda";$a[]="Nina";$a[]="Ophelia";$a[]="Petunia";
$a[]="Amanda";$a[]="Raquel";$a[]="Cindy";$a[]="Doris";$a[]="Eve";
$a[]="Evita";$a[]="Sunniva";$a[]="Tove";$a[]="Unni";$a[]="Violet";
$a[]="Liza";$a[]="Elizabeth";$a[]="Ellen";$a[]="Wenche";$a[]="Vicky";

//get the q parameter from URL
$q=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0) //something has been typed on the keyboard
  {
  $hint="";
  for($i=0; $i<count($a); $i++)
    {
    if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
      {
      if ($hint=="")
        {
        $hint=$a[$i];
        }
      else
        {
        $hint=$hint." , ".$a[$i];
        }
      }
    }
  }

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;  //this text file is received by the client in the responseText variable
?>
