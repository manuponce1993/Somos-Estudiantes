<?php 

	require('db.php');

	$id_archivo = $_POST['form_eliminar_archivo_idarchivo'];	
	$ruta = $_POST['form_eliminar_archivo_ruta'];
	unlink($ruta);
	
	$sql = "DELETE FROM `archivos` 
                WHERE id_archivo='$id_archivo'";
	mysqli_query($db, $sql);

	// // Mostrar 
	// $id_usuario = $_SESSION['id_usuario'];
	// // Cargar ultimos 10 archivos (Ultimos archivos subidos por la comunidad)
	// $sql = mysqli_query($db,"SELECT * FROM archivos ORDER BY fecha_subido DESC LIMIT 4;");
	// // Mis archivos
	// $sql_mis_archivos = mysqli_query($db,"SELECT * FROM archivos WHERE id_usuario = '$id_usuario';");
	
	// Ultimos archivos subidos por la comunidad 
       //          echo '<div class="col-12">
       //          	<div class="description">
       //                  <h3 style="border-left: 2px solid lightblue" class="pl-3"> Últimos archivos subidos por la comunidad</h3>
	      //               <hr/>
	      //               <div class="row">
	      //               	<div class="col-12 text-center">
	      //               		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_ultimos_archivos" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar el contenido"></i>	
	      //               	</div>
	      //               </div>
	      //               <div id="ultimos_archivos">';
	      //                	if($sql->num_rows > 0){
							// 	while ($archivo =  mysqli_fetch_assoc($sql)){
							// 		$id_materia=$archivo["id_materia"];
							// 		$tipo=$archivo["tipo"];
							// 		if($tipo=="parcial"){
							// 			$tipo="Parcial";
							// 		}elseif ($tipo=="resumen") {
							// 			$tipo="Resúmen";
							// 		}elseif ($tipo=="tp") {
							// 			$tipo="Trabajo práctico";
							// 		}elseif ($tipo=="mutil") {
							// 			$tipo="Material útil";
							// 		}
							// 		$materia =  mysqli_fetch_assoc(mysqli_query($db,"SELECT materias.materia FROM (`archivos`
	      //          INNER JOIN materias ON materias.id_materia = archivos.id_materia)
	      //          WHERE archivos.id_materia = '$id_materia'"));


							// 		$id_usuario = $archivo["id_usuario"];
							// 		$usuario =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';"));
							// 		$ruta = "archivos/".$archivo["id_materia"]."/".$archivo["id_archivo"].".".$archivo["extension"];
									
							//     	echo '<div class="row">
							// 			<div class="col-12">
							// 				<div class="row">
							// 					<div class="col">
							// 						<div class="hr-sect">' . $archivo["fecha_subido"] . '</div>
							// 					</div>
							// 				</div>
							// 				<div class="row">
							// 					<div class="col-12 col-sm-12 col-lg-3 mb-3 text-center">
							// 						<!-- foto -->
							// 						<img src="resources/extensiones/'.$archivo["extension"].'.png" class="img-fluid img-thumbnail w-50" style=" max-width: 50%;" alt="Responsive image">
							// 					</div>
							// 					<div class="col-12 col-sm-12 mb-3 col-lg-7">
							// 						<!-- Texto descriptivo -->
							// 						<div class="row">
							// 							<div class="col-12"><h5><a class="link_archivo text-success" href="'.$ruta.'" download="'.$archivo["titulo"].'">'. $archivo["titulo"] .'</a></h5></div>
							// 						</div>


							// 						<div class="row">
							// 							<div class="col"><span class="lead text-secondary">'.$materia["materia"].' - '.$tipo.'</span> </div>
							// 						</div>
							// 						<div class="row">
							// 							<div class="col"><span class="lead">Usuario: '. $usuario["nombre"] .' ' . $usuario["apellido"] .'</span> </div>
							// 						</div>
							// 						<div class="row">
							// 							<div class="col"><span class="lead">Detalles: '. $archivo["detalles"] .'</span></div>
							// 						</div>
							// 						<div class="row">
							// 						  	<select id="example">
							// 							  <option value="1">1</option>
							// 							  <option value="2">2</option>
							// 							  <option value="3">3</option>
							// 							  <option value="4">4</option>
							// 							  <option value="5">5</option>
							// 							</select>
							// 						</div>

							// 					</div>
							// 					<div class="col-12 col-sm-12 col-lg-2 pl-lg-0">
							// 						<!-- Denunciar -->
							// 						<button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal_denunciar">
							// 							DENUNCIAR
							// 						</button>
							// 					</div>
							// 				</div>
							// 			</div>
							// 		</div>';
							//     }
							// }
	                       
	      //               echo '</div>
	      //           </div>
       //          </div>

       //          <!-- Mis archivos -->
       //          <div class="col-12 mt-4">
       //          	<div class="description">
       //                  <h3 style="border-left: 2px solid lightblue" class="pl-3"> Mis archivos</h3>
	      //               <hr/>
	      //               <div class="row">
	      //               	<div class="col-12 text-center">
	      //               		<i class="text-center fas fa-arrow-down text-secondary" id="mostrar_ocultar_mis_archivos" data-toggle="popover" data-trigger="hover" data-content="Haga click para mostrar mis archivos"></i>
	      //               	</div>
	      //               </div>
	      //               <div id="mis_archivos">';

	      //                	if($sql_mis_archivos->num_rows > 0){
							// 	while ($archivo =  mysqli_fetch_assoc($sql_mis_archivos)){
							// 		$id_materia=$archivo["id_materia"];
							// 		$tipo=$archivo["tipo"];
							// 		$id_archivo=$archivo["id_archivo"];
							// 		if($tipo=="parcial"){
							// 			$tipo="Parcial";
							// 		}elseif ($tipo=="resumen") {
							// 			$tipo="Resúmen";
							// 		}elseif ($tipo=="tp") {
							// 			$tipo="Trabajo práctico";
							// 		}elseif ($tipo=="mutil") {
							// 			$tipo="Material útil";
							// 		}
							// 		$materia =  mysqli_fetch_assoc(mysqli_query($db,"SELECT materias.materia FROM (`archivos`
	      //          INNER JOIN materias ON materias.id_materia = archivos.id_materia)
	      //          WHERE archivos.id_materia = '$id_materia'"));


							// 		$id_usuario = $archivo["id_usuario"];
							// 		$usuario =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';"));
							// 		$ruta = "archivos/".$archivo["id_materia"]."/".$archivo["id_archivo"].".".$archivo["extension"];
									
							//     	echo '<div class="row">
							// 			<div class="col-12">
							// 				<div class="row">
							// 					<div class="col">
							// 						<div class="hr-sect">' . $archivo["fecha_subido"] . '</div>
							// 					</div>
							// 				</div>
							// 				<div class="row">
							// 					<div class="col-12 col-sm-12 col-lg-3 mb-3 text-center">
							// 						<!-- foto -->
							// 						<img src="resources/extensiones/'.$archivo["extension"].'.png" class="img-fluid img-thumbnail w-50" style=" max-width: 50%;" alt="Responsive image">
							// 					</div>
							// 					<div class="col-12 col-sm-12 mb-3 col-lg-7">
							// 						<!-- Texto descriptivo -->
							// 						<div class="row">
							// 							<div class="col-12"><h5><a class="link_archivo text-success" href="'.$ruta.'" download="'.$archivo["titulo"].'">'. $archivo["titulo"] .'</a></h5></div>
							// 						</div>


							// 						<div class="row">
							// 							<div class="col"><span class="lead text-secondary">'.$materia["materia"].' - '.$tipo.'</span> </div>
							// 						</div>
							// 						<div class="row">
							// 							<div class="col"><span class="lead">Usuario: '. $usuario["nombre"] .' ' . $usuario["apellido"] .'</span> </div>
							// 						</div>
							// 						<div class="row">
							// 							<div class="col"><span class="lead">Detalles: '. $archivo["detalles"] .'</span></div>
							// 						</div>
							// 						<div class="row">
							// 						  	<select id="example">
							// 							  <option value="1">1</option>
							// 							  <option value="2">2</option>
							// 							  <option value="3">3</option>
							// 							  <option value="4">4</option>
							// 							  <option value="5">5</option>
							// 							</select>
							// 						</div>

							// 					</div>
							// 					<div class="col-12 col-sm-12 col-lg-2 pl-lg-0">
							// 						<!-- Eliminar -->

							// 						<form class="form_eliminar_archivo">
							// 		                	<input type="hidden" name="form_eliminar_archivo_idarchivo" id="form_eliminar_archivo_idarchivo" value="'.$id_archivo.'">
							// 		                	<input type="hidden" name="form_eliminar_archivo_idmateria" id="form_eliminar_archivo_idmateria" value="'.$id_materia.'">
							// 		                	<input type="hidden" name="form_eliminar_archivo_ruta" id="form_eliminar_archivo_ruta" value="'.$ruta.'">
							// 		                	<button class="btn btn-outline-danger btn-sm btn_eliminar" type="submit">
							// 		                		ELIMINAR
							// 							</button>
							// 		                </form>

							// 					</div>
							// 				</div>
							// 			</div>
							// 		</div>';
							//     }
							// }
	                       
	      //               echo '</div>
	      //           </div>
       //          </div>	';
?>