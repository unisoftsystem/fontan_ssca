SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

CREATE TABLE IF NOT EXISTS `_carnet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `html_frente` text COLLATE utf8_spanish_ci,
  `fondo_frente` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `html_posterior` text COLLATE utf8_spanish_ci,
  `fondo_posterior` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estilos` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `agendamientoruta` (
  `idAgendamientoRuta` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPlaneacionRuta` bigint(20) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idAgendamientoRuta`),
  KEY `idPlaneacionRuta` (`idPlaneacionRuta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `alertas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idUsuario` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idRuta` bigint(20) NOT NULL,
  `mensaje` text NOT NULL,
  `tipo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRuta` (`idRuta`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=3088 ;

CREATE TABLE IF NOT EXISTS `asignacionruta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idruta` int(11) NOT NULL,
  `nombreruta` varchar(255) NOT NULL,
  `monitor` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `latorigen` varchar(100) NOT NULL,
  `longorigen` varchar(100) NOT NULL,
  `latdestino` varchar(100) NOT NULL,
  `longdestino` varchar(100) NOT NULL,
  `color` text,
  `repetir` varchar(100) NOT NULL,
  `fechainicial` date NOT NULL,
  `fechafinal` date NOT NULL,
  `horainicial` time DEFAULT NULL,
  `horafinal` time DEFAULT NULL,
  `ruta_dinamica` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idruta` (`idruta`),
  KEY `monitor` (`monitor`),
  KEY `id_conductor` (`id_conductor`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `asignacionruta_particuliaridades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idruta` int(11) NOT NULL,
  `nombreruta` varchar(255) NOT NULL,
  `monitor` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `latorigen` varchar(100) NOT NULL,
  `longorigen` varchar(100) NOT NULL,
  `latdestino` varchar(100) NOT NULL,
  `longdestino` varchar(100) NOT NULL,
  `color` text,
  `repetir` varchar(100) NOT NULL,
  `fechainicial` date NOT NULL,
  `fechafinal` date NOT NULL,
  `horainicial` time DEFAULT NULL,
  `horafinal` time DEFAULT NULL,
  `id_asignacionruta` int(11) NOT NULL,
  `fecha_reemplazo` date NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `asignacion_servicios` (
  `idasignacion` int(11) NOT NULL AUTO_INCREMENT,
  `numero_identificacion` int(11) NOT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) NOT NULL,
  `primer_nombre` varchar(30) NOT NULL,
  `segundo_nombre` varchar(30) NOT NULL,
  `tipo_servicio` varchar(200) NOT NULL,
  `categoria` varchar(500) NOT NULL,
  `valor` int(11) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL,
  `valor_total` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'sin pago',
  `estado_pago` int(11) NOT NULL,
  `recibo_pago` varchar(100) NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num_recibo` varchar(30) NOT NULL,
  `medio_pago` varchar(30) NOT NULL,
  PRIMARY KEY (`idasignacion`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=100 ;

CREATE TABLE IF NOT EXISTS `bitacora` (
  `idbitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `mapa_ruta_idmapa_ruta` int(11) NOT NULL,
  `pagos_idpagos` int(11) NOT NULL,
  `usuarios_idUsuario` varchar(200) NOT NULL,
  PRIMARY KEY (`idbitacora`,`mapa_ruta_idmapa_ruta`,`pagos_idpagos`,`usuarios_idUsuario`),
  KEY `fk_bitacora_mapa_ruta_idx` (`mapa_ruta_idmapa_ruta`),
  KEY `fk_bitacora_pagos1_idx` (`pagos_idpagos`),
  KEY `fk_bitacora_usuarios1_idx` (`usuarios_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valores` varchar(500) DEFAULT NULL,
  `ruta` int(11) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ruta` (`ruta`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1660 ;

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `urlImagenPublicidad` text NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=19 ;

CREATE TABLE IF NOT EXISTS `chatmensajes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `origen` varchar(200) NOT NULL,
  `destino` varchar(200) NOT NULL,
  `usuario1` varchar(200) NOT NULL,
  `usuario2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=881 ;

CREATE TABLE IF NOT EXISTS `conductor` (
  `idconductor` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `TipoUsuario` varchar(50) NOT NULL,
  `TipoId` varchar(100) NOT NULL,
  `ImagenFotografica` varchar(200) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Coordenadas` varchar(200) NOT NULL,
  `TipoSangre` varchar(200) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idconductor`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `credenciales` (
  `idCredencial` varchar(250) NOT NULL,
  `idUsuarioPrincipal` varchar(250) NOT NULL,
  `idUsuarioSecundario` varchar(250) NOT NULL,
  `EstadoCredencial` varchar(50) NOT NULL,
  `SaldoCredencial` int(11) NOT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  PRIMARY KEY (`idCredencial`),
  KEY `idUsuarioPrincipal` (`idUsuarioPrincipal`),
  KEY `idUsuarioSecundario` (`idUsuarioSecundario`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `credenciales_06-abr` (
  `idCredencial` varchar(250) NOT NULL,
  `idUsuarioPrincipal` varchar(250) NOT NULL,
  `idUsuarioSecundario` varchar(250) NOT NULL,
  `EstadoCredencial` varchar(50) NOT NULL,
  `SaldoCredencial` int(11) NOT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  PRIMARY KEY (`idCredencial`),
  KEY `idUsuarioPrincipal` (`idUsuarioPrincipal`),
  KEY `idUsuarioSecundario` (`idUsuarioSecundario`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `cuenta_cobro` (
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(45) NOT NULL,
  `tercero` varchar(45) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_generacion` datetime NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_corte` date NOT NULL,
  `hora_corte` time NOT NULL,
  `valor_cuenta` int(11) NOT NULL,
  `desc1` int(11) NOT NULL,
  `desc2` int(11) NOT NULL,
  `desc3` int(11) NOT NULL,
  `desc4` int(11) NOT NULL,
  `valor_total` int(11) NOT NULL,
  `fecha_cancelacion` date NOT NULL,
  `numero_recibo` int(11) NOT NULL DEFAULT '0',
  `observaciones` varchar(10000) NOT NULL,
  PRIMARY KEY (`idcuenta`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=19 ;

CREATE TABLE IF NOT EXISTS `datoscalendario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idruta` int(11) NOT NULL,
  `vehiculo` int(11) NOT NULL,
  `nombreruta` varchar(255) NOT NULL,
  `monitor` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `latorigen` varchar(100) NOT NULL,
  `longorigen` varchar(100) NOT NULL,
  `latdestino` varchar(100) NOT NULL,
  `longdestino` varchar(100) NOT NULL,
  `color` text,
  `repetir` varchar(100) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horainicial` time DEFAULT NULL,
  `horafinal` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehiculo` (`vehiculo`),
  KEY `idruta` (`idruta`),
  KEY `monitor` (`monitor`),
  KEY `id_conductor` (`id_conductor`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=28922 ;

CREATE TABLE IF NOT EXISTS `detallehorario` (
  `idHorario` bigint(20) NOT NULL,
  `idUsuario` varchar(255) NOT NULL,
  KEY `idHorario` (`idHorario`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `detallenenudia` (
  `idMenuDia` int(11) NOT NULL,
  `idProteina` bigint(20) NOT NULL,
  `idUsuario` varchar(250) NOT NULL,
  `Dia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  KEY `idMenuDia` (`idMenuDia`,`idProteina`,`idUsuario`),
  KEY `idProteina` (`idProteina`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idMenuDia_2` (`idMenuDia`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `detalleplaneacionruta` (
  `idPlaneacionRuta` bigint(20) NOT NULL,
  `idEstudiante` varchar(200) NOT NULL,
  `Coordenadas` varchar(45) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `Detalle_OrdenPedido` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idOrdenPedido` bigint(20) NOT NULL,
  `codigoProducto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=105160 ;

CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` bigint(20) NOT NULL AUTO_INCREMENT,
  `HoraEntrada` time NOT NULL,
  `HoraSalida` time NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `Log_inventario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `codigoProducto` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `stock_inicial` bigint(20) NOT NULL,
  `cantidad_agregar` bigint(20) NOT NULL,
  `stock_final` bigint(20) NOT NULL,
  `session` text,
  `origen` text,
  PRIMARY KEY (`id`),
  KEY `codigoProducto` (`codigoProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=87951 ;

CREATE TABLE IF NOT EXISTS `log_restaurante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(100) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `mensaje` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `log_ruta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestudiante` varchar(200)  DEFAULT NULL,
  `coordenadas_recogida` varchar(200)  DEFAULT NULL,
  `tipo` varchar(100)  DEFAULT NULL,
  `idruta` text,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `mensaje` varchar(500)  DEFAULT NULL,
  `acudiente` text,
  `session` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=953897 ;

CREATE TABLE IF NOT EXISTS `mapa_ruta` (
  `idmapa_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `coor_salida` varchar(45) DEFAULT NULL,
  `coor_llegada` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmapa_ruta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `menudia` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `idProteina` bigint(20) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Dia` int(11) NOT NULL,
  `Foto` varchar(500) NOT NULL,
  `Edad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idProteina` (`idProteina`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `menuespecial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Foto` varchar(500) NOT NULL,
  `Dia` int(11) NOT NULL,
  `Valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `monitor` (
  `idmonitor` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `ImagenFotografica` varchar(200) DEFAULT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Clave` varchar(200) NOT NULL,
  `qr` varchar(200) NOT NULL,
  `Coordenadas` varchar(200) NOT NULL,
  `TipoSangre` varchar(200) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  `Gcm_Phone` text,
  PRIMARY KEY (`idmonitor`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `movimientos` (
  `idUsuario` varchar(250) DEFAULT NULL,
  `idCredencial` varchar(250) DEFAULT NULL,
  `ValorMovimiento` double DEFAULT NULL,
  `FechaMovimiento` date DEFAULT NULL,
  `HoraMovimiento` time DEFAULT NULL,
  `DescripcionMovimiento` text,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `OrigenPedido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCredencial` (`idCredencial`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCredencial_2` (`idCredencial`),
  KEY `idUsuario_2` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=150357 ;

CREATE TABLE IF NOT EXISTS `ordenpedido` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idUsuario` varchar(250) NOT NULL,
  `idCredencial` varchar(250) NOT NULL,
  `ConsecutivoTurno` bigint(20) NOT NULL,
  `ConsecutivoInterno` bigint(20) NOT NULL,
  `DescripcionPedido` varchar(250) NOT NULL,
  `UbicacionPedido` varchar(50) NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `HoraEntrega` time DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `OrigenPedido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCredencial` (`idCredencial`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=65181 ;

CREATE TABLE IF NOT EXISTS `pagos` (
  `idpagos` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ruta_idruta` int(11) NOT NULL,
  PRIMARY KEY (`idpagos`,`ruta_idruta`),
  KEY `fk_pagos_ruta1_idx` (`ruta_idruta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `pago_cuenta_cobro` (
  `idpagocuentacobro` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta_cobro` int(11) NOT NULL,
  `fecha_envio` date NOT NULL,
  `valor_total` int(11) NOT NULL,
  `area` varchar(40) NOT NULL,
  `tercero` varchar(45) NOT NULL,
  `fecha_cancelacion` date NOT NULL,
  PRIMARY KEY (`idpagocuentacobro`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=80 ;

CREATE TABLE IF NOT EXISTS `permiso` (
  `idPermiso` bigint(20) NOT NULL AUTO_INCREMENT,
  `idUsuario` varchar(255) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  PRIMARY KEY (`idPermiso`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=19 ;

CREATE TABLE IF NOT EXISTS `planeacionruta` (
  `idPlaneacionRuta` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdRuta` varchar(250) NOT NULL,
  `PuntoOrigen` varchar(45) NOT NULL,
  `PuntoDestino` varchar(45) NOT NULL,
  `idConductor` varchar(200) NOT NULL,
  `idMonitor` varchar(200) NOT NULL,
  PRIMARY KEY (`idPlaneacionRuta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `planeacion_ruta` (
  `idplaneacion_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `punto_origen` varchar(45) DEFAULT NULL,
  `punto_destino` varchar(45) DEFAULT NULL,
  `agendamientoruta_idAgendamientoRuta` bigint(20) NOT NULL,
  `conductor_idconductor` int(11) NOT NULL,
  PRIMARY KEY (`idplaneacion_ruta`,`agendamientoruta_idAgendamientoRuta`,`conductor_idconductor`),
  KEY `fk_planeacion_ruta_agendamientoruta1_idx` (`agendamientoruta_idAgendamientoRuta`),
  KEY `fk_planeacion_ruta_conductor1_idx` (`conductor_idconductor`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

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
  `hora_maxima` time NOT NULL,
  `tiempo_cancelacion` time NOT NULL,
  `edad` int(11) NOT NULL,
  `edad_max` int(11) NOT NULL,
  PRIMARY KEY (`codigoProducto`),
  KEY `Categoria` (`Categoria`),
  KEY `Subcategoria` (`Subcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=419 ;

CREATE TABLE IF NOT EXISTS `productos_copia` (
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
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `productos_marzo` (
  `codigoProducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreProducto` varchar(250) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `ValorUnitario` double NOT NULL,
  `Categoria` bigint(20) NOT NULL,
  `Subcategoria` bigint(20) NOT NULL,
  `Stock` bigint(20) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Imagen` varchar(250) NOT NULL,
  `hora_maxima` time NOT NULL,
  `tiempo_cancelacion` time NOT NULL,
  `edad` int(11) NOT NULL,
  PRIMARY KEY (`codigoProducto`),
  KEY `Categoria` (`Categoria`),
  KEY `Subcategoria` (`Subcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=16004 ;

CREATE TABLE IF NOT EXISTS `proteinas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(250) NOT NULL,
  `color` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `recogida` (
  `idrecogida` bigint(20) NOT NULL AUTO_INCREMENT,
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `idestudiante` varchar(250) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`idrecogida`),
  KEY `idestudiante` (`idestudiante`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `registrocontrol` (
  `idControl` bigint(20) NOT NULL AUTO_INCREMENT,
  `idCredencial` varchar(255) NOT NULL,
  `idUsuario` varchar(255) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Observacion` text,
  PRIMARY KEY (`idControl`),
  KEY `idCredencial` (`idCredencial`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=9135 ;

CREATE TABLE IF NOT EXISTS `restriccion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idAcudiente` varchar(200) NOT NULL,
  `idEstudiante` varchar(200) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Log` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idAcudiente` (`idAcudiente`,`idEstudiante`),
  KEY `idEstudiante` (`idEstudiante`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=193 ;

CREATE TABLE IF NOT EXISTS `reversionpedidos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idUsuario` varchar(200) NOT NULL,
  `idPedido` bigint(20) DEFAULT NULL,
  `idCredencial` varchar(250) NOT NULL,
  `FechaCancelacion` date DEFAULT NULL,
  `HoraCancelacion` time DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `HoraEntrega` time DEFAULT NULL,
  `OrigenPedido` text,
  `Productos` text,
  `Turno` text,
  `Total` text,
  `Fechapedido` date DEFAULT NULL,
  `Horapedido` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCredencial` (`idCredencial`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `ruta` (
  `idruta` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(45) DEFAULT NULL,
  `nombre_ruta` varchar(45) DEFAULT NULL,
  `sillas` int(11) NOT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `conductor_idconductor` int(11) NOT NULL,
  `monitor_idmonitor` int(11) NOT NULL,
  `coordenadas` varchar(50) NOT NULL,
  PRIMARY KEY (`idruta`,`conductor_idconductor`,`monitor_idmonitor`),
  KEY `fk_ruta_conductor1_idx` (`conductor_idconductor`),
  KEY `fk_ruta_monitor1_idx` (`monitor_idmonitor`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `valor` int(11) NOT NULL,
  `periodicidad` int(11) NOT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `servicios_sistema` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modulo` int(11) NOT NULL,
  `submodulo` int(11) NOT NULL,
  `accion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modulo` (`modulo`),
  KEY `submodulo` (`submodulo`),
  KEY `accion` (`accion`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=114 ;

CREATE TABLE IF NOT EXISTS `sub-categoria` (
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `idCategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `idCategoria` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=76 ;

CREATE TABLE IF NOT EXISTS `submodulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `idModulo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idModulo` (`idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=28 ;

CREATE TABLE IF NOT EXISTS `subservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `url` text,
  `idSubmodulo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSubmodulo` (`idSubmodulo`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=114 ;

CREATE TABLE IF NOT EXISTS `subsidios_funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `TABLE 60` (
  `idUsuario` varchar(42) DEFAULT NULL,
  `TipoUsuario` varchar(11) DEFAULT NULL,
  `TipoId` varchar(21) DEFAULT NULL,
  `NumeroId` varchar(331) DEFAULT NULL,
  `PrimerApellido` varchar(13) DEFAULT NULL,
  `SegundoApellido` varchar(14) DEFAULT NULL,
  `PrimerNombre` varchar(11) DEFAULT NULL,
  `SegundoNombre` varchar(17) DEFAULT NULL,
  `ImagenFotografica` varchar(24) DEFAULT NULL,
  `idAcudiente` varchar(39) DEFAULT NULL,
  `Direccion` varchar(70) DEFAULT NULL,
  `Telefono1` varchar(23) DEFAULT NULL,
  `Telefono2` varchar(11) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL,
  `Clave` varchar(60) DEFAULT NULL,
  `Coordenadas` varchar(37) DEFAULT NULL,
  `latitud` varchar(21) DEFAULT NULL,
  `longitud` varchar(23) DEFAULT NULL,
  `ruta_idruta` int(1) DEFAULT NULL,
  `curso` int(2) DEFAULT NULL,
  `gcm_regid` varchar(152) DEFAULT NULL,
  `TipoSangre` varchar(22) DEFAULT NULL,
  `arl` varchar(12) DEFAULT NULL,
  `cargo` varchar(41) DEFAULT NULL,
  `tipoestudiante` varchar(2) DEFAULT NULL,
  `tipofuncionario` varchar(10) DEFAULT NULL,
  `fechanacimiento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `TABLE 61` (
  `idUsuario` varchar(42) DEFAULT NULL,
  `TipoUsuario` varchar(11) DEFAULT NULL,
  `TipoId` varchar(21) DEFAULT NULL,
  `NumeroId` varchar(331) DEFAULT NULL,
  `PrimerApellido` varchar(13) DEFAULT NULL,
  `SegundoApellido` varchar(14) DEFAULT NULL,
  `PrimerNombre` varchar(11) DEFAULT NULL,
  `SegundoNombre` varchar(17) DEFAULT NULL,
  `ImagenFotografica` varchar(24) DEFAULT NULL,
  `idAcudiente` varchar(39) DEFAULT NULL,
  `Direccion` varchar(70) DEFAULT NULL,
  `Telefono1` varchar(23) DEFAULT NULL,
  `Telefono2` varchar(11) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL,
  `Clave` varchar(60) DEFAULT NULL,
  `Coordenadas` varchar(37) DEFAULT NULL,
  `latitud` varchar(21) DEFAULT NULL,
  `longitud` varchar(23) DEFAULT NULL,
  `ruta_idruta` int(1) DEFAULT NULL,
  `curso` int(2) DEFAULT NULL,
  `gcm_regid` varchar(152) DEFAULT NULL,
  `TipoSangre` varchar(22) DEFAULT NULL,
  `arl` varchar(12) DEFAULT NULL,
  `cargo` varchar(41) DEFAULT NULL,
  `tipoestudiante` varchar(2) DEFAULT NULL,
  `tipofuncionario` varchar(10) DEFAULT NULL,
  `fechanacimiento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `TABLE 62` (
  `idUsuario` varchar(42) DEFAULT NULL,
  `TipoUsuario` varchar(11) DEFAULT NULL,
  `TipoId` varchar(21) DEFAULT NULL,
  `NumeroId` varchar(331) DEFAULT NULL,
  `PrimerApellido` varchar(13) DEFAULT NULL,
  `SegundoApellido` varchar(14) DEFAULT NULL,
  `PrimerNombre` varchar(11) DEFAULT NULL,
  `SegundoNombre` varchar(17) DEFAULT NULL,
  `ImagenFotografica` varchar(24) DEFAULT NULL,
  `idAcudiente` varchar(39) DEFAULT NULL,
  `Direccion` varchar(70) DEFAULT NULL,
  `Telefono1` varchar(23) DEFAULT NULL,
  `Telefono2` varchar(11) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL,
  `Clave` varchar(60) DEFAULT NULL,
  `Coordenadas` varchar(37) DEFAULT NULL,
  `latitud` varchar(21) DEFAULT NULL,
  `longitud` varchar(23) DEFAULT NULL,
  `ruta_idruta` int(1) DEFAULT NULL,
  `curso` int(2) DEFAULT NULL,
  `gcm_regid` varchar(152) DEFAULT NULL,
  `TipoSangre` varchar(22) DEFAULT NULL,
  `arl` varchar(12) DEFAULT NULL,
  `cargo` varchar(41) DEFAULT NULL,
  `tipoestudiante` varchar(2) DEFAULT NULL,
  `tipofuncionario` varchar(10) DEFAULT NULL,
  `fechanacimiento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `tarifas` (
  `idTarifa` bigint(20) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(250) NOT NULL,
  `Valor` double NOT NULL,
  `idColegio` varchar(250) NOT NULL,
  PRIMARY KEY (`idTarifa`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `temporal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(10000) NOT NULL,
  `categoria` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tercero` (
  `idtercero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `nit` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `area` varchar(40) NOT NULL,
  `descuento1` double NOT NULL,
  `descuento2` double NOT NULL,
  `descuento3` double NOT NULL,
  `descuento4` double NOT NULL,
  PRIMARY KEY (`idtercero`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `turnos_laborales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `idUsuario` varchar(200) NOT NULL,
  `date_create` date NOT NULL,
  `time_create` time NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `colegio` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=106 ;

CREATE TABLE IF NOT EXISTS `user_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `service_id` int(11) NOT NULL,
  `registration_date` date NOT NULL,
  `registration_time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `service_id` (`service_id`),
  KEY `userid_2` (`userid`),
  KEY `service_id_2` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=2000 ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` varchar(500) DEFAULT NULL,
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
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `ruta_idruta` int(11) DEFAULT '0',
  `curso` bigint(20) DEFAULT '0',
  `gcm_regid` text,
  `TipoSangre` varchar(100) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `tipoestudiante` varchar(20) DEFAULT NULL,
  `tipofuncionario` varchar(20) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_usuarios_ruta1_idx` (`ruta_idruta`),
  KEY `idAcudiente` (`idAcudiente`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `usuarios_abr-22-16` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` varchar(500) DEFAULT NULL,
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
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `ruta_idruta` int(11) DEFAULT '0',
  `curso` bigint(20) DEFAULT '0',
  `gcm_regid` varchar(250) DEFAULT NULL,
  `TipoSangre` varchar(100) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `tipoestudiante` varchar(20) DEFAULT NULL,
  `tipofuncionario` varchar(20) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_usuarios_ruta1_idx` (`ruta_idruta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `usuarios_abr-25-16` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` varchar(500) DEFAULT NULL,
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
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `ruta_idruta` int(11) DEFAULT '0',
  `curso` bigint(20) DEFAULT '0',
  `gcm_regid` varchar(250) DEFAULT NULL,
  `TipoSangre` varchar(100) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `tipoestudiante` varchar(20) DEFAULT NULL,
  `tipofuncionario` varchar(20) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_usuarios_ruta1_idx` (`ruta_idruta`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `usuarios_Mayo 11 2017` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` varchar(500) DEFAULT NULL,
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
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `ruta_idruta` int(11) DEFAULT '0',
  `curso` bigint(20) DEFAULT '0',
  `gcm_regid` text,
  `TipoSangre` varchar(100) DEFAULT NULL,
  `arl` varchar(200) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `tipoestudiante` varchar(20) DEFAULT NULL,
  `tipofuncionario` varchar(20) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_usuarios_ruta1_idx` (`ruta_idruta`),
  KEY `idAcudiente` (`idAcudiente`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `usuarios_sistema` (
  `idUsuario` varchar(200) NOT NULL,
  `TipoId` varchar(100) DEFAULT NULL,
  `NumeroId` bigint(20) DEFAULT NULL,
  `PrimerApellido` varchar(150) DEFAULT NULL,
  `SegundoApellido` varchar(150) DEFAULT NULL,
  `PrimerNombre` varchar(150) DEFAULT NULL,
  `SegundoNombre` varchar(150) DEFAULT NULL,
  `ImagenFotografica` varchar(200) DEFAULT NULL,
  `Direccion` varchar(250) DEFAULT NULL,
  `Telefono1` varchar(50) DEFAULT NULL,
  `Telefono2` varchar(50) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Clave` varchar(200) DEFAULT NULL,
  `permisos` text,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `idvehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `placa` varchar(40) NOT NULL,
  `nombre_ruta` varchar(45) NOT NULL,
  `sillas` int(11) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `ImagenFotografica` varchar(200) NOT NULL,
  `coordenadas` varchar(100) NOT NULL,
  PRIMARY KEY (`idvehiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_spanish_ci AUTO_INCREMENT=25 ;


ALTER TABLE `asignacionruta`
  ADD CONSTRAINT `FK_Conductor_Ruta` FOREIGN KEY (`id_conductor`) REFERENCES `conductor` (`idconductor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Monitor_Ruta` FOREIGN KEY (`monitor`) REFERENCES `monitor` (`idmonitor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Vehiculo_Ruta` FOREIGN KEY (`idruta`) REFERENCES `vehiculo` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_bitacora_mapa_ruta` FOREIGN KEY (`mapa_ruta_idmapa_ruta`) REFERENCES `mapa_ruta` (`idmapa_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bitacora_pagos1` FOREIGN KEY (`pagos_idpagos`) REFERENCES `pagos` (`idpagos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bitacora_usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `cart`
  ADD CONSTRAINT `Fk_Id_Ruta` FOREIGN KEY (`ruta`) REFERENCES `asignacionruta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `datoscalendario`
  ADD CONSTRAINT `datoscalendario_ibfk_3` FOREIGN KEY (`idruta`) REFERENCES `asignacionruta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datoscalendario_ibfk_5` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculo` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `datoscalendario_ibfk_6` FOREIGN KEY (`monitor`) REFERENCES `monitor` (`idmonitor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `datoscalendario_ibfk_7` FOREIGN KEY (`id_conductor`) REFERENCES `conductor` (`idconductor`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `detallehorario`
  ADD CONSTRAINT `detallehorario_ibfk_1` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallehorario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `detallenenudia`
  ADD CONSTRAINT `Fk_id_menu_dia` FOREIGN KEY (`idMenuDia`) REFERENCES `menudia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_id_Proteina` FOREIGN KEY (`idProteina`) REFERENCES `proteinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_id_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Log_inventario`
  ADD CONSTRAINT `FK_Productos_Log` FOREIGN KEY (`codigoProducto`) REFERENCES `productos` (`codigoProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `menudia`
  ADD CONSTRAINT `menudia_ibfk_1` FOREIGN KEY (`idProteina`) REFERENCES `proteinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `movimientos`
  ADD CONSTRAINT `Fk_Movimientos_Credencial` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ordenpedido`
  ADD CONSTRAINT `FK_CredencialOP` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsuarioOP` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_ruta1` FOREIGN KEY (`ruta_idruta`) REFERENCES `ruta` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `planeacion_ruta`
  ADD CONSTRAINT `fk_planeacion_ruta_agendamientoruta1` FOREIGN KEY (`agendamientoruta_idAgendamientoRuta`) REFERENCES `agendamientoruta` (`idAgendamientoRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planeacion_ruta_conductor1` FOREIGN KEY (`conductor_idconductor`) REFERENCES `conductor` (`idconductor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `productos`
  ADD CONSTRAINT `FK_CategoriaProductos` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Sub-Categoria` FOREIGN KEY (`Subcategoria`) REFERENCES `sub-categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `recogida`
  ADD CONSTRAINT `FK_IdCredencial_Recogida` FOREIGN KEY (`idestudiante`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `registrocontrol`
  ADD CONSTRAINT `PK_Credencial_Control` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `restriccion`
  ADD CONSTRAINT `FK_Acudiente` FOREIGN KEY (`idAcudiente`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Estudiante` FOREIGN KEY (`idEstudiante`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `reversionpedidos`
  ADD CONSTRAINT `reversionpedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios_sistema` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reversionpedidos_ibfk_2` FOREIGN KEY (`idCredencial`) REFERENCES `credenciales` (`idCredencial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_ruta_conductor1` FOREIGN KEY (`conductor_idconductor`) REFERENCES `conductor` (`idconductor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruta_monitor1` FOREIGN KEY (`monitor_idmonitor`) REFERENCES `monitor` (`idmonitor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `servicios_sistema`
  ADD CONSTRAINT `servicios_sistema_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_sistema_ibfk_2` FOREIGN KEY (`submodulo`) REFERENCES `submodulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_sistema_ibfk_3` FOREIGN KEY (`accion`) REFERENCES `subservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sub-categoria`
  ADD CONSTRAINT `FK_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `submodulos`
  ADD CONSTRAINT `Fk_Modulos` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `subservicios`
  ADD CONSTRAINT `subservicios_ibfk_1` FOREIGN KEY (`idSubmodulo`) REFERENCES `submodulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `turnos_laborales`
  ADD CONSTRAINT `FK_Id_Usuario_Turnos` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `usuarios_sistema` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `subservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `usuarios_sistema` (`idUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave`, `permisos`) VALUES
('prueba@ssca.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVO', 'MTIz', NULL);


INSERT INTO `modulos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'ADMINISTRATIVO', 'MODULO ADMINISTRATIVO'),
(2, 'CENTRO DE LIQUIDACION Y PAGOS', 'CENTRO DE LIQUIDACION Y PAGOS'),
(3, 'CENTRO OPERATIVO DE RUTAS ESCOLARES', 'CENTRO OPERATIVO DE RUTAS ESCOLARES'),
(4, 'CAFETERIA', 'MODULO DE CAFETERIA'),
(5, 'RESTAURANTE', 'MODULO DE RESTAURANTE');

INSERT INTO `submodulos` (`id`, `nombre`, `descripcion`, `idModulo`) VALUES
(1, 'GESTION DE USUARIOS', 'GESTION DE USUARIOS', 1),
(2, 'GESTION ADMINISTRATIVA DEL COLEGIO', 'GESTION ADMINISTRATIVA DEL COLEGIO', 1),
(3, 'GESTION DE SERVICIOS DEL SISTEMA', 'GESTION DE SERVICIOS DEL SISTEMA', 1),
(4, 'GESTION SERVICIOS ESCOLARES', 'GESTION SERVICIOS ESCOLARES', 1),
(5, 'GESTION DE CREDENCIALES', 'GESTION DE CREDENCIALES', 1),
(6, 'GESTION ENTRADA Y SALIDA DE PERSONAL', 'GESTION ENTRADA Y SALIDA DE PERSONAL', 1),
(7, 'RECAUDOS', 'RECAUDOS', 2),
(8, 'REPORTES LIQUIDACION Y PAGOS', 'REPORTES LIQUIDACION Y PAGOS', 2),
(9, 'MENSAJERIA LIQUIDACION Y PAGOS', 'MENSAJERIA LIQUIDACION Y PAGOS', 2),
(10, 'GESTION DE CONDUCTORES', 'GESTION DE CONDUCTORES', 3),
(11, 'GESTION DE MONITORES', 'GESTION DE MONITORES', 3),
(12, 'GESTION DE VEHICULOS', 'GESTION DE VEHICULOS', 3),
(13, 'GESTION DE RUTAS ESCOLARES', 'GESTION DE RUTAS ESCOLARES', 3),
(14, 'MENSAJERIA RUTAS ESCOLARES', 'MENSAJERIA RUTAS ESCOLARES', 3),
(15, 'REPORTES RUTAS ESCOLARES', 'REPORTES RUTAS ESCOLARES', 3),
(16, 'GESTION DE PEDIDOS', 'GESTION DE PEDIDOS', 4),
(17, 'REPORTES', 'REPORTES', 5),
(18, 'GESTION MENU', 'GESTION MENU', 5),
(19, 'GESTION DE PRODUCTOS', 'GESTION DE PRODUCTOS', 5),
(20, 'GESTION DE CATEGORIAS', 'GESTION DE CATEGORIAS', 5),
(21, 'GESTION DE COBROS', 'GESTION DE COBROS', 5),
(22, 'GESTION DE CONTROL DE INGRESO', 'GESTION DE CONTROL DE INGRESO', 5),
(23, 'CAJA RESTAURANTE', 'CAJA RESTAURANTE', 5),
(24, 'REPORTES REVERSION PEDIDOS', 'RREPORTES REVERSION PEDIDOS', 2),
(25, 'REPORTES SALIDAS', 'REPORTES SALIDAS', 1),
(26, 'CALENDARIO DE RUTAS', 'CALENDARIO DE RUTAS', 3),
(27, 'CHAT', 'CHAT', 3);

INSERT INTO `subservicios` (`id`, `nombre`, `descripcion`, `url`, `idSubmodulo`) VALUES
(21, 'CREACIÓN DE USUARIOS DEL SISTEMA', 'CREACIÓN DE USUARIOS DEL SISTEMA', '../usuarios_sistema/AsignarServiciosSistema', 1),
(22, 'MODIFICACIÓN USUARIOS DEL SISTEMA ', 'MODIFICACIÓN USUARIOS DEL SISTEMA ', '../usuarios_sistema/ModificarUsuarioSistema', 1),
(23, 'CREACIÓN DE USUARIOS DE APLICACIONES', 'CREACIÓN DE USUARIOS DE APLICACIONES', '../usuarios_aplicaciones/nuevo', 1),
(24, 'MODIFICACIÓN USUARIOS DE APLICACIONES', 'MODIFICACIÓN USUARIOS DE APLICACIONES', '../usuarios_aplicaciones/editar', 1),
(25, 'CAMBIOS DE ESTADO ', 'CAMBIOS DE ESTADO ', '', 1),
(26, 'CREACION DE CURSO', 'CREACION DE CURSO', '../cursos/nuevo', 2),
(27, 'ASIGNAR PERMISOS', 'ASIGNAR PERMISOS', '../credenciales/asignarPermiso', 6),
(28, 'CREACION DE TERCEROS', 'CREACION DE TERCEROS', '', 2),
(29, 'CREACIÓN DE SERVICIOS DEL SISTEMA', 'CREACIÓN DE SERVICIOS DEL SISTEMA', '../services/crearServiciosSistema', 3),
(30, 'MODIFICACIÓN DE SERVICIOS DEL SISTEMA', 'MODIFICACIÓN DE SERVICIOS DEL SISTEMA', '', 3),
(31, 'CREACIÓN DE SERVICIOS ESCOLARES', 'CREACIÓN DE SERVICIOS ESCOLARES', '', 4),
(32, 'MODIFICACIÓN DE SERVICIOS ESCOLARES', 'MODIFICACIÓN DE SERVICIOS ESCOLARES', '', 4),
(33, 'PAGO A TERCEROS', 'PAGO A TERCEROS', '', 4),
(34, 'VISUALIZACIÓN DE SERVICIOS ESCOLARES POR ESTUDIANTE', 'VISUALIZACIÓN DE SERVICIOS ESCOLARES POR ESTUDIANTE', '', 4),
(35, 'CREACION DE SUBSIDIOS DE ALIMENTACION', 'CREACION DE SUBSIDIOS DE ALIMENTACION', '', 2),
(36, 'REEMPLAZO DE CREDENCIALES', 'REEMPLAZO DE CREDENCIALES', '../credenciales/reemplazarCredencial', 5),
(37, 'ESTADO DE CUENTA', 'ESTADO DE CUENTA', '', 5),
(38, 'REPORTE CREDENCIAL', 'REPORTE CREDENCIAL', '', 5),
(39, 'REPORTE DE ENTRADA Y SALIDA DE PERSONAL POR RANGO DE FECHA', 'REPORTE DE ENTRADA Y SALIDA DE PERSONAL POR RANGO DE FECHA', '../registro_control/reporteEntradaSalida', 6),
(40, 'PAGO INICIAL DE SERVICIOS', 'PAGO INICIAL DE SERVICIOS', '', 7),
(41, 'RECAUDO DE SERVICIOS', 'RECAUDO DE SERVICIOS', '', 7),
(42, 'RECARGUE DE CREDENCIALES', 'RECARGUE DE CREDENCIALES', '../credenciales/procesoRecaudo', 7),
(43, 'GENERACIÓN DE COMPROBANTES DE RECAUDO', 'GENERACIÓN DE COMPROBANTES DE RECAUDO', '', 7),
(44, 'REPORTES DE CIERRES DE CAJA', 'REPORTES DE CIERRES DE CAJA', '../credenciales/reporteRecaudo', 8),
(45, 'GENERACIÓN ESTADOS DE CUENTA', 'GENERACIÓN ESTADOS DE CUENTA', '', 8),
(46, 'COBRO DE SERVICIOS ESCOLARES A LOS ACUDIENTES', 'COBRO DE SERVICIOS ESCOLARES A LOS ACUDIENTES', '', 9),
(47, 'CREACIÓN DE CONDUCTORES', 'CREACIÓN DE CONDUCTORES', '../conductores/nuevo', 10),
(48, 'MODIFICACIÓN DE CONDUCTORES', 'MODIFICACIÓN DE CONDUCTORES', '../conductores/editar', 10),
(49, 'CREACIÓN DE MONITORES', 'CREACIÓN DE MONITORES', '../monitores/nuevo', 11),
(50, 'MODIFICACIÓN DE MONITORES', 'MODIFICACIÓN DE MONITORES', '../monitores/editar', 11),
(51, 'CREACIÓN DE VEHÍCULOS', 'CREACIÓN DE VEHÍCULOS', '../vehiculos/nuevo', 12),
(52, 'MODIFICACIÓN DE VEHÍCULOS', 'MODIFICACIÓN DE VEHÍCULOS', '../vehiculos/editar', 12),
(53, 'CREACIÓN DE RUTAS ESCOLARES', 'CREACIÓN DE RUTAS ESCOLARES', '../rutas/nuevo', 13),
(54, 'MODIFICACIÓN DE RUTAS ESCOLARES', 'MODIFICACIÓN DE RUTAS ESCOLARES', '../rutas/editar', 13),
(55, 'TRACKING RUTAS ESCOLARES', 'TRACKING RUTAS ESCOLARES', '../rutas/obtener', 13),
(56, 'VISUALIZACIÓN RECORRIDO DE RUTA ESCOLAR', 'VISUALIZACIÓN RECORRIDO DE RUTA ESCOLAR', '', 13),
(57, 'REPORTE DE ALARMAS', 'REPORTE DE ALARMAS', '', 15),
(58, 'VISUALIZACIÓN DE INTEGRANTES DE LA RUTA', 'VISUALIZACIÓN DE INTEGRANTES DE LA RUTA', '', 15),
(59, 'AVISOS Y OBSERVACIONES EN RECORRIDOS ', 'AVISOS Y OBSERVACIONES EN RECORRIDOS ', '', 15),
(60, 'MENSAJERÍA POR RETRASO DE RECOGIDA', 'MENSAJERÍA POR RETRASO DE RECOGIDA', '', 14),
(61, 'MENSAJERÍA POR CAMBIO DE DATOS DE RUTA', 'MENSAJERÍA POR CAMBIO DE DATOS DE RUTA', '', 14),
(62, 'MENSAJERÍA POR CAMBIO DE MONITOR', 'MENSAJERÍA POR CAMBIO DE MONITOR', '', 14),
(63, 'MENSAJERÍA POR CAMBIO DE CONDUCTOR', 'MENSAJERÍA POR CAMBIO DE CONDUCTOR', '', 14),
(64, 'MENSAJERÍA POR CAMBIO DE VEHÍCULO', 'MENSAJERÍA POR CAMBIO DE VEHÍCULO', '', 14),
(65, 'ENVIAR MENSAJE A ACUDIENTES', 'ENVIAR MENSAJE A ACUDIENTES', '', 13),
(66, 'REPORTE DE MENSAJES DE ACUDIENTES A MONITOR', 'REPORTE DE MENSAJES DE ACUDIENTES A MONITOR', '../rutas/mensajeacudienteamonitor', 15),
(67, 'REPORTE DE MENSAJES A ACUDIENTES', 'REPORTE DE MENSAJES A ACUDIENTES', '../rutas/mensajecoordinadoracudiente', 15),
(68, 'REPORTE ESTADO DE CUENTA RUTA ESCOLAR', 'REPORTE ESTADO DE CUENTA RUTA ESCOLAR', '', 15),
(73, 'CREACION DE PEDIDO CAJERO', 'CREACION DE PEDIDO CAJERO', '../ordenpedido/cajero', 16),
(75, 'CREACIÓN DE MENU DEL DIA', 'CREACIÓN DE MENU DEL DIA', '../menus/MenuDia', 18),
(76, 'CREACIÓN DE MENU ESPECIAL', 'CREACIÓN DE MENU ESPECIAL', '../menus/MenuEspecial', 18),
(77, 'INCLUSIÓN STOCK', 'INCLUSIÓN STOCK', '../producto/gestionInventario', 19),
(79, 'CREACIÓN DE PRODUCTOS', 'CREACIÓN DE PRODUCTOS', '../producto/nuevo', 19),
(80, 'MODIFICACIÓN DE PRODUCTOS', 'MODIFICACIÓN DE PRODUCTOS', '../producto/editar', 19),
(81, 'CREACIÓN DE CATEGORIAS', 'CREACIÓN DE CATEGORIAS', '../categoria/nuevo', 20),
(82, 'REPORTE DE ORDENES DE PEDIDO POR UBICACIÓN', 'REPORTE DE ORDENES DE PEDIDO POR UBICACIÓN', '', 17),
(83, 'REPORTE DE PEDIDOS PLANIFICADOS', 'REPORTE DE PEDIDOS PLANIFICADOS', '', 17),
(84, 'MODIFICACION DE CATEGORIAS', 'MODIFICACION DE CATEGORIAS', '../categoria/editar', 20),
(85, 'CREACIÓN CUENTAS DE COBROS', 'CREACIÓN CUENTAS DE COBROS', '', 21),
(86, 'REPORTE CUENTAS DE COBROS', 'REPORTE CUENTAS DE COBROS', '', 17),
(87, 'CONSULTA DE CUENTAS DE PAGOS', 'CONSULTA DE CUENTAS DE PAGOS', '', 21),
(88, 'CONSULTA DE CUENTAS GENERALES', 'CONSULTA DE CUENTAS GENERALES', '', 21),
(89, 'TENDENCIAS DE CONSUMO DIA', 'TENDENCIAS DE CONSUMO DIA', '', 17),
(90, 'TENDENCIAS DE CONSUMO SEMANA', 'TENDENCIAS DE CONSUMO SEMANA', '', 17),
(91, 'TENDENCIAS DE CONSUMO MES', 'TENDENCIAS DE CONSUMO MES', '', 17),
(92, 'REPORTE DE CAFETERIA POR DIAS', 'REPORTE DE CAFETERIA POR DIAS', '../ordenpedido/ReporteCafeteriaDias', 17),
(93, 'REPORTE DE VENTAS POR DIAS', 'REPORTE DE VENTAS POR DIAS', '../ordenpedido/ReporteVentasDias', 17),
(94, 'CONSULTA DE MOVIMIENTOS', 'CONSULTA DE MOVIMIENTOS', '../movimientos/consultaMovimientos', 8),
(95, 'LECTURA DE QR CONTROL DE INGRESO', 'LECTURA DE QR CONTROL DE INGRESO', '', 22),
(97, 'REPORTE DE RUTAS', 'REPORTE DE RUTAS', '', 15),
(98, 'REPORTE DE TENDENCIAS DIA', 'REPORTE DE TENDENCIAS DIA', '', 17),
(99, 'REPORTE DE TENDENCIAS SEMANA', 'REPORTE DE TENDENCIAS SEMANA', '', 17),
(100, 'REPORTE DE TENDENCIAS MES', 'REPORTE DE TENDENCIAS MES', '', 17),
(101, 'DEVOLUCIÓN DE SALDO', 'DEVOLUCIÓN DE SALDO', '../credenciales/devolucionSaldo', 7),
(102, 'REPORTE DE DEVOLUCIONES', 'REPORTE DE DEVOLUCIONES', '../credenciales/reporteDevoluciones', 8),
(103, 'REVERSIÓN DE ORDENES DE PEDIDOS', 'REVERSIÓN DE ORDENES DE PEDIDOS', '../ordenpedido/reversionPedidos', 16),
(104, 'ENVÍO DE MENSAJES PARA ACUDIENTES', 'ENVÍO DE MENSAJES PARA ACUDIENTES', '../rutas/enviarmensajeacudientes', 14),
(105, 'REPORTE REVERSION PEDIDOS', 'REPORTE REVERSION PEDIDOS', '../credenciales/reporteReversionPedidos', 24),
(106, 'REPORTE PERMISOS SALIDAS', 'REPORTE PERMISOS SALIDAS', '../credenciales/reportePermisosSalidas', 6),
(107, 'CALENDARIO DE MONITORES EN RUTA', 'CALENDARIO DE MONITORES EN RUTA', '../rutas/calendariomonitores', 26),
(108, 'CALENDARIO DE CONDUCTORES EN RUTA', 'CALENDARIO DE CONDUCTORES EN RUTA', '../rutas/calendarioconductores', 26),
(109, 'CALENDARIO DE VEHICULOS EN RUTA', 'CALENDARIO DE VEHICULOS EN RUTA', '../rutas/calendariovehiculos', 26),
(110, 'BITÁCORA DE RUTA ESCOLAR', 'BITÁCORA DE RUTA ESCOLAR', '../rutas/bitacora', 15),
(111, 'MONITOR RUTA ESCOLAR', 'MONITOR RUTA ESCOLAR', '../rutas/chatMonitor', 27),
(112, 'ACUDIENTES', 'ACUDIENTES', '../rutas/chatAcudiente', 27),
(113, 'ADMINISTRACION DE TURNOS LABORALES', 'ADMINISTRACION DE TURNOS LABORALES', '../turnos_laborales/adminTurnos', 6);

INSERT INTO `servicios_sistema` (`id`, `modulo`, `submodulo`, `accion`) VALUES
(1, 1, 1, 21),
(2, 1, 1, 22),
(3, 1, 1, 23),
(22, 2, 7, 42),
(55, 5, 18, 75),
(56, 5, 18, 76),
(57, 5, 19, 79),
(58, 5, 19, 80),
(59, 5, 19, 77),
(60, 5, 20, 81),
(61, 5, 20, 84),
(75, 5, 17, 92),
(76, 5, 17, 93),
(82, 4, 16, 73),
(83, 1, 1, 24),
(84, 2, 8, 94),
(85, 1, 5, 36),
(86, 1, 2, 26),
(87, 1, 6, 27),
(88, 1, 6, 39),
(89, 3, 11, 49),
(90, 3, 11, 50),
(91, 3, 10, 47),
(92, 3, 10, 48),
(93, 3, 12, 51),
(94, 3, 12, 52),
(95, 2, 7, 101),
(96, 2, 8, 102),
(97, 3, 13, 53),
(98, 3, 13, 54),
(99, 3, 13, 55),
(100, 4, 16, 103),
(101, 3, 15, 66),
(102, 3, 15, 67),
(103, 3, 14, 104),
(104, 1, 6, 106),
(105, 4, 16, 105),
(106, 2, 8, 44),
(107, 3, 26, 107),
(108, 3, 26, 108),
(109, 3, 26, 109),
(110, 3, 15, 110),
(111, 3, 27, 111),
(112, 3, 27, 112),
(113, 1, 6, 113);

INSERT INTO `user_permission` (`id`, `userid`, `service_id`, `registration_date`, `registration_time`, `status`) VALUES
(NULL, 'prueba@ssca.com', 21, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 22, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 23, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 24, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 25, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 26, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 28, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 35, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 29, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 30, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 31, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 32, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 33, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 34, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 36, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 37, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 38, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 27, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 39, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 106, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 113, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 40, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 41, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 42, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 43, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 101, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 44, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 45, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 94, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 102, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 46, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 47, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 48, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 49, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 50, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 51, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 52, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 53, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 54, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 55, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 56, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 65, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 60, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 61, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 62, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 63, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 64, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 104, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 57, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 58, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 59, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 66, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 67, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 68, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 97, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 110, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 73, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 103, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 82, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 83, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 86, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 89, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 90, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 91, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 92, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 93, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 98, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 99, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 100, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 75, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 76, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 77, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 79, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 80, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 81, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 84, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 85, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 87, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 88, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 95, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 105, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 107, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 108, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 109, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 111, CURRENT_DATE, CURRENT_TIME, 'ACTIVO'),
(NULL, 'prueba@ssca.com', 112, CURRENT_DATE, CURRENT_TIME, 'ACTIVO');

INSERT INTO `_carnet` (`ID`, `html_frente`, `fondo_frente`, `html_posterior`, `fondo_posterior`, `estilos`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);