<?php  
	require('db.php');
	// suscriptor que se quiere desuscribir
	$id_suscriptor = $_SESSION['id_usuario'];
	// al que se desuscribe
	$id_usuario_desuscribirse = $_POST['id_usuario_desuscribirse'];
	
	$sql = "DELETE FROM `suscripciones` WHERE id_usuario = '$id_usuario_desuscribirse' AND id_suscriptor = '$id_suscriptor'";
    if (mysqli_query($db, $sql)){
		echo "success";    	
    }else{
    	echo "fail";
    }
?>