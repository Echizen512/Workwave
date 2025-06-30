-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2025 a las 03:31:22
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
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rol_usuario` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `tabla`, `operacion`, `id_registro`, `usuario_id`, `rol_usuario`, `fecha`, `descripcion`) VALUES
(1, 'Freelancers', 'UPDATE', 1, 1, 'freelancer', '2024-09-17 01:44:35', 'Se actualizó el freelancer: Gojo Satoru'),
(2, 'interesados_proyecto', 'INSERT', 2, 4, 'empresas', '2024-09-17 10:50:49', 'Se insertó un interesado: Prueba'),
(3, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2024-09-22 17:44:06', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(4, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2024-09-22 17:44:13', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(5, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 17:44:20', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(6, 'interesados_proyecto', 'INSERT', 3, 1, 'freelancers', '2024-09-22 18:51:22', 'Se insertó un interesado: Satoru Gojo'),
(7, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 18:57:50', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(8, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:05:40', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(9, 'interesados_proyecto', 'INSERT', 4, 1, 'freelancers', '2024-09-22 19:15:12', 'Se insertó un interesado: Satoru Gojo'),
(10, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:15:40', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(11, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:32:42', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(12, 'interesados_proyecto', 'INSERT', 5, 1, 'freelancers', '2024-09-22 19:33:18', 'Se insertó un interesado: Satoru Gojo'),
(13, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:33:53', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(14, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:48:37', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(15, 'Proyectos', 'INSERT', 17, 0, 'empresas', '2024-09-22 19:56:15', 'Se insertó un proyecto: Prueba'),
(16, 'Proyectos', 'INSERT', 18, 0, 'empresas', '2024-09-22 19:58:19', 'Se insertó un proyecto: Prueba'),
(17, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-09-22 19:59:48', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(18, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-10-26 21:34:59', 'Se actualizó la empresa: Suguru Geto'),
(19, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-10-26 21:38:26', 'Se actualizó la empresa: Suguru Geto'),
(20, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-10-26 21:42:29', 'Se actualizó la empresa: Suguru Geto'),
(21, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-10-26 21:49:10', 'Se actualizó la empresa: Suguru Geto'),
(22, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-10-26 21:53:30', 'Se actualizó la empresa: Suguru Geto'),
(23, 'interesados_proyecto', 'INSERT', 6, 1, 'freelancers', '2024-10-27 01:10:32', 'Se insertó un interesado: Satoru Gojo'),
(24, 'Freelancers', 'UPDATE', 1, 1, 'freelancer', '2024-10-27 01:23:15', 'Se actualizó el freelancer: Satoru Gojo'),
(25, 'Freelancers', 'UPDATE', 1, 1, 'freelancer', '2024-10-27 01:25:35', 'Se actualizó el freelancer: Satoru Gojo'),
(26, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2024-11-13 01:30:01', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(27, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2024-11-14 12:42:11', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(28, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2024-11-14 12:42:32', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(29, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-14 12:50:45', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(30, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2024-11-14 12:50:46', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(31, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:02:22', 'Se actualizó la empresa: Suguru Geto'),
(32, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:03:21', 'Se actualizó la empresa: Suguru Geto'),
(33, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:03:34', 'Se actualizó la empresa: Suguru Geto'),
(34, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:04:00', 'Se actualizó la empresa: Suguru Geto'),
(35, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:04:15', 'Se actualizó la empresa: Suguru Geto'),
(36, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:33:57', 'Se actualizó la empresa: Suguru Geto'),
(37, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:34:05', 'Se actualizó la empresa: 2222'),
(38, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:34:54', 'Se actualizó la empresa: Suguru Geto'),
(39, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:37:10', 'Se actualizó la empresa: Suguru Geto'),
(40, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:37:57', 'Se actualizó la empresa: Suguru Geto'),
(41, 'Proyectos', 'INSERT', 19, 0, 'empresas', '2024-11-14 19:41:18', 'Se insertó un proyecto: aasda'),
(42, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-14 19:53:44', 'Se actualizó la empresa: Suguru Geto'),
(43, 'interesados_proyecto', 'INSERT', 7, 4, 'empresas', '2024-11-14 20:02:09', 'Se insertó un interesado: Satoru Gojo'),
(44, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:42:34', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(45, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:42:54', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(46, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:43:04', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(47, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:44:08', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(48, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:45:50', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(49, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:46:10', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(50, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:52:14', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(51, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2024-11-15 13:52:21', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(52, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2024-11-15 13:52:28', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(53, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-24 13:42:24', 'Se actualizó la empresa: Suguru Geto'),
(54, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-24 14:11:41', 'Se actualizó la empresa: Suguru Geto'),
(55, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-24 14:12:17', 'Se actualizó la empresa: Suguru Geto'),
(56, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-24 14:19:51', 'Se actualizó la empresa: Suguru Geto'),
(57, 'Proyectos', 'INSERT', 20, 0, 'empresas', '2024-11-24 14:57:34', 'Se insertó un proyecto: Prueba'),
(58, 'Proyectos', 'INSERT', 21, 0, 'empresas', '2024-11-24 15:20:32', 'Se insertó un proyecto: Prueba'),
(59, 'Proyectos', 'INSERT', 22, 0, 'empresas', '2024-11-24 15:21:01', 'Se insertó un proyecto: Pruebaaa'),
(60, 'Proyectos', 'INSERT', 23, 0, 'empresas', '2024-11-24 15:21:34', 'Se insertó un proyecto: Pruebaaa'),
(61, 'Proyectos', 'INSERT', 24, 0, 'empresas', '2024-11-24 15:21:57', 'Se insertó un proyecto: Pruebasss'),
(62, 'Proyectos', 'INSERT', 25, 0, 'empresas', '2024-11-24 15:22:22', 'Se insertó un proyecto: Pruebasssss'),
(63, 'Proyectos', 'INSERT', 26, 0, 'empresas', '2024-11-24 15:29:10', 'Se insertó un proyecto: Pruebasssssss'),
(64, 'Proyectos', 'INSERT', 27, 0, 'empresas', '2024-11-24 15:29:36', 'Se insertó un proyecto: Pruebaqwqwq'),
(65, 'Proyectos', 'INSERT', 28, 0, 'empresas', '2024-11-24 15:34:27', 'Se insertó un proyecto: sdadas'),
(66, 'Proyectos', 'INSERT', 29, 0, 'empresas', '2024-11-24 15:35:01', 'Se insertó un proyecto: Pruebasadas'),
(67, 'Empresas', 'UPDATE', 4, 4, 'empresa', '2024-11-24 15:42:08', 'Se actualizó la empresa: Suguru Geto'),
(68, 'Proyectos', 'INSERT', 30, 0, 'empresas', '2024-11-24 16:23:34', 'Se insertó un proyecto: Prueba'),
(69, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-01-08 20:58:09', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(70, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-01-08 20:58:10', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(71, 'Proyectos', 'INSERT', 31, 0, 'empresas', '2025-01-08 21:32:04', 'Se insertó un proyecto: Prueba'),
(72, 'interesados_proyecto', 'INSERT', 8, 4, '0', '2025-01-09 20:20:19', 'Se insertó un interesado: Suguru Geto'),
(73, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-01-11 21:11:26', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(74, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-01-13 03:39:05', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(75, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2025-01-13 03:39:37', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(76, 'Proyectos', 'UPDATE', 8, 0, 'empresas', '2025-01-13 03:40:18', 'Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F'),
(77, 'Proyectos', 'UPDATE', 31, 0, 'empresas', '2025-01-13 03:42:01', 'Se actualizó el proyecto: Prueba'),
(78, 'Proyectos', 'UPDATE', 31, 0, 'empresas', '2025-01-13 03:46:07', 'Se actualizó el proyecto: Creación de una dApp'),
(79, 'Proyectos', 'UPDATE', 31, 0, 'empresas', '2025-01-13 03:47:10', 'Se actualizó el proyecto: Creación de una dApp'),
(80, 'interesados_proyecto', 'INSERT', 9, 1, '0', '2025-01-13 03:59:40', 'Se insertó un interesado: Satoru Gojo'),
(81, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-03-09 20:00:50', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(82, 'Proyectos', 'UPDATE', 2, 0, 'empresas', '2025-03-09 20:06:15', 'Se actualizó el proyecto: Rediseño de Página Webs'),
(83, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2025-03-09 22:05:07', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(84, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2025-03-10 00:38:02', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(85, 'Proyectos', 'UPDATE', 7, 0, 'freelancers', '2025-03-10 00:38:39', 'Se actualizó el proyecto: Creación de Contenido para Blog'),
(86, 'Empresas', 'INSERT', 10, 10, 'empresa', '2025-03-16 14:17:29', 'Se insertó una empresa: Prueba'),
(87, 'interesados_proyecto', 'INSERT', 10, 1, '0', '2025-03-30 01:21:53', 'Se insertó un interesado: Satoru Gojo'),
(88, 'interesados_proyecto', 'INSERT', 11, 1, '0', '2025-03-30 01:26:09', 'Se insertó un interesado: Satoru Gojo'),
(89, 'interesados_proyecto', 'INSERT', 12, 1, '0', '2025-03-30 01:27:38', 'Se insertó un interesado: Satoru Gojo'),
(90, 'interesados_proyecto', 'INSERT', 13, 1, '0', '2025-03-30 01:29:48', 'Se insertó un interesado: Satoru Gojo'),
(91, 'interesados_proyecto', 'INSERT', 14, 1, '0', '2025-03-30 02:05:15', 'Se insertó un interesado: Satoru Gojo'),
(92, 'interesados_proyecto', 'INSERT', 15, 1, '0', '2025-03-30 02:07:07', 'Se insertó un interesado: Satoru Gojo'),
(93, 'interesados_proyecto', 'INSERT', 16, 1, '0', '2025-03-30 02:10:08', 'Se insertó un interesado: Satoru Gojo'),
(94, 'interesados_proyecto', 'INSERT', 17, 1, '0', '2025-03-30 02:14:55', 'Se insertó un interesado: Satoru Gojo'),
(95, 'interesados_proyecto', 'INSERT', 18, 1, '0', '2025-03-30 02:17:07', 'Se insertó un interesado: Satoru Gojo'),
(96, 'interesados_proyecto', 'INSERT', 19, 1, '0', '2025-03-30 02:17:32', 'Se insertó un interesado: Satoru Gojo'),
(97, 'interesados_proyecto', 'INSERT', 20, 1, '0', '2025-03-30 02:25:06', 'Se insertó un interesado: Satoru Gojo'),
(98, 'interesados_proyecto', 'INSERT', 21, 1, '0', '2025-03-30 02:48:40', 'Se insertó un interesado: Satoru Gojo'),
(99, 'interesados_proyecto', 'INSERT', 22, 1, '0', '2025-03-30 02:56:47', 'Se insertó un interesado: Satoru Gojo'),
(100, 'interesados_proyecto', 'INSERT', 23, 1, '0', '2025-03-30 03:01:11', 'Se insertó un interesado: Satoru Gojo'),
(101, 'interesados_proyecto', 'INSERT', 24, 1, '0', '2025-03-30 03:27:23', 'Se insertó un interesado: Satoru Gojo'),
(102, 'interesados_proyecto', 'INSERT', 25, 1, '0', '2025-03-30 03:30:28', 'Se insertó un interesado: Satoru Gojo'),
(103, 'interesados_proyecto', 'INSERT', 26, 1, 'freelancers', '2025-03-30 03:31:42', 'Se insertó un interesado: Satoru Gojo'),
(104, 'interesados_proyecto', 'INSERT', 27, 1, 'freelancers', '2025-03-30 03:32:29', 'Se insertó un interesado: Satoru Gojo'),
(105, 'freelancers', 'LOGIN', 1, 1, 'freelancers', '2025-06-22 23:43:02', 'Inicio de sesión exitoso desde tabla freelancers'),
(106, 'freelancers', 'LOGIN', 1, 1, 'freelancers', '2025-06-22 23:47:39', 'Inicio de sesión exitoso desde tabla freelancers'),
(107, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-22 23:48:53', 'Inicio de sesión exitoso desde tabla empresas'),
(108, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-22 23:49:29', 'Inicio de sesión exitoso desde tabla empresas'),
(109, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-22 23:51:00', 'Inicio de sesión exitoso desde tabla empresas'),
(110, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-22 23:56:49', 'Inicio de sesión exitoso desde tabla empresas'),
(111, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-22 23:57:35', 'Inicio de sesión exitoso desde tabla empresas'),
(112, 'freelancers', 'LOGIN', 1, 1, 'freelancers', '2025-06-23 00:42:10', 'Inicio de sesión exitoso desde tabla freelancers'),
(113, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-30 01:16:26', 'Inicio de sesión exitoso desde tabla empresas'),
(114, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-30 01:17:30', 'Inicio de sesión exitoso desde tabla empresas'),
(115, 'freelancers', 'LOGIN', 1, 1, 'freelancers', '2025-06-30 01:26:43', 'Inicio de sesión exitoso desde tabla freelancers'),
(116, 'empresas', 'LOGIN', 4, 4, 'empresas', '2025-06-30 01:29:44', 'Inicio de sesión exitoso desde tabla empresas');

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
(1, 'Programación', 'Informática', 1),
(2, 'Aplicaciones Web', 'Aplicaciones Web', 1),
(3, 'Desarrollo de Juegos', 'Desarrollo de Juegos', 1),
(4, 'Desarrollo de APIs', 'Desarrollo de APIs', 1),
(5, 'Integración de Sistemas', 'Integración de Sistemas', 1),
(6, 'Diseño de UX/UI', 'Diseño de UX/UI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_valoraciones`
--

