<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Producto;
require_once __DIR__ . '/../../bootstrap/init.php';

$autenticacion = new Autenticacion();

if(!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin()) {
    $_SESSION['mensaje_error'] = "Debe iniciar sesión para realizar esta acción";
    header('Location: ../index.php?v=login');
    exit;
}

$id = $_POST['id'];

$productos = (new Producto())->traerPorId($id);

if (!$productos) {
    $_SESSION['mensaje_error'] = "El producto que estás tratando de eliminar no parece existir.";
    header("Location: ../index.php?v=productos");
    exit;
}

try {
    $productos->eliminar();
    
    if (!empty($productos->getImagen()) && file_exists(__DIR__ . '/../../imgs/' . $productos->getImagen())) {
        unlink(__DIR__ . '/../../imgs/productos/' . $productos->getImagen());
    }

    $_SESSION['mensaje_exito'] = "El producto  <b>" . $productos->getTitulo() . "</b> fue eliminado con éxito.";
    header("Location: ../index.php?v=productos");
    exit;
} 
catch (\Exception $e) 
{
    $_SESSION['mensaje_error'] = "Ocurrió un problema inesperado al tratar de eliminar el producto. Por favor, probá de nuevo más tarde.";
    header("Location: ../index.php?v=productos");
    exit;
}