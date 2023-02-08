<?php
use DaVinci\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];

// TODO: Validar... verificar que los valores estén, que el email tenga formato correcto, etc.

$autenticacion = new Autenticacion();

if (!$autenticacion->iniciarSesion($email, $password)) {
    $_SESSION['data_form'] = $_POST;
    $_SESSION['mensaje_error'] = "Las credenciales ingresadas no coinciden con ningún usuario registrado en el sistema.";
    header("Location: ../index.php?v=iniciar-sesion");
    exit;
} 
$_SESSION['mensaje_exito'] = "Sesión iniciada correctamente.";
header("Location: ../index.php?v=perfil");
exit;