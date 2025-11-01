<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: ../');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>

    <!-- Normalize -->
    <link rel="stylesheet" href="../../src/css/normalize.css">
    <link rel="preload" href="../../src/css/normalize.css" as="style">

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
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="preload" href="../../src/css/style.css" as="style">

    <!-- toaster css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="main-login">
    <div class="login contenedor">
        <div class="login__img">
            <img src="../../src/img/nike/air-jordan-1-low-se-zapatillas-vXjrg8.jfif" alt="">
        </div>
        <div class="login__contenido">
            <h2>Recuperar acceso</h2>
            <form class="formulario formulario-login">
                <div class="campo__formulario">
                    <label for="email-recuperar" class="campo__label-login">Email</label>
                    <input type="emai" placeholder="Tu Email" id="email-recuperar" class="campo__input input-login" autocomplete="off">
                </div>

                <div class="campo__botones">
                <a href="../../login.php">Regresar a login</a>
                    <input type="button" value="Enviar" class="boton" id="btnRecuperar">
                </div>
            </form>
        </div>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- toaster JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="../../src/js/login/login.js"></script>
</body>

</html>