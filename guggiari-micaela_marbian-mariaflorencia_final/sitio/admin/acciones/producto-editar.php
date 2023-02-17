<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Producto;
use DaVinci\Validacion\ProductoValidar;
require_once __DIR__ . '/../../bootstrap/init.php';
require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion();
if(!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin()) {
    $_SESSION['mensaje_error'] = "Debe iniciar sesión para realizar esta acción";
    header('Location: ../index.php?v=login');
    exit;
}

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$productos_estados_fk = $_POST['productos_estados_fk'];
$precio = $_POST['precio'];
$texto = $_POST['texto'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$imagen = $_FILES['imagen'];
$etiquetas          = $_POST['etiquetas_id'] ?? [];

$productos = (new Producto())->traerPorId($id);

if (!$productos) {
    $_SESSION['mensaje_error'] = "El producto que estás tratando de editar no existe.";
    header("Location: ../index.php?v=productos");
    exit;
}

$validador = new ProductoValidar([
    'titulo' => $titulo,
    'productos_estados_fk' => $productos_estados_fk,
    'precio' => $precio,
    'texto' => $texto,
    'imagen' => $imagen,
    'imagen_descripcion' => $imagen_descripcion,

]);

if ($validador->hayErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['data_form'] = $_POST;

    header("Location: ./../index.php?v=producto-editar&id=" . $id);
    exit;
}

if (!empty($imagen['tmp_name'])) {
    $nombreImagen = date('YmdHis_') . slugify($imagen['name']);

    move_uploaded_file($imagen['tmp_name'], __DIR__ . '/../../imgs/' . $nombreImagen);
}

try {
    $productos->editar($id, [
        'usuarios_fk' => $autenticacion->getId(),
        'productos_estados_fk' => $productos_estados_fk,
        'titulo' => $titulo,
        'precio' => $precio,
        'texto' => $texto,
        'imagen' => $nombreImagen ?? $productos->getImagen(),
        'imagen_descripcion'  => $imagen_descripcion,
        'etiquetas' => $etiquetas,

    ]);

    if (
        isset($nombreImagen) &&
        !empty($productos->getImagen()) &&
        file_exists(__DIR__ . '/../../imgs/' . $productos->getImagen())
    ) {
        unlink(__DIR__ . '/../../imgs/' . $productos->getImagen());
    }

    $_SESSION['mensaje_exito'] = "El producto '<b>" . $titulo . "</b>' fue publicado con éxito.";

    header("Location: ./../index.php?v=productos");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje_error'] = "Ocurrió un error inesperado al tratar de grabar la información, el producto no pudo ser publicado. Por favor, probá de nuevo más tarde.";
    $_SESSION['data_form'] = $_POST;

    header("Location: ./../index.php?v=producto-editar&id=" . $id);
    exit;
}