CREATE TABLE `comentarios_valoraciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario_usuario_id` int(11) NOT NULL,
  `comentario_usuario_role` varchar(50) NOT NULL,
  `comentario` text NOT NULL,
  `valoracion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios_valoraciones`
--

INSERT INTO `comentarios_valoraciones` (`id`, `usuario_id`, `comentario_usuario_id`, `comentario_usuario_role`, `comentario`, `valoracion`, `fecha`) VALUES
(1, 4, 1, 'freelancers', 'Prueba', 2, '2024-11-13 02:10:06'),
(2, 1, 4, 'empresas', 'Bueno', 5, '2024-11-14 20:07:20');

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
  `image_url` varchar(255) DEFAULT NULL,
  `doc_rif` varchar(255) DEFAULT NULL,
  `portafolio` varchar(255) DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratistas`
--

INSERT INTO `contratistas` (`id`, `nombre`, `email`, `telefono`, `direccion`, `descripcion_necesidades`, `contrasena`, `Estado`, `image_url`, `doc_rif`, `portafolio`, `membership_type`, `membership_start_date`, `membership_end_date`) VALUES
(1, 'Toji Fushiguro', 'si@gmail.com', '04121234567', 'Tokyo', '', '$2y$10$0FvtGGZICzbCmrP8LOqu6eMuhTlDDFBi8KgH/lvEHNuSzDJQH/0MS', 1, 'https://wallpapers.com/images/hd/toji-fushiguro-1920-x-1075-wallpaper-wsutogtc14vfrme8.jpg', '', '', '', '0000-00-00', '0000-00-00'),
(2, 'Prueba', 'jmrm19721@gmail.com', '04243363970', 'El Bosque', 'Sí', '$2y$10$aH3Ll2BnBsINkwZfLGQfNeal0FGMnFxz.kuWENmWsJVjx4.QFy7/m', 1, '', '', '', '', '0000-00-00', '0000-00-00');

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
  `image_url` varchar(255) DEFAULT NULL,
  `doc_rif` varchar(255) DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre_empresa`, `email`, `telefono`, `rif`, `direccion`, `descripcion_empresa`, `sitio_web`, `contrasena`, `Estado`, `image_url`, `doc_rif`, `membership_type`, `membership_start_date`, `membership_end_date`) VALUES
