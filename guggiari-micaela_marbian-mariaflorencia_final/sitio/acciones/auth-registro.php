<?php
use DaVinci\Modelos\Usuario;

require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];

// TODO VALIDAR 

try {
    (new Usuario)->crear([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'roles_fk' => 2,
    ]);




    $_SESSION['mensaje_exito'] = "Usuario creado con éxito. Ya puede iniciar sesión.";
    header("Location: ../index.php?v=iniciar-sesion");
}catch(Exception $e){
    $_SESSION['mensaje_error'] = "Ocurrio un error inesperado al tratar de crear tu cuenta.";
    header("Location: ../index.php?v=iniciar-sesion");
}