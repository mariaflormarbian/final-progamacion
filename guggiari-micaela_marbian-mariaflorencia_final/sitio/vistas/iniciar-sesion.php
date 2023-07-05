<?php
$dataForm = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);
?>

<section class="contenedor-iniciar-sesion">
    <h1 class="text-center fw-bold mt-5 p-3">Iniciar sesión</h1>
    <p class="text-center mb-1">Donde podrás ver tu historial de compras y seguimiento de las mismas.</p>
    <form action="acciones/auth-iniciar-sesion.php" class="bg-light p-5 rounded  shadow-sm mt-md-5 mb-5" method="post">
        <div class="form-fila mb-2 bg-light">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= $dataForm['email'] ?? null; ?>">
        </div>
        <div class="form-fila mt-4 mb-2">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="button-ingresar mt-5">
            <button type="submit" class="button btn btn-primary">Ingresar</button>
        </div>
    </form>

</section>