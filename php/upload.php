<?php

if(!empty($_FILES['file']['name'])){
    $uploadedFile = '';
    if(strlen($_FILES["file"]["name"])<=21){
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["hard_file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "../img/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
                echo $uploadedFile;
            }else{
                echo'Archivo no subido';
            }
            
        }else{
            echo'Formato Invalido';
        }

    }else{
        echo'Nombre Demasiado Largo';
    }
} else{
    echo 'NULL';
}




/*
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "img/".$_FILES['file']['name'])) {
        //more code here...
        echo "img/".$_FILES['file']['name'];
    } else {
        echo 0;
    }
*/
