<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\AgregarProducto;
require_once __DIR__ . '/../bootstrap/init.php';

$auth = new Autenticacion;
$id = $_POST["productos_id"];
$cantidad = $_POST["productos_cantidad"];
$subtotal = $_POST["productos_precio"];
$precio = $_POST["productos_precio"];
$titulo = $_POST["productos_titulo"];
$productos = (new AgregarProducto)->data();

if(!$auth->estaAutenticado()){
    $_SESSION['mensaje_error'] = "Para agregar un producto al carrito tenés que iniciar sesión.";
    header('Location: ../index.php?v=iniciar-sesion');
    exit;
}

foreach($productos as $producto){
    if($producto->getProductosFk() == $id && $producto->getCarritoFk() == $auth->getId()){
        $agregarProductoID = $producto->getAgregarProductoID();
        $actualCantidad = $producto->getCantidad();
        try
        {
            (new AgregarProducto)->AgregarProducto($agregarProductoID, [
                "cantidad" => $cantidad + $actualCantidad,
                "subtotal" => $subtotal * ($cantidad + $actualCantidad)
            ]);
            $_SESSION["mensaje_exito"] = "Productos añadidos correctamente.";
            header("Location: ../index.php?v=carrito");
            exit;
        } 
        catch(Exception $e)
        {
            $_SESSION["mensaje_error"] = "No se pudo añadir el producto. Probá más tarde. ";
            header("Location: ../index.php?v=catalogo");
            exit;
        }
    }
}

try
{
    (new AgregarProducto)->agregarListado([
        "carrito_fk" => $auth->getId(),
        "productos_fk" => $id,
        "titulo" => $titulo,
        "cantidad" => $cantidad,
        "subtotal" => $subtotal * $cantidad,
        "precio" => $precio
    ]);
    $_SESSION["success_text"] = "Productos añadidos correctamente.";
    header("Location: ../index.php?v=carrito");
    exit;
} 
catch(Exception $e) 
{
    $_SESSION["mensaje_error"] = "No se pudo añadir el producto. Probá más tarde." . $e;
    header("Location: ../index.php?v=catalogo");
    exit;
}