<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
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
 
    $mail->setFrom('soportetic.losangeles@redsalud.gob.cl');		// Mail del remitente
    $mail->addAddress('franco.ovalle@redsalud.gob.cl');     // Mail del destinatario
 
    $mail->isHTML(true);
    $mail->Subject = 'Sistema de ticket N 1312';  // Asunto del mensaje
    $mail->Body    = 'Saludos ticket <b>MECHE!</b>';    // Contenido del mensaje (acepta HTML)
    $mail->AltBody = 'ATTE. FRANCO OVALLE';    // Contenido del mensaje alternativo (texto plano)
 
    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
