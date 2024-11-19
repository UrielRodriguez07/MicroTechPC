<?php
require_once("../config/config.php");
session_start();
$id_producto=$_GET["id"];

if (!isset($_SESSION['sesion_personal'])) {
    header("Location: ./iniciar_sesion.php");
}

// Crear una conexión
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
    
// verificar connection con la BD
if (mysqli_connect_errno()) :
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
else:
    $info_del_producto=[];
    $result = mysqli_query($con, "SELECT * FROM producto WHERE id_producto=".$id_producto.";");
    $n_productos=mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)):
        array_push($info_del_producto, array(
            "id"=>$row['id_producto'],
            "nombre"=>$row['nombre_producto'],
            "descripcion"=>$row['descripcion_producto'],
            "disponibles"=>$row['cantidad_disponible'],
            "precio"=>$row['precio_producto'],
            "fabricante"=>$row['fabricante'],
            "origen"=>$row['origen'],
            "categoria"=>$row['categoria'],
        ));
    endwhile;
    // cerrar conexión
    mysqli_close($con);
endif;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "head_html.php"?>
    <title>Información del producto</title>
    <!-- icono -->
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- normalize -->
    <link rel="preload" href="../css/normalize.css" as="style">
    <link rel="stylesheet" href="../css/normalize.css">
    <!-- estilos -->
    <link rel="preload" href="../css/estilo_generico.css" as="style">
    <link rel="stylesheet" href="../css/estilo_generico.css">
    <link rel="preload" href="../css/styles-info-product.css" as="style">
    <link rel="stylesheet" href="../css/styles-info-product.css">
    <!-- JavaScript -->
    <script type="text/javascript" src="../js/comprar_agregarcarrito.js"></script>
</head>

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
                    <img src="..\img\logo.png" alt="MicroTechPC" style="height: 65px;">
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <!-- menú izquierdo-->
                    <ul class="nav navbar-nav">
                        <li class="active" style="height: 65px;"><a href="../index.php" style="height: 65px; padding-top: 20px;">Lista de productos</a></li>
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
                                <a href="./perfil.php" class="navbar-link" style="padding-top: 10px;">
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
<body class="container">
    <script>
    let id_del_producto = <?=$id_producto?>;
    </script>
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
                    <?php for ($i=1; $i <= $info_del_producto[0]["disponibles"]; $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                    <?php endfor ?>
                </select>
            </span>
            <span>
                <input type="button" onclick="enviarAPantallaDeCompraUno(id_del_producto)"
                    class="btn btn-default comprar" value="Comprar">
                <input type="button" onclick="agregarAlCarrito(id_del_producto)" class="btn btn-default comprar"
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
</body>

</html>