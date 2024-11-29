<?php
require_once("../config/config.php");
session_start();
if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}
$id_usuario = $_SESSION['sesion_personal']['id'];
$vaciar_carrito = $_GET['v'];

$arreglo = array(); // arreglo de productos con sus cantidad y id pe [0]=1, 2
foreach ($_GET['datos'] as $value) {
    $subarreglo = explode(",", $value);
    array_push($arreglo, $subarreglo);
}

$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()) :
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
else:


    $usuario = [];
    $result = mysqli_query($con, "SELECT * FROM usuario WHERE id_usuario=" . $id_usuario . ";");
    while ($row = mysqli_fetch_array($result)):
        array_push($usuario, array(
            "correo" => $row['correo'],
            "n_tarjeta" => $row['numero_tarjeta'],
            "direccion" => $row['direccion']
        ));
    endwhile;

    // recorrer el arreglo de productos para hacer un arreglo de productos mas detallado
    $producto = [];
    $seguro = [];
    foreach ($arreglo as $indice => $valor) {
        $cantidad = $valor[0];  //  el primer [0] es el primero producto
        $id_producto = $valor[1];
        $id_s = $valor[2];
        $años = $valor[3];
            /// AQUI
        $result = mysqli_query($con, "SELECT * FROM producto WHERE id_producto=" . $id_producto . ";");
        while ($row = mysqli_fetch_array($result)) {
            array_push($producto, array(
                "nombre" => $row['nombre_producto'],
                "precio" => $row['precio_producto'],
                "cantidad" => $cantidad,
                "id_producto" => $id_producto
            ));
        }
        $result = mysqli_query($con, "SELECT * FROM seguro_daños WHERE id_seguro=" . $id_s . ";");
        while ($row = mysqli_fetch_array($result)) {
            array_push($seguro, array(
                "descripcion" => $row['descripcion'],
                "costo_año" => $row['costo_año'],
                "años"=> $años,
                "id_seguro"=>$id_s
                ));
            }
        }

    //recorrer el arreglo para agregar los detalles del seguro por daños accidentales

    mysqli_close($con);
endif;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php" ?>
    <title>Pantalla de compra</title>
    <!-- Icono de pagina -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JavaScript -->
    <script type="text/javascript" src="../js/comprar_agregarcarrito.js"></script>
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
                <a href="../php/carrito.php" class="active"><span class="fa fa-shopping-cart"></span> Carrito de compras</a>
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
    <?php endif ?>
    </nav>
</header>

<body class="container-verify-purchase">
    <h1>Pantalla de compra</h1>
    <?php $aux=0;?>
    <?php foreach ($producto as $value) : ?>
        <div class="content-purchase">
            <!-- dirección, numero de tarjeta, correo -->
            <div class="info-fact">
                <h4>Información de facturación</h4>
                <div class="center-text">
                    <p><b>Dirección:</b> <?= $usuario[0]['direccion']; ?></p>
                    <p><b>Número de tarjeta:</b> <?= $usuario[0]['n_tarjeta']; ?></p>
                    <p><b>Correo:</b> <?= $usuario[0]['correo']; ?></p>
                </div>
            </div>
            <div class="info-verification">
                <h4>Confirmación de compra</h4> <!-- datos de los productos  NUEVO-->
                <div class="center-text">
                    <p><b>Nombre:</b> <?= $value['nombre']; ?></p>
                    <p><b>Precio:</b> $<?= number_format(floatval($value['precio']), 2, '.', ',') ?></p>
                    <p><b>Cantidad:</b> <?= $value['cantidad']; ?></p>
                    <p><b>GARANTIA: </b><?= $seguro[$aux]['descripcion']; ?> a $<?= number_format(floatval($seguro[$aux]['costo_año'])*floatval($seguro[$aux]['años']), 2, '.', ',')?></p>
                    <p><b>Total:</b>
                        $<?= number_format((((floatval($value['precio'])))+(floatval($seguro[$aux]['costo_año'])*floatval($seguro[$aux]['años'])))*(floatval($value['cantidad'])), 2, '.', ','); ?>
                    </p>
                </div>
            </div>
            <div class="content-image">
                <img style="border-radius: 20px;" src="../img/productos/<?= $value['id_producto'] ?>.jpeg" alt="<?= $value['nombre'] ?>">
            </div>
        </div>
        <?php $aux++;?>
    <?php endforeach; ?>

    <script>
        var arreglo_de_productos = JSON.parse('<?= json_encode($arreglo); ?>');
    </script>
    <div class="center-button">
        <input style="width: 180px; height:40px;" type="submit" value="Cancelar compra" class="btn btn-default boton"
            onclick="window.location.replace('../index.php')">
        <input style="width: 180px; height:40px;" type="submit" value="Confirmar compra" class="btn btn-default boton"
            onclick="comprar(arreglo_de_productos,<?= (int) $vaciar_carrito ?>)">
    </div>


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