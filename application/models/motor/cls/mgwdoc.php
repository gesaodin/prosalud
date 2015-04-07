<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MGWDoc extends CI_Model {

	var $oid = null;

	/**
	 *
	 */
	var $codigo;

	var $cedula_titular;

	var $cedula_beneficiario;

	var $centro;

	var $analista;

	var $motivo;

	var $tratamiento;

	var $fecha;

	var $hora;

	var $tipo_ingreso;

	var $estado;

	var $ciudad;

	var $responsable;

	var $tipos;

	var $tipoi;

	var $tipot;

	var $diagnostico;

	var $observacion;

	var $fechae;

	function getCodigo() {
		return $this -> codigo;
	}

	function setCodigo($sCod) {
		$sCod = $this -> Completar($sCod, 7);
		$sConsulta = "SELECT codigo FROM td_semilla WHERE codigo='" . $sCod . "' LIMIT 1";
		$rsC = $this -> db -> query($sConsulta);
		if ($rsC -> num_rows() != 0) {
			$sCod = $this -> Completar(rand(), 7);
			$this -> setCodigo($sCod);
		} else {
			$this -> db -> query('INSERT INTO td_semilla (oid, codigo) VALUES (NULL, \'' . $sCod . '\');');
		}
		$this -> codigo = $sCod;

	}

	/**
	 * Completar con ceros a la izquierda...
	 *
	 */
	function Completar($strCadena = '', $intLongitud = '') {
		$strContenido = '';
		$strAux = '';
		$intLen = strlen($strCadena);
		if ($intLen != $intLongitud) {
			$intCount = $intLongitud - $intLen;
			for ($i = 0; $i < $intCount; $i++) {
				$strAux .= '0';
			}
			$strContenido = $strAux . $strCadena;
		}
		return $strContenido;
	}

	function Obtener($sCod, $val) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$oFil = array();
		$imp = '';
		$txt = '';
		$codigo = '';

		switch ($sCod) {
			case 0 :
				$codigo = 'wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 1 :
				$codigo = 'wt_estadoejecucion.estado >= 1 AND wt_estadoejecucion.estado <= 2 AND wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 2 :
				$codigo = 'wt_estadoejecucion	.estado = 2 AND wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 3 :
				$codigo = 'wt_estadoejecucion.estado = 3';
				break;
			default :
				break;
		}

		$sConsulta = 'SELECT td_personas.nombre, wt_doc.codigo, wt_estadoejecucion.estado, 
		cedula_titular, cedula_beneficiario, motivo, wt_doc.tratamiento, wt_doc.centro, wt_doc.tipos,
		wt_docegreso.montoc
		FROM wt_doc JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
		LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula
		LEFT JOIN wt_docegreso ON  wt_doc.codigo=wt_docegreso.codigo		
		WHERE  ' . $codigo . ' AND wt_doc.modulo=\'' . $val . '\';';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 1);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "DEPENDIENTE", "atributos" => "width:80px");
		$oCabezera[5] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "ESTATUS", "atributos" => "width:80px");
		if ($sCod != 3) {
			$oCabezera[7] = array("titulo" => "MOTIVO", "atributos" => "width:250px");
			$oCabezera[8] = array("titulo" => "OBSERVACION", "atributos" => "width:250px");
		} else {
			$oCabezera[7] = array("titulo" => "CENTRO", "atributos" => "width:250px");
			$oCabezera[8] = array("titulo" => "MONTO", "atributos" => "width:70px");
		}

		$imprimir = "IMP";
		switch ($sCod) {
			case 0 :
				if ($val == 1) {
					$txt = "Ingreso";
					$fn = "Ingreso";
					$fnA = "Modificar_Hcm";
					$imp = "Imprimir_Solicitud";
				} else {
					$txt = "Verificacion";
					$fn = "Verificacion_Usuario";
					$fnA = "Modificar_Hcm";
					$imp = "Imprimir_Solicitud";
				}
				break;
			case 1 :
				$txt = "Egreso";
				$fn = "Egreso";
				$fnA = "Ingreso";
				$imp = "Imprimir_Ingreso";
				break;
			case 2 :
				$txt = "Pendientes";
				$fn = "Egresos_Pendientes";
				$imp = "Imprimir_Egreso";
				$fnA = "Egreso";
				break;
			case 3 :
				$imprimir = "VER";
				$txt = "Confirmar";
				$fn = "Confirmar_HCM";
				$imp = "Imprimir_Confirmar";
				break;
			default :
				$fn = "Ingreso";
				break;
		}

		if ($sCod != 3) {
			if ($val == 0) {
				$oCabezera[9] = array(//
				"titulo" => $txt, //
				"tipo" => "bimagen", //
				"ruta" => __IMG__ . "botones/add.png", //
				"atributos" => "width:20px", //
				"funcion" => $fn, //
				"parametro" => "1,2,4,13"//
				);
			} else {
				$oCabezera[9] = array("titulo" => $txt, //
				"tipo" => "enlace", //
				"metodo" => "2", //
				"ruta" => __IMG__ . "botones/add.png", //
				"atributos" => "width:20px", //
				"funcion" => $fn, //
				"parametro" => "1,2,4,13", //
				"target" => "_self" //
				);
			}
		} else {
			$oCabezera[9] = array(//
			"titulo" => $txt, //
			"tipo" => "bimagen", //
			"ruta" => __IMG__ . "botones/add.png", //
			"atributos" => "width:20px", //
			"funcion" => $fn, //
			"parametro" => "1,2,4,13"//
			);
		}

		if ($sCod < 3) {
			$oCabezera[10] = array("titulo" => "MOD", //
			"tipo" => "enlace", //
			"metodo" => "2", //
			"ruta" => __IMG__ . "botones/error.png", //
			"atributos" => "width:20px", //
			"funcion" => $fnA, //
			"parametro" => "1,2,4,12", //
			"target" => "_self" //
			);
		} else {
			$oCabezera[10] = array("titulo" => "MOD", "oculto" => 1);
		}

		$oCabezera[11] = array("titulo" => $imprimir, //
		"tipo" => "enlace", //
		"metodo" => 2, //
		"ruta" => __IMG__ . "botones/print.png", //
		"atributos" => "width:20px", //
		"funcion" => $imp, //
		"parametro" => "1,12", //
		"target" => "_blank");
		$oCabezera[12] = array("titulo" => "MARCA", "atributos" => "width:80px", "oculto" => 1);
		$oCabezera[13] = array("titulo" => "TIPO", "atributos" => "width:80px");

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$estado = 'Solicitud';
				switch ($row->estado) {
					case 1 :
						$estado = 'Ingreso';
						break;
					case 2 :
						$estado = 'Egreso';
						break;
					case 3 :
						$estado = 'Por Confirmar';
						break;
					default :
						break;
				}
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);

				if ($sCod == 3) {
					$oFil[$i++] = array(//
					'1' => $row -> codigo, //
					'2' => $row -> cedula_titular, //
					'3' => $row -> nombre, //
					'4' => $row -> cedula_beneficiario, //
					'5' => $this -> MPersona -> nombre, //
					'6' => $estado, //
					'7' => $row -> centro, //
					'8' => number_format($row -> montoc, 2, ",", ".") . ' Bs.', //
					'9' => "", //
					'10' => "", //
					'11' => "", //
					'12' => $val, //
					'13' => $row -> tipos);
				} else {
					if ($sCod == 1 && $row -> tipos == "Ambulatorio") {
						//Caso Especial
					} else {
						$oFil[$i++] = array(//
						'1' => $row -> codigo, //
						'2' => $row -> cedula_titular, //
						'3' => $row -> nombre, //
						'4' => $row -> cedula_beneficiario, //
						'5' => $this -> MPersona -> nombre, //
						'6' => $estado, //
						'7' => $row -> motivo, //
						'8' => $row -> tratamiento, //
						'9' => "", //
						'10' => "", //
						'11' => "", //
						'12' => $val, //
						'13' => $row -> tipos //
						);
					}
				}

			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Obtener_Finales($sCod) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$fn = "Realizar_Descuento";
		$oFil = array();
		$sConsulta = '
		SELECT td_personas.nombre, wt_doc.codigo, wt_estadoejecucion.estado, cedula_titular, cedula_beneficiario, motivo, tratamiento
		FROM wt_doc
		JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
		LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula
		WHERE wt_estadoejecucion.estado =' . $sCod;

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px");
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:200px");
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "DEPENDIENTE", "atributos" => "width:100px");
		$oCabezera[5] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "MOTIVO", "atributos" => "width:25px");
		$oCabezera[7] = array("titulo" => "CONF", "tipo" => "bimagen", "funcion" => "", "parametro" => "1,2,4", "ruta" => __IMG__ . "botones/aceptar1.png");

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				$oFil[$i++] = array('1' => $row -> codigo, //
				'2' => $row -> cedula_titular, //
				'3' => $row -> nombre, //
				'4' => $row -> cedula_beneficiario, //
				'5' => $this -> MPersona -> nombre, //
				'6' => $row -> motivo, //
				'7' => "");
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	/**
	 * sBeneficiario Beneficiario
	 * $tipo 1 titular 2 dependiente
	 */
	function Listar_Casos($sBeneficiario) {

		$oFil = array();

		$sCon = 'SELECT td_personas.nombre, wt_doc.codigo, wt_estadoejecucion.estado, 
		cedula_titular, cedula_beneficiario, motivo, wt_doc.tratamiento, wt_doc.centro, wt_doc.tipos,
		wt_docegreso.montoc, wt_doc.fecha, wt_doc.modulo
		FROM wt_doc JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
		LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula
		LEFT JOIN wt_docegreso ON  wt_doc.codigo=wt_docegreso.codigo		
		WHERE  wt_doc.cedula_beneficiario=\'' . $sBeneficiario . '\';';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px");
		$oCabezera[2] = array("titulo" => "MOTIVO", "atributos" => "width:200px");
		$oCabezera[3] = array("titulo" => "SOLICITUD", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "TIPO", "atributos" => "width:100px");
		$oCabezera[5] = array("titulo" => "ESTATUS", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "IMP", "atributos" => "width:20px", "tipo" => "enlace", //
		"metodo" => 2, //
		"ruta" => __IMG__ . "botones/print.png", //
		"funcion" => 'Imprimir_Todos', //
		"parametro" => "1,5,7", //
		"target" => "_blank");

		$oCabezera[7] = array("titulo" => "MOD", "atributos" => "width:200px", 'oculto' => 1);

		$rs = $this -> db -> query($sCon);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {

				$estado = 'Solicitud';
				switch ($row->estado) {
					case 1 :
						$estado = 'Ingreso';
						break;
					case 2 :
						$estado = 'Egreso';
						break;
					case 3 :
						$estado = 'Por Confirmar';
						break;
					case 4 :
						$estado = 'Pagado';
						break;
					default :
						break;
				}

				$oFil[$i++] = array('1' => $row -> codigo, //
				'2' => $row -> motivo, //
				'3' => date("d/m/Y", strtotime($row -> fecha)), //
				'4' => $row -> tipos, //
				'5' => $estado, //
				'6' => '', //
				'7' => $row -> modulo //
				);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, 'titulo' => 'listado por hcm', "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;

	}

	function Cantidad() {
		$oFil = 0;
		$sConsulta = 'SELECT COUNT(wt_doc.codigo) AS cod FROM wt_doc 
		JOIN wt_estadoejecucion ON wt_doc.codigo=wt_estadoejecucion.codigo
		WHERE wt_estadoejecucion.estado=0';
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$oFil = $row -> cod;
			}
		}
		return $oFil;
	}

	function Buscar($sClave) {
		$arr = array();
		$tit = "";
		$Pregunta = "SELECT * FROM wt_doc WHERE wt_doc.codigo='" . $sClave . "';";
		$rs = $this -> db -> query($Pregunta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$titular = $row -> cedula_titular;
				$beneficiario = $row -> cedula_beneficiario;
				if ($titular == $beneficiario) {
					$arr['vinculo'] = "U.T";
					$tit = "U.T";
				} else if ($beneficiario == '') {
					$tit = "U.T";
				} else {
					$this -> load -> model("grupo/mdependiente", "MDependiente");
					$this -> MDependiente -> titular = $row -> cedula_beneficiario;
					$a = $this -> MDependiente -> Dependo();
					$arr['vinculo'] = $a['parentesco'];
					$tit = "U.D";
				}
			}

		}
		$sConsulta = "";
		if ($tit == 'U.D') {
			$sConsulta = "SELECT A.codigo, A.telefono, 
			A.cedula_titular AS ced, td_personas.nombre AS ndep, cedula_beneficiario, A.nombre AS nm, A.eject,  A.motivo, tratamiento,
			A.fecha,A.fechae, A.hora, A.ciudad, A.estado, parentesco, A.analista, A.centro, A.c, A.e, A.contratantes, A.responsable, emision,
			tipos,tipot,tipoi,A.observacion
			FROM td_personas
			JOIN (
			SELECT td_personas.nombre, td_personas.telefono, wt_doc.codigo, wt_estadoejecucion.estado AS eject, cedula_titular, cedula_beneficiario, 
			motivo, tratamiento,
			wt_doc.fecha,wt_doc.fechae, wt_doc.hora,td_personasubicacion.ciudad,td_personasubicacion.estado, wt_doc.analista,wt_doc.centro, wt_doc.observacion,
			wt_doc.ciudad AS c, wt_doc.estado AS e, contratantes,
			wt_doc.responsable,emision,
			tipos,tipot,tipoi
			FROM wt_doc
			JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
			LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula		 
			JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
			JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
			WHERE wt_doc.codigo ='" . $sClave . "') AS A ON A.cedula_beneficiario = td_personas.cedula
			JOIN td_dependientes ON td_dependientes.cedula=td_personas.cedula";
		} else {
			$sConsulta = "SELECT td_personas.nombre AS nm, td_personas.telefono, wt_doc.codigo, wt_estadoejecucion.estado AS eject, 
			cedula_titular AS ced, cedula_beneficiario, motivo, tratamiento, wt_doc.observacion,
			wt_doc.fecha, wt_doc.fechae, wt_doc.hora,td_personasubicacion.ciudad,td_personasubicacion.estado, wt_doc.analista,wt_doc.centro, 
			wt_doc.ciudad AS c, wt_doc.estado AS e, contratantes,
			wt_doc.responsable, emision, tipos,tipot,tipoi
			FROM wt_doc
			JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
			LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula		 
			JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
			JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
			WHERE wt_doc.codigo ='" . $sClave . "';";

		}
		$arr['parentescofamiliar'] = $tit;
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				foreach ($row as $sC => $sV) {
					$arr[$sC] = $sV;
				}
				if ($tit == 'U.T') {$arr['ndep'] = $row -> nm;
				}
				$arr['parentesco'] = "U.T";
			}

		}

		return $arr;
	}

	function ObtenerDoc($sCod) {
		$sConsulta = "SELECT * FROM wt_doc WHERE codigo=" . $sCod . " LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
			}
		}
		return $lst;
	}

	function ObtenerCE($sCod, $val) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$oFil = array();
		$imp = '';
		$txt = '';
		$codigo = '';

		switch ($sCod) {
			case 0 :
				$codigo = 'wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 1 :
				$codigo = 'wt_estadoejecucion.estado >= 1 AND wt_estadoejecucion.estado <= 2 AND wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 2 :
				$codigo = 'wt_estadoejecucion	.estado = 2 AND wt_estadoejecucion.estado !=3 AND wt_estadoejecucion.estado !=4';
				break;
			case 3 :
				$codigo = 'wt_estadoejecucion.estado = 3';
				break;
			default :
				break;
		}

		$sConsulta = 'SELECT td_personas.nombre, wt_doc.codigo, wt_estadoejecucion.estado, 
		cedula_titular, cedula_beneficiario, motivo, wt_doc.tratamiento, wt_doc.centro, wt_doc.tipos,
		wt_docegreso.montoc
		FROM wt_doc JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
		LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula
		LEFT JOIN wt_docegreso ON  wt_doc.codigo=wt_docegreso.codigo		
		WHERE  ' . $codigo . ' AND wt_doc.modulo=\'' . $val . '\';';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 1);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "DEPENDIENTE", "atributos" => "width:80px");
		$oCabezera[5] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "ESTATUS", "atributos" => "width:80px");
		$oCabezera[7] = array("titulo" => "OBSERVACION", "atributos" => "width:250px");
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$estado = 'Solicitud';
				switch ($row->estado) {
					case 1 :
						$estado = 'Ingreso';
						break;
					case 2 :
						$estado = 'Egreso';
						break;
					case 3 :
						$estado = 'Por Confirmar';
						break;
					default :
						break;
				}
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				$oFil[$i++] = array(//
				'1' => $row -> codigo, //
				'2' => $row -> cedula_titular, //
				'3' => $row -> nombre, //
				'4' => $row -> cedula_beneficiario, //
				'5' => $this -> MPersona -> nombre, //
				'6' => $estado, //
				'7' => $row -> tratamiento //

				);

			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	/**
	 * Recepcion de las Facturas...
	 *
	 */
	function Recepcion_HCM($sCentro = null) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$oFil = array();
		$sConsulta = 'SELECT td_personas.nombre, wt_doc.codigo, wt_estadoejecucion.estado, 
		cedula_titular, cedula_beneficiario, motivo, wt_doc.tratamiento, wt_doc.centro, 
		wt_doc.tipos,	wt_docegreso.montoc,wt_docegreso.fechas, wt_docegreso.fechaingreso,
		wt_docegreso.diagnostico
		FROM wt_doc JOIN wt_estadoejecucion ON wt_doc.codigo = wt_estadoejecucion.codigo
		LEFT JOIN td_personas ON wt_doc.cedula_titular = td_personas.cedula
		LEFT JOIN wt_docegreso ON  wt_doc.codigo=wt_docegreso.codigo		
		WHERE  wt_estadoejecucion.estado = 3 AND wt_docegreso.centro like \'%' . $sCentro . '%\';';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:60px", "buscar" => 1);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:50px");
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:150px");
		$oCabezera[4] = array("titulo" => "DEPENDIENTE", "atributos" => "width:50px");
		$oCabezera[5] = array("titulo" => "NOMBRE", "atributos" => "width:150px");
		$oCabezera[6] = array("titulo" => "F. INGRESO", "atributos" => "width:50px");
		$oCabezera[7] = array("titulo" => "F. EGRESO", "atributos" => "width:50px");
		$oCabezera[8] = array("titulo" => "MONTO", "atributos" => "width:40px", "total" => 1);
		$oCabezera[9] = array("titulo" => "ACC", "atributos" => "width:20px", "tipo" => "enlace", //
		"metodo" => 1, //
		"ruta" => __IMG__ . "botones/add.png", //
		"funcion" => 'Asociar_Factura', //
		"parametro" => "1,2,3,8", //
		"target" => "_blank");
		
		$oCabezera[10] = array("titulo" => "DIAGNOSTICO", "oculto" => 1);

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "Listado de Contratantes...";
		if ($rs -> num_rows() != 0) {
			$i = 0;
			foreach ($rsC as $row) {
				$link = "<a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Confirmar/" .$row -> codigo . "/1' target='_blank'>" . $row -> codigo . "</a>";
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				$oFil[$i++] = array(//
					'1' => $link, //
					'2' => $row -> cedula_titular, //
					'3' => $row -> nombre, //
					'4' => $row -> cedula_beneficiario, //
					'5' => $this -> MPersona -> nombre, //
					'6' => date("d/m/Y", strtotime($row ->fechaingreso)), //
					'7' => date("d/m/Y", strtotime($row ->fechas)), //
					'8' => $row -> montoc, //
					'9' => '', //
					'10'=> $row->diagnostico //
				);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;

	}

	/**
	 * Recepcion de las Facturas...
	 *
	 */
	function Cuentas_Por_Pagar($sCentro = null, $tipo = null) {

		$oFil = array();
		$rif = "";
		$nche = 'AND nche =\'\'';
		if($tipo == 1){$nche = 'AND nche !=\'\'';}
		$sConsulta = 'SELECT *,sum(isrl) as impuesto, sum(mpp) as pronto, sum(mtot) AS pendiente 
		FROM `td_rfactura` JOIN td_proveedores ON td_rfactura.clin=td_proveedores.nombre 
		WHERE clin=\'' . $sCentro . '\'' . $nche . ' GROUP BY frec';

		//echo $sConsulta;
		/**			**/
		$oCabezera[1] = array("titulo" => "RIF", "atributos" => "width:80px", "oculto" => 1);
		$oCabezera[2] = array("titulo" => "NOMBRE", "atributos" => "width:200px", "oculto" => 1);
		$oCabezera[3] = array("titulo" => "FECHA", "atributos" => "width:50px");
		$oCabezera[4] = array("titulo" => "MONTO COMP.", "atributos" => "width:50px");
		$oCabezera[5] = array("titulo" => "I.S.R.L", "atributos" => "width:50px");
		$oCabezera[6] = array("titulo" => "P. PAGO", "atributos" => "width:50px");
		$oCabezera[7] = array("titulo" => "MONTO TOTAL", "atributos" => "width:50px", "total" => 1);

		if($tipo == 1){
			$oCabezera[8] = array("titulo" => "RIF", "atributos" => "width:80px", "oculto" => 1);
		}else{
			$oCabezera[8] = array("titulo" => "ACC", "atributos" => "width:20px", "tipo" => "enlace", //
			"metodo" => 1, //
			"ruta" => __IMG__ . "botones/aceptar1.png", //
			"funcion" => 'Asociar_Cheques', //
			 "atributos" => "width:20px",
			"parametro" => "1,2,3,7", //
			"target" => "_blank",
			);
			
		}

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		 
		if ($rs -> num_rows() != 0) {
			$i = 0;
			$rif = $rsC[0]->rif;  
			foreach ($rsC as $row) {
					
				$oFil[$i++] = array(//
				'1' => $row -> rif, //
				'2' => $row -> nombre, //
				'3' => $row -> frec, //
				'4' => $row -> mcom, //
				'5' => $row -> impuesto, //
				'6' => $row -> pronto, //
				'7' => $row -> pendiente, //
				'8' => '');
			}
		}
		
		$titulo = "CENTRO: " . $sCentro . " RIF: " . $rif;
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
		/**/

	}

/**
 * @param Banco
 * @param Fecha
 * @param Numero de Cheque
 */
function Listar_Relacion_Cheque($sB, $sF, $sN){
		$lista = array();	
		$relacion = array();
		$this -> load -> model("grupo/mpersona", "MPersona");

		$sConsulta = "SELECT * FROM td_rfactura
		LEFT JOIN wt_docegreso ON td_rfactura.clav=wt_docegreso.codigo
		WHERE frec='" . $sF . "' AND bnc='" . $sB . "' AND nche='" . $sN . "'";
		//echo $sConsulta; 
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
				$obj = $sCla;
				
				$this -> MPersona -> Cargar($sCla->beneficiario);
				$relacion['bnf'] = $this -> MPersona -> nombre;
				$relacion['caso'] = $sCla->tipos;
				foreach ($obj as $sC => $sV) {
					$relacion[$sC] = $sV;	
				}
				$lista[] = $relacion;				
			}	
		}
		$valor['php'] = $lista;
		return $valor;
}

}
?>