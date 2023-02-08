<?php

use DaVinci\Auth\Autenticacion;
require_once __DIR__ . '/../../bootstrap/init.php';

$autenticacion = new Autenticacion();
$autenticacion->cerrarSesion();

$_SESSION['mensaje_exito'] = "Sesión cerrada correctamente.";
header("Location: ../index.php?v=login");
exit;