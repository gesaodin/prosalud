
--
-- Base de datos: `prosalud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_grupos`
--

DROP TABLE IF EXISTS `td_grupos`;
CREATE TABLE IF NOT EXISTS `td_grupos` (
  `oid` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `monto` decimal(15,3) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_grupos`
--

INSERT INTO `td_grupos` (`oid`, `nombre`, `monto`) VALUES
(1, 'GRUPO 1', 50000.000),
(2, 'GRUPO 2', 50000.000),
(3, 'GRUPO 3', 50000.000),
(4, 'GRUPO 4', 50000.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_patologias`
--

DROP TABLE IF EXISTS `td_patologias`;
CREATE TABLE IF NOT EXISTS `td_patologias` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `define` text NOT NULL,
  PRIMARY KEY (`oid`),
  FULLTEXT KEY `nombre` (`nombre`,`descripcion`,`clave`,`define`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `t_patologias`
--

INSERT INTO `td_patologias` (`oid`, `nombre`, `descripcion`, `clave`, `define`) VALUES
(1, 'LABIO HENDIDO', 'LEPORINO', '', ''),
(2, 'PALADAR HENDIDO', '', '', ''),
(3, 'GRANULOS DE FORDYCE', '', '', ''),
(4, 'MACROGLOSIA', '', '', ''),
(5, 'MICROLOSIA', '', '', ''),
(6, 'FISURA LINGUAL', 'LENGUA CORTADA', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_personas`
--

DROP TABLE IF EXISTS `td_personas`;
CREATE TABLE IF NOT EXISTS `td_personas` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `nacionalidad` char(1) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `sexo` varchar(32) NOT NULL,
  `estadocivil` varchar(32) NOT NULL,
  `tiposangre` varchar(4) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(32) NOT NULL,
  `celular` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`,`cedula`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicios_contratados`
--

DROP TABLE IF EXISTS `td_servicioscontratados`;
CREATE TABLE IF NOT EXISTS `td_servicioscontratados` (
  `oid` int(2) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `t_servicios_contratados`
--

INSERT INTO `td_servicioscontratados` (`oid`, `codigo`, `nombre`) VALUES
(1, 'HCM', 'HOSPITALIZACION CIRUGIA Y MARTENIDAD'),
(2, 'HC', 'HOPITALIZACION Y CIRUGIA'),
(3, 'M', 'MATERNIDAD'),
(4, 'C', 'CIRUGIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sistemas`
--

DROP TABLE IF EXISTS `td_sistemas`;
CREATE TABLE IF NOT EXISTS `td_sistemas` (
  `oid` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `t_sistemas`
--

INSERT INTO `td_sistemas` (`oid`, `nombre`, `descripcion`) VALUES
(1, 'ACCIDENTES', 'TODOS LOS SISTEMAS'),
(2, 'DIGESTIVOS', ''),
(3, 'REPRODUCTOR', ''),
(4, 'GENITO URINARIO', ''),
(5, 'NERVIOSO', 'NO PSIQUIATRICO'),
(6, 'HORMONAL', ''),
(7, 'CARDIOVASCULAR', ''),
(8, 'LINFATICO', ''),
(9, 'RESPIRATORIO', ''),
(10, 'MUSCULO-ESQUELETICO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_subsistemas`
--

DROP TABLE IF EXISTS `td_subsistemas`;
CREATE TABLE IF NOT EXISTS `td_subsistemas` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `t_subsistemas`
--

INSERT INTO `td_subsistemas` (`oid`, `nombre`, `descripcion`) VALUES
(1, 'CAVIDAD ORAL', 'CAVIDAD BUCAL'),
(2, 'ESOFAGO', ''),
(3, 'ESTOMAGO', ''),
(4, 'INTESTINO DELGADO', ''),
(5, 'COLON', ''),
(6, 'HIGADO', ''),
(7, 'VIAS BILIARES', ''),
(8, 'PANCREAS', ''),
(9, 'VESICULA BILIAR', ''),
(10, 'ANO', ''),
(11, 'APENDICE', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_tr_gruposistemas`
--

DROP TABLE IF EXISTS `_tdr_grupossistemas`;
CREATE TABLE IF NOT EXISTS `_tdr_grupossistemas` (
  `oidg` int(11) NOT NULL,
  `oids` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_tr_gruposistemas`
--

INSERT INTO `_tdr_grupossistemas` (`oidg`, `oids`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_tr_sistemassubsistemas`
--

DROP TABLE IF EXISTS `_tdr_sistemassubsistemas`;
CREATE TABLE IF NOT EXISTS `_tdr_sistemassubsistemas` (
  `oids` int(11) NOT NULL,
  `oidb` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_tr_sistemassubsistemas`
--

INSERT INTO `_tdr_sistemassubsistemas` (`oids`, `oidb`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_tr_subsistemapatologias`
--

DROP TABLE IF EXISTS `_tdr_subsistemapatologias`;
CREATE TABLE IF NOT EXISTS `_tdr_subsistemapatologias` (
  `oids` int(11) NOT NULL,
  `oidp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_tr_subsistemapatologias`
--

INSERT INTO `_tdr_subsistemapatologias` (`oids`, `oidp`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);
















ALTER TABLE `wt_docingreso` ADD `descuento` VARCHAR( 32 ) NOT NULL COMMENT 'Descontar Por HCM/G1,2,3,4'



