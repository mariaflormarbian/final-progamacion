-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2023 a las 00:48:16
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_guggiari_marbian`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agregar_producto`
--

CREATE TABLE `agregar_producto` (
  `agregar_producto_id` int(10) UNSIGNED NOT NULL,
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(60) DEFAULT NULL,
  `cantidad` tinyint(4) DEFAULT NULL,
  `subtotal` decimal(6,2) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `carrito_id` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`carrito_id`, `usuarios_fk`) VALUES
(3, 3),
(25, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `total` decimal(6,2) DEFAULT NULL,
  `productos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`compra_id`, `carrito_fk`, `usuarios_fk`, `fecha`, `cantidad`, `total`, `productos`) VALUES
(12, 3, 3, '2023-07-04 01:39:38', 1, '1500.00', '1x Abejas'),
(13, 3, 3, '2023-07-04 18:50:50', 2, '9000.00', '2x Abejas'),
(17, 3, 3, '2023-07-05 01:57:52', 2, '3200.00', '2x El resplandor'),
(18, 25, 25, '2023-08-03 00:23:21', 1, '1400.00', '1x Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `etiquetas_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`etiquetas_id`, `nombre`) VALUES
(1, 'Homero'),
(2, 'Lisa'),
(3, 'Bart'),
(4, 'Marge'),
(5, 'Burns'),
(6, 'Gorgori');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productos_id` int(10) UNSIGNED NOT NULL,
  `usuarios_fk` int(10) UNSIGNED NOT NULL,
  `productos_estados_fk` tinyint(3) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_descripcion` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `texto` text NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productos_id`, `usuarios_fk`, `productos_estados_fk`, `titulo`, `precio`, `imagen`, `imagen_descripcion`, `audio`, `video`, `texto`, `stock`) VALUES
(1, 3, 2, 'Abejas', 1500, 'abejas.jpg', 'Lisa y las abejas', 'lisa_abejas.mp3', 'wVqRjxSuUXI', 'Estampado de la escena de lisa con las abejas y la goma de mascar. Calidad viscosa. El calce es suelto, con ruedo asimétrico. Está confeccionada en algodón. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 2),
(2, 3, 2, 'El resplandor', 1600, 'aun-hay-mas.jpg', 'El resplandor', 'aun_hay_mas.mp3', 'gDeW9vxmzDA', 'Remera básica en color blanco. Estampado de la escena del resplandor,  El calce es suelto, con ruedo asimétrico. Está confeccionada en viscosa y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 4),
(3, 3, 2, 'El coco', 1450, 'coco.jpg', 'El coco está en la casa', 'el_coco.mp3', 'nZPN6o4GSoY', 'Estampado de la escena del coco, calidad algodón y lycra. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 1),
(4, 3, 2, 'Cumbancha', 1500, 'cumbancha.jpg', 'Suba a la cumbancha', 'la_cumbancha.mp3', 'ELRTmo1Bg18', 'Estampado de la escena de la cumbancha, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. De las más elegidas. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 6),
(5, 3, 2, 'Francia', 1400, 'eleagncia.jpg', 'Que elegancia la de francia', 'que_elegancia.mp3', 'hJGs4FNXBMA', 'Remera blanca y también disponible en color hueso. Estampado de la escena de homero en el casino, calidad algodón y lycra. El calce es suelto, con ruedo asimétrico. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 8),
(6, 3, 2, 'Nave espacial', 1680, 'espacio.jpg', 'Homero en el espacio', 'nave_espacial.mp3', 'p9VcwN5hsno', 'Remera blanca con estampado de la escena de homero en el espacio. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 2),
(7, 3, 2, 'El heredero', 1800, 'joroba.jpg', 'Bart el heredero con joroba', 'joroba.mp3', 'Hzc40JegDS8', 'Remera blanca con estampado de la escena de bart único heredero de burns, calidad algodón y lycra. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Calidad super suave y cómoda. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 5),
(8, 3, 2, 'Un loquito', 1380, 'loquito.jpg', 'Mira bart, esto es un loquito', 'loquito.mp3', 'gF2ACavWTAI', 'Remera básica en color blanco. Estampado de la escena del capiítulo del lider,  El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 6),
(9, 3, 2, 'Maquina invisible', 1540, 'maquina.jpg', 'Maquina de escribir invisible', 'maquina_invisible.mp3', 'DiwON2lHR3c', 'Estampado de la escena de la cumbancha, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Está confeccionada con la mejor calidad del mercado. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 2),
(10, 3, 2, 'Matrimonio', 1710, 'matrimonio.jpg', 'El matrimonio es igual a una naranja', 'matrimonio_naranja.mp3', 'SMQXM98QneE', 'Estampado de la escena del matrimonio, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Está confeccionada con la mejor calidad del mercado. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 3),
(11, 3, 2, 'El padrino', 1670, 'padrino.jpg', 'Homero es el padrino', 'homero_padrino.mp3', 'rSvr4akywTQ', 'Estampado de la escena de homero siendo el padrino, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Super cómoda y canchera. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 1),
(12, 3, 2, 'Burns radiactivo', 1384, 'paz.jpg', 'Les traigo paz', 'les_traigo_paz.mp3', 'JyaElUp4Bro', 'Estampado de la escena del señor Burns radioactivo, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Las costuras son espectaculares. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 8),
(13, 3, 2, 'Stacy', 1625, 'stacy.jpg', 'Soy solo una chica', 'stacy.mp3', 'pjnHGcAvf7A', 'Remera básica en color blanco. Estampado de la escena de Stacy malibu,  El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 2),
(14, 3, 2, 'Peces del infierno', 1890, 'tanque.jpg', 'Los peces del infierno', 'waterloo_abba.mp3', 'sKO1RUb0Zqs', 'Remera básica en color blanco. Estampado de la escena del señor Burns en el tanque,  El calce es suelto, con ruedo asimétrico. Está confeccionada en viscosa y lycra. Tiene escote redondo y mangas cortas Si estas al limite del talle, te recomendamos ir por el talle siguiente! Este top al tener pecho alto ajusta más.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!', 3),
(48, 3, 1, 'Imagen por defecto', 100, 'abejas.jpg', 'asfd', '20230703045903_el_coco.mp3', '', 'assfasdfasfdsafasdf', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_estados`
--

