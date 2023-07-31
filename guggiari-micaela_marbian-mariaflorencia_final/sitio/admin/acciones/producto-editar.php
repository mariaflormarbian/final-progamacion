<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Producto;
use DaVinci\Validacion\ProductoValidar;
require_once __DIR__ . '/../../bootstrap/init.php';
require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion();

$id = $_POST['id'];
$productos = (new Producto())->traerPorId($id);

if (!$productos) {
    $_SESSION['mensaje_error'] = "El producto que estás tratando de editar no existe.";
    header("Location: ../index.php?v=productos");
    exit;
}

$titulo = $_POST['titulo'];
$productos_estados_fk = $_POST['productos_estados_fk'];
$precio = $_POST['precio'];
$texto = $_POST['texto'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$etiquetas = $_POST['etiquetas_id'] ?? [];
$audio = $_FILES['audio'];
$video =  $_POST['video'];

$nombreImagen = '';
if (!empty($_FILES['imagen']['tmp_name'])) {
    $nombreImagen = date('YmdHis_') . slugify($_FILES['imagen']['name']);
    move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../../imgs/productos/' . $nombreImagen);
} else {
    // Si no se ha seleccionado una nueva imagen, mantener la imagen existente
    $nombreImagen = $productos->getImagen();
}

$nombreAudio = '';
if (!empty($_FILES['audio']['tmp_name'])) {
    $nombreAudio = date('YmdHis_') . slugify($_FILES['audio']['name']);
    move_uploaded_file($_FILES['audio']['tmp_name'], __DIR__ . '/../../audio/' . $nombreAudio);
} else {
    // Si no se ha seleccionado un nuevo audio, mantener el audio existente
    $nombreAudio = $productos->getAudio();
}

$validador = new ProductoValidar([
    'titulo' => $titulo,
    'productos_estados_fk' => $productos_estados_fk,
    'precio' => $precio,
    'texto' => $texto,
    'imagen' => $_FILES['imagen'], // Pasamos el archivo directamente al validador
    'imagen_descripcion' => $imagen_descripcion,
    'audio' => $_FILES['audio'], // Pasamos el archivo directamente al validador
    'video' => $video,
]);

if ($validador->hayErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['data_form'] = $_POST;

    header("Location: ./../index.php?v=producto-editar&id=" . $id);
    exit;
}

try {
    $productos->editar($id, [
        'usuarios_fk' => $autenticacion->getId(),
        'productos_estados_fk' => $productos_estados_fk,
        'titulo' => $titulo,
        'precio' => $precio,
        'texto' => $texto,
        'imagen' => $nombreImagen, // Utilizamos la variable $nombreImagen
        'imagen_descripcion' => $imagen_descripcion,
        'etiquetas' => $etiquetas,
        'audio' => $nombreAudio, // Utilizamos la variable $nombreAudio
        'video' => $video,
    ]);

    // Eliminar imágenes y audios antiguos solo si se seleccionaron nuevos archivos
    if (!empty($_FILES['imagen']['tmp_name']) && !empty($productos->getImagen()) && file_exists(__DIR__ . '/../../imgs/' . $productos->getImagen())) {
        unlink(__DIR__ . '/../../imgs/' . $productos->getImagen());
    }

    if (!empty($_FILES['audio']['tmp_name']) && !empty($productos->getAudio()) && file_exists(__DIR__ . '/../../audio/' . $productos->getAudio())) {
        unlink(__DIR__ . '/../../audio/' . $productos->getAudio());
    }

    $_SESSION['mensaje_exito'] = "El producto '<b>" . $titulo . "</b>' fue publicado con éxito.";

    header("Location: ./../index.php?v=productos");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje_error'] = "Ocurrió un error inesperado al tratar de grabar la información, el producto no pudo ser publicado. Por favor, probá de nuevo más tarde.";
    $_SESSION['data_form'] = $_POST;
    $_SESSION['mensaje_error'] = $e;

    header("Location: ./../index.php?v=producto-editar&id=" . $id);
    exit;
}