<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['title'])){
			$errors[] = "Titulo vacío";
		} else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		}  else if (
			!empty($_POST['title']) &&
			!empty($_POST['description'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		// cargar datos de ticket para obtener el id 
		$id=$_POST['mod_id'];

		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];
		
		$status =mysqli_query($con, "select * from status where id=$status_id");
		foreach ($status as $sta):
			$estado = $sta['name'];
		endforeach;

		$usr = mysqli_query($con, "select * from user inner join ticket on user.id=ticket.user_id where ticket.id='".$id."';");
		foreach($usr as $dat_us):
			$email=$dat_us['email'];
			$num_ticket=$dat_us['num_ticket'];
			$name=$dat_us['name'];
		endforeach;

		// configuracion para correo 



		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);

		//fin config correo 

		$sql = "update ticket set title=\"$title\",category_id=\"$category_id\",project_id=\"$project_id\",priority_id=\"$priority_id\",description=\"$description\",status_id=\"$status_id\",kind_id=\"$kind_id\",updated_at=NOW() where id=$id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){


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
					$mail->Body    = 'El ticket Numero '.$num_ticket.' que esta asociado al funcionario '. $name. '<br><br>  Ha cambiado de estado a <b>'.$estado.'</b>  por el personal de Soporte TIC.';    // Contenido del mensaje (acepta HTML)

					$mail->AltBody = 'Atte. Soporte TIC ';    // Contenido del mensaje alternativo (texto plano)
			
						// fin correo 
				$mail->send();
				$msj= 'El mensaje ha sido enviado';
				} catch(Exception $e) {
				$msj='El mensaje no se ha podido enviar, error: '. $mail->ErrorInfo;
			}



				$messages[] = "El ticket ha sido actualizado satisfactoriamente.".$msj;
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