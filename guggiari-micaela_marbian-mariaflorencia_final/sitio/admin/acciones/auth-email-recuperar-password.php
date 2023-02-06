<?php
use DaVinci\Modelos\Usuario;
require_once __DIR__ . '/../../bootstrap/init.php';
require_once __DIR__ . '/../../bootstrap/autoload.php';



$email = $_POST['email'];

$recuperar = new \DaVinci\Auth\RecuperarPassword();
$usuario = (new Usuario())->traerPorEmail($email);

if (!$usuario) {
    $_SESSION['mensaje_error'] ="No hay ningún usuario registrado a este email";
    $_SESSION['data_form'] = $_POST;
    header("Location ../index.php?v=recuperar-password");
    exit;
}
try {
    $recuperar->enviarEmailDeRecuperacion($usuario);

    $_SESSION['mensaje_exito']= "Se envió un email con un link a <b>". $usuario->getEmail() .
        header("Location: ../index.php?v=login");
}catch (\Exception $e){
    $_SESSION['mensaje_error'] ="Ocurrió un problema con el email";
    $_SESSION['data_form'] = $_POST;
    header("Location ../index.php?v=recuperar-password");
}