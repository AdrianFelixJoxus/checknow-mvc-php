<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrar en CheckNow</p>

    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/dashboard">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form method="post" action="/admin/usuarios/registro"  class="formulario">
        <div class="formulario__campo">
            <input 
                type="text"
                class="formulario__input"
                placeholder="NOMBRE"
                id="nombre"
                name="nombre"
                value="<?php echo $usuario->nombre; ?>"
            >
        </div>

        <div class="formulario__campo">
            <input 
                type="text"
                class="formulario__input"
                placeholder="APELLIDO"
                id="apellido"
                name="apellido"
                value="<?php echo $usuario->apellido; ?>"
            >
        </div>

        <div class="formulario__campo">
            <input 
                type="text"
                class="formulario__input"
                placeholder="USUARIO"
                id="usuario"
                name="usuario"
                value="<?php echo $usuario->usuario; ?>"
            >
        </div>

        <div class="formulario__campo">
            <input 
                type="password"
                class="formulario__input"
                placeholder="TU PASSWORD"
                id="password"
                name="password"
            >
        </div>

        <div class="formulario__campo">
            <input 
                type="password"
                class="formulario__input"
                placeholder="REPETIR PASSWORD"
                id="password2"
                name="password2"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Registrar Trabajador">
    </form>
</main>