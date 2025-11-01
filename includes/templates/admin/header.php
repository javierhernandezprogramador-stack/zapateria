<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <!-- Normalize -->
    <link rel="stylesheet" href="../src/css/normalize.css">
    <link rel="preload" href="../src/css/normalize.css" as="style">

    <!-- fuentes -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&family=PT+Sans+Caption:wght@400;700&display=swap"
        as="fonts" crossorigin="crossorigin">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&family=PT+Sans+Caption:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Hoja de estilo -->
    <link rel="stylesheet" href="<?php echo $urlBase?>/src/css/style.css">
    <link rel="preload" href="<?php echo $urlBase?>/src/css/style.css" as="style">

    <!-- toaster css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="dashboard">
        <div class="barra-izquierda">
            <div class="panel__logo">
                <div class="panel__logo-contenido">
                    <img src="<?php echo $urlBase?>/src/img/prueba.png" alt="Icono de panel de control">
                </div>
            </div>
            <nav class="navegacion-panel">
                <div class="panel__enlace__inicio" id="inicio">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-app-window">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                        <path d="M6 8h.01" />
                        <path d="M9 8h.01" />
                    </svg>
                    <div class="panel__link">
                        <a href="<?php echo $urlBase?>/modulos/">Inicio</a>
                    </div>
                </div> <!--Fin inicio-->

                <?php if ($accesoAdmin): ?>
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Productos</a>
                            </div>
                            <div class="logo__flecha-producto list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info registrar__modal" id="producto"><a href="#">Nuevo Producto</a></li> -->
                            <li class="submenu__info listado" id="ListaProducto"><a href="<?php echo $urlBase?>/modulos/productos/">Lista de Productos</a></li>
                        </ul>
                    </div><!-- Fin productos -->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Proveedores</a>
                            </div>
                            <div class="logo__flecha-proveedores list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <li class="submenu__info listado" id="ListaProveedor"><a href="<?php echo $urlBase?>/modulos/proveedores/">Lista Proveedores</a></li>
                        </ul>
                    </div> <!-- Fin proveedor -->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17h-11v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Compras</a>
                            </div>
                            <div class="logo__flecha-compra list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info"><a href="#">Nueva Compra</a></li> -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/compras/">Lista de Compras</a></li>
                        </ul>
                    </div> <!--Fin de compra-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-store">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21l18 0" />
                                <path
                                    d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                                <path d="M5 21l0 -10.15" />
                                <path d="M19 21l0 -10.15" />
                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Vendedores</a>
                            </div>
                            <div class="logo__flecha-vendedor list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/vendedores/">Lista Vendedores</a></li>
                        </ul>
                    </div> <!--Fin de inventario-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Clientes</a>
                            </div>
                            <div class="logo__flecha-cliente list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info"><a href="#">Nuevo Cliente</a></li> -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/clientes/">Lista de Clientes</a></li>
                        </ul>
                    </div> <!--Fin de clientes-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-copy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M11.5 17h-5.5v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                                <path d="M15 19l2 2l4 -4" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Ventas</a>
                            </div>
                            <div class="logo__flecha-venta list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info"><a href="#">Nueva Venta</a></li> -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/ventas/">Lista de Ventas</a></li>
                        </ul>
                    </div> <!-- Fin de ventas-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 12h6" />
                                <path d="M9 16h6" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Categorías</a>
                            </div>
                            <div class="logo__flecha-cate list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/categorias/">Listado Categoria</a></li>
                        </ul>
                    </div>
                    <!-- <a href="">Configuración</a> -->
                    <!-- <a href="">Usuario</a> -->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-analytics">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 17l0 -5" />
                                <path d="M12 17l0 -1" />
                                <path d="M15 17l0 -3" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Estadisticas</a>
                            </div>
                            <div class="logo__flecha-est list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/estadisticas/">Ver Reportes</a></li>
                        </ul>
                    </div>

                <?php else: ?>
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Productos</a>
                            </div>
                            <div class="logo__flecha-producto list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info registrar__modal" id="producto"><a href="#">Nuevo Producto</a></li> -->
                            <li class="submenu__info listado" id="ListaProducto"><a href="<?php echo $urlBase?>/modulos/productos/">Lista de Productos</a></li>
                        </ul>
                    </div><!-- Fin productos -->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Clientes</a>
                            </div>
                            <div class="logo__flecha-cliente list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info"><a href="#">Nuevo Cliente</a></li> -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/clientes/">Lista de Clientes</a></li>
                        </ul>
                    </div> <!--Fin de clientes-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-copy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M11.5 17h-5.5v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                                <path d="M15 19l2 2l4 -4" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Ventas</a>
                            </div>
                            <div class="logo__flecha-venta list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <!-- <li class="submenu__info"><a href="#">Nueva Venta</a></li> -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/ventas/">Lista de Ventas</a></li>
                        </ul>
                    </div> <!-- Fin de ventas-->
                    <div class="navegacion__contenedor">
                        <div class="panel__enlace panel__boton-click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="#bcd30d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 12h6" />
                                <path d="M9 16h6" />
                            </svg>
                            <div class="panel__link">
                                <a href="#">Categorías</a>
                            </div>
                            <div class="logo__flecha-cate list-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <ul class="panel__submenu"> <!-- Hermano adyancente -->
                            <li class="submenu__info"><a href="<?php echo $urlBase?>/modulos/categorias/">Listado Categoria</a></li>
                        </ul>
                    </div>
                <?php endif ?>
            </nav>
        </div>