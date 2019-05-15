<?php  
	$esta_en_login=false;
	require('db.php');
	$id_usuario = $_SESSION['id_usuario'];
	// Cargar usuarios
	$sql_usuarios = mysqli_query($db,"SELECT * FROM usuarios where id_usuario <> '$id_usuario' ORDER BY id_usuario ASC;");

	$sql_material = mysqli_query($db,"SELECT * FROM archivos ORDER BY id_archivo ASC;");	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Somos Estudiantes - Admin</title>
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
  	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<!-- <script type="text/javascript" src="js/perfil.js"></script> -->
	<script type="text/javascript" src="js/admin.js"></script>
</head>
<body id="page-top">
	<!-- Navigation Bar -->
    <?php
    	if($id_usuario == 2){
    		require('navigationbaradmin.php');
    	}else{
    		require('navigationbar.php');
    	}
    ?>
	<section class="p-5">
		<div class="container">
			<div class="row">
				<div class="col mb-5" id="buscadorMaterial">
					<h2> Sector de administración </h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					
					<div class="description">
                        <h3 style="border-left: 2px solid lightblue" class="pl-3"> Administrador de usuarios</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12 text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_usuarios" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar el contenido" data-placement="bottom"></i>	
	                    	</div>
	                    </div>
	                    <div id="administrador_usuarios" class="mt-3">
	                    	<div class="row">
		                     	<div class="col">
		                     			<table class="table">
										  <thead class="thead-dark">
										    <tr>
										      <th scope="col-1">Id Usuario</th>
										      <th scope="col-1">Nombre</th>
										      <th scope="col-1">Apellido</th>
										      <th scope="col-2">Email</th>
										      <th scope="col-1">Fecha de nacimiento</th>
										      <th scope="col-1">Dni</th>
										      <th scope="col-1">Carrera</th>
										      <th scope="col-4">Acciones</th>
										    </tr>
										  </thead>
										  <tbody id="body_table_usuarios">
	                     <?php  
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
									echo '
										<tr>
									      <th scope="row">'.$id_usuario .'</th>
									      <td>'. $usuario["nombre"] .'</td>
									      <td>'. $usuario["apellido"] .'</td>
									      <td>'. $usuario["email"] .'</td>
									      <td>'. $usuario["fecha_nacimiento"] .'</td>
									      <td>'. $usuario["dni"].'</td>
									      <td>'. $carrera_usuario .'</td>
									      <td>
									      <form class="form_editar_usuario">
									      <input type="hidden" id="input_id_usuario_editar" name="input_id_usuario_editar" value="'.$id_usuario.'">
									      	<button class="btn btn-sm btn-success btn-block" id="btn_editar_perfil">Editar</button>
									      	</form>
									      	<form onsubmit="return eliminar_usuario('.$id_usuario.')">
									      		<input type="hidden" id="input_id_usuario_eliminar" name="input_id_usuario_eliminar" value="'.$id_usuario.'">
									      		<button type="submit" class="btn btn-sm btn-danger btn-block" id="btnEliminar">Eliminar</button>
									      	</form>
									      	
									      </td>
									    </tr>';
								}
							}
	                     ?>
									    
									  </tbody>
									</table>
	                     	</div>
	                     </div>
	                    </div>
	                </div>

				</div>
			</div>

			<div class="row mt-4">
				<div class="col-12">
					
					<div class="description">
                        <h3 style="border-left: 2px solid lightblue" class="pl-3"> Administrador de material</h3>
	                    <hr/>
	                    <div class="row">
	                    	<div class="col-12 text-center">
	                    		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_material" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar el contenido" data-placement="bottom"></i>	
	                    	</div>
	                    </div>
	                    <div id="administrador_material" class="mt-3">
	                    	<div class="row">
		                     	<div class="col">
		                     			<table class="table">
										  <thead class="thead-dark">
										    <tr>
										      <th scope="col-1">Id Archivo</th>
										      <th scope="col-1">Título</th>
										      <th scope="col-1">Fecha</th>
										      <th scope="col-2">Dueño (id_usuario)</th>
										      <th scope="col-1">Tipo</th>
										      <th scope="col-1">Materia (id)</th>
										      <th scope="col-1">Detalles</th>
										      <th scope="col-1">Extension</th>
										      <th scope="col-1">Acciones</th>
										    </tr>
										  </thead>
										  <tbody id="body_table_archivos">
	                     <?php  
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
									    
									  </tbody>
									</table>
	                     	</div>
	                     </div>
	                    </div>
	                </div>

				</div>
			</div>


		</div>
	</section>



	<div id="poner_modal"></div>


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