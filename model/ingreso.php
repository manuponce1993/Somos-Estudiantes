<?php  
require '../db.php';
if(isset($_POST['email_ajax'])){
	$email = $_POST['email_ajax'];
	$contra = $_POST['pass_ajax'];
	$contra = md5($contra, 'sanlorenzo');

	$usuario = mysqli_query($db, "SELECT * FROM usuarios WHERE email='$email' AND contrasena='$contra';");
	if($usuario->num_rows > 0){
		$usuario_db = mysqli_fetch_assoc($usuario);
        $_SESSION['id_usuario'] = $usuario_db['id_usuario'];
        $_SESSION['nombre'] = $usuario_db['nombre'];
        $_SESSION['apellido'] = $usuario_db['apellido'];

        // session_write_close();
		echo "success";
	}
	else{
		echo "fail";
	}	
	exit();
}
?>