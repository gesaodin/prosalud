
DROP TABLE IF EXISTS wt_rol ;
CREATE TABLE IF NOT EXISTS wt_rol (
	 nombre CHAR (32) NOT NULL,
	 descripcion CHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610, primery key (oid) ;

DROP TABLE IF EXISTS wt_estado ;
CREATE TABLE IF NOT EXISTS wt_estado (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
 	 claseasignacionusuario VARCHAR (32) NOT NULL,
     metodoasignacion  VARCHAR(32) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_actividad ;
CREATE TABLE IF NOT EXISTS wt_actividad (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
	 actividad VARCHAR (32) NOT NULL,
	 fechaejecucion DATE,
  
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_actor ;
CREATE TABLE IF NOT EXISTS wt_actor (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_dependencia ;
CREATE TABLE IF NOT EXISTS wt_dependencia (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_doc ;
CREATE TABLE IF NOT EXISTS wt_doc (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_docBase ;
CREATE TABLE IF NOT EXISTS wt_docBase (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_docEspecifico;
CREATE TABLE IF NOT EXISTS wt_docEpecifico (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_doctipo ;
CREATE TABLE IF NOT EXISTS wt_doctipo (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_docVariante ;
CREATE TABLE IF NOT EXISTS wt_docVariante (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_ejecucion ;
CREATE TABLE IF NOT EXISTS wt_ejecucion (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
	 actividad VARCHAR(32) NOT NULL,
	 fechacreacion DATE.
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_red ;
CREATE TABLE IF NOT EXISTS wt_red (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
	 transicion VARCHAR (32) NOT NULL,
	 estado VARCHAR (32) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_rolParam ;
CREATE TABLE IF NOT EXISTS wt_rolParam (
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
	 atributodeldoc VARCHAR (32) NOT NULL,
	 propiedad VARCHAR (32) NOT NULL,
	 atributo VARCHAR (32) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_transicion ;
CREATE TABLE IF NOT EXISTS wt_transiciom(
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);

DROP TABLE IF EXISTS wt_usuario ;
CREATE TABLE IF NOT EXISTS wt_usuario(
	 nombre  VARCHAR (32) NOT NULL,
	 descripcion VARCHAR (32) NOT NULL,
	 oid INT (3) NOT NULL,
	 login VARCHAR (32) NOT NULL,
	 palabraclave VARCHAR (32) NOT NULL,
	 nuevapalabraclave VARCHAR (32) NOT NULL,
	 confirmacion VARCHAR (32) NOT NULL, 
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1610  primery key (oid);


  





