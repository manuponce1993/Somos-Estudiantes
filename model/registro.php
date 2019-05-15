<?php
// Habria que hacer la validacion del back y tambien hacer el proceso con ajax al igual que el ingreso.
  require('../db.php'); 
  if(isset($_POST['registro_nombre_ajax'])){
    //Levantar campos
    $nombre=$_POST['registro_nombre_ajax'];
    $apellido=$_POST['registro_apellido_ajax'];
    $email=$_POST['registro_email_ajax'];
    $carrera=$_POST['registro_select_carrera_ajax'];
    $fecha_nac=$_POST['registro_fecha_nac_ajax'];
    $contrasena=$_POST['registro_contrasena_ajax'];
    $contrasena_rep=$_POST['registro_contrasena_rep_ajax'];
    //Validar (backend)
    $usuario = mysqli_query($db, "SELECT * FROM usuarios WHERE email='$email';");
    if($usuario->num_rows > 0){
        // Ya existe el email a registrar
        echo "fail";
    }else{
        $contrasena = md5($contrasena, 'sanlorenzo');
        $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`, `contrasena`, `fecha_nacimiento`, `id_carrera`) 
                VALUES ('$nombre','$apellido','$email','$contrasena','$fecha_nac','$carrera')";
        if (mysqli_query($db, $sql)) {
        // $_SESSION['id_usuario'] = "123123";
        $_SESSION['nombre'] = $nombre;
        $id_usuario = mysqli_insert_id($db);
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['apellido'] = $apellido;
        echo "success";
        // header("Location: material.php");
        } else {
          echo '<script> swal("Error!","No se ha podido hacer". $sql. "esa accion","success");</script>';
        }
    }
  }
?>