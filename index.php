<?php require_once 'admin/db_con.php'; 
session_start();
if(isset($_SESSION['user_login'])){
	header('Location: admin/index.php');
}
	if (isset($_POST['login'])) {
		$nombreUsuario= $_POST['nombreUsuario'];
		$contraseña= $_POST['contraseña'];
		$input_arr = array();
		if (empty($nombreUsuario)) {
			$input_arr['input_usuario_error']= "";
		}

		if (empty($contraseña)) {
			$input_arr['input_contraseña_error']= "";
		}

		if(count($input_arr)==0){
			$query = "SELECT * FROM `usuario` WHERE `nombreUsuario` = '$nombreUsuario';";
			$result = mysqli_query($db_con, $query);
			if (mysqli_num_rows($result)==1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['contraseña']==sha1(md5($contraseña))) {
					if ($row['estado']=='Activo') {
						$_SESSION['user_login']=$nombreUsuario;
						header('Location: admin/index.php');
					}else{
						$estado_inactivo= "Su estado está inactivo, póngase en contacto con el administrador o el soporte";
					}
				}else{
					$worngContraseña= "Contraseña o Usuario Incorrectos";	
				}
			}else{
				$nombreUsuarioorr= "Nombre de usuario no existe";
			}
		}
		
	}


?>
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
	<title>Hospital General de Huixtla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" type="image/png" href="images/chis.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
  </head>
	<body style="background: #F9F9F9">
   	<section class="container mx-auto" style="margin-top: 5%;">
      <div class="row mx-auto justify-content-center align-items-center">
         <div class="col-md-10">
            <div class="panel panel-default row" style="background-color: #fff ;box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); padding: 15px; border-radius: 15px;">
               <div class="col-12 col-md-4 d-flex align-self-center justify-content-center">
			   <?php if(isset($nombreUsuarioorr)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $nombreUsuarioorr; ?></div><?php };?>
          		<?php if(isset($worngContraseña)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngContraseña; ?></div><?php };?>
          		<?php if(isset($estado_inactivo)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $estado_inactivo; ?></div><?php };?>
				<img src="./admin/images/rh4.png" class="img-fluid">              
               </div>
		  <div class="panel-body col-12 col-md-8" style="color: #02416A">
                  <div class="page-header">
                     <h4 class="text-center">Hospital General Huixtla</h4>
					 <h4 class="text-center">Dirección de Recursos Humanos</h4>
                  </div>
          <div class="form row">
            <div class="col-md-4 offset-md-4">
             	<form method="POST" action="">
				  <div class="form-group row">
				    <div class="col-sm-75">
					<label for="dni">Nombre de usuario:</label>
				      <input type="text" class="form-control" name="nombreUsuario" value="<?= isset($nombreUsuario)? $nombreUsuario: ''; ?>" placeholder="Usuario" id="inputEmail3" required autocomplete="off"> <?php echo isset($input_arr['input_usuario_error'])? '<label>'.$input_arr['input_usuario_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-75">
					  <label for="pass">Contraseña:</label>
				      <input type="password" name="contraseña" class="form-control" id="inputPassword3" placeholder="Contraseña"><label><?php echo isset($input_arr['input_contraseña_error'])? '<label>'.$input_arr['input_contraseña_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="text-center">
				      <button type="submit" name="login" class="btn btn-primary">Ingresar</button>
				    </div>
				    <p>¿Olvidaste tu contraseña? <a href="register.php">Restablecer contraseña</a></p>
				  </div>
				</form>
            </div>
          </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
    	$('.toast').toast('show')

    </script>
  </body>
</html>