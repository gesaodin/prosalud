--
-- Base de datos: WorkFlow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_actividad`
--

DROP TABLE IF EXISTS `wt_actividad`;
CREATE TABLE IF NOT EXISTS `wt_actividad` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `actividad` varchar(32) NOT NULL,
  `fechaejecucion` date DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_actor`
--

DROP TABLE IF EXISTS `wt_actor`;
CREATE TABLE IF NOT EXISTS `wt_actor` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_dependencia`
--

DROP TABLE IF EXISTS `wt_dependencia`;
CREATE TABLE IF NOT EXISTS `wt_dependencia` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_doc`
--

DROP TABLE IF EXISTS `wt_doc`;
CREATE TABLE IF NOT EXISTS `wt_doc` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_docBase`
--

DROP TABLE IF EXISTS `wt_docBase`;
CREATE TABLE IF NOT EXISTS `wt_docBase` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_docEpecifico`
--

DROP TABLE IF EXISTS `wt_docEpecifico`;
CREATE TABLE IF NOT EXISTS `wt_docEpecifico` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_doctipo`
--

DROP TABLE IF EXISTS `wt_doctipo`;
CREATE TABLE IF NOT EXISTS `wt_doctipo` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_docVariante`
--

DROP TABLE IF EXISTS `wt_docVariante`;
CREATE TABLE IF NOT EXISTS `wt_docVariante` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_ejecucion`
--

DROP TABLE IF EXISTS `wt_ejecucion`;
CREATE TABLE IF NOT EXISTS `wt_ejecucion` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `actividad` varchar(32) NOT NULL,
  `fechacreacion` date DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_estado`
--

DROP TABLE IF EXISTS `wt_estado`;
CREATE TABLE IF NOT EXISTS `wt_estado` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `claseasignacionusuario` varchar(32) NOT NULL,
  `metodoasignacion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_red`
--

DROP TABLE IF EXISTS `wt_red`;
CREATE TABLE IF NOT EXISTS `wt_red` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_rol`
--

DROP TABLE IF EXISTS `wt_rol`;
CREATE TABLE IF NOT EXISTS `wt_rol` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_rolParam`
--

DROP TABLE IF EXISTS `wt_rolParam`;
CREATE TABLE IF NOT EXISTS `wt_rolParam` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `atributodeldoc` varchar(32) NOT NULL,
  `propiedad` varchar(32) NOT NULL,
  `atributo` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_transicion`
--

DROP TABLE IF EXISTS `wt_transicion`;
CREATE TABLE IF NOT EXISTS `wt_transicion` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wt_usuario`
--

DROP TABLE IF EXISTS `wt_usuario`;
CREATE TABLE IF NOT EXISTS `wt_usuario` (
  `oid` int(3) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `palabraclave` varchar(32) NOT NULL,
  `nuevapalabraclave` varchar(32) NOT NULL,
  `confirmacion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
