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
    <title>Inicio de sesión</title>
    <!-- Icono de la pagina -->
    <link rel="shortcut icon" href="./../img/logo.png">
    <!-- Estilos -->
    <!--<link rel="stylesheet" href="./../css/styles-iniciosesion-registro.css">-->
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
                <a href="./php/registro.php"><span class="fa fa-user-plus"></span> Registrarse</a>
            </li>

            <li>
                <a href="./php/iniciar_sesion.php" class="active"><span class="fa fa-sign-in"></span> Ingresar</a>
            </li>

        </ul>
    </nav>
</header>

<body class="container-login">

    <!-- ingreso de datos -->

    <!-- validacion -->
    <?php
    include "./valida_inicio_sesion.php";
    ?>
    <!-- formulario -->

    <!--
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" class="login-form" method="$_POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Inicia Sesión</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>Ya tienes una cuenta? Inicia sesión</span>
                <input type="text" placeholder="Nombre de usuario" value="<?= $nombre ?>"/>
                <input type="password" placeholder="Contraseña" value="<?php echo $contra ?>"/>
                <a href="#">Olvidaste tu contraseña?</a>
                <input type="submit" class="btn btn-default comprar" value="Entrar"></input>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
-->





    
    <div class="centrar">
        <h1 style="text-align:center; margin:0">Iniciar sesión</h1>
        <form class="form form-horizontal" method="POST" action="./iniciar_sesion.php">
            <div class="form-group">
                <label for="nombre" class="control-label">Nombre de usuario: <span class="error"><?php echo $nombreErr ?></span></label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <input type="text" name="nombre" class="form-control" autocomplete="username" value="<?= $nombre ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="contrasena" class="control-label">Contraseña <span class="error"><?php echo $contraErr ?></span></label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></div>
                    <input type="password" class="form-control" name="contrasena" placeholder="Password" autocomplete="password" value="<?php echo $contra ?>">
                </div>
            </div>
            <p class="no-registrado">¿No tienes cuenta? <a class="btn-link" href="./registro.php">Registrarse</a></p>
            <div class="form-group boton">
                <input type="submit" class="btn btn-default comprar" value="Entrar"></input>
            </div>
        </form>
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