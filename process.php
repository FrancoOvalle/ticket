<?php 

if(!empty($_POST)){
	
	$mail=$_POST['email'];
	$name=$_POST['name'];
	$telefono=$_POST['telefono'];
	$mensaje=$_POST['contenido'];
	$correo="soportetic.losangeles@redsalud.gob.cl";
	
	echo $_POST['email'];

	
	echo "<h1> $name acaba de Comunicarse con Nosotros</h1>
	<h2>Via web debemos contactarlo en:</h2>
	<br>
	<br>
	<table class='table table-bordered'>

		<tr>

			<th>Nombre</th>
			<th>Telefono</th>
			<th>Correo</th>

		</tr>
		<tr>

			<td>$name</td>
			<td>$telefono</td>
			<td>$mail</td>
	</tr>
	 </table>
	<br>
	<h4>Contenido del mensaje</h4>
	<p>$mensaje</p>

	<br>
	<br>
	<p>Saluda a ud <strong>Soporte TIC - Los Angeles</strong></p>";




//---------------- Envio Correo Empresa -----------------------------------
require_once 'PHPMailer/PHPMailerAutoload.php';

$mail1 = new PHPMailer;
$mensaje1="<h1> $name acaba de Comunicarse con Nosotros</h1>
	<h2>Via web debemos contactarlo en:</h2>
	<br>
	<br>
	<table class='table table-bordered'>

		<tr>

			<th>Nombre</th>
			<th>Telefono</th>
			<th>Correo</th>

		</tr>
		<tr>

			<td>$name</td>
			<td>$telefono</td>
			<td>$mail</td>
			
	</tr>
	 </table>
	<br>
	<h4>Contenido del mensaje</h4>
	<p>$mensaje</p>
	<br>
	<br>
	<p>Saluda a ud <strong>Soporte TIC - Los Angeles</strong></p>";

//$mail->SMTPDebug = 3;                               // Enable verbose debug output



$mail1->isSMTP();                                      // Set mailer to use SMTP
$mail1->Host = 'mail.minsal.cl';  // Specify main and backup SMTP servers
$mail1->SMTPAuth = true;                               // Enable SMTP authentication
$mail1->Username = 'soportetic.losangeles@redsalud.gob.cl';                 // SMTP username
$mail1->Password = 'Sl1234567';                           // SMTP password
$mail1->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail1->Port = 995;                                    // TCP port to connect to
$mail1->isHTML(true);

//$mail1->setFrom('reservas@petronquines.cl', 'Petronquines SPA');
//$mail1->addAddress('reservas@petronquines.cl', 'Petronquines SPA');     

$mail1->setFrom('soportetic.losangeles@redsalud.gob.cl', 'Soporte Tic - Los Angeles');
$mail1->addAddress( $correo , 'Soporte Tic - Los Angeles');  

$mail1->Subject = 'Soporte Tic ';
$mail1->Body    = $mensaje1;

if(!$mail1->send()) {
    echo 'Error, mensaje no enviado';
    echo 'Error del mensaje: ' . $mail1->ErrorInfo;
} else {
    echo 'El mensaje se ha enviado correctamente';
    Header( "Location: hola.php?mail=$mail" );
}
}
//---------------- Mensaje de Cotizacion Procesada ------------------------
?>
