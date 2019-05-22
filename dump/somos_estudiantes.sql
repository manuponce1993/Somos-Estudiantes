-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2019 a las 17:57:10
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `somos_estudiantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anios`
--

CREATE TABLE `anios` (
  `id_anio` int(11) NOT NULL,
  `anio` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anios`
--

INSERT INTO `anios` (`id_anio`, `anio`, `id_carrera`) VALUES
(1, '1º', 1),
(2, '1º', 2),
(3, '1º', 3),
(4, '1º', 4),
(5, '1º', 5),
(6, '1º', 6),
(7, '1º', 7),
(8, '1º', 8),
(9, '1º', 9),
(10, '1º', 10),
(11, '2º', 1),
(12, '2º', 2),
(13, '2º', 3),
(14, '2º', 4),
(15, '2º', 5),
(16, '2º', 6),
(17, '2º', 7),
(18, '2º', 8),
(19, '2º', 9),
(20, '2º', 10),
(21, '3º', 1),
(22, '3º', 2),
(23, '3º', 3),
(24, '3º', 4),
(25, '3º', 5),
(26, '3°', 6),
(27, '3°', 7),
(28, '3°', 8),
(29, '3°', 9),
(30, '3°', 10),
(31, '4°', 1),
(32, '4°', 2),
(33, '4°', 3),
(34, '4°', 4),
(35, '4°', 5),
(36, '4°', 6),
(37, '4°', 7),
(38, '4°', 8),
(39, '4°', 9),
(40, '4°', 10),
(41, '5°', 1),
(42, '5°', 2),
(43, '5°', 3),
(44, '5°', 4),
(45, '5°', 5),
(46, '5°', 6),
(47, '5°', 7),
(48, '5°', 8),
(49, '5°', 9),
(50, '5°', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `titulo` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_subido` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(55) DEFAULT NULL,
  `id_materia` int(11) NOT NULL,
  `detalles` varchar(255) DEFAULT NULL,
  `extension` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id_archivo`, `titulo`, `fecha_subido`, `id_usuario`, `tipo`, `id_materia`, `detalles`, `extension`) VALUES
(44, 'Trabajo nro 2', '2018-07-15', 2, 'tp', 1, 'Este es el trabajo practico numero 1 de algebra', 'jpg'),
(45, 'Numero complejos', '2018-01-27', 2, 'mutil', 1, 'Este es un material util sobre numeros complejos', 'jpg'),
(48, 'Resumen', '2018-01-03', 23, 'resumen', 3, 'resumen de quimica', 'jpg'),
(49, 'Modulo 1', '2018-08-24', 23, 'tp', 19, 'Respuestas a las preguntas orientadoras', 'docx'),
(50, 'resumen completo', '2018-08-24', 18, 'resumen', 16, 'Abarca contenidos hasta el primer parcial', 'pdf'),
(51, 'Parcial algebra a', '2018-08-24', 18, 'mutil', 1, 'este es un parcial', 'pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `carrera` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `carrera`) VALUES
(1, 'Ingeniería Informática'),
(2, 'Ingeniería Eléctrica'),
(3, 'Ingeniería Mecánica'),
(4, 'Ingeniería Electricomecánica'),
(5, 'Ingeniería Electrónica'),
(6, 'Ingeniería en Alimentos'),
(7, 'Ingeniería en Materiales'),
(8, 'Ingeniería Industrial'),
(9, 'Ingeniería Química'),
(10, 'Ingeniería en Computación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `materia` varchar(55) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`) VALUES
(1, 'Algebra A'),
(2, 'Análisis Matemático A'),
(3, 'Química General I'),
(4, 'Algebra B'),
(5, 'Análisis Matemático B'),
(6, 'Física 1'),
(7, 'Fundamentos de la Informática'),
(8, 'Análisis Matemático C'),
(9, 'Física 2'),
(10, 'Matemática Discreta'),
(11, 'Programación I'),
(12, 'Análisis Numérico'),
(13, 'Estadística Básica'),
(14, 'Física 3'),
(15, 'Programación II'),
(16, 'Arquitectura de Computadoras'),
(17, 'Física Experimental'),
(18, 'Investigación Operativa'),
(19, 'Organización y Dirección Industrial'),
(20, 'Programación III'),
(21, 'Análisis y Diseño de Sistemas I'),
(22, 'Organización de Datos'),
(23, 'Sistemas de Representación'),
(24, 'Taller de Programación I'),
(25, 'Teoría de la Información'),
(26, 'Análisis y Diseño de Sistemas II'),
(27, 'Ingeniería Económica'),
(28, 'Lenguajes Formales'),
(29, 'Sistemas Operativos'),
(30, 'Bases de Datos'),
(31, 'Inteligencia Artificial'),
(32, 'Redes de computadoras'),
(33, 'Sistemas Distribuidos'),
(34, 'Seguridad Higiene y Saneamiento Ambiental'),
(35, 'Taller de Programación II'),
(36, 'Derecho en Ingeniería'),
(37, 'Trabajo Final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_anio`
--

CREATE TABLE `materia_anio` (
  `id_materia_anio` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia_anio`
--

INSERT INTO `materia_anio` (`id_materia_anio`, `id_materia`, `id_anio`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 11),
(9, 9, 11),
(10, 10, 11),
(11, 11, 11),
(12, 12, 11),
(13, 13, 11),
(14, 14, 11),
(15, 15, 11),
(16, 16, 21),
(17, 17, 21),
(18, 18, 21),
(19, 19, 21),
(20, 20, 21),
(21, 21, 21),
(22, 22, 21),
(23, 23, 21),
(24, 24, 21),
(25, 25, 21),
(26, 26, 31),
(27, 27, 31),
(28, 28, 31),
(29, 29, 31),
(30, 30, 31),
(31, 31, 31),
(32, 32, 31),
(33, 33, 31),
(34, 34, 41),
(35, 35, 41),
(36, 36, 41),
(37, 37, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id_suscripcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_suscriptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`id_suscripcion`, `id_usuario`, `id_suscriptor`) VALUES
(4, 10, 9),
(8, 23, 18),
(10, 23, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `dni` bigint(20) UNSIGNED DEFAULT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `contrasena`, `fecha_nacimiento`, `dni`, `id_carrera`) VALUES
(2, 'Emanuel', 'Ponce', 'manuponce1993@gmail.com', '­d0Z#«2ªž»Üsß,s', '1999-01-01', 37867643, 1),
(21, 'Mariano', 'Ferrer', 'marianoferrer@gmail.com', '­d0Z#«2ªž»Üsß,s', '1988-01-01', 123321, 7),
(22, 'Gustavo', 'Ponce', 'gustavo@gmail.com', '­d0Z#«2ªž»Üsß,s', '1994-01-01', 321123, 10),
(23, 'Fernando NicolÃ¡s', 'Juarez', 'fer@fer.com', '­d0Z#«2ªž»Üsß,s', '1992-01-01', 2332321321, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anios`
--
ALTER TABLE `anios`
  ADD PRIMARY KEY (`id_anio`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `materia_anio`
--
ALTER TABLE `materia_anio`
  ADD PRIMARY KEY (`id_materia_anio`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id_suscripcion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anios`
--
ALTER TABLE `anios`
  MODIFY `id_anio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `materia_anio`
--
ALTER TABLE `materia_anio`
  MODIFY `id_materia_anio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
