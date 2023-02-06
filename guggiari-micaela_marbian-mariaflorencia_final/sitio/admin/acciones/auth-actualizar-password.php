<?php

require_once __DIR__ . '/../../bootstrap/init.php';


$id                 = $_POST['id'];
$token              = $_POST['token'];
$password           = $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];


$recuperar = new \DaVinci\Auth\RecuperarPassword();
$recuperar->setUsuarioPorId($id);
$recuperar->setToken($token);

if(!$recuperar->esValido()) {
    $_SESSION['mensaje_error'] = "Este token no coincide con este usuario.";
    header("Location: ../index.php?V=actualizar-password&token=" . $token . "&usuario=" . $id);
    exit;
}

if($recuperar->expirado()) {
    $_SESSION['mensaje_error'] = "Este token está expirado. Si lo necesitás, podés pedir otro nuevo.";
    header("Location: ../index.php?V=recuperar-password");
    exit;
}

try {
    $recuperar->actualizarPassword(password_hash($password, PASSWORD_DEFAULT));

    $_SESSION['mensaje_exito'] = "El password fue actualizado correctamente.";
    header("Location: ../index.php?v=login");
    exit;
} catch(\Exception $e) {
    $_SESSION['mensaje_error'] = "Ocurrió un error inesperado, el password no pudo ser actualizado.";
    header("Location: ../index.php?v=actualizar-password&token=" . $token . "&usuario=" . $id);
    exit;
}