<?php  
	require('db.php');

	// Cargar archivos
	$sql_material = mysqli_query($db,"SELECT * FROM archivos ORDER BY id_archivo ASC;");
 	
 	if($sql_material->num_rows > 0){
		while ($archivo =  mysqli_fetch_assoc($sql_material)){
			echo '
				<tr>
			      <th scope="row">'.$archivo["id_archivo"] .'</th>
			      <td>'. $archivo["titulo"] .'</td>
			      <td>'. $archivo["fecha_subido"] .'</td>
			      <td>'. $archivo["id_usuario"] .'</td>
			      <td>'. $archivo["tipo"] .'</td>
			      <td>'. $archivo["id_materia"].'</td>
			      <td>'. $archivo["detalles"].'</td>
			      <td>'. $archivo["extension"] .'</td>
			      <td>
			      <form class="form_editar_archivo">
			      <input type="hidden" id="input_id_archivo_editar" name="input_id_archivo_editar" value="'.$archivo["id_archivo"].'">
			      	<button class="btn btn-sm btn-success btn-block" id="btn_editar_archivo">Editar</button>
			      	</form>
			      	<form onsubmit="return eliminar_archivo('.$archivo["id_archivo"].')">
			      		<button type="submit" class="btn btn-sm btn-danger btn-block" id="btnEliminar_archivo">Eliminar</button>
			      	</form>
			      	
			      </td>
			    </tr>';
		}
	}
?>