(4, 'Suguru Geto', 'gramolca@gmail.com', '04243363970', 'V-30658992', 'Tokyo', 'Agropecuaria', 'https://gramolcas.com/', '$2y$10$Bjn61VMEpe7uwd72QOYT5u5GnIxe2WK3MZVxVJC83bOkDRNHFTlXi', 1, 'https://miro.medium.com/v2/resize:fit:736/1*GHQ2nQfaZyF81STYtlmAyA.jpeg', '', 'basic', '2024-11-24', '2024-12-24'),
(8, 'no', 'no@gmail.com', '04121234567', 'V-30658992', 'Cagua', 'sos', 'https://si.com/', '$2y$10$cd1hK5MwfoAqd49.k8WlDu0cRrrI.Fx3KGBW035A7KLFzcj8PybAC', 1, '', '', '', '0000-00-00', '0000-00-00'),
(9, 'Prueba', 'jmrm19722@gmail.com', '04243363970', 'V-30091390', 'El Bosque', 'Sí', 'https://gramolca.com/', '$2y$10$ShsaIzITY0VXGdOSBBTpx.J/vL6Z73z/zgqxjaqEi5yYWY2nnWTh6', 1, '', '', '', '0000-00-00', '0000-00-00'),
(10, 'Prueba', 'miguelrg2004@hotmail.com', '04243363970', '3000284102', 'El Bosque', 'Prueba', 'https://www.google.com/?safe=active&ssui=on', '$2y$10$bwH.jjHbscvrrVB0SgQq3.KRqaZdSgYfzUIfoqGDeresmPKepWwJe', 1, '', '', '', '0000-00-00', '0000-00-00');

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
  `image_url` varchar(255) DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `freelancers`
