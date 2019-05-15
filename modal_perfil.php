<div class="modal fade" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-secondary" id="modal_perfil_nombre">Nombre usuario</h5>
          </div>
          <div class="modal-body">
            
            <!-- PERFIL DE USUARIO-->
            <div class="row">
                <div class="col">                     
                    <div class="user-wrapper">
                        <!-- <img src="user-profile/assets/img/1.jpg" class="img-responsive" />  -->
                            <img id="img_foto_perfil_archivo" src="" class="img-responsive"/>
                        <div class="description">
                           <form id="form_modal_perfil">
                               <input type="hidden" name="modal_perfil_id_usuario" id="modal_perfil_id_usuario" value="">
                                <h5 id="modal_perfil_carrera" class="text-center"></h5>
                                <div class="row">
                                  <div class="col-6">
                                  <p id="modal_identificador">
                                    id
                                  </p>
                                  <p id="modal_perfil_anios" >
                                    edad 
                                  </p>
                                </div>
                                <div class="col-6">
                                  <p id="modal_perfil_cantidad_suscriptores" class="text-right">
                                    
                                  </p>
                                  <p id="modal_perfil_cantidad_archivos" class="text-right">
                                    
                                  </p>
                                </div>
                                </div>
                                <hr />
                                <div class="col text-center">
                                  <button class="btn btn-success" id="modal_perfil_suscribirse">
                                    Suscribirse
                                </button>  
                                </div>
                                
                           </form> 
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>    