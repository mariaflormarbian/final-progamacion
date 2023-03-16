<?php
use DaVinci\Database\Conexion;

require_once __DIR__ . '/../bootstrap/init.php';

$db = Conexion::getConexion();


if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];
    $consulta = $db->query("SELECT * FROM productos WHERE titulo LIKE '%$busqueda%'");

    while  ($row = $consulta->fetch_array()) {
        echo $row ['titulo'];
    }
}


$_SESSION['mensaje_exito'] = "Sesión cerrada correctamente.¡Te esperamos pronto!";
header("Location: ../index.php?v=inicio");
exit;

?>