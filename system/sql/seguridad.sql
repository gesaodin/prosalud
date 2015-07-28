-- --------------------------------------------------------

--
-- Table structure for table `t_perfil`
--

DROP TABLE IF EXISTS `ts_perfil`;
CREATE TABLE IF NOT EXISTS `ts_perfil` (
  `oid` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_privilegios`
--

DROP TABLE IF EXISTS `ts_privilegios`;
CREATE TABLE IF NOT EXISTS `ts_privilegios` (
  `oid` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `descripcion` char(64) NOT NULL,
  `clase` varchar(32) NOT NULL,
  `metodo` varchar(32) NOT NULL,
  `accion` varchar(32) NOT NULL,
  `funcion` varchar(32) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_ubicacion`
--

DROP TABLE IF EXISTS `ts_ubicacion`;
CREATE TABLE IF NOT EXISTS `ts_ubicacion` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_usuario`
--

DROP TABLE IF EXISTS `ts_usuario`;
CREATE TABLE IF NOT EXISTS `ts_usuario` (
  `oid` int(2) NOT NULL,
  `documento_id` int(11) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  `seudonimo` varchar(32) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `fecha` datetime NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `conectado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `_tr_perfilprivilegios`
--

DROP TABLE IF EXISTS `_tsr_perfilprivilegios`;
CREATE TABLE IF NOT EXISTS `_tsr_perfilprivilegios` (
  `oidp` int(2) NOT NULL,
  `oidb` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tr_usuariolinaje`
--

DROP TABLE IF EXISTS `_tsr_usuariolinaje`;
CREATE TABLE IF NOT EXISTS `_tsr_usuariolinaje` (
  `oidu` int(2) NOT NULL,
  `oidl` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tr_usuarioperfil`
--

DROP TABLE IF EXISTS `_tsr_usuarioperfil`;
CREATE TABLE IF NOT EXISTS `_tsr_usuarioperfil` (
  `oidu` int(2) NOT NULL,
  `oidp` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tr_usuarioubicacion`
--

DROP TABLE IF EXISTS `_tsr_usuarioubicacion`;
CREATE TABLE IF NOT EXISTS `_tsr_usuarioubicacion` (
  `oidu` int(2) NOT NULL,
  `oidb` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tr_usuariousuario`
--

DROP TABLE IF EXISTS `_tsr_usuariousuario`;
CREATE TABLE IF NOT EXISTS `_tsr_usuariousuario` (
  `oidu` int(2) NOT NULL,
  `oidb` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
