<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Session\Session;
require_once __DIR__ . '/../bootstrap/init.php';

$rutas = [
    'home' => [
        'titulo' => 'Página Principal',
    ],
    'login' => [
        'titulo' => 'Iniciar Sesión',
    ],
    'recuperar-password' => [
        'titulo' => 'Restablecer password',
    ],
    'actualizar-password' => [
        'titulo' => 'Restablecer Password',
    ],
    'productos' => [
        'titulo' => 'Administración de productos',
        'requiereAutenticacion' => true,
    ],
    'producto-nuevo' => [
        'titulo' => 'Producto nuevo',
        'requiereAutenticacion' => true,
    ],
    'producto-editar' => [
        'titulo' => 'Editar Producto',
        'requiereAutenticacion' => true,
    ],
    'producto-eliminar' => [
        'titulo' => 'Confirmar Eliminación de Producto',
        'requiereAutenticacion' => true,
    ],
    'usuarios' => [
        'titulo' => 'Usuarios',
    ],
    'compras' => [
        'titulo' => 'Compras',
    ],
    '404' => [
        'titulo' => 'Página no Encontrada',
    ],
];

$vistas = $_GET['v'] ?? 'login';

if (!isset($rutas[$vistas])) {
    $vistas = '404';
}

$autenticacion = new Autenticacion;
$requiereAutenticacion = $rutas[$vistas]['requiereAutenticacion'] ?? false;

if($requiereAutenticacion && 
    (!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin())
) {
    $_SESSION['mensaje_error'] = "Se requiere ser administrador para acceder a esta pantalla.";
    header("Location: index.php?v=login");
    exit;
}
$rutaTitulo = $rutas[$vistas];

$session = new Session();
$mensajeExito = $session->flash('mensaje_exito');
$mensajeError = $session->flash('mensaje_error');

unset($_SESSION['mensaje_exito'], $_SESSION['mensaje_error']);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simpsoneras : <?= $rutaTitulo['titulo'];?></title>
        <link rel="icon" href="imgs/logo.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="imgs/otros/logo.png" type="image/x-icon">
    </head>
    <body>
        <header class="navbar navbar-expand-md bd-navbar">
            <nav class="container-xxl flex-wrap flex-md-nowrap" aria-label="navegacion principal">
                <a href="index.php?v=home" id="logo" class="navbar-brand p-0 me-2" aria-label="Simpsoneras">
                    Simpsoneras :: <?= $rutaTitulo['titulo'];?>
                </a>
                <?php
                if($autenticacion->estaAutenticado() && $autenticacion->esAdmin()):
                ?>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                        </svg>
                    </button>
                    <div class="navbar-collapse collapse justify-content-md-end" id="bdNavbar">
                        <ul class="navbar-nav flex-md-row flex-wrap bd-navbar-nav pt-2 py-md-0">
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2" href="../index.php?v=home">Volver</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2" href="index.php?v=productos">Productos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2" href="index.php?v=usuarios">Usuarios</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <form action="acciones/auth-cerrar-sesion.php" method="post">
                                    <button type="submit" class="cerrar-sesion btn btn-dark border-0">
                                        <?= $autenticacion->getUsuario()->getEmail(); ?> (Cerrar Sesión)</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php
                endif;
                ?>
            </nav>
        </header>
        <main class="container">
            <?php 
            if($mensajeExito):
            ?>
                <div class="msg-success"><?= $mensajeExito;?></div>
            <?php 
            endif;
            ?>
            <?php 
            if($mensajeError):
            ?>
                <div class="msg-error"><?= $mensajeError;?></div>
            <?php 
            endif;
            ?>
            
            <?php
            $filename = __DIR__ . '/vistas/' . $vistas . '.php';
            if (file_exists($filename)) {
                require $filename;
            } else {
                require __DIR__ . '/vistas/404.php';
            }
            ?>
        </main>
        <footer>
            <div>
                <ul class="justify-content-center nav fs-3">
                    <li class="nav-item">
                        <a href="//www.facebook.com" class="nav-link"><i class="bi bi-facebook color"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="//www.twitter.com" class="nav-link"><i class="bi bi-twitter color"></i>
                        </a>
                    </li>
                    <li>
                        <a href="//www.instagram.com" class="nav-link"><i class="bi bi-instagram color"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="//www.youtube.com" class="nav-link"><i class="bi bi-youtube color"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
    </body>
</html>