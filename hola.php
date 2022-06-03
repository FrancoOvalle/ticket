<?php  
require_once 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mensaje="
<style type='text/css'>
	body{
		text-align: center;
		background-color: #323232;
		color: #fff;
	}
	h1{
		font-family: brushstrike;
	}
	div{
		background-color: green;
		border-radius: 6px;
		padding: 5px;
		margin: 25px;
	}
</style>
<body>

<div>
	<h1>Gracias por comunicarse con nosotros</h1>
	<h2>Pronto nos comunicaremos con ud.</h2>
	<br>
	<p>Saluda a ud <strong>Soporte TIC - Los Angeles</strong></p>
	</div>
	
	</body>
";

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$correo = $_GET[mail];

$nombre = $_POST[name];



$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.minsal.cl';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'soportetic.losangeles@redsalud.gob.cl';                 // SMTP username
$mail->Password = 'Sl1234567';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->isHTML(true);

$mail->setFrom('soportetic.losangeles@redsalud.gob.cl', 'Soporte TIC - Los Angeles');
$mail->addAddress($correo, $nombre);     

$mail->Subject = 'Soporte TIC - Los Angeles';
$mail->Body = $mensaje;
//$mail->Body    = $mensaje;

if(!$mail->send()) {
    echo 'Error, mensaje no enviado';
    echo 'Error del mensaje: ' . $mail->ErrorInfo;
} else {
    echo 'El mensaje se ha enviado correctamente';
    Header( "Location: index.html" );
    
}
?>