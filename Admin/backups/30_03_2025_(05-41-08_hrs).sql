SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS WorkWave;

USE WorkWave;

DROP TABLE IF EXISTS administradores;

CREATE TABLE `administradores` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO administradores VALUES("1","Admin","$2y$10$G/NZXvfperAWm3nISryM9etS4RZoP7Nn7H6rs1u0gEWq0p0GpKx9i");



DROP TABLE IF EXISTS auditoria;

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(50) DEFAULT NULL,
  `operacion` varchar(10) DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rol_usuario` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO auditoria VALUES("1","Freelancers","UPDATE","1","1","freelancer","2024-09-16 21:44:35","Se actualizó el freelancer: Gojo Satoru");
INSERT INTO auditoria VALUES("2","interesados_proyecto","INSERT","2","4","empresas","2024-09-17 06:50:49","Se insertó un interesado: Prueba");
INSERT INTO auditoria VALUES("3","Proyectos","UPDATE","2","","empresas","2024-09-22 13:44:06","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("4","Proyectos","UPDATE","7","","freelancers","2024-09-22 13:44:13","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("5","Proyectos","UPDATE","8","","empresas","2024-09-22 13:44:20","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("6","interesados_proyecto","INSERT","3","1","freelancers","2024-09-22 14:51:22","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("7","Proyectos","UPDATE","8","","empresas","2024-09-22 14:57:50","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("8","Proyectos","UPDATE","8","","empresas","2024-09-22 15:05:40","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("9","interesados_proyecto","INSERT","4","1","freelancers","2024-09-22 15:15:12","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("10","Proyectos","UPDATE","8","","empresas","2024-09-22 15:15:40","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("11","Proyectos","UPDATE","8","","empresas","2024-09-22 15:32:42","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("12","interesados_proyecto","INSERT","5","1","freelancers","2024-09-22 15:33:18","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("13","Proyectos","UPDATE","8","","empresas","2024-09-22 15:33:53","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("14","Proyectos","UPDATE","8","","empresas","2024-09-22 15:48:37","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("15","Proyectos","INSERT","17","","empresas","2024-09-22 15:56:15","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("16","Proyectos","INSERT","18","","empresas","2024-09-22 15:58:19","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("17","Proyectos","UPDATE","8","","empresas","2024-09-22 15:59:48","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("18","Empresas","UPDATE","4","4","empresa","2024-10-26 17:34:59","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("19","Empresas","UPDATE","4","4","empresa","2024-10-26 17:38:26","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("20","Empresas","UPDATE","4","4","empresa","2024-10-26 17:42:29","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("21","Empresas","UPDATE","4","4","empresa","2024-10-26 17:49:10","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("22","Empresas","UPDATE","4","4","empresa","2024-10-26 17:53:30","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("23","interesados_proyecto","INSERT","6","1","freelancers","2024-10-26 21:10:32","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("24","Freelancers","UPDATE","1","1","freelancer","2024-10-26 21:23:15","Se actualizó el freelancer: Satoru Gojo");
INSERT INTO auditoria VALUES("25","Freelancers","UPDATE","1","1","freelancer","2024-10-26 21:25:35","Se actualizó el freelancer: Satoru Gojo");
INSERT INTO auditoria VALUES("26","Proyectos","UPDATE","7","","freelancers","2024-11-12 21:30:01","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("27","Proyectos","UPDATE","2","","empresas","2024-11-14 08:42:11","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("28","Proyectos","UPDATE","2","","empresas","2024-11-14 08:42:32","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("29","Proyectos","UPDATE","8","","empresas","2024-11-14 08:50:45","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("30","Proyectos","UPDATE","2","","empresas","2024-11-14 08:50:46","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("31","Empresas","UPDATE","4","4","empresa","2024-11-14 15:02:22","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("32","Empresas","UPDATE","4","4","empresa","2024-11-14 15:03:21","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("33","Empresas","UPDATE","4","4","empresa","2024-11-14 15:03:34","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("34","Empresas","UPDATE","4","4","empresa","2024-11-14 15:04:00","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("35","Empresas","UPDATE","4","4","empresa","2024-11-14 15:04:15","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("36","Empresas","UPDATE","4","4","empresa","2024-11-14 15:33:57","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("37","Empresas","UPDATE","4","4","empresa","2024-11-14 15:34:05","Se actualizó la empresa: 2222");
INSERT INTO auditoria VALUES("38","Empresas","UPDATE","4","4","empresa","2024-11-14 15:34:54","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("39","Empresas","UPDATE","4","4","empresa","2024-11-14 15:37:10","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("40","Empresas","UPDATE","4","4","empresa","2024-11-14 15:37:57","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("41","Proyectos","INSERT","19","","empresas","2024-11-14 15:41:18","Se insertó un proyecto: aasda");
INSERT INTO auditoria VALUES("42","Empresas","UPDATE","4","4","empresa","2024-11-14 15:53:44","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("43","interesados_proyecto","INSERT","7","4","empresas","2024-11-14 16:02:09","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("44","Proyectos","UPDATE","8","","empresas","2024-11-15 09:42:34","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("45","Proyectos","UPDATE","8","","empresas","2024-11-15 09:42:54","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("46","Proyectos","UPDATE","8","","empresas","2024-11-15 09:43:04","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("47","Proyectos","UPDATE","8","","empresas","2024-11-15 09:44:08","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("48","Proyectos","UPDATE","8","","empresas","2024-11-15 09:45:50","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("49","Proyectos","UPDATE","8","","empresas","2024-11-15 09:46:10","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("50","Proyectos","UPDATE","8","","empresas","2024-11-15 09:52:14","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("51","Proyectos","UPDATE","8","","empresas","2024-11-15 09:52:21","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("52","Proyectos","UPDATE","2","","empresas","2024-11-15 09:52:28","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("53","Empresas","UPDATE","4","4","empresa","2024-11-24 09:42:24","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("54","Empresas","UPDATE","4","4","empresa","2024-11-24 10:11:41","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("55","Empresas","UPDATE","4","4","empresa","2024-11-24 10:12:17","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("56","Empresas","UPDATE","4","4","empresa","2024-11-24 10:19:51","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("57","Proyectos","INSERT","20","","empresas","2024-11-24 10:57:34","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("58","Proyectos","INSERT","21","","empresas","2024-11-24 11:20:32","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("59","Proyectos","INSERT","22","","empresas","2024-11-24 11:21:01","Se insertó un proyecto: Pruebaaa");
INSERT INTO auditoria VALUES("60","Proyectos","INSERT","23","","empresas","2024-11-24 11:21:34","Se insertó un proyecto: Pruebaaa");
INSERT INTO auditoria VALUES("61","Proyectos","INSERT","24","","empresas","2024-11-24 11:21:57","Se insertó un proyecto: Pruebasss");
INSERT INTO auditoria VALUES("62","Proyectos","INSERT","25","","empresas","2024-11-24 11:22:22","Se insertó un proyecto: Pruebasssss");
INSERT INTO auditoria VALUES("63","Proyectos","INSERT","26","","empresas","2024-11-24 11:29:10","Se insertó un proyecto: Pruebasssssss");
INSERT INTO auditoria VALUES("64","Proyectos","INSERT","27","","empresas","2024-11-24 11:29:36","Se insertó un proyecto: Pruebaqwqwq");
INSERT INTO auditoria VALUES("65","Proyectos","INSERT","28","","empresas","2024-11-24 11:34:27","Se insertó un proyecto: sdadas");
INSERT INTO auditoria VALUES("66","Proyectos","INSERT","29","","empresas","2024-11-24 11:35:01","Se insertó un proyecto: Pruebasadas");
INSERT INTO auditoria VALUES("67","Empresas","UPDATE","4","4","empresa","2024-11-24 11:42:08","Se actualizó la empresa: Suguru Geto");
INSERT INTO auditoria VALUES("68","Proyectos","INSERT","30","","empresas","2024-11-24 12:23:34","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("69","Proyectos","UPDATE","2","","empresas","2025-01-08 16:58:09","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("70","Proyectos","UPDATE","2","","empresas","2025-01-08 16:58:10","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("71","Proyectos","INSERT","31","","empresas","2025-01-08 17:32:04","Se insertó un proyecto: Prueba");
INSERT INTO auditoria VALUES("72","interesados_proyecto","INSERT","8","4","0","2025-01-09 16:20:19","Se insertó un interesado: Suguru Geto");
INSERT INTO auditoria VALUES("73","Proyectos","UPDATE","2","","empresas","2025-01-11 17:11:26","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("74","Proyectos","UPDATE","2","","empresas","2025-01-12 23:39:05","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("75","Proyectos","UPDATE","7","","freelancers","2025-01-12 23:39:37","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("76","Proyectos","UPDATE","8","","empresas","2025-01-12 23:40:18","Se actualizó el proyecto: Desarrollo de Software Personalizado para Cliente F");
INSERT INTO auditoria VALUES("77","Proyectos","UPDATE","31","","empresas","2025-01-12 23:42:01","Se actualizó el proyecto: Prueba");
INSERT INTO auditoria VALUES("78","Proyectos","UPDATE","31","","empresas","2025-01-12 23:46:07","Se actualizó el proyecto: Creación de una dApp");
INSERT INTO auditoria VALUES("79","Proyectos","UPDATE","31","","empresas","2025-01-12 23:47:10","Se actualizó el proyecto: Creación de una dApp");
INSERT INTO auditoria VALUES("80","interesados_proyecto","INSERT","9","1","0","2025-01-12 23:59:40","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("81","Proyectos","UPDATE","2","","empresas","2025-03-09 16:00:50","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("82","Proyectos","UPDATE","2","","empresas","2025-03-09 16:06:15","Se actualizó el proyecto: Rediseño de Página Webs");
INSERT INTO auditoria VALUES("83","Proyectos","UPDATE","7","","freelancers","2025-03-09 18:05:07","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("84","Proyectos","UPDATE","7","","freelancers","2025-03-09 20:38:02","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("85","Proyectos","UPDATE","7","","freelancers","2025-03-09 20:38:39","Se actualizó el proyecto: Creación de Contenido para Blog");
INSERT INTO auditoria VALUES("86","Empresas","INSERT","10","10","empresa","2025-03-16 10:17:29","Se insertó una empresa: Prueba");
INSERT INTO auditoria VALUES("87","interesados_proyecto","INSERT","10","1","0","2025-03-29 21:21:53","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("88","interesados_proyecto","INSERT","11","1","0","2025-03-29 21:26:09","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("89","interesados_proyecto","INSERT","12","1","0","2025-03-29 21:27:38","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("90","interesados_proyecto","INSERT","13","1","0","2025-03-29 21:29:48","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("91","interesados_proyecto","INSERT","14","1","0","2025-03-29 22:05:15","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("92","interesados_proyecto","INSERT","15","1","0","2025-03-29 22:07:07","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("93","interesados_proyecto","INSERT","16","1","0","2025-03-29 22:10:08","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("94","interesados_proyecto","INSERT","17","1","0","2025-03-29 22:14:55","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("95","interesados_proyecto","INSERT","18","1","0","2025-03-29 22:17:07","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("96","interesados_proyecto","INSERT","19","1","0","2025-03-29 22:17:32","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("97","interesados_proyecto","INSERT","20","1","0","2025-03-29 22:25:06","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("98","interesados_proyecto","INSERT","21","1","0","2025-03-29 22:48:40","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("99","interesados_proyecto","INSERT","22","1","0","2025-03-29 22:56:47","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("100","interesados_proyecto","INSERT","23","1","0","2025-03-29 23:01:11","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("101","interesados_proyecto","INSERT","24","1","0","2025-03-29 23:27:23","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("102","interesados_proyecto","INSERT","25","1","0","2025-03-29 23:30:28","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("103","interesados_proyecto","INSERT","26","1","freelancers","2025-03-29 23:31:42","Se insertó un interesado: Satoru Gojo");
INSERT INTO auditoria VALUES("104","interesados_proyecto","INSERT","27","1","freelancers","2025-03-29 23:32:29","Se insertó un interesado: Satoru Gojo");



DROP TABLE IF EXISTS categorias;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categorias VALUES("1","Programación","Informática","1");
INSERT INTO categorias VALUES("2","Aplicaciones Web","Aplicaciones Web","1");
INSERT INTO categorias VALUES("3","Desarrollo de Juegos","Desarrollo de Juegos","1");
INSERT INTO categorias VALUES("4","Desarrollo de APIs","Desarrollo de APIs","1");
INSERT INTO categorias VALUES("5","Integración de Sistemas","Integración de Sistemas","1");
INSERT INTO categorias VALUES("6","Diseño de UX/UI","Diseño de UX/UI","1");



DROP TABLE IF EXISTS comentarios_valoraciones;

CREATE TABLE `comentarios_valoraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `comentario_usuario_id` int(11) NOT NULL,
  `comentario_usuario_role` varchar(50) NOT NULL,
  `comentario` text NOT NULL,
  `valoracion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comentarios_valoraciones VALUES("1","4","1","freelancers","Prueba","2","2024-11-12 22:10:06");
INSERT INTO comentarios_valoraciones VALUES("2","1","4","empresas","Bueno","5","2024-11-14 16:07:20");



DROP TABLE IF EXISTS contratistas;

CREATE TABLE `contratistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `membership_end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO contratistas VALUES("1","Toji Fushiguro","si@gmail.com","04121234567","Tokyo","","$2y$10$0FvtGGZICzbCmrP8LOqu6eMuhTlDDFBi8KgH/lvEHNuSzDJQH/0MS","1","https://wallpapers.com/images/hd/toji-fushiguro-1920-x-1075-wallpaper-wsutogtc14vfrme8.jpg","","","","","");
INSERT INTO contratistas VALUES("2","Prueba","jmrm19721@gmail.com","04243363970","El Bosque","Sí","$2y$10$aH3Ll2BnBsINkwZfLGQfNeal0FGMnFxz.kuWENmWsJVjx4.QFy7/m","1","","","","","","");



DROP TABLE IF EXISTS empresas;

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `membership_end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO empresas VALUES("4","Suguru Geto","gramolca@gmail.com","04243363970","V-30658992","Tokyo","Agropecuaria","https://gramolcas.com/","$2y$10$Bjn61VMEpe7uwd72QOYT5u5GnIxe2WK3MZVxVJC83bOkDRNHFTlXi","1","https://miro.medium.com/v2/resize:fit:736/1*GHQ2nQfaZyF81STYtlmAyA.jpeg","","gold","2024-11-24","2024-12-24");
INSERT INTO empresas VALUES("8","no","no@gmail.com","04121234567","V-30658992","Cagua","sos","https://si.com/","$2y$10$cd1hK5MwfoAqd49.k8WlDu0cRrrI.Fx3KGBW035A7KLFzcj8PybAC","1","","","","","");
INSERT INTO empresas VALUES("9","Prueba","jmrm19722@gmail.com","04243363970","V-30091390","El Bosque","Sí","https://gramolca.com/","$2y$10$ShsaIzITY0VXGdOSBBTpx.J/vL6Z73z/zgqxjaqEi5yYWY2nnWTh6","1","","","","","");
INSERT INTO empresas VALUES("10","Prueba","miguelrg2004@hotmail.com","04243363970","3000284102","El Bosque","Prueba","https://www.google.com/?safe=active&ssui=on","$2y$10$bwH.jjHbscvrrVB0SgQq3.KRqaZdSgYfzUIfoqGDeresmPKepWwJe","1","","","","","");



