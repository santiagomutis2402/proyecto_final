<?php
ob_start();
require_once("../class/pelicula.php");
$obj_actividad = new pelicula();

$auth = $obj_actividad->validar();
if (!$auth) {
    header('Location: /');
}

$correo = "";
$username = "";
$pasword = "";
$rol = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo = $_POST['correo'];
    $username = $_POST['username'];
    $pasword = $_POST['password'];
    $rol = 1;

    $consulta = $obj_actividad->registro($correo, $username, $pasword, $rol);
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="../styles/style.css" />

</head>

<body class="bg-fondo">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-auto bg-dark p-5 card shadow-lg p-3 mb-5 rounded w-25">
            <h1 class="text-center text-white ">Registro</h1>
            <form method="post" class="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold  text-white">Correo</label>
                    <input type="email" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="name@example.com" name="correo">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label  fw-semibold text-white">Username</label>
                    <input type="text" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="username@" name="username">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label  fw-semibold text-white">Contraseña</label>
                    <input type="password" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="*********" name="password">
                </div>



                <p class="text-white fw-light">Ya tienes cuenta! <a href="/index.php" class="text-warning">Logeate</a>
                </p>


                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-outline-primary mb-3" type="submit">Registrarte</button>

                </div>
                <a href="/listar.php" class="text-white fw-lighter ">Volver</a>
            </form>
        </div>
    </div>
    <?php
    include '../templates/footer.php';