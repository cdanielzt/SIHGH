<?php require_once 'db_con.php'; 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage!=='index.php') {
  if ($corepage==$corepage) {
	$corepage = explode('.', $corepage);
   header('Location: index.php?page='.$corepage[0]);
 }
}
	if(isset($_POST['registrarU'])){
	$nombre=$_POST['nombre'];
	$correo=$_POST['correo'];
	$nombreUsuario=$_POST['nombreUsuario'];
	$contraseña=$_POST['contraseña'];
	$c_contraseña=$_POST['c_contraseña'];
	$estado=$_POST['estado'];

	$input_error = array();
	
	if (empty($nombre)) {
	$input_error['nombre'] = "Es necesario llenar el campo Nombre";
		}
	if (empty($correo)) {
	$input_error['correo'] = "Ingresa un correo valido";
		}
			
	if (empty($nombreUsuario)) {
	$input_error['nombreUsuario'] = "Ingresa un nombre de usuario, debe contener al menos 5 caracteres";
		}
		
	if (empty($contraseña)) {
	$input_error['contraseña'] = "Ingresa o crea una contraseña segura";
		}
		
		if (!empty($contraseña)) {
		if ($c_contraseña!==$contraseña) {
 			$input_error['notmatch']="Las contraseñas no coinciden, intentalo nuevamente";
	 		}
	 	}
	 	if (count($input_error)==0) {
	 		$verificar_correo= mysqli_query($db_con,"SELECT * FROM `usuario` WHERE `correo`='$correo';");

	 	if (mysqli_num_rows($verificar_correo)==0) {
	 			$verificar_nombreUsuario= mysqli_query($db_con,"SELECT * FROM `usuario` WHERE `nombreUsuario`='$nombreUsuario';");
				 if (mysqli_num_rows($verificar_nombreUsuario)==0) {
					if (strlen($nombreUsuario)>=5) {
						if (strlen($contraseña)>=6) {
								$contraseña = sha1(md5($contraseña));
							// 	$query = "INSERT INTO `usuario`(`nombre`, `correo`, `nombreUsuario`, `contraseña`, `estado`) VALUES ('$nombre', '$correo', '$nombreUsuario', '$contraseña','$estado');";
							// 	if (mysqli_query($db_con,$query)) {
							//  	$datainsert['insertsucess'] = '<p style="color: green;">USUARIO AGREGADO EXITOSAMENTE</p>';
								 
							// }else{
							// 	$datainsert['inserterror']= '<p style="color: red;">USUARIO NO AGREGADO, REVISE LA INFORMACION</p>';
								
							// }
							
							$query = "INSERT INTO `usuario`(`nombre`, `correo`, `nombreUsuario`, `contraseña`, `estado`) VALUES ('$nombre', '$correo', '$nombreUsuario', '$contraseña','$estado');";
							$result = mysqli_query($db_con,$query);
							if ($result) {
							header('Location:nuevoUsuario.php?insert=sucess');
							}else{
						 	header('Location: nuevoUsuario.php?insert=error');
							}
						}else{
							$contraseñalan="Esta contraseña debe contener al menos 6 caracteres";
						}
					}else{
						$nombreUsuariolan= 'El nombre de usuario debe contener al menos 5 caracteres';
					}
				}else{
					$nombreUsuario_error="Este usuario ya fue utilizado, intente con uno diferente";
				}
			}else{
				$correo_error= "El correo existe actualmente";
			}
			
		}

		
	}
?> 
<h4 class="text-primary"><i class="fas fa-user-plus">NUEVO USUARIO</i></h4>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">RECURSOS HUMANOS</a></li>
     <li class="breadcrumb-item active" aria-current="page">AGREGAR UN NUEVO USUARIO</li>
  </ol>
</nav>
<div class="d-flex justify-content-center">
          	<?php 
          		if (isset($_GET['insert'])) {
          			if($_GET['insert']=='sucess'){ echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Tus datos han sido ingresados exitósamente</div>';}
          		}
          	;?>
</div>
<!-- <form action="guardarUsuario.php" method="POST"> -->
	<form method="POST" enctype="multipart/form-data">
	<div class="col-sm-6">
		<label for="nombre">Nombre:</label>
		<!-- <input type="text" class="form-control" name="nombre" placeholder=""  required autocomplete="off"> --> 
		<!-- CHECAR EL id DE MI VARIABLE 	id=inputEmail3 -->
		<input type="text" class="form-control" value="<?= isset($nombre)? $nombre:'' ?>" name="nombre" placeholder="" id="inputEmail3" required autocomplete="off"><?= isset($input_error['nombre'])? '<label for="inputEmail3" class="error">'.$input_error['nombre'].'</label>':'';  ?>
	</div>
	<div class="col-sm-6">
		<label for="correo">Correo electronico:</label>
		<!-- <input type="email" class="form-control" name="correo" placeholder="alguien@example.com"  required autocomplete="off"> -->
		<input type="email" class="form-control" value="<?= isset($correo)? $correo:'' ?>" name="correo" placeholder="alguien@example.com" id="inputEmail3" required autocomplete="off"><?= isset($input_error['correo'])? '<label class="error">'.$input_error['correo'].'</label>':'';  ?>
				      <?= isset($correo_error)? '<label class="error">'.$correo_error.'</label>':'';  ?>
	</div>
	<div class="col-sm-6">
		<label for="nombreUsuario">Nombre de usuario:</label>
		<!-- <input type="text" class="form-control" name="nombreUsuario" placeholder="Debe contener al menos 5 caracteres"  required autocomplete="off"> -->
		<input type="text" class="form-control" name="nombreUsuario" value="<?= isset($nombreUsuario)? $nombreUsuario:'' ?>"  id="inputPassword3" placeholder="Debe contener al menos 5 caracteres" required autocomplete="off"><?= isset($input_error['nombreU'])? '<label class="error">'.$input_error['nombresUsuario'].'</label>':'';  ?><?= isset($nombreUsuario_error)? '<label class="error">'.$nombreUsuario_error.'</label>':'';  ?><?= isset($nombreUsuariolan)? '<label class="error">'.$nombreUsuariolan.'</label>':'';  ?>
	</div>
	<div class="col-sm-6">
		<label for="contraseña">Contraseña:</label>
		<!-- <input type="password" class="form-control" name="contraseña" placeholder="Cree una contraseña segura"> -->
		<input type="password" class="form-control" name="contraseña"   placeholder="Cree una contraseña segura" id="inputPassword3"><?= isset($input_error['contraseña'])? '<label class="error">'.$input_error['contraseña'].'</label>':'';  ?> <?= isset($contraseñalan)? '<label class="error">'.$contraseñalan.'</label>':'';  ?>
	</div>
	<div class="col-sm-6">
		<label for="c_contraseña">Confirmar contraseña:</label>
		<!-- <input type="password" class="form-control" name="c_contraseña" placeholder="" > -->
		<input type="password" class="form-control" name="c_contraseña"  id="inputPassword3" placeholder=""><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($contraseñalan)? '<label class="error">'.$contraseñalan.'</label>':'';  ?>
	</div>
	<div class="form-group">
	<div class="col-sm-6">
		    <label for="estado">Estado de usuario:</label>
		    <select name="estado" class="form-control"  required="">
		    	<option value="">----Selecciona----</option>
		    	<option value="Activo">Activo</option>
		    	<option value="Inactivo">Inactivo</option>
		    </select>
	</div>
	</div>
	<br>
		<div class="text-center">
			<button type="submit" name="registrarU" class="btn btn-danger">REGISTRAR</button>
		</div>
	<br>
</form>		
