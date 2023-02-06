-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2023 a las 23:19:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `etiquetas_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `imagen_descripcion` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productos_id`, `usuarios_fk`, `productos_estados_fk`, `titulo`, `precio`, `imagen`, `imagen_descripcion`, `audio`, `video`, `texto`) VALUES
(1, 3, 2, 'Abejas', 1500, 'abejas.jpg', 'Lisa y las abejas', 'lisa_abejas.mp3', 'embed/wVqRjxSuUXI', 'Estampado de la escena de lisa con las abejas y la goma de mascar. Calidad viscosa. El calce es suelto, con ruedo asimétrico. Está confeccionada en algodón. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(2, 3, 2, 'El resplandor', 1600, 'aun-hay-mas.jpg', 'El resplandor', 'aun_hay_mas.mp3', 'embed/gDeW9vxmzDA', 'Remera básica en color blanco. Estampado de la escena del resplandor,  El calce es suelto, con ruedo asimétrico. Está confeccionada en viscosa y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(3, 3, 2, 'El coco', 1450, 'coco.jpg', 'El coco está en la casa', 'el_coco.mp3', 'embed/-u62ttx-AJ4', 'Estampado de la escena del coco, calidad algodón y lycra. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(4, 3, 2, 'Cumbancha', 1500, 'cumbancha.jpg', 'Suba a la cumbancha', 'la_cumbancha.mp3', 'embed/1uN21mjo0IA', 'Estampado de la escena de la cumbancha, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. De las más elegidas. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(5, 3, 2, 'Francia', 1400, 'eleagncia.jpg', 'Que elegancia la de francia', 'que_elegancia.mp3', 'embed/QiK273PjpV8', 'Remera blanca y también disponible en color hueso. Estampado de la escena de homero en el casino, calidad algodón y lycra. El calce es suelto, con ruedo asimétrico. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(6, 3, 2, 'Nave espacial', 1680, 'espacio.jpg', 'Homero en el espacio', 'nave_espacial.mp3', 'embed/p9VcwN5hsno', 'Remera blanca con estampado de la escena de homero en el espacio. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(7, 3, 2, 'El heredero', 1800, 'joroba.jpg', 'Bart el heredero con joroba', 'joroba.mp3', 'embed/p6CDTqvQFRE', 'Remera blanca con estampado de la escena de bart único heredero de burns, calidad algodón y lycra. Disponible en color blanco y negro. El calce es suelto, con ruedo asimétrico. Calidad super suave y cómoda. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(8, 3, 2, 'Un loquito', 1380, 'loquito.jpg', 'Mira bart, esto es un loquito', 'loquito.mp3', 'embed/gF2ACavWTAI', 'Remera básica en color blanco. Estampado de la escena del capiítulo del lider,  El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(9, 3, 2, 'Maquina invisible', 1540, 'maquina.jpg', 'Maquina de escribir invisible', 'maquina_invisible.mp3', 'embed/DiwON2lHR3c', 'Estampado de la escena de la cumbancha, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Está confeccionada con la mejor calidad del mercado. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(10, 3, 2, 'Matrimonio', 1710, 'matrimonio.jpg', 'El matrimonio es igual a una naranja', 'matrimonio_naranja.mp3', 'embed/SMQXM98QneE', 'Estampado de la escena del matrimonio, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Está confeccionada con la mejor calidad del mercado. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(11, 3, 2, 'El padrino', 1670, 'padrino.jpg', 'Homero es el padrino', 'homero_padrino.mp3', 'embed/rSvr4akywTQ', 'Estampado de la escena de homero siendo el padrino, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Super cómoda y canchera. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(12, 3, 2, 'Burns radiactivo', 1384, 'paz.jpg', 'Les traigo paz', 'les_traigo_paz.mp3', 'embed/JAR1Reihlew', 'Estampado de la escena del señor Burns radioactivo, calidad algodón y lycra o en 100% lycra. Disponible en color blanco únicamente. El calce es suelto, con ruedo asimétrico. Las costuras son espectaculares. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(13, 3, 2, 'Stacy', 1625, 'stacy.jpg', 'Soy solo una chica', 'stacy.mp3', 'embed/iHLQiq-XeUQ', 'Remera básica en color blanco. Estampado de la escena de Stacy malibu,  El calce es suelto, con ruedo asimétrico. Está confeccionada en visco y lycra. Tiene escote redondo y mangas cortas.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(14, 3, 2, 'Peces del infierno', 1890, 'tanque.jpg', 'Los peces del infierno', 'waterloo_abba.mp3', 'embed/sKO1RUb0Zqs', 'Remera básica en color blanco. Estampado de la escena del señor Burns en el tanque,  El calce es suelto, con ruedo asimétrico. Está confeccionada en viscosa y lycra. Tiene escote redondo y mangas cortas Si estas al limite del talle, te recomendamos ir por el talle siguiente! Este top al tener pecho alto ajusta más.<br> Chequeá la tabla de medidas (para conecer las medidas de la prenda) y la tabla de talles (para tener de referencia a la hora de elegir tu remera)!'),
(33, 2, 1, 'Etiqueta probandosadfsf', 34, 'logo.png', '', '', '', 'probando'),
(34, 2, 1, 'Probando etiqueta', 124, NULL, '', '', '', 'Probando etiqeutas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_estados`
--

CREATE TABLE `productos_estados` (
  `productos_estados_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos_estados`
--

INSERT INTO `productos_estados` (`productos_estados_id`, `nombre`) VALUES
(1, 'Draft'),
(2, 'Publicada'),
(3, 'Deshabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_categorias`
--

CREATE TABLE `productos_has_categorias` (
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `categorias_fk` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_etiquetas`
--

CREATE TABLE `productos_has_etiquetas` (
  `productos_fk` int(10) UNSIGNED NOT NULL,
  `etiquetas_fk` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(33, 1),
(33, 3),
(33, 4),
(34, 2),
(34, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_passwords`
--

CREATE TABLE `recuperar_passwords` (
  `usuarios_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `recuperar_passwords`
--

INSERT INTO `recuperar_passwords` (`usuarios_id`, `token`, `expiracion`) VALUES
(2, '9cb2d38203c80d7dcf7e41d4cd308c51ce32a61ed6e078b52f37ba3142f993cc', '2022-07-28 01:58:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `roles_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `roles_fk`, `email`, `password`, `nombre`, `apellido`) VALUES
(2, 2, 'viviana@gmail.com', '$2y$10$7aFp85Ww5uITunSWonCR1.eC7LXfV0yApuEm7KvHsf1fmEXQ8B8aO', 'Viviana', 'Krivokapic'),
(3, 1, 'micaela.guggiari@davinci.edu.ar', '$2y$10$lVy6CJtx2smQDqvoHBINZ.PB7S47C6wkKGk7qKl4Ifdc9nfa6A6FO', 'Mica', 'Guggiari'),
(4, 2, 'flor.marbian@davinci.edu.ar', '$2y$10$ker0RZT0QBmqSGNBRLTAy.4x8B0JMhHaZJkiRMBRdtr8ETOKQ5jZm', 'Florencia', 'Marbián');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categorias_id`),
  ADD UNIQUE KEY `categorias_id_UNIQUE` (`categorias_id`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `etiquetas_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `productos_estados`
--
ALTER TABLE `productos_estados`
  MODIFY `productos_estados_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

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
