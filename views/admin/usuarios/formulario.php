
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="NOMBRE"
                id="nombre"
                name="nombre"
                value="<?php echo s($usuario->nombre) ?? ""; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="APELLIDO"
                id="apellido"
                name="apellido"
                value="<?php echo s($usuario->apellido) ?? ""; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="usuario" class="formulario__label">Usuario</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="USUARIO"
                id="usuario"
                name="usuario"
                value="<?php echo s($usuario->usuario) ?? ""; ?>"
            >
        </div>

