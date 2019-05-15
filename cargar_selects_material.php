<?php 
	require('db.php');

	if(isset($_POST['id_carrera']) && !empty($_POST['id_carrera'])){

		$id_carrera = $_POST['id_carrera'];

		// Query para levantar todos los años de esa carrera

		$anios = mysqli_query($db, "SELECT * FROM anios WHERE id_carrera='$id_carrera';");
        if($anios->num_rows > 0){
	        echo '<option value="" disabled selected>Seleccione un año</option>';
        	while ($anio =  mysqli_fetch_assoc($anios)){
	        	echo '<option value="' . $anio['id_anio'] . '">' . utf8_encode($anio['anio']) . '</option>';
	        }
        }else{
        	echo '<option value="">No hay años cargados</option>';
        }
	}

	if(isset($_POST['id_anio']) && !empty($_POST['id_anio'])){

		$id_anio = $_POST['id_anio'];

		// Query para levantar todos los años de esa carrera

		$materias = mysqli_query($db, "SELECT materias.id_materia ,materias.materia 
									FROM (materia_anio
									INNER JOIN materias ON materia_anio.id_materia = materias.id_materia)
									WHERE materia_anio.id_anio = '$id_anio';");
        if($materias->num_rows > 0){
        	echo '<option value="" disabled selected>Seleccione una materia</option>';
        	while ($materia =  mysqli_fetch_assoc($materias)){
	        	echo '<option value="' . $materia['id_materia'] . '">' . utf8_encode($materia['materia']) . '</option>';
	        }
        }else{
        	echo '<option value="">No hay materias cargadas</option>';
        }
	}

	if(isset($_POST['id_materia']) && !empty($_POST['id_materia'])){

		$id_materia = $_POST['id_materia'];

		$cantidad_parciales = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='parcial' AND id_materia='$id_materia';"));
		$cantidad_resumenes = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='resumen'AND id_materia='$id_materia';"));
		$cantidad_tp = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='tp'AND id_materia='$id_materia';"));
		$cantidad_mutil = mysqli_fetch_assoc( mysqli_query($db, "SELECT COUNT(id_archivo) as total FROM archivos WHERE tipo='mutil'AND id_materia='$id_materia';") );
	

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

?>