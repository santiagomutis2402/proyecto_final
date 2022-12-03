<?php
require_once('modelo.php');


class pelicula extends modeloCredencialesBD
{
    protected $id;
    protected $titulo;
    protected $descripcion;
    protected $portada;
    protected $video;
    protected $id_genero;

    public function __construct()
    {
        parent::__construct();
    }

    public function ListarGeneros()
    {

        $instruccion = "call streamweb.listar_generos()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if (!$resultado) {
            echo "Fallo al consultar los generos";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


    public function crearcarpeta($titulo)
    {
        $carpetaImagenes = "../img/peliculas/" . $titulo . "/";
        if (!is_dir(dirname($carpetaImagenes))) {
            mkdir($carpetaImagenes);
        }
        return $carpetaImagenes;
    }

    public function moverarchivo($imagen, $carpetaImagenes, $titulo)
    {

        $imagePath = $carpetaImagenes  . $imagen['name'];

        if (!is_dir(dirname($imagePath))) {
            mkdir(dirname($imagePath));
        }

        move_uploaded_file($imagen['tmp_name'], $imagePath);
        $rutaImagen = str_replace($carpetaImagenes, '', $imagePath);
        $rutaImagen = "img/peliculas/${titulo}/"  . $imagen['name'];
        return $rutaImagen;
    }


    public function InsertarPelicula($titulo, $descripcion, $portada, $video, $id_genero)
    {

        $instruccion = "call streamweb.insertar_peli('${titulo}','${descripcion}','${portada}','${video}',$id_genero)";
        $consulta = $this->_db->query($instruccion);

        if (!$consulta) {
            echo "Fallo al insertar la pelicula";
        } else {
            return $consulta;
            $consulta->close();
            $this->_db->close();
        }
    }

    public function EditarPelicula($titulo, $descripcion, $portada, $video, $id_genero, $id)
    {

        $instruccion = "call streamweb.update_pelicula('${titulo}','${descripcion}','${portada}','${video}',$id_genero,$id)";
        $consulta = $this->_db->query($instruccion);

        if (!$consulta) {
            echo "Fallo al insertar la pelicula";
        } else {
            return $consulta;
            // var_dump($instruccion);
            $consulta->close();
            $this->_db->close();
        }
    }


    public function actualizarPelicula($id, $titulo, $descripcion, $portada, $video, $id_genero)
    {
        $instruccion = " call streamweb.update_pelicula('" . $titulo . "','" . $descripcion .
            "','" . $portada . "','" . $video . "','" . $id_genero . "','" . $id . "' )";

        $consulta = $this->_db->query($instruccion);
    }

    public function listar_peliculas()
    {

        $instruccion = "call streamweb.listar_peliculas()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if (!$resultado) {
            echo " ";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


    public function listar_peliculas_principal()
    {

        $instruccion = "call streamweb.listar_principal()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if (!$resultado) {
?>
<a href="../forms/crear_editar.php">Insertar</a>
<?php } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


    public function listar_peliculas_ID($ID)
    {
        $instruccion = "CALL streamweb.listar_pelicula_id($ID)";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_assoc();
        if (!$resultado) {
            // echo "Fallo al consultar las actividades";
        } else {
            return $resultado;
            $this->_db->close();
        }
    }



    public function Buscar_Peli($titulo)
    {
        $instruccion = "call streamweb.buscar_parecido('${titulo}');";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$resultado) {
            return 0;
        } else {
            return $resultado;
            $this->_db->close();
            $this->_db->close();
        }
    }


    public function formatear($dumo)
    {
        echo "<pre>";
        var_dump($dumo);
        echo "</pre>";
        exit;
    }

    /////////////login

    public function login($username, $password)
    {
        $instruccion = "call streamweb.login('${username}')";
        $consulta = $this->_db->query($instruccion);

        if ($consulta->num_rows) {
            $usuario = mysqli_fetch_assoc($consulta);

            // Password a revisar y el de la BD.
            $auth = password_verify($password, $usuario['password']);
            if ($auth) {
                // Autenticado.
                session_start();
                $_SESSION['usuario'] = $usuario['username'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['picture'] = $usuario['picture'];
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['login'] = true;
                return true;
            } else {
                // No autenticado
                $errores[] = 'El Password es incorrecto';
                return false;
            }
        }
    }


    public function val_password($pasword)
    {
        $pasword = mysqli_real_escape_string($this->_db,  $pasword);
        return $pasword;
    }

    public function registro($name, $username, $password, $rol)
    {
        ////validar insert
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $instruccion = "call streamweb.insertar_usuario('${name}','${username}','${passwordHash}',${rol})";
        $consulta = $this->_db->query($instruccion);

        if ($consulta == true) {
            header('Location: /index.php');
        }
    }


    public function iniciar_Server()
    {
        session_start();
    }


    public function validar(): bool
    {
        $correo = $_SESSION['correo'];
        $username = $_SESSION['usuario'];
        if ($_SESSION['login']) {
            return true;
        }

        return false;
    }

    public function eliminar($id, $video, $portada)
    {
        $rutavideo = "../" . $video;
        unlink($rutavideo);
        $rutaImagen = "../" . $portada;
        unlink($rutaImagen);

        $instruccion = "call streamweb.eliminar('${id}')";
        $consulta = $this->_db->query($instruccion);

        header('Location: /listar.php');
    }
}