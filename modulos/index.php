<?php
require '../includes/app.php';
incluirTemplatesAdmin('header', $accesoAdmin);
?>

<div class="panel-derecho">
    <?php incluirTemplatesAdmin('barra'); ?>

    <div class="panel__contenido cuadro__fronted" id="panelContenido">
        <div class="fronted">
            <div class="fronted__left">
                <div class="fronted-barra">
                    <div class="targeta-small targeta-claro">
                        <div class="small-contenido">
                            <div class="small-icono">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart icon-car">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                </svg>
                            </div>

                            <div class="small-informacion">
                                <p class="title-yellow">Compras</p>
                                <p class="informacion-resultado" id="cantidadCompra"></p>
                            </div>
                        </div>
                    </div>

                    <div class="targeta-small targeta-claro">
                        <div class="small-contenido">
                            <div class="small-icono">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report-analytics icon-sale">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 17v-5" />
                                    <path d="M12 17v-1" />
                                    <path d="M15 17v-3" />
                                </svg>
                            </div>

                            <div class="small-informacion">
                                <p class="title-verde">Ventas</p>
                                <p class="informacion-resultado" id="cantidadVenta"></p>
                            </div>
                        </div>
                    </div>

                    <div class="targeta-small targeta-claro">
                        <div class="small-contenido">
                            <div class="small-icono">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flip-flops icon-shoes">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 4c2.21 0 4 1.682 4 3.758c0 .078 0 .156 -.008 .234l-.6 9.014c-.11 1.683 -1.596 3 -3.392 3s-3.28 -1.311 -3.392 -3l-.6 -9.014c-.138 -2.071 1.538 -3.855 3.743 -3.985a4.15 4.15 0 0 1 .25 -.007z" />
                                    <path d="M14.5 14c1 -3.333 2.167 -5 3.5 -5c1.333 0 2.5 1.667 3.5 5" />
                                    <path d="M18 16v1" />
                                    <path d="M6 4c2.21 0 4 1.682 4 3.758c0 .078 0 .156 -.008 .234l-.6 9.014c-.11 1.683 -1.596 3 -3.392 3s-3.28 -1.311 -3.392 -3l-.6 -9.014c-.138 -2.071 1.538 -3.855 3.742 -3.985c.084 0 .167 -.007 .25 -.007z" />
                                    <path d="M2.5 14c1 -3.333 2.167 -5 3.5 -5c1.333 0 2.5 1.667 3.5 5" />
                                    <path d="M6 16v1" />
                                </svg>
                            </div>

                            <div class="small-informacion">
                                <p class="title-cafe">Productos</p>
                                <p class="informacion-resultado" id="cantidadProducto"></p>
                            </div>
                        </div>
                    </div>

                    <div class="targeta-small targeta-claro">
                        <div class="small-contenido">
                            <div class="small-icono">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users icon-clientes">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>

                            <div class="small-informacion">
                                <p class="title-cian">Clientes</p>
                                <p class="informacion-resultado" id="cantidadCliente"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fronted-contenido">
                    <div class="graficas-left">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>

                        <div>
                            <canvas id="myChart-compras"></canvas>
                        </div>

                        <div>
                            <canvas id="myChart-ventas"></canvas>
                        </div>

                    </div>
                </div>

            </div>
            <div class="fronted__right">
                <div class="grafica-three">
                    <canvas id="myChart-categorias"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>


<?php incluirTemplatesAdmin('footer', false, null, null, null, null, null, null, null, true); ?>