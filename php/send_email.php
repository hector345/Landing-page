<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($nombre, $email, $telefono, $ciudad)
{
    $mail = new PHPMailer(true);
    mb_internal_encoding('UTF-8');
    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Remitente y destinatarios
        $mail->setFrom($_ENV['SMTP_USER'], $_ENV['SMTP_usuario']);
        $mail->addAddress($email, $nombre);

        // Contenido del correo para el usuario principal
        $mail->isHTML(true);
        $mail->Subject = $_ENV['CORREO_ASUNTO']; // Usa el asunto del correo desde la variable de entorno
        $body = file_get_contents('email/templates/base.html'); // Lee el archivo de plantilla
        // {titulo} {color_fondo}{subtitulo}{texto} {img_logo} {img_footer} {color_texto} {color_footer}
        // html de texto {texto} usara $nombre, $email, $telefono, $ciudad
        $html_texto = "<p>Gracias por contactarnos, <strong>$nombre</strong>. Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>";
        $titulo = "¡Gracias por contactarnos!";
        $subtitulo = "Hemos recibido tu mensaje";
        // APP_URL
        $img_logo = $_ENV['APP_URL'] . "img/dfx_bco.webp";
        $img_footer = $_ENV['APP_URL'] . "img/dfx_bco.webp";
        $directorio_images = $_ENV['APP_URL'] . "images";
        $color_fondo = "#FFbd00 !important";

        $color_texto = "#000000";
        $color_footer = "#333";
        $texto = $html_texto;
        $body = str_replace(['{titulo}', '{color_fondo}', '{subtitulo}', '{texto}', '{img_logo}', '{img_footer}', '{color_texto}', '{color_footer}','{directorio_images}'], [$titulo, $color_fondo, $subtitulo, $texto, $img_logo, $img_footer, $color_texto, $color_footer, $directorio_images], $body);
        $mail->Body = $body;

        $mail->send();

        // Limpia los destinatarios y añade el destinatario CC
        $mail->clearAddresses();
        $mail->addAddress($_ENV['CORREO_CC']);

        // Contenido del correo para el destinatario CC
        $mail->Subject = $_ENV['CORREO_ASUNTO_CC']; // Usa un asunto distinto para el correo CC
        $html_texto2 = "<p>Nombre: <strong>$nombre</strong></p><p>Email: <strong>$email</strong></p><p>Teléfono: <strong>$telefono</strong></p><p>Ciudad: <strong>$ciudad</strong></p>";
        $titulo = "Nuevo mensaje de contacto";
        $subtitulo = "Datos del contacto";
        $img_logo = $_ENV['APP_URL'] . "img/dfx_bco.webp";
        $img_footer = $_ENV['APP_URL'] . "img/dfx_bco.webp";
        $directorio_images = $_ENV['APP_URL'] . "images";
        $color_fondo = "#FFbd00 !important";
        // negro
        $color_texto = "#000000";
        $color_footer = "#333";
        $texto = $html_texto2;
        $body2 = file_get_contents('email/templates/base.html');
        $body2 = str_replace(['{titulo}', '{color_fondo}', '{subtitulo}', '{texto}', '{img_logo}', '{img_footer}', '{color_texto}', '{color_footer}','{directorio_images}'], [$titulo, $color_fondo, $subtitulo, $texto, $img_logo, $img_footer, $color_texto, $color_footer, $directorio_images], $body2);
        $mail->Body = $body2;

        $mail->send();

        return true;
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
