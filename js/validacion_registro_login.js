$(document).ready(function(){
    iniciar();
    $("#formregistro").on("submit", function(){
        // Objeto para pasar por parametro a la funcion validar_vacios, donde el nombre de cada
        // propiedad coincide con el name del input correspondiente, para agregarle la clase has-error
        // en dicha funcion
        var objeto = {
            input_nombre : $("#input_nombre").val(),
            input_apellido : $("#input_apellido").val(),
            input_email : $("#input_email").val(),
            input_nombre_usuario : $("#input_nombre_usuario").val(),
            input_contrasena : $("#input_contrasena").val(),
            input_contrasena_rep : $("#input_contrasena_rep").val()
        };
        if(!validar_vacios(objeto)){
            $("#div_error_registro").text('Por favor complete los campos marcados');
            $("#div_error_registro").css("visibility","visible");
            return false;
        }
        // Validar caracteres de la contraseña
        if (validar_contrasena($("#input_contrasena").val())==-1){
            $("#div_error_registro").text('La contraseña debe incluir mayúsculas, minúsculas, números y caracteres especiales');
            $("#div_error_registro").css("visibility","visible");
            $("#input_contrasena").addClass("has-error");
            $("#input_contrasena_rep").addClass("has-error");
            return false;
        }
        // Validar contraseñas iguales
        if($("#input_contrasena").val()!=$("#input_contrasena_rep").val()){
            $("#div_error_registro").html('Las contraseñas deben ser iguales');
            $("#div_error_registro").css("visibility","visible");
            return false;
        }
        
        // Comprobacion back end por ajax para no recargar toda la pagina

        $.ajax({
            url: 'model/registro.php',
            type: 'POST',
            data: {
                registro_nombre_ajax : $("#input_nombre").val(),
                registro_apellido_ajax : $("#input_apellido").val(),
                registro_email_ajax : $("#input_email").val(),
                registro_fecha_nac_ajax : $("#registro_fecha_nac").val(),
                registro_select_carrera_ajax : $("#registro_select_carrera").val(),
                registro_contrasena_ajax : $("#input_contrasena").val(),
                registro_contrasena_rep_ajax : $("#input_contrasena_rep").val()

            },
            success: function(response){
                //sacar espacios. Preguntar por que se generan espacios en model/ingreso.php/echo "success"
                String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
                if(response.trim()=="success"){
                    console.log(response);  
                    window.location.href="perfil.php";
                }
                else{
                    console.log(response);
                    $("#div_error_registro").text("El email ya se encuentra registrado");
                    $("#div_error_registro").css('visibility', 'visible');
                }
            }
        });
        return false;
    });

    $("#formsesion").on('submit', function() {
        // Validar vacios (Validacion front)
        var objeto = {
            ingreso_email : $("#ingreso_email").val(),
            ingreso_contrasena : $("#ingreso_contrasena").val()
        };
        if(!validar_vacios(objeto)){
            $("#div_error_login").text('Por favor complete los campos marcados');
            $("#div_error_login").css("visibility","visible");
            return false;   
        }
        // Comprobar si existe ese usuario en la DB por ajax para no recargar toda la pagina en
        // en caso de que el usuario o contraseña no sean validas y solo mostrar el error.
        $.ajax({
            url: 'model/ingreso.php',
            type: 'POST',
            data: {
                email_ajax: $("#ingreso_email").val(),
                pass_ajax: $("#ingreso_contrasena").val()
            },
            success: function(response){
                //sacar espacios. Preguntar por que se generan espacios en model/ingreso.php/echo "success"
                String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
                if(response.trim()=="success"){
                    window.location.href="perfil.php";
                }
                else{
                    $("#div_error_login").text("Usuario o contraseña incorrectos");
                    $("#div_error_login").css('visibility', 'visible');
                }
            }
        });
        return false;
    });

    function iniciar() {
        $("#div_error_registro").css("visibility","hidden");
        $("#div_error_login").css("visibility","hidden");
    }

    function validar_vacios(objeto){
        var propiedad, error=false;
        for(propiedad in objeto){
            if(objeto[propiedad]==""){
                $("#"+propiedad).addClass("has-error");
                error=true;
            }else{
                $("#"+propiedad).removeClass("has-error");
            }
        }
        if(error){
            return false;
        }else{
            return true;
        }
    }
    
    function validar_contrasena(contrasena) {
        return contrasena.search(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}/);
    }
})