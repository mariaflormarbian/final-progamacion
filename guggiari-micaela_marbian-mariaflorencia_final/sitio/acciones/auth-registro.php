<?php
use DaVinci\Modelos\Usuario;
use DaVinci\Modelos\Cart;

require_once __DIR__ . '/../bootstrap/init.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];

$validador = new \DaVinci\Validacion\Validador($_POST, [
    'email' => ['required', 'email'],
    'password' => ['required', 'min:6'],
    'password_confirmar' => ['required', 'min:6', 'equal:password'],
]);

if($validador->hayErrores()) {
    $_SESSION['data_form'] = $_POST;
    $_SESSION['mensaje_error'] = "Hay errores en los datos del formulario, por favor revisá que todo esté bien.";
    $_SESSION['errores'] = $validador->getErrores();
    header("Location: ../index.php?s=registro");
    exit;
}
try {
    (new Usuario)->crear([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'roles_fk' => 2,
    ]);


    $user = (new Usuario)->traerPorEmail($email);
    (new Cart)->createCart([
        "carrito_id" => $user->getUsuariosId(),
        "usuarios_fk" => $user->getUsuariosId(),
    ]);


    $_SESSION['mensaje_exito'] = "Usuario creado con éxito. Ya puede iniciar sesión.";
    header("Location: ../index.php?v=iniciar-sesion");
}catch(Exception $e){
    $_SESSION['mensaje_error'] = "Ocurrio un error inesperado al tratar de crear tu cuenta.";
    $_SESSION['mensaje_error'] = $e;

    header("Location: ../index.php?v=iniciar-sesion");
}