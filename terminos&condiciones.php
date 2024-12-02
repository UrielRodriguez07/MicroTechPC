<?php
session_start();
include_once("./config/config.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("./php/head_html.php"); ?>
    <title>Términos y Condiciones - MicroTechPC</title>
    <link rel="shortcut icon" href="./img/logo.png">
    <link rel="stylesheet" href="./css/MTStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .highlight {
            display: inline; /* Asegura que el estilo se aplique a texto en línea */
            background: linear-gradient(transparent 70%, rgba(255, 255, 0, 0.6) 70%);
            padding: 0 2px; /* Espaciado opcional alrededor del texto */
        }
    </style>
</head>

<body style="font-size: 22px;">
    <!-- barra de navegación -->
    <header>
        <div class="logo">MicroTechPC</div>
        <nav class="nav-bar">
            <ul>
                <li><a href="./index.php"><span class="fa fa-home"></span> Inicio</a></li>
                <li><a href="./php/carrito.php"><span class="fa fa-shopping-cart"></span> Carrito</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="terms-container">
        <h1 class="text-center" style="margin: 20px 0; text-transform: uppercase;">Términos y Condiciones</h1>
        <section style="padding: 0 20px; text-align: justify;">
            <p><strong class="highlight">Bienvenido a MicroTechPC</strong>. Al utilizar los servicios y productos proporcionados por Micro Tech PC, 
            usted acepta estar sujeto a estos términos y condiciones. Si no está de acuerdo con alguna parte de ellos, debe abstenerse 
            de usar nuestros servicios o productos:</p>
            <ol>
                <li>
                    <strong class="highlight" >Definiciones:</strong>
                    <p style="padding-left: 40px;">>Micro Tech PC: Empresa dedicada a la venta y servicios de tecnología para el consumidor.</p>
                    <p style="padding-left: 40px;">>Usuario: Persona que utiliza o adquiere productos o servicios de Micro Tech PC.</p>
                    <p style="padding-left: 40px;">>Servicios: Incluyen asesorías, ventas de equipos de cómputo, reparaciones, y cualquier otro servicio relacionado.</p>
                </li>
                <li>
                    <strong  class="highlight">Uso de los productos y servicios:</strong>
                    <p>Los productos y servicios de Micro Tech PC están diseñados para satisfacer las necesidades tecnológicas del cliente.</p>
                    <p style="padding-left: 40px;">>Responsabilidad del Usuario: Es responsabilidad del cliente garantizar que el uso de los productos o servicios cumpla con las leyes locales aplicables.</p>
                    <p style="padding-left: 40px;">>Limitación de Uso: Los productos no deben ser utilizados para fines ilegales o no autorizados.</p>

                </li>
                <li>
                    <strong class="highlight">Garantia de los productos:</strong>
                    <p>Micro Tech PC garantiza que los productos vendidos están libres de defectos de fabricación por un período especificado en el comprobante de compra.</p>
                    <p style="padding-left: 40px;">>Cobertura de la Garantía: Aplica únicamente para defectos inherentes al producto y no cubre daños por mal uso, desgaste normal o manipulación incorrecta.</p>
                    <p style="padding-left: 40px;">>Reclamaciones: Para efectuar una reclamación, el usuario debe presentar el comprobante de compra original.</p>
                </li>
                <li>
                    <strong class="highlight">Servicio de reparacion:</strong>
                    <p>Micro Tech PC ofrece servicios de reparación para diversos dispositivos tecnológicos, sujetos a las siguientes condiciones:</p>
                    <p style="padding-left: 40px;">>Diagnóstico: El diagnóstico inicial del problema puede estar sujeto a un cargo, que será informado antes de proceder.</p>
                    <p style="padding-left: 40px;">>Responsabilidad Limitada: No nos hacemos responsables por pérdida de datos u otros daños indirectos ocasionados durante el servicio de reparación.</p>
                    <p style="padding-left: 40px;">>Garantía del Servicio: Las reparaciones realizadas tienen una garantía limitada, especificada en el recibo del servicio.</p>
                </li>
                <li>
                    <strong class="highlight">Privacidad y proteccion de datos:</strong>
                    <p>Micro Tech PC se compromete a proteger la información personal de los usuarios.</p>
                    <p style="padding-left: 40px;">>Datos Recopilados: Se recopilan únicamente los datos necesarios para la prestación de servicios, como nombre, dirección y detalles de contacto.</p>
                    <p style="padding-left: 40px;">>Uso de Datos: La información será utilizada exclusivamente para los fines relacionados con los servicios contratados y no será compartida con terceros sin el consentimiento del usuario.</p>
                </li>
                <li>
                    <strong class="highlight" >Propiedad intelectual:</strong>
                    <p></p>El contenido, diseño y tecnología utilizados en los servicios ofrecidos por Micro Tech PC son propiedad de la empresa o de sus socios autorizados.
                    <p style="padding-left: 40px;">>Queda prohibido copiar, modificar o redistribuir cualquier parte de los productos o servicios sin previa autorización escrita.</p>
                </li>
                <li>
                    <strong class="highlight" >Limitacion de responsabilidad:</strong>
                    <p>Micro Tech PC no será responsable de:</p>
                    <p style="padding-left: 40px;">>Pérdidas indirectas o incidentales resultantes del uso de productos o servicios.</p>
                    <p style="padding-left: 40px;">>Daños ocasionados por mal uso o instalación incorrecta de los productos adquiridos.</p>
                </li>
                <li>
                    <strong class="highlight" >Modificaciones a los Términos y Condiciones:</strong>
                    <p>Micro Tech PC se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones serán efectivas a partir de su publicación en los canales oficiales de la empresa.</p>
                </li>
                <li>
                    <strong class="highlight" >Ley Aplicable y Jurisdicción:</strong>
                    <p>Estos términos se rigen por las leyes locales aplicables. Cualquier disputa será resuelta en los tribunales correspondientes a la jurisdicción de Micro Tech PC.</p>
                </li>
                <li>
                    <strong class="highlight" >Contacto:</strong>
                    <p>Para cualquier duda o consulta, puede contactarnos a través de:</p>
                    <p style="padding-left: 40px;">
                        Correo Electrónico: 
                        <a style="font-size: 20px;" href="mailto:180253@upslp.edu.mx">180253@upslp.edu.mx</a> | 
                        <a style="font-size: 20px;" href="mailto:173572@upslp.edu.mx">173572@upslp.edu.mx</a> | 
                        <a style="font-size: 20px;" href="mailto:180941@upslp.edu.mx">180941@upslp.edu.mx</a>
                    </p>
                </li>
                <li>
                    <p class="highlight">Al utilizar los productos y servicios de Micro Tech PC, el usuario confirma que ha leído, entendido y aceptado estos términos y condiciones.</p>
                </li>
            </ol>
            <p class="highlight">Para más información, contáctanos a través de nuestros canales oficiales.</p>
        </section>
        <div class="text-center" style="margin: 30px;">
            <button onclick="window.location.href='./index.php'" class="btn">Regresar a la tienda</button>
            <button onclick="window.close()" class="btn btn-secondary">Cerrar</button>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <p style="color: white;">&copy; 2024 MicroTechPC. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
