-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2024 a las 05:16:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `workwave`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`ID`, `Usuario`, `Contraseña`) VALUES
(1, 'Admin', '$2y$10$G/NZXvfperAWm3nISryM9etS4RZoP7Nn7H6rs1u0gEWq0p0GpKx9i');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Programació', 'Informática', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratistas`
--

CREATE TABLE `contratistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `descripcion_necesidades` text NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratistas`
--

INSERT INTO `contratistas` (`id`, `nombre`, `email`, `telefono`, `direccion`, `descripcion_necesidades`, `contrasena`, `Estado`, `image_url`) VALUES
(1, 'Toji Fushiguro', 'si@gmail.com', '04121234567', 'Tokyo', '', '$2y$10$0FvtGGZICzbCmrP8LOqu6eMuhTlDDFBi8KgH/lvEHNuSzDJQH/0MS', 1, 'https://wallpapers.com/images/hd/toji-fushiguro-1920-x-1075-wallpaper-wsutogtc14vfrme8.jpg'),
(2, 'Prueba', 'jmrm19721@gmail.com', '04243363970', 'El Bosque', 'Sí', '$2y$10$aH3Ll2BnBsINkwZfLGQfNeal0FGMnFxz.kuWENmWsJVjx4.QFy7/m', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `rif` text NOT NULL,
  `direccion` text NOT NULL,
  `descripcion_empresa` text NOT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre_empresa`, `email`, `telefono`, `rif`, `direccion`, `descripcion_empresa`, `sitio_web`, `contrasena`, `Estado`, `image_url`) VALUES
(4, 'Gramolca', 'gramolca@gmail.com', '041212345678', 'V-30658992', 'Cagua', 'Agropecuaria', 'https://gramolca.com/', '$2y$10$Bjn61VMEpe7uwd72QOYT5u5GnIxe2WK3MZVxVJC83bOkDRNHFTlXi', 1, NULL),
(8, 'no', 'no@gmail.com', '04121234567', 'V-30658992', 'Cagua', 'sos', 'https://si.com/', '$2y$10$cd1hK5MwfoAqd49.k8WlDu0cRrrI.Fx3KGBW035A7KLFzcj8PybAC', 1, NULL),
(9, 'Prueba', 'jmrm19722@gmail.com', '04243363970', 'V-30091390', 'El Bosque', 'Sí', 'https://gramolca.com/', '$2y$10$ShsaIzITY0VXGdOSBBTpx.J/vL6Z73z/zgqxjaqEi5yYWY2nnWTh6', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `freelancers`
--

CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `descripcion_habilidades` text NOT NULL,
  `curriculum` varchar(255) DEFAULT NULL,
  `portafolio` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `Estado` tinyint(1) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `freelancers`
--

INSERT INTO `freelancers` (`id`, `nombre`, `email`, `telefono`, `direccion`, `descripcion_habilidades`, `curriculum`, `portafolio`, `contrasena`, `Estado`, `image_url`) VALUES
(1, 'Gojo Satoru', 'eloy@gmail.com', '04128849077', 'Tokyo', 'tecnico de servidores', NULL, 'https://www.github.com', '$2y$10$te3OwYwUbck26ME0w0lTEutTbvDFXaL95IVclL3vYxembaWLtniMK', 0, 'https://i.pinimg.com/originals/e0/b8/4b/e0b84b00da854758dbb408359bbcffa3.jpg'),
(18, 'yo', 'yo@gmail.com', '04128849077', 'Santa Cruz', 'si', NULL, 'https://www.github.com', '$2y$10$omQQ5fbNy1nsFdjiNamgfOBQOfKE92GkFwYPvQ.851FBvTb7qd6Ii', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interesados_proyecto`
--

CREATE TABLE `interesados_proyecto` (
  `id` int(11) NOT NULL,
  `nombre_interesado` varchar(100) NOT NULL,
  `email_interesado` varchar(100) NOT NULL,
  `telefono_interesado` varchar(20) DEFAULT NULL,
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `creador_id` int(11) NOT NULL,
  `tipo_usuario_creador` enum('contratistas','freelancers','empresas') NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rol_solicitante` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('contratistas','freelancers','empresas') NOT NULL,
  `contratista_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `intereses` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `tipo_usuario`, `contratista_id`, `freelancer_id`, `empresa_id`, `titulo`, `descripcion`, `image_url`, `categoria_id`, `precio`, `estado`, `fecha_inicio`, `fecha_fin`, `fecha_registro`, `intereses`) VALUES
(2, 'empresas', NULL, NULL, 4, 'Rediseño de Página Webs', 'Rediseño completo de una página web para una empresa de moda.', 'https://www.webarq.com:8002/media/kcfinder/images/warna-dalam-desain-web.jpg', 1, 1500.00, 1, '2024-08-15', '2024-10-01', '2024-08-28 13:07:06', 'Diseño web, UX/UI, Desarrollo frontend'),
(7, 'freelancers', NULL, 1, NULL, 'Creación de Contenido para Blog', 'Creación de artículos y contenido de alta calidad para el blog E, con enfoque en SEO y estrategias de contenido.', 'https://i0.wp.com/res.cloudinary.com/djdesignerlab/image/upload/v1602264211/wp-uploads/SEO-Strategies-min_pn3uwz.jpg?w=1080&ssl=1', 1, 750.00, 1, '2024-08-15', '2024-10-15', '2024-08-28 13:56:21', 'Redacción de contenido, Estrategias de SEO'),
(8, 'empresas', NULL, NULL, 4, 'Desarrollo de Software Personalizado para Cliente F', 'Desarrollo de un software personalizado para la empresa cliente F, incluyendo análisis, diseño y programación.', 'https://softwarewebsas.com/public/images/blog/dev.webp', 1, 3500.00, 1, '2024-08-01', '2025-01-31', '2024-08-28 13:57:03', 'Desarrollo de software, Personalización');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratistas`
--
ALTER TABLE `contratistas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `freelancers`
--
ALTER TABLE `freelancers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `interesados_proyecto`
--
ALTER TABLE `interesados_proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`contratista_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contratistas`
--
ALTER TABLE `contratistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `interesados_proyecto`
--
ALTER TABLE `interesados_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `interesados_proyecto`
--
ALTER TABLE `interesados_proyecto`
  ADD CONSTRAINT `interesados_proyecto_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`contratista_id`) REFERENCES `contratistas` (`id`),
  ADD CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`),
  ADD CONSTRAINT `proyectos_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `proyectos_ibfk_4` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
