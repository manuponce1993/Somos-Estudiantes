function mostrar_datos_usuario_archivo(nomyapp, rutaFotoPerfil, carrera, id_usuario, edad, cantSuscriptores, cantArchivos) {
	$("#modal_perfil_nombre").html(nomyapp);
	$("#img_foto_perfil_archivo").attr('src', rutaFotoPerfil);
	$("#modal_perfil_carrera").html(carrera);
	$("#modal_perfil_anios").html("<strong>Edad: </strong> "+edad+" años");
	$("#modal_perfil_cantidad_suscriptores").html('<strong>Suscriptores: </strong>'+cantSuscriptores);
	$("#modal_identificador").html('<strong>Identificador: </strong> '+id_usuario);
	$("#modal_perfil_cantidad_archivos").html('<strong>Archivos subidos: </strong> '+cantArchivos);
	$("#modal_perfil_id_usuario").val(id_usuario);
	$("#modal_perfil").modal('show');
}

// No pude hacerlo por onsubmit. Al cargar nuevamente las suscripciones, no lanzaba el evento
// $("#form_desuscribirse").on('submit', function(e)... PREGUNTAR POR QUÉ. Es decir,
// no entraba a esa parte de js.
function desuscribirse() {

	swal({
		  title: "¿Estás seguro de desuscribirte de este usuario?",
		  text: "Una vez desuscripto, puede volver a suscribirse",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    $.ajax({
		        url: 'desuscribirse.php',
		        type: 'POST',
		        data: {
		        	id_usuario_desuscribirse: $("#id_usuario_desuscribirse_form").val()
		        },
		        success: function (data) {
		        	swal("Hecho","Se desuscribió correctamente","success");
		        	$.ajax({
							url: 'cargar_suscripciones.php',
							type: 'POST',
							success: function (datos) {
								$("#mis_suscripciones").html(datos);
							}
					});
					$.ajax({
							url: 'cargar_archivos_suscriptos.php',
							type: 'POST',
							success: function (datos) {
								$("#archivos_suscritos").html(datos);
							}
					});
		        }
		    }); 
		  } else {
		    swal("No se desuscribió");
		  }
		});
		return false;
}

