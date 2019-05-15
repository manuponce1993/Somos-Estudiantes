<?php 
	require('db.php');

	if($_FILES["file"]["error"] > 0){
		echo "fail";
		 
	} else{

		$titulo = $_POST['input_archivo_titulo'];
		$fecha_subido = date("Y-m-d");
		$id_usuario = $_SESSION['id_usuario'];
		$tipo =  $_POST['input_tipo'];
		$id_materia =  $_POST['input_id_materia'];
		$detalles =  $_POST['input_archivo_detalles'];
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

		// Se inserta el archivo y se toma el id generado
		$sql = "INSERT INTO `archivos`(`titulo`, `fecha_subido`, `id_usuario`, `tipo`, `id_materia`, `detalles`, `extension`) 
                VALUES ('$titulo','$fecha_subido','$id_usuario','$tipo','$id_materia','$detalles','$extension' );";
		if (mysqli_query($db, $sql)){
			// Preguntar si puede haber problemas de sincronizacion y obtener el id incorrecto.
		    $id_archivo = mysqli_insert_id($db);

			// Ruta: archivos/id materia/id archivo.extension	
			$ruta_archivo ="archivos/" . $id_materia . "/" ;
			
			// Si no existe la ruta, la crea
			if ( ! is_dir($ruta_archivo)) {
	    		mkdir($ruta_archivo);
			}

			$path = $_FILES['file']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);


			// Muevo el archivo a la ruta archivos/id usuario/id_archivo.extension 
			move_uploaded_file($_FILES["file"]["tmp_name"] , $ruta_archivo . $id_archivo . "." . $ext);
			// echo $titulo . $fecha_subido . $id_usuario . $tipo . $id_materia . $detalles . $id_archivo . $ext;

			// Recargar
			$cantidad_parciales = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='parcial' AND id_materia='$id_materia';"));
			$cantidad_resumenes = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='resumen' AND id_materia='$id_materia';;"));
			$cantidad_tp = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='tp' AND id_materia='$id_materia';;"));
			$cantidad_mutil = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='mutil' AND id_materia='$id_materia';;") );
		

			echo '<div class="col-xl-3 col-sm-6 py-2">
						<div class="card bg-secondary h-100" id="card_parciales">
							<a class="item" id="link_parciales">
		                        <div class="card-body">
		                            <div class="rotate">
		                                <i class="fa fa-tasks fa-4x"></i>
		                            </div>
		                            <h6 class="text-uppercase">Parciales</h6>
		                            <h1 class="display-4">' . $cantidad_parciales['total'] . '</h1>
		                        </div>
	                        </a>
	                    </div>
	                </div>

	                <div class="col-xl-3 col-sm-6 py-2">
	            		<div class="card bg-secondary h-100" id="card_resumenes">
	            			<a class="item" id="link_resumenes" >
		                        <div class="card-body">
		                            <div class="rotate">
		                                <i class="fa fa-list fa-4x"></i>
		                            </div>
		                            <h6 class="text-uppercase">Resúmenes</h6>
		                            <h1 class="display-4">' . $cantidad_resumenes['total'] . '</h1>
		                        </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-xl-3 col-sm-6 py-2">
	            		<div class="card bg-secondary h-100 view zoom" id="card_tp">
	            			<a class="item" id="link_tp">
		                        <div class="card-body">
		                            <div class="rotate">
		                                <i class="fa fa-edit fa-4x"></i>
		                            </div>
		                            <h6 class="text-uppercase">Trabajos prácticos</h6>
		                            <h1 class="display-4">' . $cantidad_tp['total'] . '</h1>
		                        </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-xl-3 col-sm-6 py-2">
	            		<div class="card bg-secondary h-100" id="card_mutil">
	            			<a class="item" id="link_mutil">
		                        <div class="card-body">
		                            <div class="rotate">
		                                <!-- <i class="fa fa-share fa-4x"></i> -->
		                                <i class="fa fa-book fa-4x"></i>
		                            </div>
		                            <h6 class="text-uppercase">Material útil</h6>
		                            <h1 class="display-4">' . $cantidad_mutil['total'] . '</h1>
		                        </div>
	                        </a>
	                    </div>
	                </div>';
		}
	}
?>