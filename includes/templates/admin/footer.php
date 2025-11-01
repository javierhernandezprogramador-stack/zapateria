<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- toaster JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- validacion -->
<script src="<?php echo $urlBase;?>/src/js/validar.js"></script>

<!-- files -->
<script src="<?php echo $urlBase;?>/src/js/file.js"></script>

<!-- eventos -->
<script src="<?php echo $urlBase;?>/src/js/event.js"></script>

<!-- modals -->
<script src="<?php echo $urlBase;?>/src/js/modal.js"></script>

<!-- chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<?php if (isset($customProveedor)): ?>
    <script src="<?php echo $urlBase;?>/src/js/proveedor/proveedor.js"></script>

<?php elseif (isset($customCategoria)): ?>
    <script src="<?php echo $urlBase;?>/src/js/categoria/categoria.js"></script>

<?php elseif (isset($customVendedor)): ?>
    <script src="<?php echo $urlBase;?>/src/js/vendedor/vendedor.js"></script>

<?php elseif (isset($customCliente)): ?>
    <script src="<?php echo $urlBase;?>/src/js/cliente/cliente.js"></script>

<?php elseif (isset($customProducto)): ?>
    <script src="<?php echo $urlBase;?>/src/js/producto/producto.js"></script>

<?php elseif (isset($customCompra)): ?>
    <script src="<?php echo $urlBase;?>/src/js/compra/compra.js"></script>

<?php elseif (isset($customVenta)): ?>
    <script src="<?php echo $urlBase;?>/src/js/venta/venta.js"></script>

<?php elseif (isset($customDashboard)): ?>
    <script src="<?php echo $urlBase;?>/src/js/dashboard/dashboard.js"></script>

<?php endif; ?>

</body>

</html>