<?php
$dataForm = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);
?>

<section class="contenedor-admin-login">
    <div class="login-container">
        <h1 class="visually-hidden">Iniciar Sesion en Panel de Adminsitración</h1>
        <h2 class="text-center">Iniciar sesión</h2>
        <p class="text-center">Ingresar al panel de administración.</p>

        <form action="acciones/auth-iniciar-sesion.php" method="post">
            <div class="form-fila mb-2">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $dataForm['email'] ?? null; ?>">
            </div>
            <a href="#">¿Has olvidado tu mail?</a>
            <div class="form-fila mt-4 mb-2">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="button-ingresar mt-5">
                <button type="submit" class="button btn btn-primary">Ingresar</button>
            </div>
        </form>
        <div class="pass">
            <p>¿Olvidaste tu password?</p>
            <a href="index.php?v=recuperar-password">Solicitá restablecer tu password</a>
        </div>
    </div>
</section>