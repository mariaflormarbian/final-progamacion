<?php

use DaVinci\Modelos\Usuario;

require_once __DIR__ . '/../../bootstrap/init.php';

$email = $_POST['email'];


$recuperar = new \DaVinci\Auth\RecuperarPassword();

$usuario = (new Usuario())->traerPorEmail($email);

if(!$usuario) {
    $_SESSION['mensaje_error'] = "No existe un usuario para este email.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=recuperar-password");
    exit;
}

try {
    $recuperar->enviarEmailDeRecuperacion($usuario);

    $_SESSION['mensaje_exito'] = "Se envió un email con las instrucciones a <b>" . $usuario->getEmail() . "</b>. Por favor revisá tu casilla, incluyendo por si acaso 'Correo no deseado' y 'spam'.";
    header("Location: ../index.php?v=login");
} catch(\Exception $e) {
    $_SESSION['mensaje_error'] = "Ocurrió un problema inesperado, el email no pudo ser enviado.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?v=recuperar-password");
}
