<?php  

	require('db.php');
	$nombre = $_SESSION['nombre'];
	$id_usuario = $_SESSION['id_usuario'];
	$apellido = $_SESSION['apellido'];

	// Archivos suscriptos
	$sql_archivos_suscritos = mysqli_query($db,"SELECT * FROM `archivos` 
INNER JOIN suscripciones ON archivos.id_usuario=suscripciones.id_usuario
WHERE suscripciones.id_suscriptor= '$id_usuario';");

 	if($sql_archivos_suscritos->num_rows > 0){
		while ($archivo =  mysqli_fetch_assoc($sql_archivos_suscritos)){
			$id_materia=$archivo["id_materia"];
			$tipo=$archivo["tipo"];
			if($tipo=="parcial"){
				$tipo="Parcial";
			}elseif ($tipo=="resumen") {
				$tipo="Resúmen";
			}elseif ($tipo=="tp") {
				$tipo="Trabajo práctico";
			}elseif ($tipo=="mutil") {
				$tipo="Material útil";
			}
			$materia =  mysqli_fetch_assoc(mysqli_query($db,"SELECT materias.materia FROM (`archivos`
INNER JOIN materias ON materias.id_materia = archivos.id_materia)
WHERE archivos.id_materia = '$id_materia'"));


			$id_usuario = $archivo["id_usuario"];
			$usuario =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';"));
			$ruta = "archivos/".$archivo["id_materia"]."/".$archivo["id_archivo"].".".$archivo["extension"];
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
						<div class="col">
							<div class="hr-sect">' . $archivo["fecha_subido"] . '</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-lg-3 mb-3 text-center">
							<!-- foto -->
							<img src="resources/extensiones/'.$archivo["extension"].'.png" class="img-fluid img-thumbnail w-50" style=" max-width: 50%;" alt="Responsive image">
						</div>
						<div class="col-12 col-sm-12 mb-3 col-lg-7">
							<!-- Texto descriptivo -->
							<div class="row">
								<div class="col-12"><h5><a class="link_archivo text-success" href="'.$ruta.'" download="'.$archivo["titulo"].'">'. $archivo["titulo"] .'</a></h5></div>
							</div>


							<div class="row">
								<div class="col"><span class="lead text-secondary">'.utf8_encode($materia["materia"]).' - '.$tipo.'</span> </div>
							</div>
							<div class="row">
								<div class="col"><span class="lead">Usuario: <a class="text-primary" href="#" onclick="mostrar_datos_usuario_archivo(\''.$nomyap.'\', \''.$ruta_foto_perfil_archivo.'\', \''.$carrera_archivo.'\','.$id_usuario.',\''.$anios.'\',\''.$suscriptores.'\',\''.$cant_arch.'\')">'. $usuario["nombre"] .' '.$usuario["apellido"].'</a> </span> </div>
							</div>
							<div class="row">
								<div class="col"><span class="lead">Detalles: '. $archivo["detalles"] .'</span></div>
							</div>
							<div class="row">
							  	<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>
							</div>

						</div>
						<div class="col-12 col-sm-12 col-lg-2 pl-lg-0">
							<!-- Denunciar -->
							<button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal_denunciar">
								DENUNCIAR
							</button>
						</div>
					</div>
				</div>
			</div>';
	    }
	}
	else{
		?>
			<p>No tiene ninguna suscripción</p>
		<?php
	}

?>