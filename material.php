<?php  
	$esta_en_login=false;
	require('db.php');
	$id_usuario = $_SESSION['id_usuario'];
	$carreras = mysqli_query($db, "SELECT * FROM carreras;");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Somos Estudiantes - Material</title>
	
	<?php 
		require('head.php'); 
	?>
	<link rel="stylesheet" type="text/css" href="css/material.css">
	<link rel="stylesheet" type="text/css" href="css/estrellas.css">
	<script type="text/javascript" src="js/material.js"></script>
	<!-- <script type="text/javascript" src="js/cargar_selects_material.js"></script> -->
</head>
<body id="page-top">
	

    <!-- Navigation Bar -->
    <?php 
	    if($id_usuario == 2){
			require('navigationbaradmin.php');
		} else{
			require('navigationbar.php');
		}
    ?>

	<!-- Container -->
	<section class="p-5">
		<div class="container">
			<div class="row">
				<div class="col" id="buscadorMaterial">
					<h2 >Buscador de material</h2>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p class="text-muted mt-3">Para acceder al material buscado, seleccione la carrera, el año y la materia deseada, en dicho orden.</p>
				</div>
			</div>
			<form class="mt-4">	
				<div class="form-group row">	
					<label for="select_carrera" class="col-xl-1 col-sm-6 col-12 col-form-label col-form-label-sm px-0 mt-2 mt-xl-0">
					<img src="resources/oneprev.png" id="img_number_1" class="img-fluid"> Carrera</label>
	      			<div class="col-xl-3 col-sm-6 col-12 pl-0 mt-2 mt-xl-0">
	      				<select id="select_carrera" class="form-control input-sm">
      					    <option value="" disabled selected>Seleccione una carrera</option>
	      					<?php  
	      						if($carreras->num_rows > 0){
							        // Mostrar las carreras cargadas
							    	while ($carrera =  mysqli_fetch_assoc($carreras)) {
							    		?>
							    			<option value= <?= $carrera['id_carrera'] ?> ><?php echo utf8_encode($carrera['carrera']); ?></option>
							    		<?php		
							    	}
							    }else{
							        echo "no hay carreras cargadas";
							    }
	      					?>
		      			</select>
	      			</div>
	      			<label for="select_anio" class="col-xl-1 col-sm-6 col-12 col-form-label col-form-label-sm px-0 mt-2 mt-xl-0"><img src="resources/twoprev.png" id="img_number_2" class="ml-xl-3"> Año </label>
	      			<div class="col-xl-3 col-sm-6 col-12 pl-0 mt-2 mt-xl-0">
	      				<select id="select_anio" class="form-control">
		        			<option value="" disabled selected>Seleccione una carrera primero</option>
		      			</select>
	      			</div>
	      			<label for="select_materia" class="col-xl-1 col-sm-6 col-12 col-form-label col-form-label-sm px-0 mt-2 mt-xl-0"><img src="resources/threeprev.png" id="img_number_3"> Materia </label>
	      			<div class="col-xl-3 col-sm-6 col-12 pl-0 mt-2 mt-xl-0">
	      				<select id="select_materia" class="form-control">
		        			<option value="" disabled selected>Seleccione un año primero</option>
		      			</select>
	      			</div>
				</div>
			</form>
		</div>	
	</section>

	<section class="pt-3">
		<div class="container" id="container_opciones">
			<div class="row">
				<div class="col">
					<h1 id="titulo_materia_cargada" class="text-center text-secondary"></h1>
				</div>
			</div>
			<div class="row" id="div_seleccion_archivos">
				<div class="col-xl-3 col-sm-6 py-2">
					<div class="card bg-secondary h-100" id="card_parciales">
						<a class="item" id="link_parciales">
	                        <div class="card-body">
	                            <div class="rotate">
	                                <i class="fa fa-tasks fa-4x"></i>
	                            </div>
	                            <h6 class="text-uppercase">Parciales</h6>
	                            <h1 class="display-4">-</h1>
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
	                            <h1 class="display-4">-</h1>
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
	                            <h1 class="display-4">-</h1>
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
	                            <h1 class="display-4">-</h1>
	                        </div>
                        </a>
                    </div>
                </div>
			</div>
		</div>
		<div class="container mt-5 pt-3 border bg-light" id="container_archivos">
			<div class="row" >
				<div class="col text-center">
					<!-- Ojo que se modifica en materia.js -->
					<h2 class="text-secondary" id="titulo_categoria">Sin seleccionar categoría <i class="fas fa-info-circle" title="Información" data-toggle="popover" data-trigger="hover" data-content="Para visualizar el material debe presionar sobre una de las categorías anteriores (parciales, resúmenes, trabajos prácticos o material útil).">
						
					</i></h2>


					<!-- Buscador -->
					<div class="input-group mb-3">
		              <input id="input_palabra_buscar" type="text" class="form-control" placeholder="Buscar archivo o usuario" aria-label="ejemplo@tuemail.com" aria-describedby="basic-addon2">
		              <div class="input-group-append">
		                <button id="btn_buscar_archivo" class="btn btn-outline-secondary" type="button">
		                  <i class="fas fa-angle-right"></i>
		                </button>
		              </div>
		            </div>
		            <!-- Subir archivo -->
		            <button class="btn text-white" id="btn_subir_archivo" data-toggle="modal" data-target="#modal_subir_archivo"></button>
				</div>
			</div>
			<div class="container pb-2" id="container_archivos_mostrados">
				
				
			</div>
		</div>
	</section>

	<?php 
		require('footer.php');
		require('modal_subir_archivo.php');
		require('modal_denunciar.php');
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