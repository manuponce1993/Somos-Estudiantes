$(document).ready(function() {
	$("#navbarmaterial").addClass('active');
	$("#navbarmaterial").prop('href','#page-top');
	$("#navbarinicio").prop('href', 'index.php');
	$("#navbarusuario").prop('href', 'index.php#usuarios');
	$("#navbarcontacto").prop('href', 'contacto.php');
	$("#btn_subir_archivo").hide();

	$('[data-toggle="popover"]').popover();
	
	// sin_cargar_categoria();

	cargar_selects();

	$("#form_subir_archivo").submit(function(e) {
	    if($("#input_archivo_titulo").val()=="" || $("#input_archivo_detalles").val()=="" || $("#file").val()==""){
	    	swal("Error","Debe completar todos los campos","error");
	    }else{
	    	e.preventDefault();    
		    var formData = new FormData(this);

		    $.ajax({
		        url: 'administrar_archivos.php',
		        type: 'POST',
		        data: formData,
		        success: function (data) {
		        	// Limpiamos los campos antes de cerrar el modal
		        	limpiar_modal();
		        	$('#modal_subir_archivo').modal('hide');
		            swal("Hecho!","El archivo se subió correctamente", "success");
		            $("#div_seleccion_archivos").html(data);
		            cargado();
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });
	    }
	    return false;
	});

	$("#cerrar_modal_subir_archivo").on('click', function() {
		limpiar_modal();
	});

	function limpiar_modal() {
		$("#input_archivo_titulo").val("");
    	$("#input_archivo_detalles").val("");
    	$("#file").val("");
    	// Invoco al clic de cerrar para limpiar el contenido del file preview
    	$(".fileinput-remove").trigger('click');
	}

	function cargar_selects() {
		$("#select_carrera").on('change', function() {
			var carreraID = $(this).val();
			// Si hay seleccionada alguna opcion
			if(carreraID){
				$("#img_number_1").prop('src', 'resources/onepost.png');
				$.ajax({
					url: 'cargar_selects_material.php',
					type: 'POST',
					data: {id_carrera: carreraID},
					success: function (contenido) {
						console.log(carreraID);
						$("#select_anio").html(contenido);
						$("#img_number_2").prop('src', 'resources/twoprev.png');
						$("#select_materia").html('<option value="">Seleccione un año primero </option>');
						$("#img_number_3").prop('src', 'resources/threeprev.png');
					}
				});
			}
			else{
				$("#select_anio").html('<option value="">Seleccione una carrera primero</option>');
				$("#select_materia").html('<option value="">Seleccione un año primero</option>');
			}
		});

		$("#select_anio").on('change', function() {
			var anioID = $(this).val();
			if(anioID){
				$("#img_number_2").prop('src', 'resources/twopost.png');
				$.ajax({
					url: 'cargar_selects_material.php',
					type: 'POST',
					data: {id_anio: anioID},
					success:function (contenido) {
						console.log(anioID);
						$("#select_materia").html(contenido);
						$("#img_number_3").prop('src', 'resources/threeprev.png');
					}
				});
			}else{
				$("#select_materia").html('<option value="">Seleccione un año primero</option>');
			}
		});

		$("#select_materia").on('change', function() {

			sin_cargar_categoria();
			var materiaID = $(this).val();
			// Se carga el input hidden del form de modal_subir_archivo
			$("#input_id_materia").val(materiaID);
			if(materiaID){
				var nombre_materia = $("#select_materia option:selected").text();
				$("#img_number_3").prop('src', 'resources/threepost.png');
				$.ajax({
					url: 'cargar_selects_material.php',
					type: 'POST',
					data: {id_materia: materiaID},
					success:function (contenido) {
						$("#titulo_materia_cargada").html(nombre_materia);
						$("#div_seleccion_archivos").html(contenido);
						cargado();
					}
				});	
			}else{
				$("#select_materia").html('<option value="">Seleccione un año primero</option>');
			}
		});

		// $("#btn_buscar_material").on('click', function(event) {
		// 	sin_cargar_categoria();
		// 	var materiaID = $("#select_materia").val();
		// 	if(materiaID){
		// 		$.ajax({
		// 			url: 'cargar_selects_material.php',
		// 			type: 'POST',
		// 			data: {id_materia: materiaID},
		// 			success:function (contenido) {
		// 				$("#div_seleccion_archivos").html(contenido);
		// 				cargado();
		// 			}
		// 		});
		// 	}else{
		// 		if(!$("#select_anio").val()){
		// 			swal("Error","Debe seleccionar un año y luego una materia","error");
		// 		}else{
		// 			swal("Error","Debe seleccionar una materia","error");
		// 		}
		// 	}
		// 	return false;
		// });
	}


	// Funcion que se llama cuando no se selecciono ninguna categoria (parcial, resumenes, etc) 
	// o cuando se cambia la materia, por lo tanto se refresca la seccion y se indica que no se 
	// selecciono ninguna categoria aun.
	function sin_cargar_categoria() {
		// $("#input_palabra_buscar").prop('disabled', 'true');
		$("#titulo_categoria").html('Sin seleccionar categoría <i class="fas fa-info-circle" title="Información" data-toggle="popover" data-trigger="hover" data-content="Para visualizar el material debe presionar sobre una de las categorías anteriores (parciales, resúmenes, trabajos prácticos o material útil)."></i>');
		$('[data-toggle="popover"]').popover();
		$("#titulo_categoria").removeClass (function (index, className) {
		    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
		});
		$("#titulo_categoria").addClass('text-secondary');
		$("#btn_subir_archivo").hide();
		$("#container_archivos_mostrados").hide();
	}

	// Funcion que se llama una vez cargada la materia a investigar
	function cargado() {
		$("#link_parciales, #link_resumenes, #link_tp, #link_mutil").attr('href', '#container_opciones');
		$("#card_parciales, #card_resumenes, #card_tp, #card_mutil").removeClass('bg-secondary');
		
		$("#card_parciales").addClass('bg-success');
		$("#card_resumenes").addClass('bg-danger');
		$("#card_tp").addClass('bg-info');
		$("#card_mutil").addClass('bg-warning');

		var materiaID = $("#select_materia").val();

		$("#link_parciales").on('click', function() {
			// Se cargan 
			$("#input_tipo").val("parcial");
			$("#container_archivos_mostrados").hide('slow');
			// $("#input_palabra_buscar").prop('disabled', 'false');

			var nombre_materia = $("#select_materia option:selected").text();

			$("#modal_subir_archivo_titulo").text('Subir parcial de '+nombre_materia);
			$("#modal_subir_archivo_titulo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#modal_subir_archivo_titulo").addClass('text-success');

			$("#titulo_categoria").text('Parciales');
			$("#titulo_categoria").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#titulo_categoria").addClass('text-success');

			$("#link_resumenes").removeClass ('item-active');
			$("#link_tp").removeClass ('item-active');
			$("#link_mutil").removeClass ('item-active');
			$(this).addClass('item-active');
			// Boton subir archivo (parcial)
			$("#btn_subir_archivo").show();
			$("#btn_subir_archivo").text('Subir parcial');
			$("#btn_subir_archivo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)btn-\S+/g) || []).join(' ');
			});
			$("#btn_subir_archivo").addClass('btn-success');

			// Cargar parciales por ajax
			$.ajax({
				url: 'cargar_archivos.php',
				type: 'POST',
				data: {id_materia: materiaID,
						tipo: $("#input_tipo").val()},
				success:function (contenido) {
					$("#container_archivos_mostrados").html(contenido);
					$("#container_archivos_mostrados").show('slow');
				}
			});
		});

		$("#link_resumenes").on('click', function() {
			$("#input_tipo").val("resumen");
			$("#container_archivos_mostrados").hide('slow');
			// $("#input_palabra_buscar").prop('disabled', 'false');

			var nombre_materia = $("#select_materia option:selected").text();

			$("#modal_subir_archivo_titulo").text('Subir resumen de '+nombre_materia);
			$("#modal_subir_archivo_titulo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#modal_subir_archivo_titulo").addClass('text-danger');

			$("#titulo_categoria").text('Resumenes');
			$("#titulo_categoria").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#titulo_categoria").addClass('text-danger');

			$("#link_parciales").removeClass ('item-active');
			$("#link_tp").removeClass ('item-active');
			$("#link_mutil").removeClass ('item-active');
			$(this).addClass('item-active');

			// Boton subir parcial
			$("#btn_subir_archivo").show();
			$("#btn_subir_archivo").text('Subir resúmen');
			$("#btn_subir_archivo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)btn-\S+/g) || []).join(' ');
			});
			$("#btn_subir_archivo").addClass('btn-danger');

			// Cargar resumenes
			$.ajax({
				url: 'cargar_archivos.php',
				type: 'POST',
				data: {id_materia: materiaID,
						tipo: $("#input_tipo").val()},
				success:function (contenido) {
					$("#container_archivos_mostrados").html(contenido);
					$("#container_archivos_mostrados").show('slow');
				}
			});

		});

		$("#link_tp").on('click', function() {
			$("#input_tipo").val("tp");
			$("#container_archivos_mostrados").hide('slow');
			// $("#input_palabra_buscar").prop('disabled', 'false');

			var nombre_materia = $("#select_materia option:selected").text();

			$("#modal_subir_archivo_titulo").text('Subir trabajo práctico de '+nombre_materia);
			$("#modal_subir_archivo_titulo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#modal_subir_archivo_titulo").addClass('text-info');

			$("#titulo_categoria").text('Trabajos prácticos');
			$("#titulo_categoria").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#titulo_categoria").addClass('text-primary');

			$("#link_resumenes").removeClass ('item-active');
			$("#link_parciales").removeClass ('item-active');
			$("#link_mutil").removeClass ('item-active');
			$(this).addClass('item-active');

			// Boton subir parcial
			$("#btn_subir_archivo").show();
			$("#btn_subir_archivo").text('Subir trabajo práctico');
			$("#btn_subir_archivo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)btn-\S+/g) || []).join(' ');
			});
			$("#btn_subir_archivo").addClass('btn-primary');

			// Cargar tps
			$.ajax({
				url: 'cargar_archivos.php',
				type: 'POST',
				data: {id_materia: materiaID,
						tipo: $("#input_tipo").val()},
				success:function (contenido) {
					$("#container_archivos_mostrados").html(contenido);
					$("#container_archivos_mostrados").show('slow');
				}
			});
			
		});

		$("#link_mutil").on('click', function() {
			$("#input_tipo").val("mutil");
			$("#container_archivos_mostrados").hide('slow');
			// $("#input_palabra_buscar").prop('disabled', 'false');

			var nombre_materia = $("#select_materia option:selected").text();

			$("#modal_subir_archivo_titulo").text('Subir material útil de '+nombre_materia);
			$("#modal_subir_archivo_titulo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#modal_subir_archivo_titulo").addClass('text-warning');

			$("#titulo_categoria").text('Material útil');
			$("#titulo_categoria").removeClass (function (index, className) {
			    return (className.match (/(^|\s)text-\S+/g) || []).join(' ');
			});
			$("#titulo_categoria").addClass('text-warning');

			$("#link_resumenes").removeClass ('item-active');
			$("#link_tp").removeClass ('item-active');
			$("#link_parciales").removeClass ('item-active');
			$(this).addClass('item-active');

			// Boton subir material util
			$("#btn_subir_archivo").show();
			$("#btn_subir_archivo").text('Subir material útil');
			$("#btn_subir_archivo").removeClass (function (index, className) {
			    return (className.match (/(^|\s)btn-\S+/g) || []).join(' ');
			});
			$("#btn_subir_archivo").addClass('btn-warning');

			// Cargar material util
			$.ajax({
				url: 'cargar_archivos.php',
				type: 'POST',
				data: {id_materia: materiaID,
						tipo: $("#input_tipo").val()},
				success:function (contenido) {
					$("#container_archivos_mostrados").html(contenido);
					$("#container_archivos_mostrados").show('slow');
				}
			});

		});
		// $("#btn_buscar_archivo").on('click', function() {
		// 	var palabra_buscada = $("#input_palabra_buscar").val();
		// 	console.log("lapm");
		// 	$.ajax({
		// 		url: 'cargar_archivos.php',
		// 		type: 'POST',
		// 		data: {id_materia: materiaID,
		// 				tipo: $("#input_tipo").val(),
		// 				palabra: palabra_buscada},
		// 		success:function (contenido) {
		// 			$("#container_archivos_mostrados").html(contenido);
		// 		}
		// 	});		
		// });	

		$("#input_palabra_buscar").on('keyup', function() {
			var palabra_buscada = $("#input_palabra_buscar").val();
			$.ajax({
				url: 'cargar_archivos.php',
				type: 'POST',
				data: {id_materia: materiaID,
						tipo: $("#input_tipo").val(),
						palabra: palabra_buscada},
				success:function (contenido) {
					// $("#container_archivos_mostrados").hide();
					// $("#container_archivos_mostrados").show('fast');
					$("#container_archivos_mostrados").html(contenido);
				}
			});		
		});
	}

	// Fin ready
});