DROP TABLE IF EXISTS freelancers;

CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `membership_end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO freelancers VALUES("1","Satoru Gojo","eloy@gmail.com","04128849077","Tokyo","tecnico de servidores","C:\\xampp\\htdocs\\Anderson\\Includes/../Assets/doc/Folleto Comunitario (2)_20241021_000911_0000.pdf","https://www.github.com","$2y$10$te3OwYwUbck26ME0w0lTEutTbvDFXaL95IVclL3vYxembaWLtniMK","1","https://cdn.chatfai.com/public_characters/ssmHlayEkdP03mM4xKJam1kwmOe2/c43f2674-0e42-4e8b-8219-7dd53f180afathumb-1920-1332281.jpeg","","","");
INSERT INTO freelancers VALUES("18","yo","yo@gmail.com","04128849077","Santa Cruz","si","","https://www.github.com","$2y$10$omQQ5fbNy1nsFdjiNamgfOBQOfKE92GkFwYPvQ.851FBvTb7qd6Ii","1","","","","");



DROP TABLE IF EXISTS interesados_proyecto;

CREATE TABLE `interesados_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_interesado` varchar(100) NOT NULL,
  `email_interesado` varchar(100) NOT NULL,
  `telefono_interesado` varchar(20) DEFAULT NULL,
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `creador_id` int(11) NOT NULL,
  `tipo_usuario_creador` enum('contratistas','freelancers','empresas') NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rol_solicitante` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proyecto` (`id_proyecto`),
  CONSTRAINT `interesados_proyecto_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO interesados_proyecto VALUES("5","Satoru Gojo","jmrm19722@gmail.com","04243363970","8","Desarrollo de Software Personalizado para Cliente F","4","empresas","1","freelancers");
