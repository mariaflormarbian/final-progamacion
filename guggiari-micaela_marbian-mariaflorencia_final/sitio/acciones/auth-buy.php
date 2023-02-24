<?php


use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Compra;

use DaVinci\Modelos\AddProduct;
require_once __DIR__ . '/../bootstrap/autoload.php';

$auth = new Autenticacion;

if(!$auth->estaAutenticado()){
    $_SESSION['error_text'] = 'Debe iniciar sesión para poder comprar';
    header('Location: ../index.php?s=login');
    exit;
}

$id = $auth->getId();
$cantidad = $_POST['productos_cantidad'];
$total = $_POST['productos_total'];
$productos = $_POST['productos'];

$orders = (new Compra)->data();
$addedProducts = new AddProduct;

try{
    (new Compra)->addPurchases([
        "carrito_fk" => $id,
        "usuarios_fk" => $id,
        "fecha" => fecha('Y-m-d H:i:s'),
        "cantidad" => $cantidad,
        "total" => $total,
        "productos" => $productos

    ]);
    $addedProducts->removeAddProduct($id);
    $_SESSION['success_text'] = '¡Éxito! Gracias por su compra';
    header('Location: ../index.php?v=perfil');
    exit;
} catch(Exception $e){
    $_SESSION['error_text'] = 'Se produjo un error al finalizar la compra. Probá de nuevo más tarde';
    header('Location: ../index.php?v=carrito');
    exit;
}
