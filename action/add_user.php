<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacío";
		}else if (empty($_POST['email'])){
			$errors[] = "Correo Vacio vacío";
		} else if ($_POST['status']==""){
			$errors[] = "Selecciona el estado";
		} else if (empty($_POST['password'])){
			$errors[] = "Contraseña vacío";
		} else if (empty($_POST['username'])){
			$errors[] = "Username Vacío";
		} else if ($_POST['depend_id']==""){
			$errors[] = "Debes seleccionar una Dependencia";
		}else if ($_POST['unidad_id']==""){
			$errors[] = "Debes seleccionar una Unidad";
		}else if ($_POST['tipo_us']==""){
			$errors[] = "Debes seleccionar un tipo de Usuario";
		}else if ($_POST['password']!=$_POST['password_comp']){
			$errors[] = "Las Contraseñas no coinciden";
		}else if(
			(!empty($_POST['name']) &&
			!empty($_POST['lastname']) &&
			$_POST['status']!="" &&
			!empty($_POST['password'])&&
			!empty($_POST['username'])&&
			$_POST['depend_id']!="" &&
			$_POST['unidad_id']!="" &&
			$_POST['password']==$_POST['password_comp']&&
			$_POST['tipo_us']!="")
		){

		include "../config/config.php"; //Contiene funcion que conecta a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$lastname=mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
		$email=$_POST["email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['status']);
		$end_name=$name." ".$lastname;
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];
		$dep_id=intval($_POST['depend_id']);
		$unid_id=intval($_POST['unidad_id']);
		$tipo_us=intval($_POST['tipo_us']);
		$userna=mysqli_real_escape_string($con,(strip_tags($_POST['username'],ENT_QUOTES)));
		$profile_pic="default.png";

		$usr = mysqli_query($con, "select * from user where username='".$userna."' OR email='".$email."'");
		foreach($usr as $dat_us):
			$email_b=$dat_us['email'];
			$username_b=$dat_us['username'];
		endforeach;

		if(empty($email_b) && empty($username_b)){
			$is_admin=0;
		if(isset($_POST["is_admin"])){$is_admin=1;}

			$sql="INSERT INTO user ( name, password, email, profile_pic, is_active, created_at, unidad_id, dependencia_id, tipo_us, username) VALUES ('$end_name','$password','$email','$profile_pic',$status,'$created_at','$unid_id','$dep_id','$tipo_us','$userna')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
		}else{
			$errors[]="usuario registrado";
		}


		
			
		}else{
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>