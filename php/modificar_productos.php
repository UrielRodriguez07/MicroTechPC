<?php
require_once("../config/config.php");
session_start();
if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php"; ?>
    <title>Admin - Modificar producto</title>
    <!-- Icono dpeagina -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<!-- barra de navegación -->
<header>
    <!-- Nombre empresa -->
    <div class="logo">MicroTechPC</div>

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

            <?php if (!isset($_SESSION['sesion_personal'])): ?>
                <li>
                    <a href="../php/registro.php"><span class="fa fa-user-plus"></span> Registrarse</a>
                </li>

                <li>
                    <a href="../php/iniciar_sesion.php"><span class="fa fa-sign-in"></span> Ingresar</a>
                </li>

            <?php else: ?>
                <li>
                    <!--<a>Bienvenido <u><?= $_SESSION['sesion_personal']['nombre'] ?></u></a>-->
                </li>

                <li>
                    <a href="../php/perfil.php"><span class="fa fa-user"></span> Perfil</a>
                </li>

                <?php if ($_SESSION['sesion_personal']['super'] == 1): ?>
                    <li>
                        <a href="#" class="active"><span class="fa fa-unlock"></span> Admin</a>
                        <ul class="dropdown-list-admin">
                            <li><a href="../php/consultar_historial.php"><span class="glyphicon glyphicon-list"></span> Consultar historial</a></li>
                            <li><a href="../php/modificar_productos.php" class="active"><span class="glyphicon glyphicon-cog"></span> Modificar productos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="../php/cerrar_sesion.php"><span class="fa fa-sign-out"></span> Cerrar sesión</a>
                </li>
        </ul>
    <?php endif ?>
    </nav>
</header>

<body class="container-update-product">
    <div class="mismo-nivel">
        <h1>Modificar productos</h1>
        <a href="modificar_crear_producto.php?op=2"><input type="submit" value="Agregar Producto" class="btn btn-default boton"></a>
    </div>
    <!-- lista de productos -->
    <main>
        <!-- lista de productos automatica -->
        <?php
        // Crear una conexión
        $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        // verificar connection con la BD
        if (mysqli_connect_errno()) :
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        else:
            $result = mysqli_query($con, "SELECT * FROM producto ORDER BY id_producto DESC;");
            $n_productos = mysqli_num_rows($result);
            if ($n_productos > 0): ?>
                <div class="container-table-history">
                    <ul class="responsive-table-update">
                        <li class="table-header">
                            <div class="col col-1">Imagen producto</div>
                            <div class="col col-2">Nombre producto</div>
                            <div class="col col-3">Descripción</div>
                            <div class="col col-4">Cantidad</div>
                            <div class="col col-5">Precio</div>
                            <div class="col col-6">Fabricante</div>
                            <div class="col col-7">Origen</div>
                            <div class="col col-8">Categoria</div>
                            <div class="col col-8">Acción</div>
                        </li>
                        <?php
                        while ($row = mysqli_fetch_array($result)): ?>
                            <li class="table-row">
                                <div class="col col-1"><img class="imagen" src="../img/productos/<?= $row['id_producto'] ?>.jpeg" alt="<?= $row['nombre_producto'] ?>"></div>
                                <div class="col col-2"><?= $row['nombre_producto'] ?></div>
                                <div class="col col-3"><?= $row['descripcion_producto'] ?></div>
                                <div class="col col-4"><?= $row['cantidad_disponible'] ?></div>
                                <div class="col col-5"><?= $row['precio_producto'] ?></div>
                                <div class="col col-6"><?= $row['fabricante'] ?></div>
                                <div class="col col-7"><?= $row['origen'] ?></div>
                                <div class="col col-8"><?= $row['categoria'] ?></div>
                                <div class="col col-8"><a href="modificar_crear_producto.php?op=1&i=<?= urlencode($row['id_producto']) ?>&n=<?= urlencode($row['nombre_producto']) ?>&d=<?= urlencode($row['descripcion_producto']) ?>&c=<?= urlencode($row['cantidad_disponible']) ?>&p=<?= urlencode($row['precio_producto']) ?>&f=<?= urlencode($row['fabricante']) ?>&o=<?= urlencode($row['origen']) ?>&cat=<?= urlencode($row['categoria']) ?>">
                                        <input type="submit" value="Cambiar" class="btn btn-default btn-sm">
                                    </a></div>
                            </li>
                        <?php
                        endwhile; ?>
                    </ul>
                </div>
            <?php
            else: ?>
                <h1>NO HAY PRODUTOS EXISTENTES</h1>
        <?php
            endif;
            mysqli_close($con);
        endif;
        ?>
    </main>

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