<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\AgregarProducto;
require_once __DIR__ . '/../bootstrap/init.php';

$auth = new Autenticacion;

if(!$auth->estaAutenticado()){
    $_SESSION["mensaje_error"] = "Se necesita iniciar sesión para realizar esta acción";
    header("Location: ../index.php?v=iniciar-sesion");
    exit;
}

$id = $_POST["productos_id"];
$productoAgregado = new AgregarProducto;

if(!$productoAgregado){
    $_SESSION["mensaje_error"] = "No existe un carrito para vaciar";
    header("Location: ../index.php?s=carrito");
    exit;
}

try
{
    $productoAgregado->eliminarAgregarProducto($id);
    $_SESSION["mensaje_exito"] = "Carrito vaciado correctamente";
    header("Location: ../index.php?v=carrito");
    exit;
} 
catch (Exception $e)
{
    $_SESSION["mensaje_error"] = "Se produjo un error al intentar vaciar el carrito";
    header("Location: ../index.php?v=carrito");
    exit;
}