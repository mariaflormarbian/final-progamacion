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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <header class="navbar navbar-expand-md bd-navbar">
        <nav class="container-xxl flex-wrap flex-md-nowrap" aria-label="navegacion principal">
            <a href="index.php?v=home" id="logo" class="navbar-brand p-0 me-2" aria-label="Simpsoneras">
                Simpsoneras :: <?= $rutaTitulo['titulo'];?>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
            </svg>
            </button>
            <div class="navbar-collapse collapse justify-content-md-end" id="bdNavbar">
                <ul class="navbar-nav flex-md-row flex-wrap bd-navbar-nav pt-2 py-md-0">
                    <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=home">Home</a></li>
                    <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=listado">Listado</a></li>
                    <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=contacto">Contacto</a>
                    </li>
                    <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=carrito">Carrito</a>
                    </li>
                    <?php
                    if ($autenticacion->estaAutenticado()):
                    ?>
                        <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=perfil">Mi Perfil</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
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
                        <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=iniciar-sesion">Iniciar Sesion</a></li>
                        <li class="nav-item col-6 col-md-auto"><a class="nav-link p-2" href="index.php?v=registro">Registrarse</a></li>
                    <?php 
                    endif;
                    ?>

                </ul>
            </div>
        </nav>
    </header>
    <div class="main-content container">
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
    <footer class="container-fluid">
        <div class=" pt-6">
            <div class="d-flex pt-6 justify-content-center justify-content-md-evenly">
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
                        <li class="nav-item">
                            <a href="//www.facebook.com" class="nav-link"><i class="bi bi-facebook color"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="//www.twitter.com" class="nav-link"><i class="bi bi-twitter color"></i></a>
                        </li>
                        <li>
                            <a href="//www.instagram.com" class="nav-link"><i class="bi bi-instagram color"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="//www.youtube.com" class="nav-link"><i class="bi bi-youtube color"></i></a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
            <ul class="d-flex justify-content-center flex-column flex-md-row">
                <li class="p-3 text-center"><a class="btn btn-dark border-0" href="index.php?v=listado">Sobre Nosotros</a></li>
                <li class="p-3 text-center"><a class="btn btn-dark border-0"  href="index.php?v=listado">Showroom</a></li>
                <li class="p-3 text-center"><a class="btn btn-dark border-0"  href="index.php?v=contacto">Contactenos</a></li>
            </ul>
            <div>
                <p class="text-center">Simpsoneras Indumentaria ® 2023. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>