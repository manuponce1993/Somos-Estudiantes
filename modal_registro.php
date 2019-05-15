<?php  
	// require ('db.php');
	define ('DB_HOST', "localhost");
	define ('DB_USER', "root");
	define ('DB_PASS', "");
	define ('DB_DB', "somos_estudiantes");

	//Create connection
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$carreras = mysqli_query($db, "SELECT * FROM carreras;");

?>

<!-- Modal DENUNCICAR-->
<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-secondary" id="exampleModalLabel">Registrarse</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	
	      	<form id="formregistro" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	          <div class="form-row">
	            <div class=" form-group col">
	              <p id="div_error_registro" style="color: red"></p>
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col">
	              <input name="nombre" type="text" class="form-control" required="" placeholder="Nombre" id="input_nombre">
	            </div>
	            <div class=" form-group col">
	              <input name="apellido" type="text" class="form-control" required="" placeholder="Apellido" id="input_apellido">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <input name="email" type="email" class="form-control" required="" placeholder="Correo electrónico" id="input_email" title="Ingrese su correo electrónico">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <input name="registro_fecha_nac" type="date" required="" class="form-control" id="registro_fecha_nac" title="Ingrese su fecha de nacimiento">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <select id="registro_select_carrera" class="form-control input-sm" required="">
	              		<option value="" disabled selected>Seleccione su carrera</option>
      					<?php  
      						if($carreras->num_rows > 0){
						        // Mostrar las carreras cargadas
						    	while ($carrera =  mysqli_fetch_assoc($carreras)) {
						    		$selected="";
						    		if($id_carrera == $carrera['id_carrera']){
						    			$selected="selected";
						    		}
						    		?>
						    			<option value= <?= $carrera['id_carrera'] ?> <?php  echo " ".$selected ?>  ><?php echo utf8_encode($carrera['carrera']); ?></option>
						    		<?php		
						    	}
						    }else{
						        echo "no hay carreras cargadas";
						    }
      					?>
	      			</select>
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <input name="contrasena" type="Password" required="" class="form-control" placeholder="Contraseña" id="input_contrasena">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <input name="contrasena_rep" type="password" class="form-control" required="" placeholder="Repita la contraseña" id="input_contrasena_rep">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class="col-12 text-center">
	              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Registrarse</button>
	            </div>
	          </div>
	        
	        </form>

	      </div>
	    </div>
	  </div>
	</div>
</div>