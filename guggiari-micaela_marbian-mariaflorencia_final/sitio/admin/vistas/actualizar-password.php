<section>
    <h1 class="mb-1">Restablecer Password</h1>

    <form action="acciones/auth-actualizar-password.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['usuario'];?>">
        <input type="hidden" name="token" value="<?= $_GET['token'];?>">
        <div class="form-fila">
            <label for="password">Nuevo Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-fila">
            <label for="password_confirmar">Confirmar Password</label>
            <input type="password" id="password_confirmar" name="password_confirmar" class="form-control">
        </div>
        <button type="submit" class="button">Actualizar</button>
    </form>
</section>
