-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-11-2015 a las 22:33:53
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ssca`
--
CREATE DATABASE `ssca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ssca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendamientoruta`
--

CREATE TABLE IF NOT EXISTS `agendamientoruta` (
  `idAgendamientoRuta` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPlaneacionRuta` bigint(20) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idAgendamientoRuta`),
  KEY `idPlaneacionRuta` (`idPlaneacionRuta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo`, `Nombre`) VALUES
(1, 'Bebidas'),
(2, 'Adicionales'),
(4, 'Ensaldas'),
(5, 'Verduras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE IF NOT EXISTS `credenciales` (
  `idCredencial` varchar(250) NOT NULL,
  `idUsuarioPrincipal` varchar(250) NOT NULL,
  `idUsuarioSecundario` varchar(250) NOT NULL,
  `EstadoCredencial` varchar(50) NOT NULL,
  `SaldoCredencial` double NOT NULL,
  PRIMARY KEY (`idCredencial`),
  KEY `idUsuarioPrincipal` (`idUsuarioPrincipal`),
  KEY `idUsuarioSecundario` (`idUsuarioSecundario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`idCredencial`, `idUsuarioPrincipal`, `idUsuarioSecundario`, `EstadoCredencial`, `SaldoCredencial`) VALUES
('6d8980b4-834b-11e5-95d5-c4da260350a1', 'demo', 'demo', 'ACTIVO', -120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleplaneacionruta`
--

CREATE TABLE IF NOT EXISTS `detalleplaneacionruta` (
  `idPlaneacionRuta` bigint(20) NOT NULL,
  `idEstudiante` varchar(200) NOT NULL,
  `Coordenadas` varchar(45) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `idUsuario` varchar(250) NOT NULL,
  `idCredencial` varchar(250) NOT NULL,
  `ValorMovimiento` double NOT NULL,
  `FechaMovimiento` date NOT NULL,
  `HoraMovimiento` time NOT NULL,
  `DescripcionMovimiento` varchar(250) NOT NULL,
  KEY `idCredencial` (`idCredencial`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCredencial_2` (`idCredencial`),
  KEY `idUsuario_2` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`idUsuario`, `idCredencial`, `ValorMovimiento`, `FechaMovimiento`, `HoraMovimiento`, `DescripcionMovimiento`) VALUES
