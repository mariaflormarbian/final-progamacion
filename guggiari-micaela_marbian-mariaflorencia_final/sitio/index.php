<?php
use DaVinci\Auth\Autenticacion;

require_once __DIR__ . '/bootstrap/init.php';
require_once __DIR__ . '/bibliotecas/helpers.php';

$rutas = [
    'home' => [
    'titulo' => 'Página Principal',
    ],
    'listado' => [
    'titulo' => 'Productos',
    ],
    'detalle' => [
    'titulo' => 'Detalles',
    ],
    'iniciar-sesion' => [
        'titulo' => 'Ingresa a tu cuenta',
    ],
    'registro' => [
        'titulo' => 'Crea una nueva cuenta',
    ],
    'perfil' => [
        'titulo' => 'Mi Perfil',
        'requiereAutenticacion' => true,
    ],
    'contacto' => [
    'titulo' => 'Contactános',
    ],
    'carrito' => [
        'titulo' => 'Carrito',
    ],
    '404' => [
    'titulo' => 'Página no Encontrada',
    ],
];

$vistas = $_GET['v'] ?? 'home';

if(!isset($rutas[$vistas])) {
    $vistas = '404';
}
$rutaTitulo = $rutas[$vistas];  

//Autenticacion
$autenticacion = new Autenticacion;
$requiereAutenticacion = $rutaConfig['requiereAutenticacion'] ?? false;

if ($requiereAutenticacion && !$autenticacion->estaAutenticado()) {
    $_SESSION['mensaje_error'] = "Se requiere haber iniciado sesión para acceder a esta pantalla.";
    header("Location: index.php?v=iniciar-sesion");
    exit;
}

$mensajeExito = $_SESSION['mensaje_exito'] ?? null;
$mensajeError = $_SESSION['mensaje_error'] ?? null;

unset($_SESSION['mensaje_exito'], $_SESSION['mensaje_error']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpsoneras : <?= $rutaTitulo['titulo'];?></title>
    <link rel="icon" href="imgs/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="imgs/logo.png" type="image/x-icon" />
</head>

<body>
    <header>
        <a href="index.php?v=home">
            <h1 id="logo">Simpsoneras :: <?= $rutaTitulo['titulo'];?></h1>
        </a>
        <nav class=" nav navbar-expand navbar-dark pt-4">
            <div id="barra" class="navbar-collapse collapse">
                <ul class="navbar-nav nav-tabs text-center ms-auto">
                    <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=home">Home</a></li>
                    <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=listado">Listado</a></li>
                    <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=contacto">Contacto</a>
                    </li>
                    <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=carrito">Carrito</a>
                    </li>
                    <?php
                    if ($autenticacion->estaAutenticado()):
                    ?>
                        <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=perfil">Mi Perfil</a>
                        </li>
                        <li >
                            <form action="acciones/auth-cerrar-sesion.php" method="post">
                                <button class="btn btn-danger" type="submit">
                                    <?= $autenticacion->getUsuario()->getEmail(); ?> 
                                    (Cerrar Sesion)
                                </button>
                            </form>
                        </li>
                    <?php 
                    else:
                    ?>
                        <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=iniciar-sesion">Iniciar Sesion</a></li>
                        <li class="nav-item px-2 mx-2"><a class="btn nav-link" href="index.php?v=registro">Registrarse</a></li>
                    <?php 
                    endif;
                    ?>

                </ul>
            </div>
        </nav>
    </header>
    <div class="main-content">
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
        if(file_exists($filename)) {
            require $filename;
        } else {
            require __DIR__ . '/vistas/404.php';
        }
        ?>
    </div>
    <footer>
        <div class="container pt-6">

            <div class="d-flex pt-6 justify-content-center">
                <div  class="mx-6"><img width="100" src="imgs/logo.png" alt="simpsoneras indumentaria logo" title="exoma remeras logo"></div>
            <div class="px-6 ">
                <h3>Encontrános</h3>
                <ul  class="px-0">
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <p>Local 1: <span>Av. Rivadavia 5040 Piso 1D</span></p>
                    </li>
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <p>Local 2: <span>Av. Cabildo 3560</span></p>
                    </li>
                </ul>
            </div>

                <div class="px-6">
                    <h3>Contactános</h3>
                    <ul class="px-0">

                        <li>
                            <i class="fa fa-phone"></i>
                            <p>Teléfono: <span>11 2759-1970 </span></p>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <p>Mail: <a href="mailto:info@simpsoneras.com" class="dropdown">info@simpsoneras.com</a></p>
                        </li>
                    </ul>
                </div>

            <div class="px-6">
                <h3>Sigamos conectados</h3>
                <ul class="d-flex px-0">

                    <li>
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
            </div>
        </div>


        <div>
            <div>
                <ul class="d-flex justify-content-center">
                    <li class="p-3"><a href="index.php?v=listado">Sobre Nosotros</a></li>
                    <li class="p-3"><a href="index.php?v=listado">Showroom</a></li>
                    <li class="p-3"><a href="index.php?v=contacto">Contactenos</a></li>
                </ul>
            </div>

        </div>
        <div>
            <p class="text-center">Simpsoneras Indumentaria ® 2023. Todos los derechos reservados.</p>
        </div>
    </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>
</html>