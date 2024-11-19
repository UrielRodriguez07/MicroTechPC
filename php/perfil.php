<?php
require_once("../config/config.php");
session_start();

if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}
include "./head_html.php";
$id_usuario = $_SESSION['sesion_personal']['id'];
$nombre_usuario = $_SESSION['sesion_personal']['nombre'];

// Creación de la lista del información del usuario
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
// verificar connection con la BD
if (mysqli_connect_errno()) :
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
else:
    $usuario = [];
    $result = mysqli_query($con, "SELECT * FROM usuario WHERE id_usuario=" . $id_usuario . ";");
    while ($row = mysqli_fetch_array($result)):
        array_push($usuario, array(
            "correo" => $row['correo'],
            "n_tarjeta" => $row['numero_tarjeta'],
            "direccion" => $row['direccion'],
            "fechanac" => $row['fecha_nacimiento'],
            "contrasena" => $row['contrasena'],
            "tipo_usuario" => $row['super_usuario']
        ));
    endwhile;

    // cerrar conexión
    mysqli_close($con);
endif;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Informacion perfil de usuario</title>
    <!-- Icono de pagina web -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/MTStyle.css">
    <!-- Icono de imagenes perfil -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<!-- barra de navegación -->
<header>
    <!-- Nombre empresa -->
    <div class="logo">MicroTechPC</div>

    <!-- Campo de búsqueda -->
    <form class="form-search" action="./php/busqueda.php" method="GET">
        <div class="search-seo">
            <input type="text" class="form-control" placeholder="Cuadro de busqueda..." name="querySEO">
        </div>
        <br>
        <a href="#"><i class="fa fa-search"></i></a>
    </form>
    <!-- Barras para el modo responsivo -->
    <div class="bars">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <!-- Menu de opciones -->
    <nav class="nav-bar">
        <ul>
            <li>
                <a href="../index.php"><span class="fa fa-home"></span> Inicio</a>
            </li>

            <li>
                <a href="../index.php#seccionProduct"><span class="fa fa-laptop"></span> Lista de productos</a>
            </li>

            <li>
                <a href="../php/carrito.php"><span class="fa fa-shopping-cart"></span> Carrito de compras</a>
            </li>

            <li>
                <!--<a>Bienvenido <u><?= $_SESSION['sesion_personal']['nombre'] ?></u></a>-->
            </li>

            <li>
                <a href="./perfil.php" class="active"><span class="fa fa-user"></span> Perfil</a>
            </li>

            <?php if ($_SESSION['sesion_personal']['super'] == 1): ?>
                <li>
                    <a href="#"><span class="fa fa-unlock"></span> Admin</a>
                    <ul class="dropdown-list-admin">
                        <li><a href="../php/consultar_historial.php"><span class="glyphicon glyphicon-list"></span> Consultar historial</a></li>
                        <li><a href="../php/modificar_productos.php"><span class="glyphicon glyphicon-cog"></span> Modificar productos</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li>
                <a href="../php/cerrar_sesion.php"><span class="fa fa-sign-out"></span> Cerrar sesión</a>
            </li>
        </ul>
    </nav>
</header>


<body class="container-perfil">
    <h1 style="font-size: 56px; color: aliceblue; text-align: center;">Perfil de usuario</h1>
    <div class="container-info-perfil">
        <div class="carta_perfi">
            <div class="carta_header">
                <div class="avatar">
                    <img src="../img/perfil.jpg" alt="">
                </div>
                <div class="textos">
                    <h3><?= $nombre_usuario; ?></h3>
                    <h4><?= $usuario[0]['tipo_usuario'] == 1 ? 'Administrador' : 'Estandar'; ?></h4>
                </div>
                <button type="button" id="carta_boton"><i class="fa fa-plus"></i></button>
            </div>
            <div class="carta_body">
                <div class="carta_contenido">
                    <ul class="lista">
                        <li><i class="fa fa-solid fa-credit-card"></i> Número de tarjeta: <?= $usuario[0]['n_tarjeta']; ?></li>
                        <li><i class="fa-duotone fa-solid fa-envelope"></i> Correo electrónico: <?= $usuario[0]['correo']; ?></li>
                        <li><i class="fa-solid fa-location-dot"></i> Dirección: <?= $usuario[0]['direccion']; ?></li>
                        <li><i class="fa-solid fa-calendar-days"></i> Fecha nacimiento: <?= $usuario[0]['fechanac']; ?></li>
                        <li><i class="fa-solid fa-key"></i> Contraseña: <?= $usuario[0]['contrasena']; ?></li>
                    </ul>
                    <div class="carta_pie">
                    <a href="historial_individual.php"><input type="submit" class="btn" value="Historial de compras"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de animacion para la box de info de usuario -->
    <script>
        let carta_perfi = document.querySelector('.carta_perfi');
        let carta_boton = document.getElementById('carta_boton');
        carta_boton.addEventListener('click', () => {
            carta_perfi.classList.toggle('animacion');
        });
    </script>


    <!---------------------------------------- footer ------------------------------------------------------------------------------>

    <div class="footer">
        <div class="container-footer">
            <hr>
            <div class="footer-link">

                <div class="link">
                    <h3>Sobre MicroTechPC</h3>
                    <ul>
                        <li>Nuestra empresa</li>
                        <li>Informacion legal</li>
                        <li>Relación con inversores</li>
                        <li>Misión y Visión</li>
                    </ul>
                </div>

                <div class="link">
                    <h3>Recursos</h3>
                    <ul>
                        <li>Registro de nuestros productos</li>
                        <li>Soporte</li>
                        <li>Guía para comprar tu laptop</li>
                        <li>Cumplimiento de normas y certificaciones</li>
                    </ul>
                </div>

                <div class="link">
                    <h3>Soluciones para</h3>
                    <ul>
                        <li>Educación</li>
                        <li>Empresas</li>
                        <li>Independientes</li>
                        <li>Gamers</li>
                    </ul>
                </div>

                <div class="link">
                    <h3>Ayuda al cliente</h3>
                    <ul>
                        <li>FAQ's</li>
                        <li>Contacto</li>
                        <li>Medios de pago</li>
                        <li>Politica de privacidad</li>
                    </ul>
                </div>

                <div class="link">
                    <h3>Siguenos</h3>
                    <div class="media-socials">
                        <a href="#"><i class="fa-brands fa-facebook-f" style="padding-top: 7px;"></i></a>
                        <a href="#"><i class="fab fa-twitter" style="padding-top: 7px;"></i></a>
                        <a href="#"><i class="fa-brands fa-google-plus-g" style="padding-top: 7px;"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in" style="padding-top: 7px;"></i></a>
                    </div>
                    <h3>Comentarios y dudas</h3>
                    <form class="footer-form">
                        <input type="email" placeholder="Correo electronico">
                        <input class="btn" type="submit" value="Enviar">
                    </form>
                </div>
            </div>

            <hr>
            <div class="footer-text">
                <p>Politica de privacidad</p>
                <p>Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</body>

</html>