<?php
session_start();
include_once("./config/config.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("./php/head_html.php"); ?>
    <title>Página de inicio - MicroTechPC</title>
    <!-- icono -->
    <link rel="shortcut icon" href="./img/logo.png">
    <!-- normalize -->
    <link rel="preload" href="./css/normalize.css" as="style">
    <link rel="stylesheet" href="./css/normalize.css">
    <!-- estilos -->
    <link rel="preload" href="./css/styles.css" as="style">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preload" href="./css/estilo_generico.css" as="style">
    <link rel="stylesheet" href="./css/estilo_generico.css">
</head>

<body>
    <!-- barra de navegación -->
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <!-- responsividad del header, marca -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- marca -->
                    <img src="./img/logo.png" alt="MicroTechPC" style="height: 65px;">
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <!-- menú izquierdo-->
                    <ul class="nav navbar-nav">
                        <li class="active" style="height: 65px;"><a href="#" style="height: 65px; padding-top: 20px;">Lista de productos</a></li>
                    </ul>
                    <!-- Campo de búsqueda -->
                    <form class="navbar-form navbar-left" action="./php/busqueda.php" method="GET" style="margin: 0; padding-top: 15px;">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar..." name="querySEO" required style="width: 600px;">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <!-- menú derecho -->
                    <?php if (!isset($_SESSION['sesion_personal'])): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="./php/registro.php"><span class="glyphicon glyphicon-user" style="padding-top: 10px;"></span>Registrarse
                                </a>
                            </li>
                            <li>
                                <a href="./php/iniciar_sesion.php"><span class="glyphicon glyphicon-log-in" style="padding-top: 10px;">
                                    </span> Ingresar</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="nav navbar-nav">
                            <li class="navbar-text quita_margen">
                                <a href="./php/perfil.php" class="navbar-link" style="padding-top: 24px;">
                                    Sesión iniciada como
                                    <u><?= $_SESSION['sesion_personal']['nombre'] ?></u>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($_SESSION['sesion_personal']['super'] == 1): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false" style="padding-top: 24px;">Modo Administrador <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./php/consultar_historial.php"><span class="glyphicon glyphicon-list"></span> Consultar historial</a></li>
                                        <li><a href="./php/modificar_productos.php"><span class="glyphicon glyphicon-cog"></span> Modificar productos</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="./php/cerrar_sesion.php"><span class="glyphicon glyphicon-log-out" style="padding-top: 10px;"></span> Cerrar sesión</a>
                            </li>
                            <li>
                                <a href="./php/carrito.php"><span class="glyphicon glyphicon-shopping-cart" style="padding-top: 10px;"></span> Carrito de compras</a>
                            </li>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
        </nav>
    </header>

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
                        <h3>Laptos de modalidad Gamer de la mejor calidad</h3>
                        <p>Aprovecha ahora las diversas ofertas!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/a.jpg" alt="setup2">
                    <div class="carousel-caption">
                        <h3>Listo para estrenar tu nueva laptop escolar</h3>
                        <p>Un rendimiento excepcional a un precio que no se puede dejar pasar!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/c.jpg" alt="setup3">
                    <div class="carousel-caption">
                        <h3>Las empresas tambien merecen lo suyo</h3>
                        <p>Renueva de la mejor manera en tu entorno de trabajo y logra aquello que desees!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/carrusel/d.jpg" alt="setup4">
                    <div class="carousel-caption">
                        <h3>Puedes encontrar cualquier equipo perfecto para tus actividades y tareas</h3>
                        <p>Desde precios muy accesibles y ofertas</p>
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
    <h2 class="container text-center" style="margin-bottom: .6em; margin-top: .5em;">Catalogo de equipos</h2>

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
                        <a href="./php/info_producto.php?id=<?= $row['id_producto'] ?>" class="btn btn-sm comprar">Comprar</a>
                    <?php else: ?>
                        <a href="./php/iniciar_sesion.php" class="btn btn-sm comprar">Comprar</a>
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

    <!-- footer -->
    <div class="footer">
        <a href="https://franciscogl.notion.site/Francisco-Guti-rrez-L-pez-c327c3fd856d41ea95934e1f68713d84">
            COPYRIGHT © 2022<br>
            MicroTechPC<br>
            Tel de contacto (444) 8696358
        </a>
    </div>
</body>

</html>

</html>