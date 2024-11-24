<?php
require_once("../config/config.php");
session_start();

if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}

// Crear una conexión
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

// verificar connection con la BD
if (mysqli_connect_errno()) :
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
else:
    $arreglo_de_productos = [];
    $result = mysqli_query($con, "SELECT * FROM carrito INNER JOIN producto ON carrito.id_producto = producto.id_producto INNER JOIN seguro_daños ON carrito.id_seguro = seguro_daños.id_seguro WHERE carrito.id_usuario=" . $_SESSION['sesion_personal']['id'] . ";");
    $n_productos = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)):
        array_push($arreglo_de_productos, array(
            "id_carrito" => $row['id_carrito'],
            "id" => $row['id_producto'],
            "nombre" => $row['nombre_producto'],
            "precio" => $row['precio_producto'],
            "disponibles" => $row['cantidad_disponible'],
            "cantidad" => $row['cantidad_seleccionada'],
            "descripcion" => $row['descripcion'],
            "años" => $row['años'],
            "costo_año" => $row['costo_año'],
        ));
    endwhile;

    // cerrar conexión
    mysqli_close($con);
endif;
$suma = 0;
$arreglo_para_comprar = array();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php" ?>
    <title>Carrito de compras</title>
    <!-- Icono de pagina -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JS -->
    <script type="text/javascript" src="../js/comprar_agregarcarrito.js"></script>
</head>

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


<body class="container-cart">

    <?php if ($n_productos == 0): ?>
        <h1 class="h1">TU CARRITO ESTA VACIO</h1>
        <div class="responsive-table-cart"></div>
    <?php else: ?>
        <h1 class="h1">CARRITO DE COMPRAS</h1>

        <div class="responsive-table-cart">
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">Imagen producto</div>
                    <div class="col col-2">Nombre producto</div>
                    <div class="col col-3">Stock disponible</div>
                    <div class="col col-4">Cantidad total requerida</div>
                    <div class="col col-5">Detalles del equipo</div>
                    <div class="col col-6">Precio unitario</div>
                    <div class="col col-6">Precio total</div>
                </li>
                <?php foreach ($arreglo_de_productos as $producto):
                    // [0]=
                    array_push($arreglo_para_comprar, ($producto["cantidad"] . "," . $producto["id"] . ""));
                ?>
                    <li class="table-row">
                        <div class="col col-1"><img src="../img/productos/<?= $producto["id"] ?>.jpeg" alt="producto <?= $producto["nombre"] ?>" class="imagen"></div>
                        <div class="col col-2"><?= $producto["nombre"] ?></div>
                        <div class="col col-3"><?= $producto["disponibles"] ?></div>
                        <div class="col col-4">
                            <a href="modificar_producto_carrito.php?signo=0&id_carrito=
                            <?= $producto['id_carrito'] ?>&disp=<?= $producto["disponibles"] ?>&cant= <?= $producto["cantidad"] ?>" class="btn btn-default">-
                            </a>

                            <button type="submit" class="btn btn-default disabled" style="color: #373737;"><?= $producto["cantidad"] ?></button>

                            <a href="modificar_producto_carrito.php?signo=1&id_carrito=<?= $producto['id_carrito'] ?>&disp=
                            <?= $producto["disponibles"] ?> &cant=<?= $producto["cantidad"] ?>" class="btn btn-default">+
                            </a>
                        </div>
                        <div class="col col-5">
                            <!-- <?= $producto['descripcion'] ?><br>  Nunca se recolecta de la consulta SQL, checar -->
                            - Seguro durante <?= $producto["años"] < 1 ? 0 : $producto["años"] ?> año(s).
                            <br>
                            - Precio parcial de $<?= number_format(floatval($producto["costo_año"])) ?> por año y equipo.
                        </div>
                        <div class="col col-6">$<?= number_format(floatval(floatval($producto["precio"])), 2, '.', ',')  ?></div>
                        <div class="col col-7">$<?= number_format(floatval(floatval($producto["precio"]) * ((int) $producto["cantidad"]) + (+ (floatval(floatval($producto["costo_año"])) * (int)($producto["años"]) * ((int) $producto["cantidad"])))), 2, '.', ',') ?></div>

                        <?php $suma += floatval(floatval($producto["precio"]) * ((int) $producto["cantidad"]));
                        $suma += (floatval(floatval($producto["costo_año"])) * (int)($producto["años"]) * ((int) $producto["cantidad"]));
                        ?>
                    </li>
                <?php endforeach; ?>
                <div class="cost-total">
                    <div>Costo total </div>
                     <div>$<?= number_format(floatval(floatval($suma)), 2, '.', ',') ?></div>
                </div>
            </ul>
        </div>

        <script>
            var arreglo_de_productos = JSON.parse('<?= json_encode($arreglo_para_comprar); ?>');
        </script>
       
        <div class="buttons-cart">
            <a href="vaciar_carrito.php"><input type="submit" class="btn btn-default" value="Vaciar carrito" style="width: 160px; height:40px; font-size:20px; margin-bottom:20px; margin:0;"></a>
            <input style="width: 160px; height:40px; font-size:20px; margin-bottom:20px;" type="submit" class="btn btn-default" value="Comprar todo"
                onclick="enviarAPantallaDeCompraMuchos(arreglo_de_productos)">
        </div>
    <?php endif ?>


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