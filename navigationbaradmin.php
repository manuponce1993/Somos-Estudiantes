<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger negmargin" href="#page-top" id="navbarinicio">
        <img src="resources/logofondo_transp.png" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-lg-5">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger mr-3" href="perfil.php" id="navbarperfil">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger mr-3" href="material.php" id="navbarmaterial">Material</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger mr-3" href="admin.php" id="navbaradmin">Admin</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto ">
          <li class="nav-item dropdown">  
            <a class="nav-link mr-3 dropdown-toggle" href="#" id="navbarusuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['nombre']; ?></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!-- <a class="dropdown-item" href="#">Editar</a> -->
              <a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a>
              <!-- <a class="dropdown-item" href="#">Another action</a> -->
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a> -->
            </div>
          </li>


          <li>
              <form class="form-inline">   
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
              </form>
          </li>
      </ul>
    </div>
  </div>
</nav>