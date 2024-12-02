<?php
require_once("../config/config.php");
session_start();
$id_producto = $_GET["id"];

if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}

// Crear una conexión
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

// verificar connection con la BD
if (mysqli_connect_errno()) :
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
else:
    $info_del_producto = [];
    $result = mysqli_query($con, "SELECT * FROM producto WHERE id_producto=" . $id_producto . ";");
    $n_productos = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)):
        array_push($info_del_producto, array(
            "id" => $row['id_producto'],
            "nombre" => $row['nombre_producto'],
            "descripcion" => $row['descripcion_producto'],
            "disponibles" => $row['cantidad_disponible'],
            "precio" => $row['precio_producto'],
            "fabricante" => $row['fabricante'],
            "origen" => $row['origen'],
            "categoria" => $row['categoria'],
        ));
    endwhile;
    // cerrar conexión
    mysqli_close($con);
endif;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php" ?>
    <title>Información del producto</title>
    <!-- Icono de pagina -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JavaScript -->
    <script type="text/javascript" src="../js/comprar_agregarcarrito.js"></script>
    <style>
        .ocultar {
            display: none;
        }

        .mostrar {
            display: contents;
            /* Utiliza flexbox para alinear los selects */
            gap: 10px;
            /* Espacio entre los selects */
        }
    </style>
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
                <a href="../index.php#seccionProduct" class="active"><span class="fa fa-laptop"></span> Lista de productos</a>
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



