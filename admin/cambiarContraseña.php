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
    if(isset($_POST['cambiar']))
    {
    $contraseña=md5($_POST['contraseña']);
    $nuevaContraseña=md5($_POST['nuevaContraseña']);
    $sql ="SELECT contraseña FROM usuario WHERE EmailId=:nombreUsuario and contraseña=:contraseña";
    $query= $db_con -> prepare($sql);
    $query-> bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
    $query-> bindParam(':contraseña', $contraseña, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
    $con="update usuario set contraseña=:nuevaContraseña where EmailId=:nombreUsuario";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1-> bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
    $chngpwd1-> bindParam(':nuevaContraseña', $nuevaContraseña, PDO::PARAM_STR);
    $chngpwd1->execute();
    $msg="Tu contraseña a cambiado exitósamente";
    }
    else {
    $error="Tu usuario o contraseña están incorrectos";    
    }
    }    
?>
<h4 class="text-primary"><i class="fa fa-key"> NUEVA CONTRASEÑA</i></h4>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">RECURSOS HUMANOS</a></li>
     <li class="breadcrumb-item active" aria-current="page"><a href="index.php?page=perfilUsuario">PERFIL DE USUARIO</a></li>
     <li class="breadcrumb-item active" aria-current="page">CAMBIAR CONTRASEÑA</li>
    </ol>
    <div class="row">
    <div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" name="chngpwd" action="">
    <div class="form-group">
		    <label for="corntraseñaAc">Contraseña actual:</label>
		    <input type="password" class="form-control"class="validate" name="contraseñaAc"  id="contraseña" placeholder="Ingresa tu contraseña actual" required autocomplete="off">
	</div>
    <div class="form-group">
		    <label for="nuevaContraseña">Nueva contraseña:</label>
		    <input type="password" class="form-control"class="validate" name="nuevaContraseña"  id="nuevaContraseña" placeholder="Cree una nueva contraseña" required autocomplete="off">
	</div>
    <div class="form-group">
		    <label for="cocontraseña">Confirmar contraseña:</label>
		    <input type="password" class="form-control"class="validate" name="cocontraseña"  id="cocontraseña" placeholder="" required autocomplete="off">
	</div>
    <div class="form-group text-center">
		    <input name="cambiar" value="CAMBIAR CONTRASEÑA" type="submit" class="btn btn-danger">
	  	</div>
</nav>