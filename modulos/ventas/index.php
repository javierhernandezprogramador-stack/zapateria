<?php
require '../../includes/app.php';
incluirTemplatesAdmin('header', $accesoAdmin);

?>

<!-- Barra de navegacion -->
<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido" id="panelContenido">

        <button class="boton boton-agregar m-g registrar__modal" id="venta">Agregar</button>

        <div class="tabla-contenedor">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Codigo</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-ventas">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Formulario compras -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__compra" id="form-venta">
        <?php include '../../formularios/venta/crear.php'; ?>
    </div> <!--Fin formulario venta-->
</div>

<!-- Formulario ver venta -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__compra" id="form-ver-venta">
        <?php include '../../formularios/venta/ver.php'; ?>
    </div>
</div>  <!--Fin formulario ver venta-->

<?php incluirTemplatesAdmin('footer', false, null, null, null, null, null, null, true); ?>