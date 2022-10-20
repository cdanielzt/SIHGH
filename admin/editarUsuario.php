<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
    
    $idUsuario = base64_decode($_GET['idUsuario']);
  if (isset($_POST['actualizarUsuario'])) {
  	$nombre = $_POST['nombre'];
  	$correo = $_POST['correo'];

  	$query = "UPDATE `usuario` SET `nombre`='$nombre', `correo`='$correo' WHERE `idUsuario`= $idUsuario";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Usuario actualizado exitósamente</p>';
  		header('Location: index.php?page=perfilUsuario&edit=success');
  	}else{
  		header('Location: index.php?page=perfilUsuario&edit=error');
  	}
  }
?>
<h4 class="text-primary"><i class="fas fa-user"> EDITAR USUARIO</i></h4>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">RECURSOS HUMANOS</a></li>
     <li class="breadcrumb-item active" aria-current="page"><a href="index.php?page=perfilUsuario">PERFIL DE USUARIO</a></li>
     <li class="breadcrumb-item active" aria-current="page">EDITAR PERFIL DE USUARIO</li>
    </ol>
</nav>
	<?php
		if (isset($idUsuario)) {

			$query = "SELECT  `nombre`, `correo` FROM `usuario` WHERE `idUsuario`=$idUsuario;";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" name="nombre"  id="nombre" value="<?php echo $row['nombre']; ?>" required autocomplete="off">
	  	</div>
	  	<div class="form-group">
		    <label for="correo">Correo electrónico:</label>
		    <input type="email" class="form-control" name="correo"  id="correo" value="<?php echo $row['correo']; ?>" required autocomplete="off">
	  	</div>
		<!-- <div class="form-group">
		    <label for="corntraseñaAc">Contraseña actual:</label>
		    <input type="password" class="form-control" name="contraseñaAc"  id="contraseñaAc" placeholder="Ingresa tu contraseña actual" required autocomplete="off">
	  	</div>
		  <div class="form-group">
		    <label for="corntraseñaN">Cree una nueva contraseña:</label>
		    <input type="password" class="form-control" name="contraseñaN"  id="contraseñaN" placeholder="Cree una nueva contraseña segura" required autocomplete="off">
	  	</div>
		  <div class="form-group">
		    <label for="corntraseñaNu">Confirmar contraseña:</label>
		    <input type="password" class="form-control" name="contraseñaNu"  id="contraseñaNu" placeholder="" required autocomplete="off">
	  	</div> -->
		  <div class="form-group text-center">
		    <input name="actualizarUsuario" value="ACTUALIZAR " type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>