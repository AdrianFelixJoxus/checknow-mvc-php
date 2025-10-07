<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton dashboard__contenedor-boton--registros">
    <a class="dashboard__boton" href="/admin/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
    <input class="dashboard__boton dashboard__boton--fecha-registro" type="date" id="fecha" value="<?php echo date("Y-m-d"); ?>">
</div>

<div class="dashboard__contenedor dashboard__contenedor--registros">
    
        <table class="table">
            <thead class="table__thead table__thead--registros">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Asistencia Hora</th>
                    <th scope="col" class="table__th">Desayuno | hora Salida y Hora Entrada</th>
                    <!-- <th scope="col" class="table__th">Diferiencia</th> -->
                    <th scope="col" class="table__th">Comida | hora Salida y Hora Entrada</th>
                    <th scope="col" class="table__th">Jornada Terminada Hora</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
            </tbody>
            
        </table>
    
</div>



