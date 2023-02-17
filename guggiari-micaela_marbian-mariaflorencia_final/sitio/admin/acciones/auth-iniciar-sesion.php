<?php
use DaVinci\Auth\Autenticacion;

require_once __DIR__ . '/../../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];

// TODO: Validar... verificar que los valores estén, que el email tenga formato correcto, etc.
$autenticacion = new Autenticacion();

if ($autenticacion->iniciarSesion($email, $password)) {
    $_SESSION['mensaje_exito'] = "Sesión iniciada correctamente.";
    header("Location: ../../index.php?v=perfil");
    exit;
} else {
    $_SESSION['mensaje_error'] = "Las credenciales ingresadas no coinciden con ningún usuario registrado en el sistema.";
    $_SESSION['old_data'] = $_POST;
    header("Location: ../index.php?v=login");
    exit;
}