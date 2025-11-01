<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: ../');
    exit();
}

$tiempoMax = 300; // 3 minutos

if (isset($_SESSION['tiempo']) && isset($_SESSION['token'])) {
    $rangoTiempo = time() - $_SESSION['tiempo'];
    $idUsuario = $_SESSION['idUsuarioUpdate'];

    if (!($rangoTiempo <= $tiempoMax)) {
        unset($_SESSION['token']);
        unset($_SESSION['tiempo']);
        header('Location: ../../login.php');
        exit;
    }
} else {
    header('Location: ../../login.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>

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
            <img src="../../src/img/nike/victori-one-chanclas-3V75Sf.png" alt="Imagen de cambio de contraseña">
        </div>
        <div class="login__contenido">
            <h2>Cambiar contraseña</h2>
            <form class="formulario formulario-login">
                <input type="hidden" id="idUsuario" value="<?php echo $idUsuario; ?>">
                <div class="campo__formulario">
                    <label for="new_password" class="campo__label-login">Contraseña nueva</label>
                    <input type="password" placeholder="Tu nueva contraseña" id="new_password" class="campo__input input-login">
                </div>
                <div class="campo__formulario">
                    <label for="repet_password" class="campo__label-login">Repetir contraseña</label>
                    <input type="password" placeholder="Repite la contaseña" id="repet_password" class="campo__input input-login">
                </div>

                <div class="campo__botones">
                    <input type="button" value="Confirmar" class="boton" id="btnLoginRestart">
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