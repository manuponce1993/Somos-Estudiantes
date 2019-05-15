<?php  
	
	$esta_en_login=false;
	require('db.php');
	$nombre = $_SESSION['nombre'];
	$id_usuario = $_SESSION['id_usuario'];
	$apellido = $_SESSION['apellido'];

	$ruta_foto_perfil ="foto_perfil/" . $id_usuario . "/";
	// Cargar ultimos 10 archivos (Ultimos archivos subidos por la comunidad)
	$sql = mysqli_query($db,"SELECT * FROM archivos ORDER BY fecha_subido DESC LIMIT 4;");
	// Mis archivos
	$sql_mis_archivos = mysqli_query($db,"SELECT * FROM archivos WHERE id_usuario = '$id_usuario';");
	// Archivos suscriptos
	$sql_archivos_suscritos = mysqli_query($db,"SELECT * FROM `archivos` 
INNER JOIN suscripciones ON archivos.id_usuario=suscripciones.id_usuario
WHERE suscripciones.id_suscriptor= '$id_usuario';");
	// Suscripciones
	$sql_suscripciones = mysqli_query($db,"SELECT * FROM `usuarios` 
INNER JOIN suscripciones ON usuarios.id_usuario = suscripciones.id_usuario
WHERE suscripciones.id_suscriptor = '$id_usuario';");
	// Usuario
	$usuario = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';")); 
	// Carrera
	$carrera = mysqli_fetch_assoc(mysqli_query($db,"SELECT carreras.carrera FROM usuarios INNER JOIN carreras ON usuarios.id_carrera = carreras.id_carrera WHERE id_usuario = '$id_usuario';"));
	$carrera = utf8_encode($carrera['carrera']);

	$fecha_nac =  $usuario["fecha_nacimiento"];
	$fecha_actual = date("Y-m-d");
	$anios = abs(strtotime($fecha_actual) - strtotime($fecha_nac));
	
	$anios = floor($anios / (365*60*60*24));

	$cant_arch_subidos = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_archivo) AS cantidad FROM archivos WHERE archivos.id_usuario = '$id_usuario';"));
	$cant_arch_subidos = $cant_arch_subidos['cantidad'];

	$cant_suscriptores = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_suscripcion) AS cantidad FROM suscripciones WHERE suscripciones.id_usuario = '$id_usuario';"));
	$cant_suscriptores = $cant_suscriptores['cantidad'];

	$cant_suscripciones = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(id_suscripcion) AS cantidad FROM suscripciones WHERE suscripciones.id_suscriptor = '$id_usuario';"));
	$cant_suscripciones = $cant_suscripciones['cantidad'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Somos Estudiantes - Inicio</title>
	<?php 
		require('head.php'); 
	?>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  	<link rel="shortcut icon" href="assets/images/logofondo-128x128-2.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/perfil.css">
  	<link href="user-profile/assets/css/style.css" rel="stylesheet" />
  	<link rel="stylesheet" type="text/css" href="css/material.css">
	<script type="text/javascript" src="js/perfil.js"></script>

</head>
<body>


    <!-- Navigation Bar -->
    <?php
    	if($id_usuario == 2){
    		require('navigationbaradmin.php');
    	}else{
    		require('navigationbar.php');
    	}
    ?>
	
    
    <section class="container pt-5">
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h2>Bienvenido/a <?= $nombre ?></h2>                    
            </div>
        </div>
        <!-- PERFIL DE USUARIO-->
        <div class="row">
            <div class="col-12 col-md-3 col-sm-12">                     
                <div class="user-wrapper">
                    <!-- <img src="user-profile/assets/img/1.jpg" class="img-responsive" />  -->
                    <a href="" data-toggle="modal" data-target="#modal_foto_perfil" >
                    	<img id="img_foto_perfil" <?php if(!is_dir($ruta_foto_perfil)){
                    		echo 'src="resources/avatar.png"';
                    	}else{
                    		echo "src=".$ruta_foto_perfil."foto_perfil.jpg";
                    	} ?> class="img-responsive" data-toggle="popover" data-trigger="hover" title="Foto de perfil" data-content="Haga click para cambiar su foto de perfil"/>
                    </a> 
                    <div class="description">
                       <h4> <strong> <?= $nombre. " " .$apellido  ?> </strong> </h4>
                        <!-- <h5> <strong> <?= $carrera ?> </strong></h5> -->
                        <p> <strong>Identificador: </strong><?= $id_usuario ?></p>
                        <p> <strong>Carrera: </strong> <?= $carrera ?> </p>
                        <p> <strong>Edad: </strong> <?= $anios ?> años</p>
                        <p> <strong>Archivos: </strong>  <?= $cant_arch_subidos ?> </p>
                        <p> <strong>Suscriptores: </strong> <?= $cant_suscriptores ?></p>
                        <p> <strong>Suscripciones: </strong> <?= $cant_suscripciones ?></p>
                        <hr />
                        <a href="#" class="btn btn-danger btn-sm" id="btn_editar_perfil" data-toggle="modal" data-target="#modal_editar_perfil"> <i class="fa fa-user-plus" ></i> &nbsp;Editar perfil  </a> 
                	</div>
                </div>
            </div>
            
            <div class="col-12 col-md-9 col-sm-12 mt-4 mt-md-0  user-wrapper" id="contenedor_archivos_general">
            	<!-- Ultimos archivos subidos por la comunidad -->
                <div class="col-12">
                	<div class="description">
                        <h3 style="border-left: 2px solid lightblue" class="pl-3"> Últimos archivos subidos por la comunidad</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12 text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_ultimos_archivos" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar el contenido" data-placement="bottom"></i>	
	                    	</div>
	                    </div>
	                    <div id="ultimos_archivos">
	                     <?php  
	                     	if($sql->num_rows > 0){
								while ($archivo =  mysqli_fetch_assoc($sql)){
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
									// Cantidad de archivos subidos por ese usuario
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
														<div class="col"><span class="lead text-secondary">'. utf8_encode($materia["materia"]) .' - '.$tipo.'</span> </div>
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
								<p>No hay archivos subidos</p>
								<?php
							}
	                     ?>  
	                    </div>
	                </div>
                </div>

                <div class="col-12 mt-4">
                	<div class="description">
                		<h3 style="border-left: 2px solid lightblue" class="pl-3"> Archivos subidos por usuarios seguidos</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12">
	                    		<div class="text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_archivos_suscriptos" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar el contenido" data-placement="bottom"></i>
	                    		</div>
	                    		<div id="archivos_suscritos">  
			                     	<?php  
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
																<div class="col"><span class="lead text-secondary">'. utf8_encode($materia["materia"]).' - '.$tipo.'</span> </div>
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
	                    		</div>
	                    	</div>
	                    </div>
                	</div>
                </div>

                <!-- Mis archivos -->
                <div class="col-12 mt-4">
                	<div class="description">
                        <h3 style="border-left: 2px solid red" class="pl-3"> Mis archivos</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12 text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_mis_archivos" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar mis archivos" data-placement="bottom"></i>
	                    	</div>
	                    </div>
	                    <div id="mis_archivos">
	                     <?php  
	                     	if($sql_mis_archivos->num_rows > 0){
								while ($archivo =  mysqli_fetch_assoc($sql_mis_archivos)){
									$id_materia=$archivo["id_materia"];
									$tipo=$archivo["tipo"];
									$id_archivo=$archivo["id_archivo"];
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
														<div class="col"><span class="lead">Usuario: '. $usuario["nombre"] .' ' . $usuario["apellido"] .'</span> </div>
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
													<!-- Eliminar -->

													<form class="form_eliminar_archivo">
									                	<input type="hidden" name="form_eliminar_archivo_idarchivo" id="form_eliminar_archivo_idarchivo" value="'.$id_archivo.'">
									                	<input type="hidden" name="form_eliminar_archivo_idmateria" id="form_eliminar_archivo_idmateria" value="'.$id_materia.'">
									                	<input type="hidden" name="form_eliminar_archivo_ruta" id="form_eliminar_archivo_ruta" value="'.$ruta.'">
									                	<button class="btn btn-outline-danger btn-sm btn_eliminar" type="submit">
									                		ELIMINAR
														</button>
									                </form>             
												</div>
											</div>
										</div>
									</div>';
							    }
							}else{
								?>
								<p>No tiene ningún archivo en el sistema</p>
								<?php
							}
	                     ?>  
	                    </div>
	                </div>
                </div>

                <!-- Suscripciones -->
                <div class="col-12 mt-4">
                	<div class="description">
                        <h3 style="border-left: 2px solid red" class="pl-3"> Suscripciones</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12 text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_suscripciones" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar mis suscripciones" data-placement="bottom"></i>
	                    	</div>
	                    </div>
	                    <div id="mis_suscripciones">
	                     <?php  
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
													<form onsubmit="return desuscribirse()">
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

	                    </div>
	                </div>
                </div>
               
                <!-- <form class="form_eliminar_archivo">
                	<input type="hidden" name="form_eliminar_archivo_idarchivo" id="form_eliminar_archivo_idarchivo" value="'.$id_archivo.'">
                	<input type="hidden" name="form_eliminar_archivo_idmateria" id="form_eliminar_archivo_idmateria" value="'.$id_materia.'">
                	<input type="hidden" name="form_eliminar_archivo_ruta" id="form_eliminar_archivo_ruta" value="'.$ruta.'">
                	<button class="btn btn-outline-danger btn-sm btn_eliminar" type="submit">
                		ELIMINAR
					</button>
                </form> -->


            </div>
        </div>
           <!-- USER PROFILE ROW END-->
    </section>
	<?php 	
		require('modal_denunciar.php');
		require('modal_foto_perfil.php');
		require('modal_editar_perfil.php');
		require('modal_perfil.php');
		require('footer.php');
	?>

	<!-- Ref -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/navigationbar.js"></script>
</body>
</html>