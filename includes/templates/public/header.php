<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de zapateria</title>

    <!-- Normalize -->
    <link rel="stylesheet" href="<?php echo $urlBase?>/src/css/normalize.css">
    <link rel="preload" href="<?php echo $urlBase?>/src/css/normalize.css" as="style">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

    <!-- Hoja de estilo -->
    <link rel="stylesheet" href="<?php echo $urlBase?>/src/css/style.css">
    <link rel="preload" href="<?php echo $urlBase?>/src/css/style.css" as="style">
</head>

<body>

    <div class="barra-fondo">
        <div class="barra contenedor">
            <div class="barra__logo">
                <a href="<?php echo $urlBase?>/index.php"><img src="<?php echo $urlBase?>/src/img/prueba.png" class="imagen-logo" alt="Imagen de logo"></a>
            </div><!--barra__logo-->

            <header class="header">
                <a href="nosotros.php" class="header__enlace">Nosotros</a>
                <a href="catalogo.php" class="header__enlace">Catalogo</a>
                <a href="contacto.php" class="header__enlace">Contacto</a>
            </header>
        </div><!--Barra-->
    </div> <!--Barra de fondo-->

    <?php if($inicio): ?>

    <div class="carrusel">
        <div class="carrusel-contenido">
            <div class="carrusel-item">
                <div class="hero__contenido">
                    <h1 class="no-margin">Zapateria JADEZ SA DE CV</h1>
                    <p>Entregando producto de calidad desde 1890</p>
                </div><!--hero__contenido-->
                <img src="<?php echo $urlBase?>/src/img/nike/air-force-1-07-easyon-zapatillas-v5mlf5.png" alt="Imagen de fondo">
            </div>
            <div class="carrusel-item">
                <div class="hero__contenido">
                    <h1 class="no-margin">Zapateria JADEZ SA DE CV</h1>
                    <p>Entregando producto de calidad desde 1890</p>
                </div><!--hero__contenido-->
                <img src="<?php echo $urlBase?>/src/img/nike/air-jordan-1-low-se-zapatillas-vXjrg8.jfif" alt="Imagen de fondo 2">
            </div>
            <div class="carrusel-item">
                <div class="hero__contenido">
                    <h1 class="no-margin">Zapateria JADEZ SA DE CV</h1>
                    <p>Entregando producto de calidad desde 1890</p>
                </div><!--hero__contenido-->
                <img src="<?php echo $urlBase?>/src/img/nike/air-jordan-1-mid-zapatillas-lfbFkL.png" alt="Imagen de fondo 3">
            </div>
            <div class="carrusel-item">
                <div class="hero__contenido">
                    <h1 class="no-margin">Zapateria JADEZ SA DE CV</h1>
                    <p>Entregando producto de calidad desde 1890</p>
                </div><!--hero__contenido-->
                <img src="<?php echo $urlBase?>/src/img/nike/dunk-low-zapatillas-15mQNw.png" alt="Imagen de fondo 4">
            </div>
        </div>
    </div>
    <?php endif; ?>