
	<!-- Modal SUBIR ARCHIVO-->
	<div class="modal fade" id="modal_subir_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal_subir_archivo_titulo">Nuevo archivo</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form enctype="multipart/form-data" method="POST" action="administrar_archivos.php" id="form_subir_archivo">
	        	<!-- input hidden para mandar al servidor el tipo de archivo (se carga en material.js al momento de hacer clic sobre uno de los posibles archivos (parcial, resumen, mutil y tp)) -->
	        	<div class="form-group">
	        		<input type="hidden" name="input_tipo" id="input_tipo">	
	        	</div>
	        	<!-- input hidden para mandar al servidor el id_materia (se carga en material.js al momento de seleccionar el select de la materia) -->
	        	<div class="form-group">
	        		<input type="hidden" name="input_id_materia" id="input_id_materia">	
	        	</div>
	          <div class="form-group">
	            <!-- <label for="recipient-name" class="col-form-label">Título:</label> -->
	            <input type="text" class="form-control" name="input_archivo_titulo" id="input_archivo_titulo" placeholder="Título">
	          </div>
	          <div class="form-group">
	            <!-- <label for="message-text" class="col-form-label">Detalles:</label> -->
	            <textarea class="form-control" id="input_archivo_detalles" name="input_archivo_detalles" placeholder="Detalles..."></textarea>
	          </div>

	          <!-- <div class="custom-file">
			    <input type="file" class="file" name="file" id="file" size="80" multiple 
    data-show-upload="false" data-show-caption="true" data-msg-placeholder="Seleccione archivos para subir..."><br>
			  </div> -->
		
				<div class="file-loading">
				    <input id="file" name="file" type="file" data-show-upload="false" data-msg-placeholder="Seleccione un archivo para subir..." multiple>
				</div>
	        <!-- </form> -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar_modal_subir_archivo">Cerrar</button>
	        <button type="submit" class="btn btn-success">Subir</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>

	<script>
	$("#file").fileinput({
	    language: "es",
	    theme: "fa",
	    allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc","docx",]

	});
	</script>