<body class="container-info-product">
    <script>
        let id_del_producto = <?= $id_producto ?>;
    </script>

    <h1>Información del producto</h1>
    <div class="content-info" id="con-info_id">

        <div class="container-image-info">
            <img style="border-radius: 20px;" src="../img/productos/<?= $info_del_producto[0]["id"] ?>.jpeg" alt="">
        </div>

        <div class="text-product">
            <h3 style="margin-top:0;">Datos del producto</h3>
            <p><b>Nombre del producto: </b><?= $info_del_producto[0]["nombre"] ?></p>
            <p><b>Precio unitario: </b>$ <?= number_format(floatval($info_del_producto[0]["precio"])) ?></p>
            <hr>
            <h3>Descripción detallada</h3>
            <div class="info-secundaria">
                <p><b>Descripción: </b><?= $info_del_producto[0]["descripcion"] ?></p>
                <p><b>Fabricante: </b><?= $info_del_producto[0]["fabricante"] ?></p>
                <p><b>Origen: </b><?= $info_del_producto[0]["origen"] ?></p>
                <p><b>Categoría: </b><?= $info_del_producto[0]["categoria"] ?></p>
            </div>

            <p><b>Disponibles: </b><br><?= $info_del_producto[0]["disponibles"] ?></p>
            <p><b>Seleccionar cantidad: </b></p>
            <select class="form-control" id="cantidad_seleccionada">
                <?php for ($i = 1; $i <= $info_del_producto[0]["disponibles"]; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
            </select>
            <hr>
            <lavel style="color:#aa96da; font-size:22px;" id="garantia">
                <input style="width: 50px; height:15px;" type="checkbox" name="miCheckbox" id="miCheckbox"> Agregar seguro de daños
            </lavel>
        
            <div id="seguros" class="ocultar">
                <p><b>Selecciona el seguro de tu interes:</b></p>
                <br>
                <select class="form-control" name="tipo_seguro" id="tipo_seguro">
                    <option value="">---Selecciona tipo seguro---</option>
                    <?php
                    $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $sql = 'SELECT * FROM seguro_daños';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $id_seguro = $row['id_seguro'];
                        $detalle = $row['descripcion'];
                        $costo_año = $row['costo_año'];
                    ?>
                        <option value="<?php echo $id_seguro ?>"><?php echo $detalle ?> costo por año: $<?php echo number_format(floatval($costo_año)) ?>MXN</option>
                    <?php
                    }
                    mysqli_close($con);
                    ?>
                </select>
                <br>
                <p><b>Periodo de cobertura anual</b></p>
                <br>
                <select class="form-control" name="tiempo_seguro" id="tiempo_seguro">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                </select>
            </div>
        </div>


        <script>
            const checkbox = document.getElementById('miCheckbox');
            const seccion = document.getElementById('seguros');
            const conInfo = document.getElementById('con-info_id');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    seccion.classList.remove('ocultar');
                    seccion.classList.add('mostrar');
                    conInfo.style.height = '900px';
                } else {

                    seccion.classList.add('ocultar');
                    seccion.classList.remove('mostrar');
                    conInfo.style.height = '700px';
                }
            });

            function comprobar(id_del_producto, aux) {
                if (checkbox.checked) {
                    const tipo = document.querySelector('#tipo_seguro');
                    const tiempo = document.querySelector('#tiempo_seguro');
                    const select = document.getElementById('tipo_seguro');

                    const valorSeleccionado = parseInt(select.value); // Convertir a entero
                    let id_s = valorSeleccionado;
                    const valorSeleccionado2 = parseInt(tiempo.value); // Convertir a entero
                    let años_s = valorSeleccionado2;
                    comprobarTipoCompra(aux, id_del_producto, id_s, años_s);
                } else {
                    comprobarTipoCompra(aux, id_del_producto, 4, null);
                }
            }

            function comprobarTipoCompra(aux, id_del_producto, id_s, años_s) {
                if (aux) {
                    agregarAlCarrito(id_del_producto, id_s, años_s);
                } else {
                    enviarAPantallaDeCompraUno(id_del_producto, id_s, años_s);
                }
            }
        </script>

    </div>

    <div class="center-button">
        <input style="width: 180px; height:40px;" type="button" onclick="comprobar(id_del_producto,false)"
            class="btn btn-default comprar" value="Comprar">
        <input style="width: 180px; height:40px;" type="button" onclick="comprobar(id_del_producto,true)" class="btn btn-default comprar"
            value="Agregar al carrito">
    </div>







    <!--
    <div class="grande">
        <div class="imagen">
            <span><img src="../img/productos/<?= $info_del_producto[0]["id"] ?>.jpeg" alt=""></span>
        </div>
        <div class="info-importante">
            <span><b>Nombre: </b><br><?= $info_del_producto[0]["nombre"] ?></span>
            <span><b>Precio: </b><br>$ <?= number_format(floatval($info_del_producto[0]["precio"])) ?></span>
            <span><b>Disponibles: </b><br><?= $info_del_producto[0]["disponibles"] ?></span>
            <span><b>Seleccionar cantidad: </b>
                <select class="form-control" id="cantidad_seleccionada">
                    <?php for ($i = 1; $i <= $info_del_producto[0]["disponibles"]; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor ?>
                </select>
            </span>

            <div>
                <lavel id="garantia">
                    <input type="checkbox" name="miCheckbox" id="miCheckbox"> Agregar seguro de daños
                </lavel>
            </div>
            <div id="titulos_seleccionar" class="ocultar">
                <span><b>tipos de seguro</b></span>
                <span><b>tiempo de cobertura (años)</b></span>
            </div>
            <div id="seguros" class="ocultar">
                <select class="form-control" name="tipo_seguro" id="tipo_seguro">
                    <option value="">---Selecciona tipo seguro---</option>
                    <?php
                    $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $sql = 'SELECT * FROM seguro_daños';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $id_seguro = $row['id_seguro'];
                        $detalle = $row['descripcion'];
                        $costo_año = $row['costo_año'];
                    ?>
                        <option value="<?php echo $id_seguro ?>"><?php echo $detalle ?> costo por año: $<?php echo number_format(floatval($costo_año)) ?>MXN</option>
                    <?php
                    }
                    mysqli_close($con);
                    ?>
                </select>
                <select class="form-control" name="tiempo_seguro" id="tiempo_seguro">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                </select>
            </div>
            <script>
                const checkbox = document.getElementById('miCheckbox');
                const seccion = document.getElementById('seguros');
                const seccion2 = document.getElementById('titulos_seleccionar');
                //let aux=0;
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        seccion.classList.remove('ocultar');
                        seccion.classList.add('mostrar');
                        seccion2.classList.remove('ocultar');
                        seccion2.classList.add('mostrar');
                    } else {

                        seccion.classList.add('ocultar');
                        seccion.classList.remove('mostrar');
                        seccion2.classList.add('ocultar');
                        seccion2.classList.remove('mostrar');

                    }
                });

                function comprobar(id_del_producto, aux) {
                    if (checkbox.checked) {
                        const tipo = document.querySelector('#tipo_seguro');
                        const tiempo = document.querySelector('#tiempo_seguro');
                        const select = document.getElementById('tipo_seguro');

                        const valorSeleccionado = parseInt(select.value); // Convertir a entero
                        let id_s = valorSeleccionado;
                        const valorSeleccionado2 = parseInt(select.value); // Convertir a entero
                        let años_s = valorSeleccionado2;
                        comprobarTipoCompra(aux, id_del_producto, id_s, años_s);
                    } else {
                        comprobarTipoCompra(aux, id_del_producto, 4, null);
                    }
                }

                function comprobarTipoCompra(aux, id_del_producto, id_s, años_s) {
                    if (aux) {
                        agregarAlCarrito(id_del_producto, id_s, años_s);
                    } else {
                        enviarAPantallaDeCompraUno(id_del_producto, id_s, años_s);
                    }
                }
            </script>


            <span>
                <input type="button" onclick="comprobar(id_del_producto,false)"
                    class="btn btn-default comprar" value="Comprar">
                <input type="button" onclick="comprobar(id_del_producto,true)" class="btn btn-default comprar"
                    value="Agregar al carrito">
            </span>
        </div>
    </div>
    <h3>Descripción detallada</h3>
    <div class="info-secundaria">
        <span><b>Descripción: </b><?= $info_del_producto[0]["descripcion"] ?></span>
        <span><b>Fabricante: </b><?= $info_del_producto[0]["fabricante"] ?></span>
        <span><b>Origen: </b><?= $info_del_producto[0]["origen"] ?></span>
        <span><b>Categoría: </b><?= $info_del_producto[0]["categoria"] ?></span>
    </div>

                -->













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