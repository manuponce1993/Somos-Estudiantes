<?php  
	require('db.php');

	$id_usuario = $_POST['id_usuario_eliminar'];	
	// $ruta_foto_perfil = 'foto_perfil/'.$id_usuario_eliminar.'/foto_perfil.jpg';
	// unlink($ruta_foto_perfil);
	echo $id_usuario;
	$sql = "DELETE FROM `usuarios` 
                WHERE id_usuario='$id_usuario'";
	mysqli_query($db, $sql);
?>