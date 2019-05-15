<?php 
	require('db.php');
	// suscriptor
	$id_suscriptor = $_SESSION['id_usuario'];
	// al que se suscribe
	$id_usuario_ajax = $_POST['id_usuario_ajax'];
	$yaSuscripto =mysqli_query($db, "SELECT * FROM `suscripciones` WHERE id_usuario='$id_usuario_ajax' AND id_suscriptor = '$id_suscriptor'");

	
	if($yaSuscripto->num_rows > 0){
	        // Ya esta suscripto
	        echo "yasuscripto";
	}elseif ( $id_suscriptor ==  $id_usuario_ajax) {
		echo "mismousuario";
	}else{
		$sql = "INSERT INTO `suscripciones`(`id_usuario`, `id_suscriptor`) VALUES ('$id_usuario_ajax','$id_suscriptor')";
	    if (mysqli_query($db, $sql)){
			echo "success";    	
	    }else{
	    	echo mysqli_error($db);
	    }
	}


?>