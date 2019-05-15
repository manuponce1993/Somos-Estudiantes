<?php  
  $esta_en_login=true;
  require('db.php');
  // require('model/ingreso.php');
  // require('model/registro.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  require('head.php');
  ?>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/cards.css">
  <script type="text/javascript" src="js/validacion_registro_login.js"></script>
</head>

<body id="page-top">
  <!-- Header -->
  <?php 
  require('header.php');
  ?>
  <div class="container-fluid text-white p-5" id="info" style="background: linear-gradient(to bottom,#161616 0,rgba(22,22,22,.9) 75%,rgba(22,22,22,.8) 100%);">
    <h2 class="section-heading text-white text-center">Tenemos lo que necesitas!</h2>
    <hr>
    <div class="row">
      <div class="col-12">
        <p class="lead">En nuestra pagina encontrarás materiales subidos por la comunindad de estudiantes 
        de todas las carreras de la Universidad Nacional de Mar del Plata. En esta página hallarás:</p>
      </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="profile-card card-group text-center">
            <div class="profile-info">
              <h2 class="hvr-underline-from-center">Exámenes<span>Parciales / Finales</span></h2>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="profile-card card-group text-center">
            <div class="profile-info">
              <h2 class="hvr-underline-from-center">Apuntes<span>Resúmenes / Anotaciones</span></h2>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="profile-card card-group text-center">
            <div class="profile-info">
              <h2 class="hvr-underline-from-center">Trabajos prácticos<span>Proyectos / Exposiciones</span></h2>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="profile-card card-group text-center">
            <div class="profile-info">
              <h2 class="hvr-underline-from-center">Material útil<span>Bibliografía / Material web</span></h2>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <a class="btn btn-xl btn-success mt-5 js-scroll-trigger" href="#usuarios">Comienza</a>
      </div>
    </div>
  </div>

  <!-- Login/Registro -->
  <?php  
    require('login.php');
  ?>

  <!-- Footer -->
  <?php 
  require('footer.php')
  ?>

  <!-- Ref -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/navigationbar.js"></script>

</body>
</html>