<!-- Modal SUBIR ARCHIVO-->
	<div class="modal fade" id="modal_foto_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cargar foto de perfil</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form enctype="multipart/form-data" method="POST" id="form_foto_perfil">
				<div class="file-loading">
				    <input id="file" name="file" type="file" data-show-upload="false" data-msg-placeholder="Seleccione un archivo para subir..." multiple>
				</div>
	        <!-- </form> -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar_modal_foto_perfil">Cerrar</button>
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
	    allowedFileExtensions: ["jpg", "png"]
	});
	</script>