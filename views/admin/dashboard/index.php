<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/usuarios/registro">
        <i class="fa-solid fa-circle-plus"></i>
        Agregar Usuario
    </a>

    <a class="dashboard__boton dashboard__boton--naranja" href="/admin/dashboard/registros">
        <i class="fa-regular fa-id-card"></i>
        Ver Registros
    </a>
</div>


<div class="alertas">
    <?php if(isset($_GET["resultado"]) && $_GET["resultado"] < 4) { 
       $alerta = alerta($_GET["resultado"]);
       foreach($alerta as $key => $mensaje) { ?>
            <p class="alertas__mensaje alertas__mensaje--<?php echo $key; ?>"><?php echo $mensaje[0] ?></p>
        <?php } ?>
     <?php } ?>
</div>


<div class="dashboard__contenedor">
    <div class="dashboard__contenedor">
    <?php if(!empty($usuarios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Usuario</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($usuarios as $usuario) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo "{$usuario->nombre} {$usuario->apellido}"?>
                        </td>
                        <td class="table__td">
                            <?php echo "{$usuario->usuario} "?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/usuarios/editar?id=<?php echo $usuario->id;?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <form method="post" action="/admin/usuarios/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Usuarios Aun</p>
    <?php } ?>
    </div>
</div>