$(document).ready(function() {		
	$('[data-toggle="popover"]').popover();
    $("#navbarperfil").addClass('active');
    $("#navbarcontacto").prop('href', 'contacto.php');
    $("#navbarinicio").prop('href', 'index.php');
    $("#navbarmaterial").prop('href', 'material.php'); 
    $("#ultimos_archivos").hide();
    $("#mis_archivos").hide();
    $("#archivos_suscritos").hide();
    $("#mis_suscripciones").hide();

    var nombre,email,apellido,dni,fecha_nac;
    email = $("#input_email").val();
	fecha_nac = $("#input_fecha_nac").val();
	nombre = $("#input_nombre").val();
	apellido = $("#input_apellido").val();
	dni = $("#input_dni").val();
	carrera = $("#select_carrera").val();
	
	// No pude hacerlo por acá 
	// $("#form_desuscribirse").on('submit', function(e) {
	// 	// return false;
	// 	swal({
	// 	  title: "¿Estás seguro de desuscribirte de este usuario?",
	// 	  text: "Una vez desuscripto, puede volver a suscribirse",
	// 	  icon: "warning",
	// 	  buttons: true,
	// 	  dangerMode: true,
	// 	})
	// 	.then((willDelete) => {
	// 	  if (willDelete) {
	// 	  	e.preventDefault();    
	// 	    $.ajax({
	// 	        url: 'desuscribirse.php',
	// 	        type: 'POST',
	// 	        data: {
	// 	        	id_usuario_desuscribirse: $("#id_usuario_desuscribirse_form").val()
	// 	        },
	// 	        success: function (data) {
	// 	        	swal("Hecho","Se desuscribió correctamente","success");
	// 	        	$.ajax({
	// 						url: 'cargar_suscripciones.php',
	// 						type: 'POST',
	// 						success: function (datos) {
	// 							$("#mis_suscripciones").html(datos);
	// 						}
	// 				});
	// 				$.ajax({
	// 						url: 'cargar_archivos_suscriptos.php',
	// 						type: 'POST',
	// 						success: function (datos) {
	// 							$("#archivos_suscritos").html(datos);
	// 						}
	// 				});
	// 	        }
	// 	    }); 
	// 	  } else {
	// 	    swal("No se desuscribió");
	// 	  }
	// 	});
	// 	return false;
	// });

	$('#form_modal_perfil').on('submit', function() {
		$.ajax({
		        url: 'suscribirse.php',
		        type: 'POST',
		        data: {
		        	id_usuario_ajax: $("#modal_perfil_id_usuario").val()
		        },
		        success: function (data) {
		        	String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
		        	data = data.trim();
		        	console.log(data);
		        	if(data == "success"){
		        		swal("Hecho!","Se ha suscripto correctamente","success");

		        		$.ajax({
							url: 'cargar_suscripciones.php',
							type: 'POST',
							success: function (datos) {
								$("#mis_suscripciones").html(datos);
							}
						});
						$.ajax({
								url: 'cargar_archivos_suscriptos.php',
								type: 'POST',
								success: function (data) {
									$("#archivos_suscritos").html(data);
								}
						});
		        		
		        	}else if(data== "yasuscripto"){
		        		swal("Error","Usted ya se encuentra suscripto a este usuario","error");
		        	}else if(data=="mismousuario"){
		        		swal("Error","No se puede autosuscribir","error");
		        	}
		        }
		    });
		return false;
	});	

	$('#modal_editar_perfil').on('hidden.bs.modal', function () {
    	$("#input_email").val(email);
		$("#input_fecha_nac").val(fecha_nac);
		$("#input_nombre").val(nombre);
		$("#input_apellido").val(apellido);
		$("#input_dni").val(dni);
		$("#select_carrera").val(carrera);
	})   

    $("#form_editar_perfil").submit(function(event) {
    	var cambiar_email = 0;
    	if(email != $("#input_email").val()){
    		cambiar_email = 1;
    	}
    	$.ajax({
            url: 'editar_perfil.php',
            type: 'POST',
            data: {
                editar_nombre_ajax : $("#input_nombre").val(),
                editar_apellido_ajax : $("#input_apellido").val(),
                editar_email_ajax : $("#input_email").val(),
                editar_dni_ajax : $("#input_dni").val(),
                editar_fechanac_ajax : $("#input_fecha_nac").val(),
                editar_id_carrera_ajax : $("#select_carrera").val(),
                cambiar_email_ajax : cambiar_email
            },
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
					  window.location.replace("perfil.php");
					});

	     //             	email = $("#input_email").val();
						// fecha_nac = $("#input_fecha_nac").val();
						// nombre = $("#input_nombre").val();
						// apellido = $("#input_apellido").val();
						// dni = $("#input_dni").val();
						// carrera = $("#select_carrera").val();   
                }
                else{
                    swal("Error","El correo electrónico ya se encuentra registrado","error");
                }
            }
        });
        return false;
    });

    $("#mostrar_ocultar_suscripciones").click(function() {
		$("#mis_suscripciones").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_suscripciones").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_suscripciones").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_suscripciones").addClass('fa-arrow-up');
				$("#mostrar_ocultar_suscripciones").attr('data-content', 'Haga click para ocultar el contenido');
			}else{
				$("#mostrar_ocultar_suscripciones").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_suscripciones").addClass('fa-arrow-down');
				$("#mostrar_ocultar_suscripciones").attr('data-content', 'Haga click para mostrar el contenido');
			}
		});
	});
	$("#mostrar_ocultar_ultimos_archivos").click(function() {
		$("#ultimos_archivos").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_ultimos_archivos").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_ultimos_archivos").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_ultimos_archivos").addClass('fa-arrow-up');
				$("#mostrar_ocultar_ultimos_archivos").attr('data-content', 'Haga click para ocultar el contenido');
			}else{
				$("#mostrar_ocultar_ultimos_archivos").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_ultimos_archivos").addClass('fa-arrow-down');
				$("#mostrar_ocultar_ultimos_archivos").attr('data-content', 'Haga click para mostrar el contenido');
			}
		});
	});
	$("#mostrar_ocultar_archivos_suscriptos").click(function() {
		$("#archivos_suscritos").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_archivos_suscriptos").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_archivos_suscriptos").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_archivos_suscriptos").addClass('fa-arrow-up');
				$("#mostrar_ocultar_archivos_suscriptos").attr('data-content', 'Haga click para ocultar el contenido');
			}else{
				$("#mostrar_ocultar_archivos_suscriptos").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_archivos_suscriptos").addClass('fa-arrow-down');
				$("#mostrar_ocultar_archivos_suscriptos").attr('data-content', 'Haga click para mostrar el contenido');
			}
		});
	});    
	$("#mostrar_ocultar_mis_archivos").click(function() {
		$("#mis_archivos").toggle('slow', function (argument) {
			if($("#mostrar_ocultar_mis_archivos").hasClass('fa-arrow-down')){
				$("#mostrar_ocultar_mis_archivos").removeClass('fa-arrow-down');
				$("#mostrar_ocultar_mis_archivos").addClass('fa-arrow-up');
				$("#mostrar_ocultar_mis_archivos").attr('data-content', 'Haga click para ocultar mis archivos');
			}else{
				$("#mostrar_ocultar_mis_archivos").removeClass('fa-arrow-up');
				$("#mostrar_ocultar_mis_archivos").addClass('fa-arrow-down');
				$("#mostrar_ocultar_mis_archivos").attr('data-content', 'Haga click para mostrar mis archivos');
			}
		});
	});    


	$(".form_eliminar_archivo").submit(function(e) {
		
		swal({
		  title: "¿Estás seguro de eliminar este archivo?",
		  text: "Una vez eliminado, el archivo no se podrá recuperar",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {

		  	e.preventDefault();    
		    var formData = new FormData(this);

		    $.ajax({
		        url: 'eliminar_archivo.php',
		        type: 'POST',
		        data: formData,
		        success: function (data) {
		        	swal({
						  title: "Hecho!",
						  text: "Se ha eliminado el archivo correctamente",
						  icon: "success",
						});
		        	
						$.ajax({
							url: 'cargar_mis_archivos.php',
							type: 'POST',
							success: function (datos) {
								$("#mis_archivos").html(datos);
							}
						});
						
		      //   	$('#modal_eliminar_archivo').modal('hide');
		      //       swal("Hecho!","El archivo ha sido eliminado","success");
		      //       $('#contenedor_archivos_general').html(data);
		      //       $('[data-toggle="popover"]').popover();
		      //       $("#ultimos_archivos").hide();
    				// $("#mis_archivos").hide();
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });
		    
		  } else {
		    swal("Tu archivo no se eliminó");
		  }
		});
	    return false;
	});

    $("#form_foto_perfil").submit(function(e) {
    	if($("#file").val()==""){
	    	swal("Error","Debe seleccionar un archivo para subir como foto de perfil","error");
	    }else{
	    	e.preventDefault();    
		    var formData = new FormData(this);

		    $.ajax({
		        url: 'administrar_foto_perfil.php',
		        type: 'POST',
		        data: formData,
		        success: function (data) {
		        	$('#modal_foto_perfil').modal('hide');
		            swal("Hecho!","Se cambió la foto de perfil correctamente", "success");
		            // Cargar la foto en la seccion correspondiente
		            d = new Date();
					$("#img_foto_perfil").attr("src", data+"?"+d.getTime());
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });
	    }
	    return false;
    });

});