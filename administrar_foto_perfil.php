<?php 
	require('db.php');

	if($_FILES["file"]["error"] > 0){
		echo "fail";
		 
	} else{
		$id_usuario = $_SESSION['id_usuario'];
		// Ruta: foto_perfil/id usuario/foto_perfil.extension	
		$ruta_archivo ="foto_perfil/" . $id_usuario . "/" ;
		
		// Si no existe la ruta, la crea
		if ( ! is_dir($ruta_archivo)) {
    		mkdir($ruta_archivo);
		}
		// Muevo el archivo a la ruta archivos/id usuario/id_archivo.jpg obligamos a que sea jpg
		move_uploaded_file($_FILES["file"]["tmp_name"] , $ruta_archivo . "foto_perfil." . "jpg");
		// Devuelvo el src de la img para que se cargue en perfil.js
		echo $ruta_archivo . "foto_perfil." . "jpg";
	}
?>