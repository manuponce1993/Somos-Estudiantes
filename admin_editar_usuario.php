<?php
  require('db.php'); 
  // if(isset($_POST['id_usuario_ajax'])){
    //Levantar campos
    $id_usuario = $_POST['id_usuario'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $email=$_POST['email'];
    $dni=$_POST['dni'];
    $fecha_nacimiento=$_POST['fecha_nac'];
    $id_carrera=$_POST['carrera'];
    //Validar (backend)
    $sql_usuario_consulta_email = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE id_usuario='$id_usuario';"));

    // Si cambio el email pregunto si no esta registrado aun
    if($sql_usuario_consulta_email['email'] != $email){
        $usuario = mysqli_query($db, "SELECT * FROM usuarios WHERE email='$email';");
        if($usuario->num_rows > 0){
            // Ya existe el email a registrar
            echo "fail";
        }else{
            $sql = "UPDATE `usuarios` 
                    SET nombre = '$nombre', apellido = '$apellido', email= '$email', dni= '$dni', fecha_nacimiento = '$fecha_nacimiento', id_carrera = '$id_carrera' 
                    WHERE id_usuario = '$id_usuario';";
            if (mysqli_query($db, $sql)) {
                echo "success";
            } else {
              echo 'fail_otor';
            }
        }
    }else{

            $sql = "UPDATE `usuarios` 
                    SET nombre = '$nombre', apellido = '$apellido', dni= '$dni', fecha_nacimiento = '$fecha_nacimiento', id_carrera = '$id_carrera'
                    WHERE id_usuario = '$id_usuario';";
            if (mysqli_query($db, $sql)) {
                echo "success";
            } else {
              echo 'fail';
            }
    }
  // }else{
  //   echo "laputamadre";
  // }

?>