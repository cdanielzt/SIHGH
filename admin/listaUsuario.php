<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
?>
<h4 class="text-primary"><i class="fas fa-users"> USUARIOS</i></h4>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">RECURSOS HUMANOS</a></li>
     <li class="breadcrumb-item active" aria-current="page">LISTA DE USUARIOS</li>
  </ol>
</nav>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Num</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha de registro</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query=mysqli_query($db_con,'SELECT * FROM `usuario`');
      $i=1;
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '<td>'.$i.'</td>
          <td>'.ucwords($result['nombre']).'</td>
          <td>'.$result['correo'].'</td>
          <td>'.ucwords($result['nombreUsuario']).'</td>
          <td>'.$result['estado'].'</td>
          <td>'.$result['fechaRegistro'].'</td>';?>     
      </tr>  
     <?php $i++;} ?>
  </tbody>
</table>
