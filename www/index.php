<?php

require_once("class/pelicula.php");
$obj_actividad = new pelicula();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'];

  $password = $_POST['password'];
  $password = $obj_actividad->val_password($password);


  if (!$username) {
    $errores[] = 'El Username es Obligatorio o no válido';
  }

  if (!$password) {
    $errores[] = 'El Password es obligatorio';
  }

  if (empty($errores)) {
    $login = $obj_actividad->login($username, $password);

    if ($login == true) {
      header('Location: /listar.php');
    } // else {
    //   header('Location: /forms/login.php');
    // }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="/styles/style.css">
</head>

<body class="bg-fondo">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-auto bg-dark p-5 card shadow-lg p-3 mb-5 rounded w-25">

            <h1 class="text-center text-white ">Login</h1>
            <form method="post" class="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold  text-white">Username</label>
                    <input type="text" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="name@example.com" name="username">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label  fw-semibold text-white">Contraseña</label>
                    <input type="password" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="*********" name="password">
                </div>

                <p class="text-white fw-light">No tienes cuenta! <a href="forms/registro.php"
                        class="text-warning">Registrate</a></p>


                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-outline-primary mb-3" type="submit">Logeate</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section: Design Block -->
    <?php include 'templates/footer.php' ?>