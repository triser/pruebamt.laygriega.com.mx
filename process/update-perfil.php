<?php

//upload file by abisoft https://github.com/amnersaucedososa 
include "../lib/config2.php";


if (isset($_FILES["file"])  && isset($_POST['id_edit']))
{
    $id_edit=$_POST['id_edit'];
    $file = $_FILES["file"];
    $name = $file["name"];
    $type = $file["type"];
    $tmp_n = $file["tmp_name"];
    $size = $file["size"];
    $folder = "../img/profiles/";
    
    if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
    {
      echo "Error, el archivo no es una imagen"; 
    }
    else if ($size > 1024*1024)
    {
      echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else
    {
        $src = $folder.$name;
       @move_uploaded_file($tmp_n, $src);

       $query=mysqli_query($con, "UPDATE usuario set foto_perfil=\"$name\" WHERE idusuario = '$id_edit'");
       if($query){
        echo "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>¡Bien hecho!</strong> Foto de Perfil insertado Correctamente
        </div>";
       }
    }
}