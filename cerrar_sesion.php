<?php
   session_start();
   if(!isset($_SESSION['nombre']))
   {
        echo "No hay ninguna sesion iniciada";
//esto ocurre cuando la sesion caduca.
   }
   else
   { 
     session_destroy();
	 header("location: http://localhost/somos_estudiantes/");   
   } 
?>