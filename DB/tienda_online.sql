-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 01:59:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `cantidad_seleccionada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `id_historial` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad_comprada` int(11) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) DEFAULT NULL,
  `descripcion_producto` varchar(255) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `precio_producto` double DEFAULT NULL,
  `fabricante` varchar(100) DEFAULT NULL,
  `origen` varchar(100) DEFAULT 'China',
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion_producto`, `cantidad_disponible`, `precio_producto`, `fabricante`, `origen`, `categoria`) VALUES
(1, 'Dell Inspiron 15 3000', 'Laptop ligera y asequible para tareas académicas. Equipado con un procesador Intel, ideal para navegación y aplicaciones de oficina.', 15, 4900, 'Dell', 'China', 'Estudiantes'),
(2, 'Dell Vostro 15 3000', 'Ideal para estudiantes, ofrece un equilibrio entre rendimiento y precio. Con pantalla HD y teclado cómodo para escribir.', 12, 5600, 'Dell', 'China', 'Estudiantes'),
(3, 'Dell Chromebook 3100', 'Perfecta para tareas en línea, con sistema operativo Chrome OS y batería de larga duración, ideal para estudiantes.', 10, 3500, 'Dell', 'China', 'Estudiantes'),
(4, 'Lenovo IdeaPad 330', 'Versátil y fácil de usar, cuenta con un diseño moderno y un rendimiento sólido para trabajos escolares y entretenimiento.', 10, 5600, 'Lenovo', 'China', 'Estudiantes'),
(5, 'Lenovo IdeaPad 530S', 'Diseño delgado y potente, ideal para estudiantes que necesitan un dispositivo ligero y eficiente.', 8, 6500, 'Lenovo', 'China', 'Estudiantes'),
(6, 'Lenovo Chromebook C330', 'Compacta y eficiente, con gran conectividad y fácil de manejar, perfecta para el uso diario de estudiantes.', 12, 3200, 'Lenovo', 'China', 'Estudiantes'),
(7, 'HP Pavilion 15', 'Ideal para tareas escolares y entretenimiento, cuenta con un rendimiento sólido y buena duración de batería.', 10, 5600, 'HP', 'México', 'Estudiantes'),
(8, 'HP Stream 14', 'Ligera y portátil, perfecta para estudiantes que necesitan un dispositivo para tareas diarias y navegación web.', 12, 4000, 'HP', 'México', 'Estudiantes'),
(9, 'HP Chromebook 14', 'Eficiente y fácil de usar, con sistema Chrome OS, ideal para tareas en línea y productividad.', 10, 3200, 'HP', 'México', 'Estudiantes'),
(10, 'Dell G3 15 Gaming', 'Laptop potente para gaming en movimiento, cuenta con gráficos dedicados y rendimiento optimizado para juegos.', 8, 12800, 'Dell', 'China', 'Gamer'),
(11, 'Dell Alienware m15', 'Diseño premium y rendimiento excepcional, ideal para gamers exigentes que buscan calidad gráfica.', 6, 21000, 'Dell', 'China', 'Gamer'),
(12, 'Lenovo Legion 5', 'Rendimiento excepcional para los gamers, con sistema de refrigeración avanzada y teclado retroiluminado.', 6, 14000, 'Lenovo', 'China', 'Gamer'),
(13, 'HP Omen 15 Gaming', 'Potente y elegante, proporciona experiencias de juego envolventes con un diseño atractivo.', 7, 17500, 'HP', 'México', 'Gamer'),
(14, 'Dell Latitude 5490', 'Laptop confiable y segura para entornos de trabajo, equipada con características de seguridad empresarial.', 10, 9600, 'Dell', 'China', 'Oficina'),
(15, 'Dell Latitude 5500', 'Ideal para profesionales en movimiento, ofrece una combinación de rendimiento y durabilidad.', 8, 10400, 'Dell', 'China', 'Oficina'),
(16, 'Dell Latitude 5510', 'Eficiente y segura para el trabajo diario, cuenta con varias opciones de conectividad.', 9, 11200, 'Dell', 'China', 'Oficina'),
(17, 'Dell XPS 13 (9370)', 'Elegante y potente, ideal para profesionales que necesitan un diseño compacto y alto rendimiento.', 5, 14400, 'Dell', 'China', 'Oficina'),
(18, 'Dell Precision 5530', 'Laptop de trabajo para tareas exigentes, cuenta con gráficos dedicados y pantalla 4K opcional.', 4, 20000, 'Dell', 'China', 'Oficina'),
(19, 'Lenovo ThinkPad T490', 'Excelente rendimiento y durabilidad, ideal para profesionales que requieren una laptop confiable.', 5, 8000, 'Lenovo', 'China', 'Oficina'),
(20, 'Lenovo ThinkPad T580', 'Laptop robusta y eficiente para entornos de trabajo, con teclado cómodo y gran duración de batería.', 6, 9600, 'Lenovo', 'China', 'Oficina'),
(21, 'Lenovo ThinkPad X1 Carbon (6th Gen)', 'Diseño ligero y alto rendimiento para ejecutivos, con excelente teclado y pantalla.', 4, 16000, 'Lenovo', 'China', 'Oficina'),
(22, 'Lenovo ThinkPad L480', 'Gran capacidad de conectividad y rendimiento, ideal para pequeñas y medianas empresas.', 7, 7600, 'Lenovo', 'China', 'Oficina'),
(23, 'Lenovo ThinkBook 15', 'Diseño moderno y profesional, adecuado para entornos de trabajo con gran rendimiento.', 5, 8800, 'Lenovo', 'China', 'Oficina'),
(24, 'HP EliteBook 840 G5', 'Diseño premium y características avanzadas, ideal para ejecutivos y profesionales de negocios.', 4, 11200, 'HP', 'México', 'Oficina'),
(25, 'HP EliteBook 850 G5', 'Laptop de alto rendimiento para profesionales, con seguridad mejorada y duración de batería prolongada.', 4, 12800, 'HP', 'México', 'Oficina'),
(26, 'HP ProBook 450 G5', 'Ofrece un rendimiento sólido y diseño atractivo, ideal para negocios y uso diario.', 6, 8000, 'HP', 'México', 'Oficina'),
(27, 'HP ProBook 640 G4', 'Combinación de rendimiento y características de seguridad para el uso en oficina.', 5, 8800, 'HP', 'México', 'Oficina'),
(28, 'HP Spectre x360 (2019)', 'Convertible y elegante, ideal para presentaciones y trabajos creativos.', 4, 14400, 'HP', 'México', 'Oficina'),
(29, 'HP Envy 13', 'Rendimiento excepcional en un diseño compacto, perfecto para profesionales que viajan.', 5, 10400, 'HP', 'México', 'Oficina'),
(30, 'HP 255 G7', 'Laptop económica pero confiable para tareas básicas en oficina, con buen rendimiento.', 10, 4600, 'HP', 'México', 'Oficina'),
(31, 'HP Elite x2 1012', '2 en 1 ideal para movilidad, combina tablet y laptop para mayor versatilidad.', 3, 7700, 'HP', 'México', 'Oficina'),
(32, 'Lenovo Yoga 730', 'Laptop convertible con diseño elegante y rendimiento potente, ideal para presentaciones y trabajo creativo.', 4, 12000, 'Lenovo', 'China', 'Oficina'),
(33, 'Lenovo Flex 14', 'Convertible y versátil, ideal para estudiantes y profesionales que requieren flexibilidad.', 5, 7200, 'Lenovo', 'China', 'Estudiantes'),
(34, 'Lenovo ThinkPad E490', 'Rendimiento sólido y diseño clásico, ideal para pequeñas y medianas empresas.', 6, 7200, 'Lenovo', 'China', 'Oficina'),
(35, 'Dell Inspiron 15 5000', 'Laptop de uso general con buena potencia y rendimiento, ideal para tareas diarias.', 10, 5600, 'Dell', 'China', 'Estudiantes'),
(36, 'Dell XPS 15 (9570)', 'Potente laptop para profesionales y creativos, con gráficos dedicados y pantalla 4K opcional.', 3, 17600, 'Dell', 'China', 'Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `numero_tarjeta` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `super_usuario` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `fecha_nacimiento`, `correo`, `contrasena`, `numero_tarjeta`, `direccion`, `super_usuario`) VALUES
(1, '173572', '2001-06-04', '173572@upslp.edu.mx', '173572', '1234567890123456', 'Universidad Politécnica de San Luis Potosí', 1),
(3, 'franciscodios', '2001-06-04', 'francgutierrezlopez@gmail.com', '12345', '1111111111111111', 'uni anahuac', 1),
(5, 'franciscootrousuario', '2001-06-04', 'francogl@gmail.com', '12345', '2222222222222222', 'uni anahuac facultad ingenieria 2', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `carrito_FK_1` (`id_producto`),
  ADD KEY `carrito_FK` (`id_usuario`);

--
-- Indices de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `historial_compras_FK_1` (`id_producto`),
  ADD KEY `historial_compras_FK` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_FK_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `historial_compras_FK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_compras_FK_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
