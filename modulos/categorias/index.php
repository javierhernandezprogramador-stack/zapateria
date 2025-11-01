<?php
require '../../includes/app.php';
incluirTemplatesAdmin('header', $accesoAdmin);

?>

<!-- Barra de navegacion -->
<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido" id="panelContenido">

        <button class="boton boton-agregar m-g registrar__modal" id="categoria">Agregar</button>

        <div class="tabla-contenedor">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-categorias">
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Formulario categoria -->
<div class="contenedor__formularios overflow-hidden oculto">
    <div class="formulario__categoria" id="form-categoria">
        <?php include '../../formularios/categoria/crear.php'; ?>
    </div> <!--Fin formulario producto-->
</div>








<?php incluirTemplatesAdmin('footer', false, null, true); ?>