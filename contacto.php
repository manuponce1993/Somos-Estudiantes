<?php  
  $esta_en_login=false;
  require('db.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php  
    require('head.php');
  ?>
  
  <link rel="stylesheet" type="text/css" href="css/cards.css">


  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/animatecss/animate.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link href="assets/fonts/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional2.css" type="text/css">
  <script type="text/javascript" src="js/contacto.js"></script>
</head>
<body id="page-top">

  <!-- Header -->
    <!-- <?php 
      require('header_sesion.php')
    ?> -->

    <!-- Navigation Bar -->
    <?php 
      require('navigationbar.php')
    ?>

    <section class="mbr-section form1 cid-r02Vs2bdO0 mbr-parallax-background" id="form1-n">
        <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(0, 0, 0);">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    CONTACTO</h2>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <div data-form-alert="" hidden="">
                        Gracias por contactarte! Te responderemos a la brevedad
                    </div>

                    <form class="mbr-form" action="https://gmail.com/" method="post" data-form-title="Nuevo contacto"><input type="hidden" name="email" data-form-email="true" value="7TD89YKgGHxHaLDsYC+/CtPQU/+N22vSsHGJ7vDiF3iFPzETh1f2DTiZd1s1INydfxnjFJ4WhDboOTnGq+YqyMGllEmlysRHgMebyfk0NHI3UkR5HU5xpWb7oXmvtUUP" data-form-field="Email">
                        <div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="name-form1-n">Nombre</label>
                                    <input type="text" class="form-control" name="name" data-form-field="Name" required="" id="name-form1-n">
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-n">Email</label>
                                    <input type="email" class="form-control" name="email" data-form-field="Email" required="" id="email-form1-n">
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="phone">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-n">Teléfono</label>
                                    <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="phone-form1-n">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-for="message">
                            <label class="form-control-label mbr-fonts-style display-7" for="message-form1-n">Mensaje</label>
                            <textarea type="text" class="form-control" name="message" rows="7" data-form-field="Message" id="message-form1-n"></textarea>
                        </div>

                        <span class="input-group-btn"><button href="" type="submit" class="btn btn-primary btn-form display-4">ENVIAR</button></span>
                    </form>
                </div>
            </div>
        </div>
    </section>

  <!-- <section id="contacto">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">contactános</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <form id="form_contacto">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Nombre *" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Email *" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Teléfono" required="required" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Mensaje *" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-4">
            <div class="profile-card text-center">
              <img class="img-fluid" src="https://stackoverflow.blog/wp-content/uploads/2017/02/TheDeveloperCoverLetter-1024x395.jpg">
              <div class="profile-info">

                <img class="profile-pic" src="https://media.licdn.com/dms/image/C4E03AQHiqs_8buYTNQ/profile-displayphoto-shrink_200_200/0?e=1537401600&v=beta&t=VrRc9ui-inWechBWmug61FOua6hrXPUtlRzqqwYnHkM">

                <h2 class="hvr-underline-from-center mt-3">Ponce Emanuel<span>Ingeniero Informático</span></h2>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <a href="http://www.twitter.com/mike_youngg"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#"><i class="fab fa-facebook-f fa-2x"></i></a>
                <a href="http://www.linkedin.com"><i class="fab fa-linkedin-in fa-2x"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    
        <!-- <script src="assets/web/assets/jquery/jquery.min.js"></script> -->
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/tether/tether.min.js"></script>
        <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
        <script src="assets/smoothscroll/smooth-scroll.js"></script>
        <script src="assets/dropdown/js/script.min.js"></script>
        <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
        <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
        <script src="assets/parallax/jarallax.min.js"></script>
        <script src="assets/sociallikes/social-likes.js"></script>
        <script src="assets/theme/js/script.js"></script>
        <script src="assets/formoid/formoid.min.js"></script>


        <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
        <input name="animation" type="hidden">

    
</body>
</html>

<?php 
    require('footer.php');
  ?>

  <!-- Ref -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/navigationbar.js"></script>