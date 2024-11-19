<?php
session_start();
include_once("./config/config.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("./php/head_html.php"); ?>
    <title>Inicio MicroTechPC</title>
    <!-- Icono pagina -->
    <link rel="shortcut icon" href="./img/logo.png">
    <!-- Estilo -->
    <link rel="stylesheet" href="./css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
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
                    <a href="#seccionInfoMT" class="active"><span class="fa fa-home"></span> Inicio</a>
                </li>

                <li>
                    <a href="#seccionProduct"><span class="fa fa-laptop"></span> Lista de productos</a>
                </li>

                <li>
                    <a href="./php/carrito.php"><span class="fa fa-shopping-cart"></span> Carrito de compras</a>
                </li>

                <?php if (!isset($_SESSION['sesion_personal'])): ?>
                    <li>
                        <a href="./php/registro.php"><span class="fa fa-user-plus"></span> Registrarse</a>
                    </li>

                    <li>
                        <a href="./php/iniciar_sesion.php"><span class="fa fa-sign-in"></span> Ingresar</a>
                    </li>

                <?php else: ?>
                    <li>
                        <!--<a>Bienvenido <u><?= $_SESSION['sesion_personal']['nombre'] ?></u></a>-->
                    </li>

                    <li>
                        <a href="./php/perfil.php"><span class="fa fa-user"></span> Perfil</a>
                    </li>

                    <?php if ($_SESSION['sesion_personal']['super'] == 1): ?>
                        <li>
                            <a href="#"><span class="fa fa-unlock"></span> Admin</a>
                            <ul class="dropdown-list-admin">
                                <li><a href="./php/consultar_historial.php"><span class="glyphicon glyphicon-list"></span> Consultar historial</a></li>
                                <li><a href="./php/modificar_productos.php"><span class="glyphicon glyphicon-cog"></span> Modificar productos</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="./php/cerrar_sesion.php"><span class="fa fa-sign-out"></span> Cerrar sesión</a>
                    </li>
            </ul>
        <?php endif ?>
        </nav>
    </header>




    <!-- Arreglar ruta del script de Nav Bar por mientras esta aqui provisionalmente -->
    <script>
        // Obtener el icono de las barras
        const bars = document.querySelector(".bars");

        bars.onclick = function() {
            // Obtener el navbar
            const navBar = document.querySelector(".nav-bar");

            // Alternar la clase "active" en el navbar
            navBar.classList.toggle("active");

            // Obtener el contenedor del carrusel
            const carrusel = document.querySelector(".container-fluid");

            // Si el navbar tiene la clase "active", cambiar el padding-top del carrusel
            if (navBar.classList.contains("active")) {
                carrusel.style.paddingTop = "630px"; // Establecer padding-top a 550px
            } else {
                carrusel.style.paddingTop = "0"; // Dejar padding-top en 0 si el navbar no está activo
            }
        }
    </script>




    <!-- carrusel -->
    <div class="container-fluid carrusel" style="padding: 0;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="./img/carrusel/b.jpg" alt="setup1">
                    <div class="carousel-caption">
                        <h2>Laptos de modalidad Gamer de la mejor calidad</h2>
                        <h3>Aprovecha ahora las diversas ofertas!</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/a.jpg" alt="setup2">
                    <div class="carousel-caption">
                        <h2>Listo para estrenar tu nueva laptop escolar</h2>
                        <h3>Un rendimiento excepcional a un precio que no se puede dejar pasar!</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/c.jpg" alt="setup3">
                    <div class="carousel-caption">
                        <h2>Las empresas tambien merecen lo suyo</h2>
                        <h3>Renueva de la mejor manera en tu entorno de trabajo y logra aquello que desees!</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/d.jpg" alt="setup4">
                    <div class="carousel-caption">
                        <h2>Puedes encontrar cualquier equipo perfecto para tus actividades y tareas</h2>
                        <h3>Desde precios muy accesibles y ofertas</h3>
                    </div>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- panel del titulo -->
    <div class="info-MT" id="seccionInfoMT">
        <div class="info-text">
            <h1 class="container text-center" style="margin-bottom: .6em; margin-top: .5em;">Quienes somos</h1>
            <p>En Micro Tech PC somos una empresa comprometida con ofrecer soluciones tecnológicas accesibles y sostenibles.
                Nos especializamos en la venta de laptops usadas y reacondicionadas, cuidadosamente seleccionadas y mejoradas para satisfacer las necesidades de estudiantes, gamers y profesionales.</p>
            <br>
            <p>Nuestro propósito es ser una alternativa confiable en el mercado, ofreciendo productos de alta calidad a precios competitivos,
                mientras contribuimos a la reducción de basura electrónica y al cuidado del medio ambiente.</p>
            <br>
            <p>En Micro Tech PC valoramos la satisfacción de nuestros clientes y trabajamos para brindar un servicio excepcional que combina tecnología, sostenibilidad y ahorro económico.
                Con un enfoque en la excelencia y la responsabilidad, buscamos acompañarte en cada paso para que encuentres la solución perfecta para tus necesidades tecnológicas.</p>
        </div>
        <div class="info-img">
            <img src="./img/logo.png" alt="MicroTech-Logo" class="info-logo">
        </div>
    </div>
    <hr>

    <!-- panel del titulo -->
    <h1 class="container text-center" id="seccionProduct" style="margin-bottom: .6em; margin-top: .5em; text-transform: uppercase;font-size: 50px;">Catálogo de equipos</h1>

    <!-- lista de productos -->
    <main class="principal">
        <!-- lista de productos automatica -->
        <?php
        // Crear una conexión
        $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        // verificar connection con la BD
        if (mysqli_connect_errno()) :
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        else:
            $result = mysqli_query($con, "SELECT * FROM producto;");
            $vacios = 0;
            while ($row = mysqli_fetch_array($result)):
                if ($row['cantidad_disponible'] == 0) {
                    $vacios++;
                    continue;
                }
        ?>
                <div class="card text-center">
                    <img class="card-img-top" src="./img/productos/<?= $row['id_producto'] ?>.jpeg" alt="Card image cap">
                    <div class="card-body">
                        <hr class="solid">

                        <div id="altura_caja">
                            <p class="card-text">
                                <?= $row['nombre_producto'] ?>
                            </p>
                        </div>

                        <hr class="solid">
                        <p class="card-text">$
                            <?= number_format(floatval($row['precio_producto']), 2, '.', ',') ?>
                        </p>
                    </div>
                    <?php if (isset($_SESSION['sesion_personal'])): ?>
                        <a href="./php/info_producto.php?id=<?= $row['id_producto'] ?>" class="comprar">Comprar</a>
                    <?php else: ?>
                        <a href="./php/iniciar_sesion.php" class="comprar">Comprar</a>
                    <?php endif ?>
                </div>
                <?php
            endwhile;
            $n_relleno = (((int)mysqli_num_rows($result)) - $vacios) % 5;
            if ($n_relleno != 0):
                for ($x = 0; $x < 5 - $n_relleno; $x++): ?>
                    <div class="card" style="border: solid 1px transparent;">
                    </div>
        <?php
                endfor;
            endif;
            // cerrar conexión
            mysqli_close($con);
        endif;
        ?>
    </main>
    <hr>

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
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
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

</html>