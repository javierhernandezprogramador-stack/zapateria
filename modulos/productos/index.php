<?php
require '../../includes/app.php';
incluirTemplatesAdmin('header', $accesoAdmin);

?>

<!-- Barra de navegacion -->
<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido" id="panelContenido">

        <button class="boton boton-agregar m-g registrar__modal" id="producto">Agregar</button>

        <div class="tabla-contenedor">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Foto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-productos">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Formulario productos -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__producto" id="form-producto">
        <?php include '../../formularios/producto/crear.php'; ?>
    </div> <!--Fin formulario producto-->
</div>

<?php incluirTemplatesAdmin('footer', false, null, null, null, null, true); ?>