INSERT INTO interesados_proyecto VALUES("6","Satoru Gojo","jmrm19722@gmail.com","3080754","2","Rediseño de Página Webs","4","empresas","1","freelancers");
INSERT INTO interesados_proyecto VALUES("7","Satoru Gojo","jmrm19722@gmail.com","04243363970","7","Creación de Contenido para Blog","1","freelancers","4","empresas");



DROP TABLE IF EXISTS membership_purchases;

CREATE TABLE `membership_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_type` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO membership_purchases VALUES("1","4","basic","2024-11-24","2024-12-24","15.00","completed","empresas");
INSERT INTO membership_purchases VALUES("4","4","silver","2024-11-24","2024-12-24","30.00","completed","empresas");
INSERT INTO membership_purchases VALUES("5","4","gold","2024-11-24","2024-12-24","50.00","completed","empresas");



DROP TABLE IF EXISTS messages;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outgoing_msg_id` int(11) NOT NULL,
  `outgoing_role` enum('contratistas','empresas','freelancers') NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `incoming_role` enum('contratistas','empresas','freelancers') NOT NULL,
  `msg` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO messages VALUES("1","4","empresas","1","freelancers","a","2024-11-02 23:56:12");
INSERT INTO messages VALUES("2","4","empresas","1","freelancers","a","2024-11-03 00:02:47");
INSERT INTO messages VALUES("3","4","empresas","1","freelancers","w","2024-11-03 00:05:35");
INSERT INTO messages VALUES("4","4","empresas","1","freelancers","s","2024-11-03 00:12:43");
INSERT INTO messages VALUES("5","1","freelancers","1","freelancers","a","2024-11-03 00:14:10");
INSERT INTO messages VALUES("6","4","empresas","1","freelancers","Prueba","2024-11-03 00:24:23");
INSERT INTO messages VALUES("7","1","freelancers","1","freelancers","a","2024-11-03 00:26:26");
INSERT INTO messages VALUES("8","1","freelancers","4","empresas","s","2024-11-03 00:47:08");
INSERT INTO messages VALUES("9","4","empresas","1","freelancers","s","2024-11-03 00:48:38");
INSERT INTO messages VALUES("10","4","empresas","1","freelancers","s","2024-11-03 00:48:38");
INSERT INTO messages VALUES("11","4","empresas","1","freelancers","a","2024-11-03 00:48:42");
INSERT INTO messages VALUES("12","4","empresas","1","freelancers","a","2024-11-03 00:48:42");
INSERT INTO messages VALUES("13","4","empresas","1","freelancers","w","2024-11-03 00:51:31");
INSERT INTO messages VALUES("14","1","freelancers","4","empresas","dd","2024-11-03 00:54:53");
INSERT INTO messages VALUES("15","1","freelancers","4","empresas","Hola","2025-03-09 20:36:47");



DROP TABLE IF EXISTS proyectos;

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `pago` enum('Pendiente','Pagado') DEFAULT 'Pendiente',
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`contratista_id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`contratista_id`) REFERENCES `contratistas` (`id`),
  CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`),
  CONSTRAINT `proyectos_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `proyectos_ibfk_4` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO proyectos VALUES("2","empresas","","","4","Rediseño de Página Webs","Rediseño completo de una página web para una empresa de moda.","https://pixelemos.com/wp-content/uploads/2017/06/como-crear-un-sitio-web.jpg","1","1500.00","1","2025-01-13","2025-02-05","2024-08-28 09:07:06","Diseño web, UX/UI, Desarrollo frontend","Oferta","https://github.com/","Sí","Pagado");
