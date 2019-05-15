<?php  
	require('db.php');

	$id_archivo = $_POST['id_archivo_eliminar'];
	echo $id_archivo;
	$sql = "DELETE FROM `archivos` 
                WHERE id_archivo='$id_archivo'";
	mysqli_query($db, $sql);
?>