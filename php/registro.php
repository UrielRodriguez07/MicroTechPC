<?php
require_once("../config/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include "./head_html.php";
    ?>
    <title>Registro</title>
    <!-- icono -->
    <link rel="shortcut icon" href="./../img/logo.png">
    <!-- estilos -->
    <link rel="stylesheet" href="./../css/MTStyle.css">
    <!-- Iconos redes sociales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <a href="../php/registro.php" class="active"><span class="fa fa-user-plus"></span> Registrarse</a>
            </li>

            <li>
                <a href="../php/iniciar_sesion.php"><span class="fa fa-sign-in"></span> Ingresar</a>
            </li>

        </ul>
    </nav>
</header>

<body class="container-register">
    <!-- validación de datos -->
    <?php
    include "./valida_registro.php";
    ?>

    <section class="wrapper">
        <div class="form signup">
            <header class="register-header">Registrate</header>
            <form class="form-product" method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <label class="error">Nombre de usuario: <?php echo $nombreErr ?></label>
                <input type="text" name="nombre" placeholder="Ingresa nombre de usuario" value="<?php echo $nombre ?>" required>
                <label class="error">Contraseña: <?php echo $contraErr ?></label>
                <input type="password" name="contrasena" placeholder="Ingresa contraseña" value="<?php echo $contra ?>" required>
                <label class="error">Fecha de nacimiento: <?php echo $fechanacimientoErr ?></label>
                <input type="date" name="fnac" placeholder="Ingresa tu fecha de nacimiento" value="<?php echo $fechanacimiento ?>" max="2005-05-03" required>
                <label class="error">Correo electrónico: <?php echo $correoErr ?></label>
                <input type="email" name="correo" placeholder="Ingresa tu correo electrónico" autocomplete="email" value="<?php echo $correo ?>" required>
                <label class="error">Número de tarjeta de crédito o debito: <?php echo $ntarjetaErr ?></label>
                <input type="text" name="numero_tarjeta" placeholder="Ingresa el número de tu tarjeta" value="<?php echo $ntarjeta ?>" required>
                <label class="error">Direccion de vivienda: <?php echo $addressErr ?></label>
                <input type="text" name="direccion" placeholder="Ingresa tu dirección" autocomplete="address-level1" value="<?php echo $address ?>" required>
                <div class="checkbox">
                    <input type="checkbox" id="signupCheck" required/>
                    <label for="signupCheck">I accept all terms & conditions</label>
                </div>
                <input type="submit" value="Registrarse"/>
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