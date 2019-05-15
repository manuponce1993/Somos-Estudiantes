<?php 
	require ('db.php');
	$id_archivo = $_POST['input_id_archivo_editar'];
	$archivo =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM archivos WHERE id_archivo = '$id_archivo';"));
	$titulo = $archivo['titulo'];
	$fecha = $archivo['fecha_subido'];
	$id_usuario = $archivo['id_usuario'];
	$tipo = $archivo['tipo'];
	$id_materia = $archivo['id_materia'];
	$detalles = $archivo['detalles'];
	$extension = $archivo['extension'];

echo '<div class="modal fade" id="modal_editar_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-secondary" id="exampleModalLabel">Editar archivo</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	
	      	<form id="form_editar_archivo" method="POST">
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Título</label>
	              <input name="titulo" type="text" class="form-control" required="" placeholder="Título" id="input_titulo" title="Ingrese el título" value="'. $titulo .'">
	              <input name="id_archivo" type="hidden" id="input_id_archivo" value="'. $id_archivo .'">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Fecha</label>
	              <input name="fecha" type="date" class="form-control" required="" placeholder="Fecha" id="input_fecha" title="Ingrese la fecha del archivo" value="'. $fecha .'">
	            </div>
	          </div>
	          <div class="form-row">
	            <div class=" form-group col-12">
	              <label for="nombre">Detalles</label>
	              <textarea class="form-control" id="input_archivo_detalles" name="detalles" placeholder="Detalles...">'.$detalles.'</textarea>
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
</div>';
?>