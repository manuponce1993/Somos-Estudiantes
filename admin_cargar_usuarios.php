<?php  
	require('db.php');
	$id_usuario = $_SESSION['id_usuario'];

	// Cargar usuarios
	$sql_usuarios = mysqli_query($db,"SELECT * FROM usuarios where id_usuario <> '$id_usuario' ORDER BY id_usuario ASC;");
 	if($sql_usuarios->num_rows > 0){
		while ($usuario =  mysqli_fetch_assoc($sql_usuarios)){
			
			$id_usuario = $usuario["id_usuario"];
			$ruta_foto_perfil_archivo="foto_perfil/" . $id_usuario . "/";
			if(!is_dir($ruta_foto_perfil_archivo)){
				$ruta_foto_perfil_archivo="resources/avatar.png";
			}else{
				$ruta_foto_perfil_archivo.="foto_perfil.jpg";
			}

        	$carrera_usuario = mysqli_fetch_assoc(mysqli_query($db,"SELECT carreras.carrera FROM usuarios INNER JOIN carreras ON usuarios.id_carrera = carreras.id_carrera WHERE id_usuario = '$id_usuario';"));
			$carrera_usuario = utf8_encode($carrera_usuario['carrera']);
			// Datos necesarios para mostrar info cuando se hace click sobre el nombre del usuario --> salta el modal
			$nomyap = $usuario["nombre"]." ".$usuario["apellido"];
			$fecha_nac =  $usuario["fecha_nacimiento"];
			$fecha_actual = date("Y-m-d");
			$anios = abs(strtotime($fecha_actual) - strtotime($fecha_nac));
			
			$anios = floor($anios / (365*60*60*24));

			$suscriptores = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_usuario) AS suscriptores FROM suscripciones WHERE id_usuario='$id_usuario'"));
			$suscriptores = $suscriptores['suscriptores'];
			$cant_arch = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_archivo) AS cantidad FROM archivos WHERE archivos.id_usuario = '$id_usuario';"));
			$cant_arch = $cant_arch['cantidad'];
			echo '<tr>
				      <th scope="row">'.$id_usuario .'</th>
				      <td>'. $usuario["nombre"] .'</td>
				      <td>'. $usuario["apellido"] .'</td>
				      <td>'. $usuario["email"] .'</td>
				      <td>'. $usuario["fecha_nacimiento"] .'</td>
				      <td>'. $usuario["dni"].'</td>
				      <td>'. $carrera_usuario .'</td>
				      <td>
			      	<form class="form_editar_usuario">
			      		<input type="hidden" id="input_id_usuario_editar" name="input_id_usuario_editar" value="<'. $id_usuario .'">
			      		<button type="submit" class="btn btn-sm btn-success btn-block">Editar</button>
			      	</form>
			      	<form onsubmit="return eliminar_usuario('.$id_usuario.')">
			      		<input type="hidden" id="input_id_usuario_eliminar" name="input_id_usuario_eliminar" value="'. $id_usuario .'">
			      		<button type="submit" class="btn btn-sm btn-danger btn-block">Eliminar</button>
			      	</form>
			      	
			      </td>
			    </tr>';
			}
		}
?>