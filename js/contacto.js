$(document).ready(function() {
	$("#navbarcontacto").addClass('active');
	$("#navbarcontacto").prop('href', '#page-top');
	$("#navbarinicio").prop('href', 'index.php');
	$("#navbarmaterial").prop('href', 'material.php');
	$("#navbarusuario").prop('href', 'index.php#usuarios');
	$('[data-toggle="popover"]').popover();
});