INSERT INTO proyectos VALUES("7","freelancers","","1","","Creación de Contenido para Blog","Creación de artículos y contenido de alta calidad para el blog E, con enfoque en SEO y estrategias de contenido.","https://i0.wp.com/res.cloudinary.com/djdesignerlab/image/upload/v1602264211/wp-uploads/SEO-Strategies-min_pn3uwz.jpg?w=1080&ssl=1","1","750.00","1","2025-01-13","2025-02-20","2024-08-28 09:56:21","Redacción de contenido, Estrategias de SEO","Oferta","","Sí","Pagado");
INSERT INTO proyectos VALUES("8","empresas","","","4","Desarrollo de Software Personalizado para Cliente F","Desarrollo de un software personalizado para la empresa cliente F, incluyendo análisis, diseño y programación.","https://softwarewebsas.com/public/images/blog/dev.webp","1","3500.00","1","2025-01-13","2025-03-15","2024-08-28 09:57:03","Desarrollo de software, Personalización","Servicio","https://github.com","Sí","Pendiente");
INSERT INTO proyectos VALUES("31","empresas","","","4","Creación de una dApp","Crear una dApp con Scaffold-ETH-2 para la administración de una DAO.","https://miro.medium.com/v2/resize:fit:400/0*RnvmtiFbfDWsZu6N.jpg","1","12.00","1","2025-01-08","2025-01-09","2025-01-08 17:32:04","Una dApp que asigne tareas a los contribuyentes de la DAO y que obtengan recompensas al cobrarlas. ","Oferta","","No","Pendiente");



