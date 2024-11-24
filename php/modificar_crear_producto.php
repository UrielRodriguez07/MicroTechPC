<?php
session_start();
if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}
$opcion = $_GET['op']; // 1 modificar, 2 agregar
$id_producto = isset($_GET['i']) ? $_GET['i'] : "";
$nombre_producto = isset($_GET['n']) ? $_GET['n'] : "";
$descripcion_producto = isset($_GET['d']) ? $_GET['d'] : "";
$cantidad_disponible = isset($_GET['c']) ? $_GET['c'] : "";
$precio_producto = isset($_GET['p']) ? $_GET['p'] : "";
$fabricante = isset($_GET['f']) ? $_GET['f'] : "";
$origen = isset($_GET['o']) ? $_GET['o'] : "";
$categoria = isset($_GET['cat']) ? $_GET['cat'] : "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php";
    $titulo = $opcion == 1 ? "Modificar producto" : "Agregar producto"; ?>
    <title>Admin - Agregar producto</title>
    <!-- Icono de pagina -->
    <link rel="shortcut icon" href="./img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="./../css/MTStyle.css">
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

<body class="container-modify-new-product">
    <h1><?= $titulo ?></h1>
    <?php $directorio = $opcion == 1 ? "hacer_modificacion.php" : "hacer_registro.php"; ?>
    <?php $_SESSION['sesion_personal']['id_producto'] = $id_producto; ?>

    <section class="wrapper">
        <div class="form signup">
            <header class="register-header">Información del producto</header>
            <form class="form-product" method="post" action="<?= $directorio ?>" enctype="multipart/form-data">
                <label for="nombre_producto">Nombre del producto:</label>
                <input type="text" id="nombre_producto" name="nombre_producto" placeholder="Ingresa nombre del producto" value="<?= $nombre_producto ?>">
                <label for="descripcion_producto">Descripción:</label>
                <textarea class="form-control" rows="3" id="descripcion_producto" name="descripcion_producto" placeholder="Ingrese descripción del producto"><?= $descripcion_producto ?></textarea>
                <label for="cantidad_disponible">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" placeholder="Ingrese cantidad disponible" value="<?= $cantidad_disponible ?>">
                <label for="precio_producto">Precio:</label>
                <input type="number" step="any" class="form-control" id="precio_producto" name="precio_producto" placeholder="Ingrese precio unitario del producto" value="<?= $precio_producto ?>">
                <label for="fabricante">Fabricante:</label>
                <input type="text" class="form-control" id="fabricante" name="fabricante" placeholder="Ingrese fabricante" value="<?= $fabricante ?>">
                <label for="origen">Origen:</label>
                <input type="text" class="form-control" id="origen" name="origen" placeholder="Ingrese origen del producto" value="<?= $origen ?>">
                <label for="categoria">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Ingrese categoria" value="<?= $categoria ?>">

                <?php if ($opcion == 2): ?>
                    <div class="form-image" style="justify-content: center;">
                        <label for="imagen_producto" style="font-size: 22px;">Imágen del producto:</label>
                        <input type="file" id="imagen_producto" name="imagen_producto" style="padding-top:15px;" />
                    </div>
                <?php endif; ?>
                <input type="submit" value="Agregar producto" />
            </form>
        </div>
    </section>

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