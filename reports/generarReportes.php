<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//session_start();
include '../config/Conexion.php';
include '../utils/encriptacion.php';
//include '../includes/app.php';
//incluirTemplates('header', $accesoRolAdmin);

?>
<!-- Cuerpo de la aplicaci��n -->
<div class="app-body">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-6 text-primary">Panel de Reportes</h1>
                <p class="text-black">Selecciona un reporte para visualizar</p>
            </div>
        </div>
        <div class="row">
            <?php
            $reportes = [
                //["Reporte de Empleados",   "reporteEmpleados.php", "logoReporte.png"],
                ["Reporte de Proveedores", "reporteProveedores.php", "logoReporte.png"]
                //["Reporte de Categorias",  "reporteCategoria.php", "logoReporte.png"],
                //["Reporte de Compras",     "reporteCompra.php", "logoReporte.png"],
                //["Reporte de Ventas",      "reporteVenta.php", "logoReporte.png"]
            ];

            foreach ($reportes as $reporte) {
                $imgSrc = !empty($reporte[2]) ? "../assets/images/report/{$reporte[2]}" : "https://via.placeholder.com/100"; // Imagen de placeholder si no hay imagen disponible
                echo "
                <div class='col-lg-4 col-md-6 mb-4'>
                    <div class='card report-card shadow-lg text-center'>
                        <div class='mt-3'>
                            <img src='{$imgSrc}' alt='{$reporte[0]}' style='width: 25px; height: 25px; object-fit: cover;'>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>{$reporte[0]}</h5>
                            <a href='{$reporte[1]}' class='btn btn-primary w-100'>Ver Reporte</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Fin del cuerpo de la aplicaci��n -->

<?php incluirTemplates('footer'); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>