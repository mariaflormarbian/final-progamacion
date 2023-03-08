<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\AgregarProducto;
require_once __DIR__ . '/../bootstrap/init.php';

$auth = new Autenticacion;

if(!$auth->estaAutenticado()){
    $_SESSION["mensaje_error"] = "Se necesita iniciar sesión para realizar esta acción";
    header("Location: ../index.php?s=login");
    exit;

    if(!$auth->esAdmin()){
        $_SESSION["mensaje_error"] = "No tienes permisos para realizar esta acción";
        header("Location: ../index.php?v=carrito");
        exit;
    }
}

$id = $_POST["productos_id"];
$productoAgregado = (new AgregarProducto)->traerPorId($id);

if(!$productoAgregado){
    $_SESSION["mensaje_error"] = "El producto que estás intentando eliminar no existe";
    header("Location: ../index.php?v=carrito");
    exit;
}

try
{
    $productoAgregado->eliminar();
    $_SESSION["mensaje_exito"] = "Producto eliminado correctamente";
    header("Location: ../index.php?v=carrito");
    exit;
} 
catch (Exception $e)
{
    $_SESSION["mensaje_error"] = "Se produjo un error al intentar eliminar el producto";
    $_SESSION["mensaje_error"] = $e;
    header("Location: ../index.php?v=carrito");
    exit;
}