('demo', '6d8980b4-834b-11e5-95d5-c4da260350a1', 2120, '2015-11-04', '18:26:04', 'costo de asignaciÃ³n de tarjeta nueva'),
('demo', '6d8980b4-834b-11e5-95d5-c4da260350a1', 2000, '2015-11-04', '18:26:04', 'recargue monetario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenpedido`
--

CREATE TABLE IF NOT EXISTS `ordenpedido` (
  `idUsuario` varchar(250) NOT NULL,
  `idCredencial` varchar(250) NOT NULL,
  `ConsecutivoTurno` bigint(20) NOT NULL,
  `ConsecutivoInterno` bigint(20) NOT NULL,
  `DescripcionPedido` varchar(250) NOT NULL,
  `UbicacionPedido` varchar(50) NOT NULL,
  KEY `idUsuario` (`idUsuario`),
  KEY `idCredencial` (`idCredencial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planeacionruta`
--

CREATE TABLE IF NOT EXISTS `planeacionruta` (
  `idPlaneacionRuta` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreRuta` varchar(250) NOT NULL,
  `PuntoOrigen` varchar(45) NOT NULL,
  `PuntoDestino` varchar(45) NOT NULL,
  `idConductor` varchar(200) NOT NULL,
  `idMonitor` varchar(200) NOT NULL,
  PRIMARY KEY (`idPlaneacionRuta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `planeacionruta`
--

INSERT INTO `planeacionruta` (`idPlaneacionRuta`, `NombreRuta`, `PuntoOrigen`, `PuntoDestino`, `idConductor`, `idMonitor`) VALUES
(1, '', '24242332', '2', '5', '55'),
(2, '', '1', '2', '2', '1'),
(3, '1', 'dsd', '2', '2', '1'),
(4, '1', 'ruta', '2', '2', '1'),
(5, 'ruta', '1', '2', '2', '1'),
(6, 'ruta 2', '1', '2', '2', '2'),
(7, 'ruta3', '1', '1', '1', '1'),
(8, '1', '1', '1', '9', '8'),
(9, '1', '1', '1', '9', '8'),
(10, 'ddd', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `codigoProducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreProducto` varchar(250) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `ValorUnitario` double NOT NULL,
  `Categoria` bigint(20) NOT NULL,
  `Subcategoria` bigint(20) NOT NULL,
  `Stock` bigint(20) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Imagen` varchar(250) NOT NULL,
  PRIMARY KEY (`codigoProducto`),
  KEY `Categoria` (`Categoria`),
  KEY `Subcategoria` (`Subcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigoProducto`, `NombreProducto`, `Descripcion`, `ValorUnitario`, `Categoria`, `Subcategoria`, `Stock`, `Estado`, `Imagen`) VALUES
(1, 'Quatro 400 ml', 'Bebida gaseosa quatro toronja coca cola  Mantï¿½ngase refrigerado. Despuï¿½s de abierto consuma en el menor tiempo posible', 1200, 1, 2, 1967, 'ACTIVO', 'images/7_clipboard.png'),
(2, 'Pony malta mini pet x 200 ml', 'Pony malta mini pet x 200 ml', 700, 1, 2, 591, 'ACTIVO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub-categoria`
--

CREATE TABLE IF NOT EXISTS `sub-categoria` (
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `idCategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `idCategoria` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `sub-categoria`
--

INSERT INTO `sub-categoria` (`codigo`, `Nombre`, `idCategoria`) VALUES
(1, 'Bebidas calientes', 1),
(2, 'Bebidas Frias', 1),
(3, 'Adicional Verdura', 2),
(5, 'Frutas', 4),
(6, 'Adicional Carne', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `idTarifa` bigint(20) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(250) NOT NULL,
  `Valor` double NOT NULL,
  `idColegio` varchar(250) NOT NULL,
  PRIMARY KEY (`idTarifa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`idTarifa`, `Descripcion`, `Valor`, `idColegio`) VALUES
(1, 'Vr. Tarjeta', 2000, ''),
(2, 'Vr Transaccional', 0.06, ''),
(3, 'cambio de estado credencial', 600, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` bigint(20) DEFAULT NULL,
  `PrimerApellido` varchar(150) DEFAULT NULL,
  `SegundoApellido` varchar(150) DEFAULT NULL,
  `PrimerNombre` varchar(150) DEFAULT NULL,
  `SegundoNombre` varchar(150) DEFAULT NULL,
  `ImagenFotografica` varchar(200) DEFAULT NULL,
  `idAcudiente` varchar(200) DEFAULT NULL,
  `Direccion` varchar(250) DEFAULT NULL,
  `Telefono1` varchar(50) DEFAULT NULL,
  `Telefono2` varchar(50) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Clave` varchar(200) DEFAULT NULL,
  `Coordenadas` varchar(45) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave`, `Coordenadas`) VALUES
('demo', 'Funcionario', 'Registro Civil', 555, 'demo', 'demo', 'demo', '', 'images/563a940c726c6.png', '555', 'Cartagena, Bolivar', '433', '', 'ACTIVO', 'ZGVtbw==', '4.710988599999999, -74.072092'),
('shelvin', 'Monitor', 'Cedula', 1047426283, 'Batista', 'Batista', 'Shelvin', NULL, NULL, '1047426283', 'San Jose', '6636727', NULL, 'ACTIVO', 'ZGVtbw==', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD CONSTRAINT `credenciales_ibfk_2` FOREIGN KEY (`idUsuarioSecundario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_UsuarioPrincipal` FOREIGN KEY (`idUsuarioPrincipal`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenpedido`
--
ALTER TABLE `ordenpedido`
  ADD CONSTRAINT `FK_CredencialOP` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsuarioOP` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_CategoriaProductos` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Sub-Categoria` FOREIGN KEY (`Subcategoria`) REFERENCES `sub-categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub-categoria`
--
ALTER TABLE `sub-categoria`
  ADD CONSTRAINT `FK_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
