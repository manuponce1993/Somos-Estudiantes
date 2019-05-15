<?php  
	require('db.php');
	$nombre = $_SESSION['nombre'];
	$id_usuario = $_SESSION['id_usuario'];
	$apellido = $_SESSION['apellido'];
// Suscripciones
	$sql_suscripciones = mysqli_query($db,"SELECT * FROM `usuarios` 
INNER JOIN suscripciones ON usuarios.id_usuario = suscripciones.id_usuario
WHERE suscripciones.id_suscriptor = '$id_usuario';");
	
	if($sql_suscripciones->num_rows > 0){
		while ($usuario =  mysqli_fetch_assoc($sql_suscripciones)){
			$id_usuario = $usuario["id_usuario"];
			$ruta_foto_perfil_archivo="foto_perfil/" . $id_usuario . "/";
			if(!is_dir($ruta_foto_perfil_archivo)){
				$ruta_foto_perfil_archivo="resources/avatar.png";
			}else{
				$ruta_foto_perfil_archivo.="foto_perfil.jpg";
			}

        	$carrera_archivo = mysqli_fetch_assoc(mysqli_query($db,"SELECT carreras.carrera FROM usuarios INNER JOIN carreras ON usuarios.id_carrera = carreras.id_carrera WHERE id_usuario = '$id_usuario';"));
			$carrera_archivo = utf8_encode($carrera_archivo['carrera']);
			$nomyap = $usuario["nombre"]." ".$usuario["apellido"];
			$fecha_nac =  $usuario["fecha_nacimiento"];
			$fecha_actual = date("Y-m-d");
			$anios = abs(strtotime($fecha_actual) - strtotime($fecha_nac));
			
			$anios = floor($anios / (365*60*60*24));

			$suscriptores = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_usuario) AS suscriptores FROM suscripciones WHERE id_usuario='$id_usuario'"));
			$suscriptores = $suscriptores['suscriptores'];
			$cant_arch = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_archivo) AS cantidad FROM archivos WHERE archivos.id_usuario = '$id_usuario';"));
			$cant_arch = $cant_arch['cantidad'];

	    	echo '<div class="row">
				<div class="col-12">
					
					<div class="row">
						<div class="col-12 col-sm-12 mb-3 col-lg-10">
							<!-- Texto descriptivo -->
							
							<div class="row">
								<div class="col"><span class="lead">Usuario: <a class="text-primary" href="#" onclick="mostrar_datos_usuario_archivo(\''.$nomyap.'\', \''.$ruta_foto_perfil_archivo.'\', \''.$carrera_archivo.'\','.$id_usuario.',\''.$anios.'\',\''.$suscriptores.'\',\''.$cant_arch.'\')">'. $usuario["nombre"] .' '.$usuario["apellido"].'</a> </span> 
								</div>
								<div class="col"><span class="lead">Edad: '.$anios.' años</span> 
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-lg-2 pl-lg-0">
							<!-- Desuscribirse -->
							<form id="form_desuscribirse" type="POST" onsubmit="return desuscribirse()">
	                     	<input type="hidden" name="id_usuario_desuscribirse_form" id="id_usuario_desuscribirse_form" value="'.$id_usuario.'">
	                     	<button class="btn btn-danger btn-sm" id="btnDesuscribirse">Desuscribirse</button>
	                     </form>
						</div>
					</div>
				</div>
			</div>';
	    }
	}else{
		?>
		<p>No tiene ninguna suscripción</p>
		<?php
	}

?>