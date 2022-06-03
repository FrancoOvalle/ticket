<?php	
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if (
			!empty($_POST['title']) &&
			!empty($_POST['description'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		// cargar datos de ticket para obtener el id 

		$num_ticket = mysqli_query($con, "SELECT random_num FROM ( SELECT FLOOR(Rand() * 99999) AS random_num UNION SELECT FLOOR(Rand() * 99999) AS random_num ) AS numbers_mst_plus_1 WHERE `random_num` NOT IN (SELECT num_ticket FROM ticket) LIMIT 1;
");
foreach($num_ticket as $num_t):
echo "  Numero de ticket ".$num_t['random_num'];
endforeach;

		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		if ($_SESSION['tipo_us']==2){
		$user_id = $_SESSION["user_id"];
		}else{
			$user_id = $_POST["user_id"];
		}
		$usr = mysqli_query($con, "select * from user where id='".$_POST["user_id"]."';");
		foreach($usr as $dat_us):
			$email=$dat_us['email'];
			$name=$dat_us['name'];
		endforeach;
		
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];
		$created_at="NOW()";
		$num_ticket = $num_t['random_num'];

		// configuracion para correo 



		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);

		//fin config correo
		

		// $user_id=$_SESSION['user_id'];

		$sql="insert into ticket (title,description,category_id,project_id,priority_id,user_id,status_id,kind_id,created_at, num_ticket) value (\"$title\",\"$description\",\"$category_id\",\"$project_id\",$priority_id,$user_id,$status_id,$kind_id,$created_at,$num_ticket)";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){

				try {
					//$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
					$mail->isSMTP();
					$mail->Host = 'mail.minsal.cl';  // Host de conexión SMTP
					$mail->SMTPAuth = true;
					$mail->Username = 'soportetic.losangeles@redsalud.gob.cl';                 // Usuario SMTP
					$mail->Password = 'Sl1234567';                           // Password SMTP
					$mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
					$mail->Port = 587;                                    // Puerto SMTP
			
					#$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
					#$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
					#$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
			
					$mail->setFrom('soportetic.losangeles@redsalud.gob.cl', 'Soporte Tic');		// Mail del remitente
					$mail->addAddress($email);     // Mail del destinatario
					$mail->addBCC('soportetic.losangeles@redsalud.gob.cl');
					$mail->addBCC('franco.ovalle@redsalud.gob.cl');
			
					$mail->isHTML(true);
					$mail->Subject = 'Sistema de ticket N '.$num_ticket;  // Asunto del mensaje
					$mail->Body    = 'El ticket Numero '.$num_ticket.'  esta asociado al funcionario '. $name. '<br><br>  Este sera resuelto lo antes posible por el personal de Soporte TIC.';    // Contenido del mensaje (acepta HTML)

					$mail->AltBody = 'Atte. Soporte TIC ';    // Contenido del mensaje alternativo (texto plano)
			
						// fin correo 
				$mail->send();
				$msj= 'El mensaje ha sido enviado';
				} catch(Exception $e) {
				$msj='El mensaje no se ha podido enviar, error: '. $mail->ErrorInfo;
			}

				$messages[] = "Tu ticket ha sido ingresado satisfactoriamente. <br> ".$msj;


			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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