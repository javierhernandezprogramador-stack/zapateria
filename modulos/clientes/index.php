<?php
require '../../includes/app.php';
incluirTemplatesAdmin('header', $accesoAdmin);

?>

<!-- Barra de navegacion -->
<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido" id="panelContenido">

        <button class="boton boton-agregar m-g registrar__modal" id="cliente">Agregar</button>

        <div class="tabla-contenedor">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Id</th>
                        <th>Nombre Completo</th>
                        <th>Télefono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-clientes">
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Formulario cliente -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__cliente" id="form-cliente">
        <?php include '../../formularios/cliente/crear.php'; ?>
    </div> <!--Fin formulario cliente-->
</div>







<?php incluirTemplatesAdmin('footer', false, null, null, null, true); ?>