<?php
$dataForm = (new \DaVinci\Session\Session())->flash('data_form', []);
$errores = (new \DaVinci\Session\Session())->flash('errores', []);


?>
<section>

    <h1 class="text-center fw-bold mt-5 p-3">Registro</h1>

    <p class="mb-1">Crear una cuenta es fácil y gratuito.</p>

    <form action="acciones/auth-registro.php" method="post">
        <div class="form-fila">
            <label for="nombre">Nombre</label>
            <input
                    type="nombre"
                    id="nombre"
                    name="nombre"
                    class="form-control"
                    value="<?= e($dataForm['nombre'] ?? '');?>"
                <?= isset($errores['nombre']) ? 'aria-describedby="error-nombre"' : '';?>
            >
        </div>
        <div class="form-fila">
            <label for="apellido">Apellido</label>
            <input
                    type="apellido"
                    id="apellido"
                    name="apellido"
                    class="form-control"
                    value="<?= e($dataForm['apellido'] ?? '');?>"
                <?= isset($errores['apellido']) ? 'aria-describedby="error-apellido"' : '';?>
            >
        </div>

        <div class="form-fila">
            <label for="email">Email</label>
            <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="<?= e($dataForm['email'] ?? '');?>"
                <?= isset($errores['email']) ? 'aria-describedby="error-email"' : '';?>
            >
            <?php
            if(isset($errores['email'])):
                ?>
                <div class="msg-error" id="error-email"><?= $errores['email'][0];?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-fila">
            <label for="password">Password</label>
            <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                <?= isset($errores['password']) ? 'aria-describedby="error-password"' : '';?>
            >
            <?php
            if(isset($errores['password'])):
                ?>
                <div class="msg-error" id="error-password"><?= $errores['password'][0];?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-fila">
            <label for="password_confirmar">Confirmar Password</label>
            <input
                    type="password"
                    id="password_confirmar"
                    name="password_confirmar"
                    class="form-control"
                <?= isset($errores['password_confirmar']) ? 'aria-describedby="error-password_confirmar"' : '';?>
            >
            <?php
            if(isset($errores['password_confirmar'])):
                ?>
                <div class="msg-error" id="error-password_confirmar"><?= $errores['password_confirmar'][0];?></div>
            <?php
            endif;
            ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
    </form>
</section>
