<?php require_once 'db_con.php';
session_start();
if (!isset($_SESSION['user_login'])) {
  header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Direccion de Recursos Humanos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/chis.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/fontawesome.min.js"></script>
    <script src="../js/script.js"></script>
   
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><i class="fas fa-chart-line fa-3x"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
    <?php $showuser = $_SESSION['user_login']; $haha = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$showuser';"); $showrow=mysqli_fetch_array($haha); ?>
    <ul class="nav navbar-nav ">
     
      <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i> Perfil</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>
<br>
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php?page=dashboard" class="list-group-item list-group-item-action active">
               <i class="fas fa-tachometer-alt"></i>RECURSOS HUMANOS
              </a> 
              <a href="index.php?page=add-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i>AGREGAR EMPLEADO</a>
              <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i>LISTA DE EMPLEADOS</a>
              <a href="index.php?page=all-users" class="list-group-item list-group-item-action"><i class="fa fa-users"></i>LISTA DE USUARIOS</a>
              <a href="index.php?page=all-users" class="list-group-item list-group-item-action"><i class="fa fa-users"></i>USUARIOS</a>
              <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
              <a href="index.php?page=nuevoUsuario" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> AGREGAR USUARIO N</a>
              <a href="index.php?page=listaUsuario" class="list-group-item list-group-item-action"><i class="fa fa-users"></i>LISTA DE USUARIOS N</a>
              <a href="index.php?page=perfilUsuario" class="list-group-item list-group-item-action"><i class="fa fa-user"></i>PERFIL DE USUARIO</a>
            </div>
          </div>
          <div class="col-md-9">
             <div class="content">
                 <?php 
                   if (isset($_GET['page'])) {
                    $page = $_GET['page'].'.php';
                    }else{
                      $page = 'dashboard.php';
                    }

                    if (file_exists($page)) {
                      require_once $page;
                    }else{
                      require_once '404.php';
                    }
                  ?>
             </div>
        </div>
        </div>  
    </div>
    <div class="clearfix"></div>
    <script type="text/javascript">
      jQuery('.toast').toast('show');
    </script>
  </body>
</html>