DROP TABLE IF EXISTS tareas;

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `completado` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tareas VALUES("1","31","Crear la Interfaz Gráfica","2025-01-08 17:32:04","0");
INSERT INTO tareas VALUES("2","31","Crear el Smart Contract","2025-01-08 17:32:04","0");
INSERT INTO tareas VALUES("3","2","Estilizar con CSS","2025-01-11 17:07:19","1");
INSERT INTO tareas VALUES("4","2","Crear animaciones con JS","2025-01-12 23:43:29","1");
INSERT INTO tareas VALUES("5","7","Crear Artículo de: Ciencias Naturales","2025-01-12 23:44:49","0");
INSERT INTO tareas VALUES("6","7","Crear Artíuclo de: Matemáticas","2025-01-12 23:44:49","0");
INSERT INTO tareas VALUES("7","8","Diseñar Interfaz Gráfica","2025-01-12 23:45:27","0");
INSERT INTO tareas VALUES("8","8","Programar funcionalidad en PHP","2025-01-12 23:45:27","0");



DROP TABLE IF EXISTS usuarios_aceptados;

CREATE TABLE `usuarios_aceptados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `nombre_interesado` varchar(255) NOT NULL,
  `email_interesado` varchar(255) NOT NULL,
  `telefono_interesado` varchar(50) DEFAULT NULL,
  `rol_solicitante` varchar(50) NOT NULL,
  `fecha_aceptacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `usuarios_aceptados_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios_aceptados VALUES("3","8","Satoru Gojo","jmrm19722@gmail.com","04243363970","freelancers","2024-09-22 15:59:48","1");
INSERT INTO usuarios_aceptados VALUES("4","2","Satoru Gojo","jmrm19722@gmail.com","3080754","freelancers","2024-11-14 08:42:32","1");



DROP TABLE IF EXISTS usuarios_paypal;

CREATE TABLE `usuarios_paypal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `rol` enum('contratistas','freelancers','empresas') NOT NULL,
  `cuenta_paypal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios_paypal VALUES("1","1","freelancers","sb-q7bm833432292@business.example.com");
INSERT INTO usuarios_paypal VALUES("2","4","empresas","sb-xzgfq33436270@personal.example.com");



SET FOREIGN_KEY_CHECKS=1;