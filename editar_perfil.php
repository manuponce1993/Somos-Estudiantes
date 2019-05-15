<?php
  require('db.php'); 
  if(isset($_POST['editar_nombre_ajax'])){
    //Levantar campos
    $id_usuario = $_SESSION['id_usuario'];
    $nombre=$_POST['editar_nombre_ajax'];
    $apellido=$_POST['editar_apellido_ajax'];
    $email=$_POST['editar_email_ajax'];
    $dni=$_POST['editar_dni_ajax'];
    $fecha_nacimiento=$_POST['editar_fechanac_ajax'];
    $id_carrera=$_POST['editar_id_carrera_ajax'];
    $cambiar_email = $_POST['cambiar_email_ajax'];
    //Validar (backend)
    if($cambiar_email){
        $sql_usuario_consulta_email = mysqli_query($db, "SELECT * FROM usuarios WHERE id_usuario='$id_usuario';");
        $usuario = mysqli_query($db, "SELECT * FROM usuarios WHERE email='$email';");
        if($usuario->num_rows > 0){
            // Ya existe el email a registrar
            echo "fail";
        }else{
            $sql = "UPDATE `usuarios` 
                    SET nombre = '$nombre', apellido = '$apellido', email= '$email', dni= '$dni', fecha_nacimiento = '$fecha_nacimiento', id_carrera = '$id_carrera' 
                    WHERE id_usuario = '$id_usuario';";
            if (mysqli_query($db, $sql)) {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
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
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                echo "success";
            } else {
              echo 'fail';
            }
    }
  }
?>