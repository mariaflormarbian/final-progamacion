<?php

use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\AddProduct;

require_once __DIR__ . '/../bootstrap/init.php';

$auth = new Autenticacion;

$id = $_POST["productos_id"];
$cantidad = $_POST["productos_cantidad"];
$subtotal = $_POST["productos_precio"];
$titulo = $_POST["productos_titulo"];

$products = (new AddProduct)->data();

if(!$auth->estaAutenticado()){
    $_SESSION['mensaje_error'] = "Para agregar un producto al carrito tenés que iniciar sesión.";
    header('Location: ../index.php?v=iniciar-sesion');
    exit;
}

foreach($products as $product){
    if($product->getProductsFk() == $id && $product->getCartFk() == $auth->getId()){
        $addedProductID = $product->getAddProductID();
        $actualQuantity = $product->getQuantity();
        try{
            (new AddProduct)->addProduct($addedProductID, [
                "cantidad" => $cantidad + $actualQuantity,
                "subtotal" => $subtotal * ($cantidad + $actualQuantity)
            ]);
            $_SESSION["mensaje_exito"] = "Productos añadidos correctamente.";
            header("Location: ../index.php?v=carrito");
            exit;
        } catch(Exception $e){
            $_SESSION["mensaje_error"] = "No se pudo añadir el producto. Probá más tarde. ";

            header("Location: ../index.php?v=listado");
            exit;
        }
    }
}

try{
    (new AddProduct)->addList([
        "carrito_fk" => $auth->getId(),
        "productos_fk" => $id,
        "titulo" => $titulo,
        "cantidad" => $cantidad,
        "subtotal" => $subtotal * $cantidad
    ]);
    $_SESSION["success_text"] = "Productos añadidos correctamente.";
    $_SESSION['mensaje_error'] = $auth->getId();
    header("Location: ../index.php?v=carrito");
    exit;
} catch(Exception $e) {
    $_SESSION["mensaje_error"] = "No se pudo añadir el producto. Probá más tarde." . $e;
    header("Location: ../index.php?v=listado");
    exit;
}