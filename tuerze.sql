-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2018 a las 01:09:45
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tuerze`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epica`
--

CREATE TABLE `epica` (
  `id_epica` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `name_epica` varchar(60) NOT NULL,
  `desc_epica` varchar(280) DEFAULT NULL,
  `status_epica` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `epica`
--

INSERT INTO `epica` (`id_epica`, `id_proyecto`, `name_epica`, `desc_epica`, `status_epica`) VALUES
(1, 1, 'Epica B', 'Descripción de la épica A', 'to do'),
(2, 1, 'Epica A', 'Descripción de la épica A', 'To do');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `id_hist` int(11) NOT NULL,
  `id_epica` int(11) NOT NULL,
  `name_hist` varchar(60) NOT NULL,
  `desc_hist` varchar(280) DEFAULT NULL,
  `priority_hist` varchar(10) DEFAULT NULL,
  `status_hist` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historia`
--

INSERT INTO `historia` (`id_hist`, `id_epica`, `name_hist`, `desc_hist`, `priority_hist`, `status_hist`) VALUES
(2, 1, 'Historia 1', 'Descripción de la historia 1', 'low', 'to do'),
(3, 2, 'Historia 2', 'Descripción de la historia 2', 'low', 'progress'),
(4, 2, 'Historia 3', 'Descripción de la historia 3', 'high', 'done'),
(5, 2, 'Historia 4', 'Descripción de la historia 4', 'medium', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `id_user` varchar(45) NOT NULL,
  `name_proyecto` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `id_user`, `name_proyecto`) VALUES
(1, 'ZrG9WPVMmFejCrBa7U4DQVQHOVT2', 'Primer proyecto ()');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositorio`
--

CREATE TABLE `repositorio` (
  `id_repo` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `URL_repo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id_tarea` int(11) NOT NULL,
  `id_proyecto` int(6) NOT NULL,
  `id_epica` int(11) NOT NULL,
  `id_historia` int(11) DEFAULT NULL,
  `name_tarea` varchar(60) NOT NULL,
  `desc_tarea` varchar(280) DEFAULT NULL,
  `priority_tarea` varchar(10) DEFAULT NULL,
  `status_tarea` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id_tarea`, `id_proyecto`, `id_epica`, `id_historia`, `name_tarea`, `desc_tarea`, `priority_tarea`, `status_tarea`) VALUES
(1, 1, 2, 3, 'Tarea 1', 'Descripción 1 parte2', 'high', 'progress');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` varchar(30) NOT NULL,
  `display_name` varchar(45) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pic_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `display_name`, `username`, `pic_url`) VALUES
('ZrG9WPVMmFejCrBa7U4DQVQHOVT2', 'Lucía Blanco', 'lucia-blanco', 'https://avatars1.githubusercontent.com/u/32088542?v=4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `epica`
--
ALTER TABLE `epica`
  ADD PRIMARY KEY (`id_epica`),
  ADD KEY `epica_ibfk_1` (`id_proyecto`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id_hist`),
  ADD KEY `idEpica` (`id_epica`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `repositorio`
--
ALTER TABLE `repositorio`
  ADD PRIMARY KEY (`id_repo`),
  ADD KEY `repositorio_ibfk_1` (`id_proyecto`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `tarea_ibfk_1` (`id_epica`),
  ADD KEY `tarea_ibfk_3` (`id_proyecto`),
  ADD KEY `tarea_ibfk_2` (`id_historia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `epica`
--
ALTER TABLE `epica`
  MODIFY `id_epica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `id_hist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `repositorio`
--
ALTER TABLE `repositorio`
  MODIFY `id_repo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `epica`
--
ALTER TABLE `epica`
  ADD CONSTRAINT `epica_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`id_epica`) REFERENCES `epica` (`id_epica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repositorio`
--
ALTER TABLE `repositorio`
  ADD CONSTRAINT `repositorio_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`id_epica`) REFERENCES `epica` (`id_epica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`id_historia`) REFERENCES `historia` (`id_hist`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarea_ibfk_3` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
