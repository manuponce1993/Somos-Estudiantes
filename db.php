<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

// Si no inicio sesion y se quiere dirigir a otra pantalla que no sea la principal:
if(isset($esta_en_login) && !$esta_en_login && !isset($_SESSION['nombre'])){
    header("location: http://localhost/somos_estudiantes/");
    die();
}

define ('DB_HOST', "localhost");
define ('DB_USER', "root");
define ('DB_PASS', "");
define ('DB_DB', "somos_estudiantes");

//Create connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>		