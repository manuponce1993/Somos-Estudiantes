<!-- Modal DENUNCICAR-->
<div class="modal fade" id="modal_ingreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-primary" id="exampleModalLabel">Ingresar</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	
	      	<form id="formsesion" method="POST">
          <div class="form-row text-center">
              <div class=" form-group text-center">
                <p id="div_error_login" style="color: red"></p>
              </div>
            </div>
          <div class="form-row">
            <div class=" form-group col-12">
              <input name="ingreso_email" required="" type="text" class="form-control" placeholder="Email o Alias" id="ingreso_email">
            </div>
          </div>
          <div class="form-row">
            <div class=" form-group col-12">
              <input name="ingreso_contrasena" required="" type="password" class="form-control" placeholder="Contraseña" id="ingreso_contrasena">
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 text-center">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Entrar</button>
            </div>
          </div>
        </form>

	      </div>
	    </div>
	  </div>
	</div>
</div>