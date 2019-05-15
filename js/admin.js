function eliminar_usuario(id_usuario_elim) {
	swal({
	  title: "¿Estás seguro de eliminar este usuario?",
	  text: "Una vez eliminado, el usuario no se podrá recuperar",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	$.ajax({
			url: 'eliminar_usuario.php',
			type: 'POST',
			data: {
				id_usuario_eliminar: id_usuario_elim
			},
			success: function (data) {
				console.log(data);
				$.ajax({
					url: 'admin_cargar_usuarios.php',
					type: 'POST',
					success: function (datos) {
						$("#body_table_usuarios").html(datos);
						swal("Hecho","El usuario se eliminó correctamente","success");
					}
				});
				
			}
		});
	  }else{
	  	swal("No se ha eliminado el usuario");
	  }
	});
	return false;
}

function eliminar_archivo(id_archivo) {
	swal({
	  title: "¿Estás seguro de eliminar este archivo?",
	  text: "Una vez eliminado, el archivo no se podrá recuperar",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	$.ajax({
			url: 'admin_eliminar_archivo.php',
			type: 'POST',
			data: {
				id_archivo_eliminar: id_archivo
			},
			success: function (data) {
				console.log(data);
				$.ajax({
					url: 'admin_cargar_archivos.php',
					type: 'POST',
					success: function (datos) {
						$("#body_table_archivos").html(datos);
						swal("Hecho","El archivo se eliminó correctamente","success");
					}
				});
				
			}
		});
	  }else{
	  	swal("No se ha eliminado el archivo");
	  }
	});
	return false;
}


$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
	$("#navbaradmin").addClass('active');
	$("#navbaradmin").prop('href','#page-top');
	$("#navbarinicio").prop('href', 'index.php');
	$("#navbarcontacto").prop('href', 'contacto.php');

	$("#administrador_usuarios").hide();
	$("#administrador_material").hide();

	$("#mostrar_ocultar_usuarios").click(function() {
		$("#administrador_usuarios").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_usuarios").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_usuarios").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_usuarios").addClass('fa-arrow-up');
				$("#mostrar_ocultar_usuarios").attr('data-content', 'Haga click para ocultar el contenido');
			}else{
				$("#mostrar_ocultar_usuarios").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_usuarios").addClass('fa-arrow-down');
				$("#mostrar_ocultar_usuarios").attr('data-content', 'Haga click para mostrar el contenido');
			}
		});
	});
	$("#mostrar_ocultar_material").click(function() {
		$("#administrador_material").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_material").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_material").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_material").addClass('fa-arrow-up');
				$("#mostrar_ocultar_material").attr('data-content', 'Haga click para ocultar el contenido');
			}else{
				$("#mostrar_ocultar_material").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_material").addClass('fa-arrow-down');
				$("#mostrar_ocultar_material").attr('data-content', 'Haga click para mostrar el contenido');
			}
		});
	});
	
	$(".form_editar_usuario").submit(function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: 'admin_modal_editar_usuario.php',
			type: 'POST',
			data: formData,
			success: function (datos) {
				$('#poner_modal').html(datos); 
				$('#modal_editar_perfil').modal('show');
				// Ajax para editar el usuario seleccionado

				$("#form_editar_perfil").submit(function(event) {
					var formData = new FormData(this);
					$.ajax({
				        url: 'admin_editar_usuario.php',
				        type: 'POST',
				        data: formData,
				        success: function(response){
				            //sacar espacios. Preguntar por que se generan espacios en model/ingreso.php/echo "success"
				            String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
				            if(response.trim()=="success"){
				            	$('#modal_editar_perfil').modal('hide');
				                // swal("Hecho","El perfil se modificó correctamente","success");
				                // window.location.replace("perfil.php");
				             	
				             	swal({
								  title: "Hecho",
								  text: "El perfil se modificó correctamente",
								  icon: "success",
								})
								.then(willDelete => {
								   window.location.replace("admin.php");
								});
				            }
				            else{
				            	console.log(response);
				                swal("Error","El correo electrónico ya se encuentra registrado","error");
				            }
				        },
				        cache: false,
				        contentType: false,
				        processData: false
			    	});
			    	return false;
				});

			},
			cache: false,
	        contentType: false,
	        processData: false
		});
		return false;		
	});

	// Falta editar archivo, esto
	$(".form_editar_archivo").submit(function(e) {
		e.preventDefault();
		var formData2 = new FormData(this);
		$.ajax({
			url: 'admin_modal_editar_archivo.php',
			type: 'POST',
			data: formData2,
			success: function (datos) {
				$('#poner_modal').html(datos); 
				$('#modal_editar_archivo').modal('show');
				// Ajax para editar el archivo seleccionado

				$("#form_editar_archivo").submit(function(event) {
					var formData = new FormData(this);
					$.ajax({
				        url: 'admin_editar_archivo.php',
				        type: 'POST',
				        data: formData,
				        success: function(response){
				            //sacar espacios. Preguntar por que se generan espacios en model/ingreso.php/echo "success"
				            String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
				            if(response.trim()=="success"){
				            	$('#modal_editar_archivo').modal('hide');
				                // swal("Hecho","El perfil se modificó correctamente","success");
				                // window.location.replace("perfil.php");
				             	
				             	swal({
								  title: "Hecho",
								  text: "El archivo se modificó correctamente",
								  icon: "success",
								})
								.then(willDelete => {
								   window.location.replace("admin.php");
								});
				            }
				            else{
				            	console.log(response);
				                swal("Error","No se pudo editar el archivo","error");
				            }
				        },
				        cache: false,
				        contentType: false,
				        processData: false
			    	});
			    	return false;
				});

			},
			cache: false,
	        contentType: false,
	        processData: false
		});
		return false;		
	});

});
