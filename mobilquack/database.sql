-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2017 a las 12:20:57
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mobilquack`
--
CREATE DATABASE IF NOT EXISTS `mobilquack` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mobilquack`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `email` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`email`, `modelo`) VALUES
('carra@gmail.com', 'Aquaris M5'),
('carra@gmail.com', 'Galaxy S7'),
('jorge@gmail.com', 'Aquaris M5'),
('jorge@gmail.com', 'Galaxy S7'),
('jorge@gmail.com', 'iPhone 7'),
('jorge@gmail.com', 'Zenfone 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `modelo` varchar(30) NOT NULL,
  `marca` varchar(15) DEFAULT NULL,
  `s_o` varchar(15) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`modelo`, `marca`, `s_o`, `precio`) VALUES
('Aquaris M5', 'bq', 'Android', 200),
('Galaxy S7', 'Samsung', 'Android', 400),
('iPhone 7', 'Apple', 'iOS', 700),
('P9', 'Huawei', 'Android', 200),
('Zenfone 2', 'ASUS', 'Android', 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(30) NOT NULL,
  `nombre_u` varchar(20) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `fech_nac` date DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `nombre_u`, `apellido`, `password`, `dni`, `fech_nac`, `admin`) VALUES
('carra@gmail.com', 'Dani', 'Carra', '81dc9bdb52d04dc20036dbd8313ed055', '71169934C', '1996-10-12', 0),
('jorge@gmail.com', 'Jorge', 'del Pozo', 'e10adc3949ba59abbe56e057f20f883e', '71169901J', '1995-07-11', 1),
('usr2@gmail.com', 'Usu2', 'Ario2', '81dc9bdb52d04dc20036dbd8313ed055', '02', '1992-02-02', 0),
('usr3@gmail.com', 'Usu3', 'Ario3', '81dc9bdb52d04dc20036dbd8313ed055', '03', '1993-03-03', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`email`,`modelo`),
  ADD KEY `compra_ibfk_2` (`modelo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`modelo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`modelo`) REFERENCES `producto` (`modelo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