--

INSERT INTO `freelancers` (`id`, `nombre`, `email`, `telefono`, `direccion`, `descripcion_habilidades`, `curriculum`, `portafolio`, `contrasena`, `Estado`, `image_url`, `membership_type`, `membership_start_date`, `membership_end_date`) VALUES
(1, 'Satoru Gojo', 'eloy@gmail.com', '04128849077', 'Tokyo', 'tecnico de servidores', 'C:\\xampp\\htdocs\\Anderson\\Includes/../Assets/doc/Folleto Comunitario (2)_20241021_000911_0000.pdf', 'https://www.github.com', '$2y$10$te3OwYwUbck26ME0w0lTEutTbvDFXaL95IVclL3vYxembaWLtniMK', 1, 'https://cdn.chatfai.com/public_characters/ssmHlayEkdP03mM4xKJam1kwmOe2/c43f2674-0e42-4e8b-8219-7dd53f180afathumb-1920-1332281.jpeg', 'gold', '2025-06-30', '2025-07-30'),
(18, 'yo', 'yo@gmail.com', '04128849077', 'Santa Cruz', 'si', '', 'https://www.github.com', '$2y$10$omQQ5fbNy1nsFdjiNamgfOBQOfKE92GkFwYPvQ.851FBvTb7qd6Ii', 1, '', '', '0000-00-00', '0000-00-00');

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

