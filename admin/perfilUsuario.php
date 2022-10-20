<?php 
$nombreUsuario=  $_SESSION['user_login'];
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
?>
<h4 class="text-primary"><i class="fas fa-user"> PERFIL DE USUARIO</i></h4>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">RECURSOS HUMANOS</a></li>
     <li class="breadcrumb-item active" aria-current="page">PERFIL DE USUARIO</li>
  </ol>
</nav>
<?php 
  $query = mysqli_query($db_con, "SELECT * FROM `usuario` WHERE `nombreUsuario` ='$nombreUsuario';");
  $row = mysqli_fetch_array($query);

 ?>
 <br>
 <div class="row">
  <div class="col-sm-8">
    <table class="table table-bordered">
    <tr>
        <td>Nombre</td>
        <td><?php echo ucwords($row['nombre']); ?></td>
    </tr>
    <tr>
        <td>Correo</td>
        <td><?php echo($row['correo']); ?></td>
    </tr>
    <tr>
        <td>Usuario</td>
        <td><?php echo ucwords($row['nombreUsuario']); ?></td>
    </tr>
    <tr>
        <td>Estado</td>
        <td><?php echo ucwords($row['estado']); ?></td>
    </tr>
    <tr>
        <td>Fecha de registro</td>
        <td><?php echo ($row['fechaRegistro']); ?></td>
    </tr>
    </table>    
    <a class="btn btn-warning pull-right" href="index.php?page=editarUsuario&idUsuario=<?php echo base64_encode($row['idUsuario']); ?>">Editar Perfil</a>
    <br>
    <br>
    <a class="btn btn-warning pull-right" href="index.php?page=cambiarContraseña&idUsuario=<?php echo base64_encode($row['idUsuario']); ?>">Cambiar Contraseña</a>
  </div>
  </div>
