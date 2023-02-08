<?php
$dataForm = $_SESSION['data_form'] ?? [];

unset($_SESSION['data_form']);
?>

<section>
    <h1>
        Iniciar Sesion
    </h1>
    <form action="acciones/auth-inciar-sesion.php" method="post">
        <label for="email">Usuario</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            value="<?=  $dataForm['email'] ?? '' ;?>"
        >
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="button" class="btn">Ingresar</button>
    </form>
</section>