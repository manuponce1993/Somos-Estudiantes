<?php 

	$id_usuario = $_SESSION['id_usuario'];
	$usuario =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';"));
	$nombre = $usuario['nombre'];
	$apellido = $usuario['apellido'];
	$email = $usuario['email'];
	$fecha_nacimiento = $usuario['fecha_nacimiento'];
	$dni = $usuario['dni'];
	$id_carrera = $usuario['id_carrera'];
	$carreras = mysqli_query($db, "SELECT * FROM carreras;");
?>

<div class="modal fade" id="modal_editar_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-secondary" id="exampleModalLabel">Editar perfil</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	
	      	<form id="form_editar_perfil" method="POST">
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Nombre</label>
	              <input name="nombre" type="text" class="form-control" required="" placeholder="Nombre" id="input_nombre" title="Ingrese su nombre" value="<?= $nombre ?>">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Apellido</label>
	              <input name="apellido" type="text" class="form-control" required="" placeholder="Apellido" id="input_apellido" title="Ingrese su apellido" value="<?= $apellido ?>">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Dni</label>
	              <input name="dni" type="text" class="form-control" required="" placeholder="Ingrese su dni" id="input_dni" value="<?= $dni ?>">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Fecha de nacimiento</label>
	              <input name="fecha_nac" type="date" required="" class="form-control" id="input_fecha_nac" title="Ingrese su fecha de nacimiento" value="<?= $fecha_nacimiento ?>">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Correo electrónico</label>
	              <input name="email" type="email" class="form-control" required="" placeholder="Correo electrónico" id="input_email" value="<?= $email ?>">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="carrera">Carrera</label>
	              <select id="select_carrera" class="form-control input-sm">
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
	            <div class="col-12 text-center">
	              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Guardar</button>
	            </div>
	          </div>
	        </form>

	      </div>
	    </div>
	  </div>
	</div>
</div>