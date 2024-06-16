<?php
require '../vendor/autoload.php';

// Cargar variables de entorno desde .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Funciones y lógica del formulario
require 'validate_recaptcha.php';
require 'save_to_database.php';
require 'send_email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $mensajes = array();
    if (validateRecaptcha($recaptchaResponse)) {
        $mensajes[] = 'Validación de reCAPTCHA exitosa.';
        if (saveToDatabase($nombre, $email, $telefono, $ciudad)) {
            $mensajes[] = 'Guardado en la base de datos exitoso.';
            if (sendEmail($nombre, $email, $telefono, $ciudad)) {
                $mensajes[] = 'Correo enviado exitosamente.';
                echo json_encode(['success' => true, 'messages' => $mensajes]);
            } else {
                $mensajes[] = 'Error al enviar el correo.';
                echo json_encode(['success' => false, 'message' => 'Error al enviar el correo.', 'messages' => $mensajes]);
            }
        } else {
            $mensajes[] = 'Error al guardar en la base de datos.';
            echo json_encode(['success' => false, 'message' => 'Error al guardar en la base de datos.', 'messages' => $mensajes]);
        }
    } else {
        $mensajes[] = 'Validación de reCAPTCHA fallida.';
        echo json_encode(['success' => false, 'message' => 'Validación de reCAPTCHA fallida.', 'messages' => $mensajes]);
    }
} else {
    $mensajes[] = 'Método de solicitud no permitido.';
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido.', 'messages' => $mensajes]);
}