CREATE TABLE `productos_estados` (
  `productos_estados_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_estados`
--

INSERT INTO `productos_estados` (`productos_estados_id`, `nombre`) VALUES
(1, 'Borrador'),
(2, 'Publicada'),
(3, 'Deshabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_categorias`
--

CREATE TABLE `productos_has_categorias` (
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `categorias_fk` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_etiquetas`
--

CREATE TABLE `productos_has_etiquetas` (
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `etiquetas_fk` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_has_etiquetas`
--

INSERT INTO `productos_has_etiquetas` (`productos_fk`, `etiquetas_fk`) VALUES
(1, 2),
(2, 1),
(3, 1),
(3, 3),
(4, 5),
(5, 1),
(6, 1),
(7, 3),
(7, 5),
(8, 1),
(8, 3),
(9, 6),
(10, 1),
(11, 1),
(12, 5),
(13, 2),
(14, 5),
(48, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_passwords`
--

CREATE TABLE `recuperar_passwords` (
  `usuarios_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `roles_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`roles_id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(10) UNSIGNED NOT NULL,
  `roles_fk` tinyint(3) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `roles_fk`, `email`, `password`, `nombre`, `apellido`) VALUES
(3, 1, 'micaela.guggiari@davinci.edu.ar', '$2y$10$lVy6CJtx2smQDqvoHBINZ.PB7S47C6wkKGk7qKl4Ifdc9nfa6A6FO', 'Mica', 'Guggiari'),
(25, 2, 'maria.marbian@davinci.edu.ar', '$2y$10$2VGL444RtBalSJ53xWtgS.8czsOSNOGwG9LahRpkMYM1fUsUHLYJ.', 'Florencia', 'Marbián');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agregar_producto`
--
ALTER TABLE `agregar_producto`
  ADD PRIMARY KEY (`agregar_producto_id`),
  ADD KEY `fk_agregar_producto_productos1_idx` (`productos_fk`),
  ADD KEY `fk_agregar_producto_carrito1_idx` (`carrito_fk`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`carrito_id`),
  ADD KEY `fk_carrito_usuarios1_idx` (`usuarios_fk`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categorias_id`),
  ADD UNIQUE KEY `categorias_id_UNIQUE` (`categorias_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`),
  ADD UNIQUE KEY `compra_id_UNIQUE` (`compra_id`),
  ADD KEY `fk_compra_carrito1_idx` (`carrito_fk`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`etiquetas_id`),
  ADD UNIQUE KEY `idetiquetas_UNIQUE` (`etiquetas_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productos_id`),
  ADD KEY `fk_productos_usuarios_idx` (`usuarios_fk`),
  ADD KEY `fk_productos_producos_estados1_idx` (`productos_estados_fk`);

--
-- Indices de la tabla `productos_estados`
--
ALTER TABLE `productos_estados`
  ADD PRIMARY KEY (`productos_estados_id`);

--
-- Indices de la tabla `productos_has_categorias`
--
ALTER TABLE `productos_has_categorias`
  ADD PRIMARY KEY (`productos_fk`,`categorias_fk`),
  ADD KEY `fk_productos_has_categorias_categorias1_idx` (`categorias_fk`),
  ADD KEY `fk_productos_has_categorias_productos1_idx` (`productos_fk`);

--
-- Indices de la tabla `productos_has_etiquetas`
--
ALTER TABLE `productos_has_etiquetas`
  ADD PRIMARY KEY (`productos_fk`,`etiquetas_fk`),
  ADD KEY `fk_productos_has_etiquetas_etiquetas1_idx` (`etiquetas_fk`),
  ADD KEY `fk_productos_has_etiquetas_productos1_idx` (`productos_fk`);

--
-- Indices de la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  ADD PRIMARY KEY (`usuarios_id`),
  ADD KEY `fk_recuperar_passwords_usuarios1_idx` (`usuarios_id`),
  ADD KEY `token_idx` (`token`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuarios_roles1_idx` (`roles_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agregar_producto`
--
ALTER TABLE `agregar_producto`
  MODIFY `agregar_producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `carrito_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `etiquetas_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `productos_estados`
--
ALTER TABLE `productos_estados`
  MODIFY `productos_estados_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agregar_producto`
--
ALTER TABLE `agregar_producto`
  ADD CONSTRAINT `fk_agregar_producto_carrito1` FOREIGN KEY (`carrito_fk`) REFERENCES `carrito` (`carrito_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agregar_producto_productos1` FOREIGN KEY (`productos_fk`) REFERENCES `productos` (`productos_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_usuarios1` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_carrito1` FOREIGN KEY (`carrito_fk`) REFERENCES `carrito` (`carrito_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_producos_estados1` FOREIGN KEY (`productos_estados_fk`) REFERENCES `productos_estados` (`productos_estados_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuarios_fk`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_has_categorias`
--
ALTER TABLE `productos_has_categorias`
  ADD CONSTRAINT `fk_productos_has_categorias_categorias1` FOREIGN KEY (`categorias_fk`) REFERENCES `categorias` (`categorias_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_categorias_productos1` FOREIGN KEY (`productos_fk`) REFERENCES `productos` (`productos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_has_etiquetas`
--
ALTER TABLE `productos_has_etiquetas`
  ADD CONSTRAINT `fk_productos_has_etiquetas_etiquetas1` FOREIGN KEY (`etiquetas_fk`) REFERENCES `etiquetas` (`etiquetas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_etiquetas_productos1` FOREIGN KEY (`productos_fk`) REFERENCES `productos` (`productos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  ADD CONSTRAINT `fk_recuperar_passwords_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_fk`) REFERENCES `roles` (`roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
