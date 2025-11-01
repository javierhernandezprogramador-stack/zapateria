<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: modulos/');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <!-- Normalize -->
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="preload" href="src/css/normalize.css" as="style">

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
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="preload" href="src/css/style.css" as="style">

    <!-- toaster css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="main-login">
    <div class="login contenedor">
        <div class="login__img">
            <img src="src/img/nike/dunk-low-zapatillas-15mQNw.png" alt="">
        </div>
        <div class="login__contenido">
            <h2>Iniciar Sesión</h2>
            <form class="formulario formulario-login">
                <div class="campo__formulario">
                    <label for="email" class="campo__label-login">Email</label>
                    <input type="emai" placeholder="Tu Email" id="email" class="campo__input input-login" autocomplete="off">
                </div>
                <div class="campo__formulario">
                    <label for="password" class="campo__label-login">Contraseña</label>
                    <input type="password" placeholder="Tu Contraseña" id="password" class="campo__input input-login">
                </div>

                <div class="campo__botones">
                    <a href="modulos/acceso/recuperar.php">¿Olvidaste la contraseña?</a>
                    <input type="button" value="Acceder" class="boton" id="btnLogin">
                </div>
            </form>
        </div>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- toaster JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="src/js/login/login.js"></script>
</body>

</html>