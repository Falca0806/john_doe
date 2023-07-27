<nav class="navbar " role="navigation" aria-label="main navigation">
  <img src="./img/logo.png" style="width:300px;height:100px;">
  <div class="navbar-brand">
    

    <a role="button" class="navbar-burger has-background-info" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu has-background-info">
    <div class="navbar-end ">

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Clientes</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=client_new">Nuevo</a>
          <a class="navbar-item" href="index.php?vista=client_list" >Lista</a>
        </div>
      </div>
      
      
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Servicio</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=servi_new">Nuevo</a>
          <a class="navbar-item" href="index.php?vista=servi_list">Lista</a>
        </div>
      </div>
      <div class="navbar-item">
        <div class="buttons">
          <a href="index.php?vista=logout" class="button is-danger is-rounded">
            Salir
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>