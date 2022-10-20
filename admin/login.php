<?php require_once 'db_con.php'; 
session_start();
if(isset($_SESSION['user_login'])){
	header('Location: index.php');
}
	if (isset($_POST['login'])) {
		$username= $_POST['username'];
		$password= $_POST['password'];


		$input_arr = array();

		if (empty($username)) {
			$input_arr['input_user_error']= "";
		}

		if (empty($password)) {
			$input_arr['input_pass_error']= "";
		}

		if(count($input_arr)==0){
			$query = "SELECT * FROM `users` WHERE `username` = '$username';";
			$result = mysqli_query($db_con, $query);
			if (mysqli_num_rows($result)==1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['password']==sha1(md5($password))) {
					if ($row['status']=='activo') {
						$_SESSION['user_login']=$username;
						header('Location: index.php');
					}else{
						$status_inactive = "Su estado está inactivo, póngase en contacto con el administrador o el soporte";
					}
				}else{
					$worngpass= "Contraseña o Usurario Incorrectos";	
				}
			}else{
				$usernameerr= "Nombre de usuario no existe";
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
	<body style="background: #F9F9F9">
   	<section class="container mx-auto" style="margin-top: 5%;">
      <div class="row mx-auto justify-content-center align-items-center">
         <div class="col-md-10">
            <div class="panel panel-default row" style="background-color: #fff ;box-shadow: 2px 2px 2px 1px #474747; padding: 15px; border-radius: 15px;">
               <div class="col-12 col-md-4 d-flex align-self-center justify-content-center">
			   <?php if(isset($usernameerr)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $usernameerr; ?></div><?php };?>
          		<?php if(isset($worngpass)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngpass; ?></div><?php };?>
          		<?php if(isset($status_inactive)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $status_inactive; ?></div><?php };?>
				<img src="images/rh4.png" class="img-fluid">              
               </div>
		  <div class="panel-body col-12 col-md-8" style="color: #02416A">
                  <div class="page-header">
                     <h4 class="text-center">Hospital General de Huixtla</h4>
					 <h4 class="text-center">Dirección de Recursos Humanos</h4>
                  </div>
          <div class="form row">
            <div class="col-md-4 offset-md-4">
             	<form method="POST" action="">
				  <div class="form-group row">
				    <div class="col-sm-75">
					<label for="dni">Nombre de usuario:</label>
				      <input type="text" class="form-control" name="username" value="<?= isset($username)? $username: ''; ?>" placeholder="Usuario" id="inputEmail3" required autocomplete="off"> <?php echo isset($input_arr['input_user_error'])? '<label>'.$input_arr['input_user_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-75">
					  <label for="pass">Contraseña:</label>
				      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><label><?php echo isset($input_arr['input_pass_error'])? '<label>'.$input_arr['input_pass_error'].'</label>':''; ?>
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