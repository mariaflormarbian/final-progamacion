<?php
use DaVinci\Session\Session;

require_once __DIR__ . '/bootstrap/autoload.php';
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
    'contacto' => [
    'titulo' => 'Contactános',
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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpsoneras : <?= $rutaTitulo['titulo'];?></title>
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
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <?php
        $filename = __DIR__ . '/vistas/' . $vistas . '.php';
        if(file_exists($filename)) {
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