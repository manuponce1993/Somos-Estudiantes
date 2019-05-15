<?php
  require('db.php'); 
  // if(isset($_POST['id_usuario_ajax'])){
    //Levantar campos
    $id_archivo = $_POST['id_archivo'];
    $titulo=$_POST['titulo'];
    $fecha=$_POST['fecha'];
    $detalles=$_POST['detalles'];

    $sql = "UPDATE `archivos` 
            SET titulo = '$titulo', fecha_subido = '$fecha', detalles= '$detalles' 
            WHERE id_archivo = '$id_archivo';";
    if (mysqli_query($db, $sql)) {
        echo "success";
    } else {
      echo 'fail';
    }

?>