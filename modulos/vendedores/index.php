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

        <button class="boton boton-agregar m-g registrar__modal" id="vendedor">Agregar</button>

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
                <tbody id="t-vendedores">
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Formulario vendedor -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__vendedor" id="form-vendedor">
        <?php include '../../formularios/vendedor/crear.php'; ?>
    </div> <!--Fin formulario vendedor-->
</div>







<?php incluirTemplatesAdmin('footer', false, null, null, true); ?>