--
-- Volcado de datos para la tabla `interesados_proyecto`
--

INSERT INTO `interesados_proyecto` (`id`, `nombre_interesado`, `email_interesado`, `telefono_interesado`, `id_proyecto`, `nombre_proyecto`, `creador_id`, `tipo_usuario_creador`, `usuario_id`, `rol_solicitante`) VALUES
(5, 'Satoru Gojo', 'jmrm19722@gmail.com', '04243363970', 8, 'Desarrollo de Software Personalizado para Cliente F', 4, 'empresas', 1, 'freelancers'),
(6, 'Satoru Gojo', 'jmrm19722@gmail.com', '3080754', 2, 'Rediseño de Página Webs', 4, 'empresas', 1, 'freelancers'),
(7, 'Satoru Gojo', 'jmrm19722@gmail.com', '04243363970', 7, 'Creación de Contenido para Blog', 1, 'freelancers', 4, 'empresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_purchases`
--

CREATE TABLE `membership_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_type` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membership_purchases`
--

INSERT INTO `membership_purchases` (`id`, `user_id`, `membership_type`, `purchase_date`, `expiration_date`, `amount`, `payment_status`, `role`) VALUES
(1, 4, 'basic', '2025-05-24', '2025-07-24', 15.00, 'completed', 'empresas'),
(6, 1, 'gold', '2024-06-30', '2024-07-30', 50.00, 'completed', 'freelancers');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `outgoing_role` enum('contratistas','empresas','freelancers') NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `incoming_role` enum('contratistas','empresas','freelancers') NOT NULL,
  `msg` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `outgoing_msg_id`, `outgoing_role`, `incoming_msg_id`, `incoming_role`, `msg`, `timestamp`) VALUES
(1, 4, 'empresas', 1, 'freelancers', 'a', '2024-11-02 23:56:12'),
(2, 4, 'empresas', 1, 'freelancers', 'a', '2024-11-03 00:02:47'),
(3, 4, 'empresas', 1, 'freelancers', 'w', '2024-11-03 00:05:35'),
(4, 4, 'empresas', 1, 'freelancers', 's', '2024-11-03 00:12:43'),
(5, 1, 'freelancers', 1, 'freelancers', 'a', '2024-11-03 00:14:10'),
(6, 4, 'empresas', 1, 'freelancers', 'Prueba', '2024-11-03 00:24:23'),
(7, 1, 'freelancers', 1, 'freelancers', 'a', '2024-11-03 00:26:26'),
(8, 1, 'freelancers', 4, 'empresas', 's', '2024-11-03 00:47:08'),
(9, 4, 'empresas', 1, 'freelancers', 's', '2024-11-03 00:48:38'),
(10, 4, 'empresas', 1, 'freelancers', 's', '2024-11-03 00:48:38'),
(11, 4, 'empresas', 1, 'freelancers', 'a', '2024-11-03 00:48:42'),
(12, 4, 'empresas', 1, 'freelancers', 'a', '2024-11-03 00:48:42'),
(13, 4, 'empresas', 1, 'freelancers', 'w', '2024-11-03 00:51:31'),
(14, 1, 'freelancers', 4, 'empresas', 'dd', '2024-11-03 00:54:53'),
(15, 1, 'freelancers', 4, 'empresas', 'Hola', '2025-03-09 20:36:47');

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
  `intereses` text DEFAULT NULL,
  `Etiqueta` enum('Oferta','Servicio') DEFAULT NULL,
  `repositorio` varchar(255) DEFAULT NULL,
  `terminado` enum('Sí','No') DEFAULT 'No',
  `pago` enum('Pendiente','Pagado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `tipo_usuario`, `contratista_id`, `freelancer_id`, `empresa_id`, `titulo`, `descripcion`, `image_url`, `categoria_id`, `precio`, `estado`, `fecha_inicio`, `fecha_fin`, `fecha_registro`, `intereses`, `Etiqueta`, `repositorio`, `terminado`, `pago`) VALUES
(2, 'empresas', 0, 0, 4, 'Rediseño de Página Webs', 'Rediseño completo de una página web para una empresa de moda.', 'https://pixelemos.com/wp-content/uploads/2017/06/como-crear-un-sitio-web.jpg', 1, 1500.00, 1, '2025-01-13', '2025-02-05', '2024-08-28 13:07:06', 'Diseño web, UX/UI, Desarrollo frontend', 'Oferta', 'https://github.com/', 'Sí', 'Pagado'),
(7, 'freelancers', 0, 1, 0, 'Creación de Contenido para Blog', 'Creación de artículos y contenido de alta calidad para el blog E, con enfoque en SEO y estrategias de contenido.', 'https://i0.wp.com/res.cloudinary.com/djdesignerlab/image/upload/v1602264211/wp-uploads/SEO-Strategies-min_pn3uwz.jpg?w=1080&ssl=1', 1, 750.00, 1, '2025-01-13', '2025-02-20', '2024-08-28 13:56:21', 'Redacción de contenido, Estrategias de SEO', 'Oferta', '', 'Sí', 'Pagado'),
(8, 'empresas', 0, 0, 4, 'Desarrollo de Software Personalizado para Cliente F', 'Desarrollo de un software personalizado para la empresa cliente F, incluyendo análisis, diseño y programación.', 'https://softwarewebsas.com/public/images/blog/dev.webp', 1, 3500.00, 1, '2025-01-13', '2025-03-15', '2024-08-28 13:57:03', 'Desarrollo de software, Personalización', 'Servicio', 'https://github.com', 'Sí', 'Pendiente'),
(31, 'empresas', 0, 0, 4, 'Creación de una dApp', 'Crear una dApp con Scaffold-ETH-2 para la administración de una DAO.', 'https://miro.medium.com/v2/resize:fit:400/0*RnvmtiFbfDWsZu6N.jpg', 1, 12.00, 1, '2025-01-08', '2025-01-09', '2025-01-08 21:32:04', 'Una dApp que asigne tareas a los contribuyentes de la DAO y que obtengan recompensas al cobrarlas. ', 'Oferta', '', 'No', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `completado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `proyecto_id`, `descripcion`, `fecha_registro`, `completado`) VALUES
(1, 31, 'Crear la Interfaz Gráfica', '2025-01-08 17:32:04', 0),
(2, 31, 'Crear el Smart Contract', '2025-01-08 17:32:04', 0),
(3, 2, 'Estilizar con CSS', '2025-01-11 17:07:19', 1),
(4, 2, 'Crear animaciones con JS', '2025-01-12 23:43:29', 1),
(5, 7, 'Crear Artículo de: Ciencias Naturales', '2025-01-12 23:44:49', 0),
(6, 7, 'Crear Artíuclo de: Matemáticas', '2025-01-12 23:44:49', 0),
(7, 8, 'Diseñar Interfaz Gráfica', '2025-01-12 23:45:27', 0),
(8, 8, 'Programar funcionalidad en PHP', '2025-01-12 23:45:27', 0),
(9, 32, 'as', '2025-06-29 21:18:27', 0),
(10, 32, 'as', '2025-06-29 21:18:27', 0),
(11, 33, 'as', '2025-06-29 21:18:47', 0),
(12, 33, 'qw', '2025-06-29 21:18:47', 0),
(13, 34, 'as', '2025-06-29 21:18:59', 0),
(14, 34, 'qw', '2025-06-29 21:18:59', 0),
(15, 35, 'as', '2025-06-29 21:21:10', 0),
(16, 35, 'qw', '2025-06-29 21:21:10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_aceptados`
--

CREATE TABLE `usuarios_aceptados` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `nombre_interesado` varchar(255) NOT NULL,
  `email_interesado` varchar(255) NOT NULL,
  `telefono_interesado` varchar(50) DEFAULT NULL,
  `rol_solicitante` varchar(50) NOT NULL,
  `fecha_aceptacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_aceptados`
--

INSERT INTO `usuarios_aceptados` (`id`, `proyecto_id`, `nombre_interesado`, `email_interesado`, `telefono_interesado`, `rol_solicitante`, `fecha_aceptacion`, `usuario_id`) VALUES
(3, 8, 'Satoru Gojo', 'jmrm19722@gmail.com', '04243363970', 'freelancers', '2024-09-22 19:59:48', 1),
(4, 2, 'Satoru Gojo', 'jmrm19722@gmail.com', '3080754', 'freelancers', '2024-11-14 12:42:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_paypal`
--

CREATE TABLE `usuarios_paypal` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `rol` enum('contratistas','freelancers','empresas') NOT NULL,
  `cuenta_paypal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_paypal`
--

INSERT INTO `usuarios_paypal` (`id`, `usuario_id`, `rol`, `cuenta_paypal`) VALUES
(1, 1, 'freelancers', 'sb-q7bm833432292@business.example.com'),
(2, 4, 'empresas', 'sb-xzgfq33436270@personal.example.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios_valoraciones`
--
ALTER TABLE `comentarios_valoraciones`
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
-- Indices de la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_aceptados`
--
ALTER TABLE `usuarios_aceptados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyecto_id` (`proyecto_id`);

--
-- Indices de la tabla `usuarios_paypal`
--
ALTER TABLE `usuarios_paypal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios_valoraciones`
--
ALTER TABLE `comentarios_valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contratistas`
--
ALTER TABLE `contratistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `interesados_proyecto`
--
ALTER TABLE `interesados_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios_aceptados`
--
ALTER TABLE `usuarios_aceptados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_paypal`
--
ALTER TABLE `usuarios_paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

--
-- Filtros para la tabla `usuarios_aceptados`
--
ALTER TABLE `usuarios_aceptados`
  ADD CONSTRAINT `usuarios_aceptados_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
