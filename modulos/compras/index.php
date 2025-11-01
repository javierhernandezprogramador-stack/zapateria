<?php
require '../../includes/app.php';

if(!$accesoAdmin) {
    header("Location: /modulos/");
}

incluirTemplatesAdmin('header', $accesoAdmin);
?>

<!-- Barra de navegacion -->
<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido" id="panelContenido">

        <button class="boton boton-agregar m-g registrar__modal" id="compra">Agregar</button>

        <div class="tabla-contenedor">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Codigo</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-compras">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Formulario compras -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__compra" id="form-compra">
        <?php include '../../formularios/compra/crear.php'; ?>
    </div> <!--Fin formulario compra-->
</div>

<!-- Formulario ver compra -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__compra" id="form-ver-compra">
        <?php include '../../formularios/compra/ver.php'; ?>
    </div> <!--Fin formulario ver compra-->
</div>

<?php incluirTemplatesAdmin('footer', false, null, null, null, null, null, true); ?>