<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\AddProduct;

require_once __DIR__ . '/../bootstrap/init.php';

$auth = new Autenticacion;

if(!$auth->estaAutenticado()){
    $_SESSION["mensaje_error"] = "Se necesita iniciar sesión para realizar esta acción";
    header("Location: ../index.php?s=login");
    exit;

    if(!$auth->isAdmin()){
        $_SESSION["mensaje_error"] = "No tienes permisos para realizar esta acción";
        header("Location: ../index.php?v=carrito");
        exit;
    }
}

$id = $_POST["productos_id"];

$addedProduct = (new AddProduct)->traerPorId($id);

if(!$addedProduct){
    $_SESSION["mensaje_error"] = "El producto que estás intentando eliminar no existe";
    header("Location: ../index.php?v=carrito");
    exit;
}

try{
    $addedProduct->delete();
    $_SESSION["mensaje_exito"] = "Producto eliminado correctamente";
    header("Location: ../index.php?v=carrito");
    exit;
} catch (Exception $e){
    $_SESSION["mensaje_error"] = "Se produjo un error al intentar eliminar el producto";
    header("Location: ../index.php?v=carrito");
    exit;
}