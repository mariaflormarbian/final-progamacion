<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Compra;
use DaVinci\Modelos\AgregarProducto;
require_once __DIR__ . '/../bootstrap/init.php';
$auth = new Autenticacion;

if(!$auth->estaAutenticado()){
    $_SESSION['mensaje_error'] = 'Debe iniciar sesión para poder comprar';
    header('Location: ../index.php?v=iniciar-sesion');
    exit;
}

$id = $auth->getId();
$cantidad = $_POST['productos_cantidad'];
$total = $_POST['productos_total'];
$productos = $_POST['productos'];
$orden = (new Compra)->data();
$productosAgregados = new AgregarProducto;

try
{
    (new Compra)->agregarCompras([
        "carrito_fk" => $id,
        "usuarios_fk" => $id,
        "fecha" => date('Y-m-d H:i:s'),
        "cantidad" => $cantidad,
        "total" => $total,
        "productos" => $productos

    ]);
    $productosAgregados->eliminarAgregarProducto($id);
    $_SESSION['mensaje_exito'] = '¡Éxito! Gracias por su compra';
    header('Location: ../index.php?v=perfil');
    exit;
} 
catch(Exception $e)
{
    $_SESSION['mensaje_error'] = 'Se produjo un error al finalizar la compra. Probá de nuevo más tarde';
    header('Location: ../index.php?v=carrito');
    exit;
}