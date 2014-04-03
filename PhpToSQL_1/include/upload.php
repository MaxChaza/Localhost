<?php
    if(isset($_FILES["file1"]["name"]))
    {
        $name = basename($_FILES["file1"]["name"]);
        $tempname = basename($_FILES["file1"]["tmp_name"]);
        $datafile="../uploads/".$name;        
        if(move_uploaded_file($_FILES["file1"]["tmp_name"],$datafile))
        {
                echo "fichier uploader </br>";
        }
        else
        {
                echo "marche pas !!!!";
        }
    }
    if(isset($_FILES["file2"]["name"]))
    {
        $name = basename($_FILES["file2"]["name"]);
        $tempname = basename($_FILES["file2"]["tmp_name"]);
        $datafile2="../uploads/".$name;
        if(move_uploaded_file($_FILES["file2"]["tmp_name"],$datafile2))
        {
                echo "fichier uploader </br>";
        }
        else
        {
                echo "marche pas !!!!";
        }
    }
    $d2=fopen($datafile2,"r");
    //open the file to be added in read mode 
    file_put_contents($datafile, $d2, FILE_APPEND); //concatenate d2 to datafile1
?>