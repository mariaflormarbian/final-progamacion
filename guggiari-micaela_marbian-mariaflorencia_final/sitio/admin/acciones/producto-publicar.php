<?php

use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Producto;
use DaVinci\Validacion\ProductoValidar;
require_once __DIR__ . '/../../bootstrap/init.php';

$autenticacion = new Autenticacion();

if(!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin()) {
    $_SESSION['mensaje_error'] = "Debe iniciar sesión para realizar esta acción";
    header('Location: ../index.php?v=login');
    exit;
}

$titulo = $_POST['titulo'];
$precio = $_POST['precio'];
$texto = $_POST['texto'];
$productos_estados_fk = $_POST['productos_estados_fk'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$video = $_POST['video'];
$imagen = $_FILES['imagen'];
$audio = $_FILES['audio'];
$etiquetas= $_POST['etiquetas_id'] ?? [];
$stock = $_POST['stock'];



$validador = new ProductoValidar([
    'titulo' => $titulo,
    'precio' => $precio,
    'texto' => $texto,
    'imagen' => $imagen,
    'video' => $video,
    'audio' => $audio,
    'imagen_descripcion' => $imagen_descripcion,
    'stock' => $stock,
]);

if ($validador->hayErrores()) {

    $_SESSION['errores'] = $validador->getErrores();

    $_SESSION['data_form'] = $_POST;


    header("Location: ./../index.php?v=producto-nuevo");

    exit;
}

if (!empty($imagen['tmp_name'])) {
    $nombreImagen = date('YmdHis_') . slugify($imagen['name']);

    move_uploaded_file($imagen['tmp_name'], __DIR__ . '/../../imgs/productos/' . $nombreImagen);
}

try {
    (new Producto())->crear([
        'usuarios_fk' => $autenticacion->getId(),
        'titulo' => $titulo,
        'productos_estados_fk' => $productos_estados_fk,
        'precio' => $precio,
        'texto' => $texto,
        'video' => $video,
        'audio' => $audio,
        'imagen' => $nombreImagen,
        'imagen_descripcion' => $imagen_descripcion,
        'etiquetas' => $etiquetas,
        'stock' => $stock,
    ]);
    
    $_SESSION['mensaje_exito'] = "El producto '<b>" . $titulo . "</b>' fue o con éxito.";

    header("Location: ./../index.php?v=productos");
    exit;

    // echo "<pre>";
    // var_dump($producto);
    // echo "</pre>";
} catch (\Exception $e) {
    $_SESSION['mensaje_error'] = "Ocurrió un error inesperado al tratar de grabar la información, el producto no pudo ser publicada. Por favor, probá de nuevo más tarde.";
    $_SESSION['data_form'] = $_POST;

    header("Location: ./../index.php?v=producto-nuevo");
    exit;
}