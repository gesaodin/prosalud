<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MReembolso extends CI_Model {

	var $oid = null;

	/**
	 *
	 */
	var $codigo;

	var $titular;

	var $fechar;

	var $fechaf;

	var $numero;

	var $monto;

	var $concepto;

	var $cubierto;

	var $observacion;

	var $tipo;

	var $dependiente;

	var $nombre;

	var $creador;

	var $autor;

	/**
	 * Confirmado va para Administracion
	 * Cancelado va para Historial
	 */
	function Obtener($sCod, $sMarca) {
		$oFil = array();

		$modelo = "td_reembolso.marca ='" . $sMarca . "'";

		$sConsulta = "SELECT td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,td_reembolso.estatus,
		codigo,titular,fechar,fechaf,numero,SUM(monto) AS mnt,concepto,cubierto,observacion,tipo,dependiente,td_personas.nombre,creador,autor	FROM td_personas
		JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE " . $modelo . " AND td_reembolso.estatus < 2 GROUP BY td_reembolso.codigo  ;";

		$oCabezera[1] = array("titulo" => " ", "tipo" => "detallePost", "atributos" => "width:24px", "funcion" => "NL_Reembolso", "parametro" => "2");
		$oCabezera[2] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 1);
		$oCabezera[3] = array("titulo" => "TITULAR", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[5] = array("titulo" => "CONTRATANTE", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "ESTADO", "atributos" => "width:200px");
		$oCabezera[7] = array("titulo" => "MONTO", "atributos" => "width:80px");
		$oCabezera[8] = array("titulo" => "OBSERVACION", "tipo" => "textArea", "atributos" => "width:200px");
		$oCabezera[9] = array("titulo" => "ESTATUS", "atributos" => "width:80px");
		$oCabezera[10] = array("titulo" => "ACC", //
		"tipo" => "bimagen", //
		"metodo" => "2", //
		"ruta" => __IMG__ . "botones/add.png", //
		"atributos" => "width:20px", //
		"funcion" => "Actualizar_Reem", //
		"mantiene" => 1, //
		"parametro" => "2,8" //
		);

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$estatus = "Procesando";
				switch ($row -> estatus) {
					case '0' :
						//Procesando
						$estatus = "Recepcionado";
						break;
					case '1' :
						//Retenido
						$estatus = "Procesado";
						break;
					case '2' :
						//Confirmado
						$estatus = "Confirmado";
						break;
					case '3' :
						$estatus = "Cancelado";
						break;
					case '4' :
						$estatus = "Improcedente";
						break;
					default :
						$estatus = "Anulado";
						break;
				}

				$oFil[$i++] = array(//
				'1' => '', '2' => $row -> codigo, //
				'3' => $row -> cedula, //
				'4' => $row -> nm, //
				'5' => $row -> contratantes, //
				'6' => $row -> estado, //
				'7' => $row -> mnt, //
				'8' => $row -> observacion, //
				'9' => $estatus, '10' => '');
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Listar($sCod) {
		$oFil = array();
		$sConsulta = "SELECT td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,td_reembolso.estatus,
		codigo,titular,fechar, DATE_ADD(fechar, INTERVAL 30 DAY) AS fap, fechaf,numero,SUM(monto) AS mnt,concepto,cubierto,observacion,tipo,dependiente,td_personas.nombre,creador,autor	FROM td_personas
		JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE td_personas.cedula='" . $sCod . "'
		GROUP BY td_reembolso.codigo;";

		$oCabezera[1] = array("titulo" => " ", "tipo" => "detallePost", "atributos" => "width:24px", "funcion" => "NL_ReembolsoP", "parametro" => "2");
		$oCabezera[2] = array("titulo" => "CODIGO", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "MONTO", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "OBSERVACION", "atributos" => "width:200px");
		$oCabezera[5] = array("titulo" => "ESTATUS", "atributos" => "width:80px");
		$oCabezera[6] = array("titulo" => "APR. PAGO", "atributos" => "width:80px");

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {

				$estatus = "Procesando";
				switch ($row -> estatus) {
					case '0' :
						//Procesando
						$estatus = "Recepcionado";
						break;
					case '1' :
						//Retenido
						$estatus = "Procesado";
						break;
					case '2' :
						//Confirmado
						$estatus = "Confirmado";
						break;
					case '3' :
						$estatus = "Cancelado";
						break;
					case '4' :
						$estatus = "Improcedente";
						break;
					default :
						$estatus = "Anulado";
						break;
				}

				$oFil[$i++] = array(//
				'1' => '', //
				'2' => $row -> codigo, //
				'3' => $row -> mnt, //
				'4' => $row -> observacion, //
				'5' => $estatus, //
				'6' => date("d/m/Y", strtotime($row -> fap)), //
				);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, 'titulo' => 'Listado por reembolso', "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Obtener_Finales($sCod, $sMarca = null) {
		$this -> load -> model("grupo/mpersona", "MPersona");

		$titular = "";
		$oFil = array();
		$tipo = array('Consultas' => 'Consultas', //
		'Laboratorio' => 'Laboratorio', //
		'Hcm' => 'Hcm', 'Estudios Especiales' => 'Estudios Especiales', //
		'Odontologia' => 'Odontologia', //
		'G1' => 'G1', //
		'G2' => 'G2', //
		'G3' => 'G3', //
		'G4' => 'G4' //
		);

		$porcentaje = array('100' => '100', //
		'90' => '90', //
		'80' => '80', //
		'70' => '70', //
		'60' => '60', //
		'50' => '50', //
		'40' => '40', //
		'30' => '30', //
		'20' => '20', //
		'10' => '10'	//
		);

		$sConsulta = "SELECT td_reembolso.oid AS auto, td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,
		codigo,titular,fechar,fechaf,numero, monto,concepto,cubierto,ncubierto,observacion,tipo,tipou,dependiente,
		td_reembolso.nombre,creador,autor,cant,porcentaje
		FROM td_personas JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE td_reembolso.codigo ='" . $sCod[0] . "';";

		//echo $sConsulta;

		$oCabezera[1] = array("titulo" => "", "atributos" => "width:80px", "oculto" => 1);
		$oCabezera[2] = array("titulo" => "FECHA SOLICITUD", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "FECHA FACTURA", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "N. FACTURA", "atributos" => "width:80px");
		$oCabezera[5] = array("titulo" => "CONCEPTO", "tipo" => "texto", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "SOLICITADO", "atributos" => "width:80px");
		$oCabezera[7] = array("titulo" => "APROBADO", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[8] = array("titulo" => "EXCLUSION", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[9] = array("titulo" => "TIPO", "tipo" => "combo", "atributos" => "width:80px");
		$oCabezera[10] = array("titulo" => "CANT", "tipo" => "texto", "atributos" => "width:50px");
		$oCabezera[11] = array("titulo" => "DEPENDIENTE", "tipo" => "combo", "atributos" => "width:200px");
		$oCabezera[12] = array("titulo" => "PORCENTAJE", "tipo" => "combo", "atributos" => "width:80px");
		$oCabezera[13] = array("titulo" => "ACC", //
		"tipo" => "bimagen", //
		"metodo" => "2", //
		"ruta" => __IMG__ . "botones/add.png", //
		"atributos" => "width:20px", //
		"funcion" => "Actualizar_Reembolso", //
		"mantiene" => 1, //
		"parametro" => "1,5,7,8,9,10,11,12" //
		);
		$titulo = "LISTADO DE FACTURAS<br>";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$titular = $row -> cedula;
				$tip = $row -> tipou;

				if ($row -> tipo == "") {
					$tip = "<font color=red>Sin identificar</font>";
				}
				$dep = $row -> dependiente . "|" . $row -> nombre;
				if ($row -> dependiente == "") {
					$dep = "<font color=red>Sin identificar</font>";
				}
				$oFil[$i++] = array(//
				'1' => $row -> auto, //
				'2' => date("d/m/Y", strtotime($row -> fechar)), //
				'3' => date("d/m/Y", strtotime($row -> fechaf)), //
				'4' => $row -> numero, //
				'5' => $row -> concepto, //
				'6' => $row -> monto, //
				'7' => $row -> cubierto, //
				'8' => $row -> ncubierto, //
				'9' => $tip, //
				'10' => $row -> cant, //
				'11' => $dep, //
				'12' => $row -> porcentaje, //
				'13' => ''//
				);
			}
		}
		$Mp = $this -> MPersona -> jsPersona($titular);
		$dependiente = array();
		$i = 0;

		foreach ($Mp['php']['dependiente'] as $sCl => $sVl) {
			$dependiente[$sVl['cedula'] . '|' . $sVl['nombre']] = $sVl['cedula'] . '|' . $sVl['nombre'];
		}
		$dependiente[$titular . '|' . "Mismo Titular"] = $titular . '|Mismo Titular';
		//print_r($dependiente);

		$obj = array('9' => $tipo, '11' => $dependiente, '12' => $porcentaje);
		$leyenda = '
		<table style="width:100%"><tr><td align="left">				
			<button onclick="ImprimirS(\'' . $sCod[0] . '\',\'' . $titular . '\')">Imprimir Recepcion de Facturas</button>
			<button onclick="Retener(\'' . $sCod[0] . '\',\'' . $titular . '\')">Retener Monto</button>
			<button onclick="Improcedente(\'' . $sCod[0] . '\',\'' . $titular . '\')">Improcedente</button>
			<button onclick="Imprimir(\'' . $sCod[0] . '\',\'' . $titular . '\')">Imprimir Reembolso</button>
			<button onclick="Reversar(\'' . $sCod[0] . '\',\'' . $titular . '\')">Reversar Solicitud</button>		
			</td><td style="width:20%" align="right">';

		if ($_SESSION['usuario'] == "luisany" || $_SESSION['usuario'] == "Crash") {
			$leyenda .= '<button onclick="Confirmar(\'' . $sCod[0] . '\',\'' . $titular . '\')">Confirmar Monto del Reembolso</button>';
		} else {
			$leyenda .= '&nbsp;';
		}

		$leyenda .= '
		</td></tr></table><br><br>';
		$oTable = array("Cabezera" => $oCabezera, "Objetos" => $obj, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo, "leyenda" => $leyenda);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Buscar($sClave, $sMarca) {
		$arr = array();
		$tit = array();
		$sConsulta = "SELECT td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,
		consultas,consultas_usadas,laboratorio,laboratorio_usado,
		codigo,titular,fechar,fechaf,numero,monto,monto_familiar,concepto,cobertura_disponible,td_reembolso.porcentaje,td_reembolso.tipou,
		cubierto,ncubierto,observacion,tipo,td_reembolso.dependiente, td_reembolso.nombre AS nmdep,td_personas.nombre,creador,autor,titularc,numeroc,td_reembolso.banco,tipoc,responsable
		FROM td_personas
		JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_afiliacion ON td_personas.cedula = td_afiliacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE td_reembolso.codigo ='" . $sClave . "' AND td_reembolso.marca ='" . $sMarca . "';";

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();

		if ($rs -> num_rows() != 0) {

			$i = 0;
			foreach ($rsC as $row) {
				foreach ($row as $sC => $sV) {
					$arr[$sC] = $sV;
				}
				$tit[$i++] = $arr;
			}
		}
		//$sCon = "SELECT * FROM td_dependiente WHERE cedula='" . $arr['cedula'] . "';";

		return $tit;
	}

	/***
	 * En Caso Personales
	 */
	function Obtener_FinalesP($sCod) {
		$this -> load -> model("grupo/mpersona", "MPersona");

		$titular = "";
		$oFil = array();

		$sConsulta = "SELECT td_reembolso.oid AS auto, td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,
		codigo,titular,fechar,fechaf,numero, monto,concepto,cubierto,observacion,tipo,tipou,dependiente,
		td_reembolso.nombre,creador,autor,cant,porcentaje
		FROM td_personas JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE td_reembolso.codigo ='" . $sCod[0] . "';";

		//echo $sConsulta;

		$oCabezera[1] = array("titulo" => "", "atributos" => "width:80px", "oculto" => 1);
		$oCabezera[2] = array("titulo" => "FECHA SOLICITUD", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "FECHA FACTURA", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "N. FACTURA", "atributos" => "width:80px");
		$oCabezera[5] = array("titulo" => "CONCEPTO", "tipo" => "texto", "atributos" => "width:200px");
		$oCabezera[6] = array("titulo" => "SOLICITADO", "atributos" => "width:80px");
		$oCabezera[7] = array("titulo" => "APROBADO", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[8] = array("titulo" => "TIPO", "tipo" => "combo", "atributos" => "width:80px");
		$oCabezera[9] = array("titulo" => "CANT", "tipo" => "texto", "atributos" => "width:50px");
		$oCabezera[10] = array("titulo" => "DEPENDIENTE", "tipo" => "combo", "atributos" => "width:200px");
		$oCabezera[11] = array("titulo" => "PORCENTAJE", "tipo" => "combo", "atributos" => "width:80px");
		$titulo = "LISTADO DE FACTURAS<br>";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$titular = $row -> cedula;
				$tip = $row -> tipou;

				if ($row -> tipo == "") {
					$tip = "<font color=red>Sin identificar</font>";
				}
				$dep = $row -> dependiente . "|" . $row -> nombre;
				if ($row -> dependiente == "") {
					$dep = "<font color=red>Sin identificar</font>";
				}
				$oFil[$i++] = array(//
				'1' => $row -> auto, //
				'2' => $row -> fechar, //
				'3' => $row -> fechaf, //
				'4' => $row -> numero, //
				'5' => $row -> concepto, //
				'6' => $row -> monto, //
				'7' => $row -> cubierto, //
				'8' => $tip, //
				'9' => $row -> cant, //
				'10' => $dep, //
				'11' => $row -> porcentaje, //
				);
			}
		}
		$Mp = $this -> MPersona -> jsPersona($titular);
		$dependiente = array();
		$i = 0;

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Retener($sClave = null, $titular = null) {
		$msj = "Proceso Exitoso Reembolso Retenido (" . $sClave . ")";
		$sConsulta = "SELECT * FROM td_reembolso WHERE  codigo='" . $sClave . "' AND estatus=0";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {//Dependiente
			$sConsulta = "SELECT * FROM td_reembolso WHERE codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=0 
			AND titular ='" . $titular . "' GROUP BY dependiente";
			$rs = $this -> db -> query($sConsulta);
			$rsC = $rs -> result();
			if ($rs -> num_rows() != 0) {
				foreach ($rsC as $row) {
					if ($titular == $row -> dependiente) {
						//Titular
						$sConsulta = "UPDATE td_afiliacion SET retencion=retencion+
						(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND 
						estatus=0 AND dependiente='" . $titular . "' GROUP BY tipo),
						cobertura_disponible=cobertura_disponible-(SELECT SUM(cubierto*porcentaje/100)  FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND 
						estatus=0 AND dependiente='" . $titular . "' GROUP BY tipo) WHERE cedula='" . $titular . "'";
						$this -> db -> query($sConsulta);
					} else {
						$sConsulta = "UPDATE td_dependientes SET retenido=retenido+
						(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' 
						AND estatus=0 AND dependiente='" . $row -> dependiente . "'	GROUP BY tipo),
						monto=monto-(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' 
						AND estatus=0 AND dependiente='" . $row -> dependiente . "'	GROUP BY tipo)		WHERE cedula='" . $row -> dependiente . "'";
						$this -> db -> query($sConsulta);
					}
				}
			}
			// $sConsulta = "UPDATE td_afiliacion SET laboratorio=laboratorio-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=0 GROUP BY tipo) WHERE cedula='" . $titular . "'";
			// $this -> db -> query($sConsulta);
			// $sConsulta = "UPDATE td_afiliacion SET consultas=consultas-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Consultas' AND estatus=0  GROUP BY tipo) WHERE cedula='" . $titular . "'";
			// $this -> db -> query($sConsulta);
			//
			
			/**
			 * Retención por estudios Especiales
			 */
			$sConsulta = "UPDATE td_afiliacion SET EE=EE-IFNULL((SELECT SUM(cubierto) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo LIKE 'Estudios%' AND estatus=0 GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
			$this -> db -> query($sConsulta);
			
			
			$sConsulta = "UPDATE td_afiliacion SET laboratorio=laboratorio-IFNULL((SELECT SUM(cant) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=0 GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
			$this -> db -> query($sConsulta);
			$sConsulta = "UPDATE td_afiliacion SET consultas=consultas-IFNULL((SELECT SUM(cant) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo='Consultas' AND estatus=0 GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
			$this -> db -> query($sConsulta);
			$sConsulta = "UPDATE td_reembolso SET estatus = 1 WHERE  codigo='" . $sClave . "'";
			$this -> db -> query($sConsulta);
		} else {
			$msj = "No se pudo rentener Reembolso ya esta en otro estado  (" . $sClave . ")";
		}

		return $msj;
	}

	function Confirmar($sClave = null, $titular = null) {
		$msj = "Proceso Exitoso Reembolso Confirmado (" . $sClave . ")";
		$sConsulta = "SELECT * FROM td_reembolso WHERE  codigo='" . $sClave . "' AND estatus=1";

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {

			$sConsulta = "SELECT * FROM td_reembolso WHERE codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1
			AND titular ='" . $titular . "' GROUP BY dependiente";
			//$msj .= $sConsulta;

			$rs = $this -> db -> query($sConsulta);
			$rsC = $rs -> result();
			if ($rs -> num_rows() != 0) {
				foreach ($rsC as $row) {

					if ($titular == $row -> dependiente) {
						$sConsulta = "UPDATE td_afiliacion SET 
						retencion=retencion-(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND 
						estatus=1 AND dependiente='" . $titular . "' GROUP BY tipo)	WHERE  
						cedula='" . $titular . "'";
						$this -> db -> query($sConsulta);
					} else {
						$sConsulta = "UPDATE td_dependientes SET 
						retenido=retenido-(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' 
						AND estatus=1 AND dependiente='" . $row -> dependiente . "'	GROUP BY tipo)
						WHERE cedula='" . $row -> dependiente . "'";
						$this -> db -> query($sConsulta);
					}

				}
			}

			// $sConsulta = "UPDATE td_afiliacion SET
			// laboratorio=laboratorio-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=1 GROUP BY tipo),
			// laboratorio_usado=laboratorio_usado-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=1 GROUP BY tipo)
			// WHERE cedula='" . $titular . "' AND laboratorio_usado!=0";
			// $this -> db -> query($sConsulta);
			//
			// $sConsulta = "UPDATE td_afiliacion SET
			// consultas=consultas-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Consultas' AND estatus=1  GROUP BY tipo),
			// consultas_usadas=consultas_usadas-(SELECT SUM(cant) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Consultas' AND estatus=1  GROUP BY tipo)
			// WHERE cedula='" . $titular . "' AND consultas_usadas!=0";
			// $this -> db -> query($sConsulta);

			$sConsulta = "UPDATE td_reembolso SET estatus = 2 WHERE  codigo='" . $sClave . "'";
			$this -> db -> query($sConsulta);

		} else {
			$msj = "No se puede Confirmar Verifique que se haya retenido (" . $sClave . ")";
		}
		return $msj;
	}

	function Reversar($sClave = null, $titular = null) {
		$msj = "Proceso Exitoso Reembolso Reversado (" . $sClave . ")";
		$estatus = 0;

		$sConsulta = "SELECT * FROM td_reembolso WHERE  codigo='" . $sClave . "'";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {

			$estatus = $rsC[0] -> estatus;
			//Dependiente
			$sConsulta = "SELECT * FROM td_reembolso WHERE codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1 
			AND titular ='" . $titular . "' GROUP BY dependiente";
			$rss = $this -> db -> query($sConsulta);
			$rsCs = $rs -> result();
			if ($rss -> num_rows() != 0) {
				foreach ($rsCs as $row) {

					if ($titular == $row -> dependiente) {
						if ($estatus == 1) {
							//Retenido
							$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-
							(SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND 
							estatus=1 AND dependiente='" . $titular . "' GROUP BY tipo),
							cobertura_disponible=cobertura_disponible+(SELECT SUM(cubierto*porcentaje/100)
							FROM td_reembolso	WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1 AND 
							dependiente='" . $titular . "' GROUP BY tipo) WHERE cedula='" . $titular . "' AND retencion !=0";

							$this -> db -> query($sConsulta);

						} elseif ($estatus == 2) {
							//Confirmar
							$sConsulta = "UPDATE td_afiliacion SET cobertura_disponible=cobertura_disponible+(SELECT SUM(cubierto*porcentaje/100)	
							FROM td_reembolso WHERE  
							codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1  AND dependiente='" . $titular . "' GROUP BY tipo) 
							WHERE cedula='" . $titular . "' AND retencion !=0";
							$this -> db -> query($sConsulta);
						}
					} else {
						if ($estatus == 1) {
							//Retenido
							$sConsulta = "UPDATE td_dependientes SET 
							retenido=retenido-(SELECT SUM(cubierto) FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' 
							AND estatus=1 AND dependiente='" . $row -> dependiente . "'	GROUP BY tipo), monto=monto+(SELECT SUM(cubierto*porcentaje/100)
							FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1  AND dependiente='" . $row -> dependiente . "' GROUP BY tipo) 
							WHERE cedula='" . $row -> dependiente . "' AND retenido !=0";
							$this -> db -> query($sConsulta);
						} elseif ($estatus == 2) {
							//Confirmar
							$sConsulta = "UPDATE td_dependientes SET monto=monto+(SELECT SUM(cubierto*porcentaje/100)
							FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1  AND dependiente='" . $row -> dependiente . "' GROUP BY tipo) 
							WHERE cedula='" . $row -> dependiente . "' AND retenido !=0";
							$this -> db -> query($sConsulta);
						}

					}

					$dependiente[] = $row -> dependiente;

				}
			}

			// //Cambios al Titular
			// if ($estatus == 1) {
			// //Retenido...
			// $sConsulta = "UPDATE td_afiliacion SET laboratorio=laboratorio+IFNULL((SELECT SUM(cant) FROM td_reembolso
			// WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=1 GROUP BY tipo),0)
			// WHERE cedula='" . $titular . "' AND laboratorio_usado != 0";
			// $this -> db -> query($sConsulta);
			// $sConsulta = "UPDATE td_afiliacion SET consultas=consultas+IFNULL((SELECT SUM(cant) FROM td_reembolso
			// WHERE  codigo='" . $sClave . "' AND tipo='Consulta' AND estatus=1 GROUP BY tipo),0)
			// WHERE cedula='" . $titular . "' AND consultas_usadas != 0";
			// $this -> db -> query($sConsulta);
			// } elseif ($estatus == 2) {
			// //Confirmado....
			if ($estatus != 0) {
				$sConsulta = "UPDATE td_afiliacion SET EE=EE+IFNULL((SELECT SUM(cubierto) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo LIKE 'Estudios%' AND estatus=" . $estatus . " GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);			
				
				$sConsulta = "UPDATE td_afiliacion SET laboratorio=laboratorio+IFNULL((SELECT SUM(cant) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=" . $estatus . " GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);
				$sConsulta = "UPDATE td_afiliacion SET consultas=consultas+IFNULL((SELECT SUM(cant) FROM td_reembolso 
					WHERE  codigo='" . $sClave . "' AND tipo='Consultas' AND estatus=" . $estatus . " GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);
				// }
				$sConsulta = "UPDATE td_reembolso SET estatus = 0 WHERE  codigo='" . $sClave . "'";
				$this -> db -> query($sConsulta);

			} else {
				$msj = "Ya se encuentra reversado  (" . $sClave . ")";
			}
		} else {
			$msj = "No se pudo Reversar Reembolso ya esta en otro estado  (" . $sClave . ")";
		}
		return $msj;
	}

	function Anular($sClave = null, $titular = null) {
		$msj = "Proceso Exitoso Reembolso Anulacion (" . $sClave . ")";
		$estatus = 0;

		$sConsulta = "SELECT * FROM td_reembolso WHERE  codigo='" . $sClave . "'";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {

			$estatus = $rsC[0] -> estatus;

			//Dependiente

			$sConsulta = "SELECT * FROM td_reembolso WHERE codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=0 
			AND dependiente !='" . $titular . "' GROUP BY dependiente";
			$rss = $this -> db -> query($sConsulta);
			$rsCs = $rs -> result();
			if ($rss -> num_rows() != 0) {
				foreach ($rsCs as $row) {

					if ($estatus == 1) {
						//Retenido

					} elseif ($estatus == 2) {
						//Confirmar

					}
					//Retenido
					$sConsulta = "UPDATE td_dependientes SET retenido=retenido-(SELECT SUM(cubierto*porcentaje/100) 
					FROM td_reembolso  WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1 AND dependiente='" . $row -> dependiente . "' 
					GROUP BY tipo, dependiente) WHERE cedula='" . $row -> dependiente . "'";
					$this -> db -> query($sConsulta);
					//Confirmado
					$sConsulta = "UPDATE td_dependientes SET retenido=retenido-(SELECT SUM(cubierto*porcentaje/100) 
					FROM td_reembolso  WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=2 AND dependiente='" . $row -> dependiente . "' 
					GROUP BY tipo, dependiente) WHERE cedula='" . $row -> dependiente . "'";
					$this -> db -> query($sConsulta);
					//Retenido
					$sConsulta = "UPDATE td_dependientes SET monto=monto-(SELECT SUM(cubierto*porcentaje/100) 
					FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1  AND dependiente='" . $row -> dependiente . "' GROUP BY tipo) 
					WHERE cedula='" . $row -> dependiente . "' AND retenido !=0";
					$this -> db -> query($sConsulta);
					//Confirmado
					$sConsulta = "UPDATE td_dependientes SET monto=monto-(SELECT SUM(cubierto*porcentaje/100) 
					FROM td_reembolso WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=2  AND dependiente='" . $row -> dependiente . "' GROUP BY tipo) 
					WHERE cedula='" . $row -> dependiente . "' AND retenido !=0";
					$this -> db -> query($sConsulta);

					$dependiente[] = $row -> dependiente;

				}
			}

			//Cambios al Titular
			if ($estatus == 1) {
				//Retenido...

				$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-IFNULL((SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=1 AND dependiente='" . $titular . "' GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);

				$sConsulta = "UPDATE td_afiliacion SET laboratorio_usado=laboratorio_usado-IFNULL((SELECT SUM(cant) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=1 GROUP BY tipo),0) 
				WHERE cedula='" . $titular . "' AND laboratorio_usado != 0";
				$this -> db -> query($sConsulta);
				$sConsulta = "UPDATE td_afiliacion SET consultas_usadas=consultas_usadas-IFNULL((SELECT SUM(cant) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Consulta' AND estatus=1 GROUP BY tipo),0) 
				WHERE cedula='" . $titular . "' AND consultas_usadas != 0";
				$this -> db -> query($sConsulta);
			} elseif ($estatus == 2) {
				//Confirmado....

				$sConsulta = "UPDATE td_afiliacion SET cobertura_disponible=cobertura_disponible+IFNULL((SELECT SUM(cubierto*porcentaje/100) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Hcm' AND estatus=2 AND dependiente='" . $titular . "' GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);

				$sConsulta = "UPDATE td_afiliacion SET laboratorio=laboratorio+IFNULL((SELECT SUM(cant) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Laboratorio' AND estatus=2 GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$this -> db -> query($sConsulta);
				$sConsulta = "UPDATE td_afiliacion SET consultas=consultas+IFNULL((SELECT SUM(cant) FROM td_reembolso 
				WHERE  codigo='" . $sClave . "' AND tipo='Consulta' AND estatus=2 GROUP BY tipo),0) WHERE cedula='" . $titular . "'";
				$msj .= $sConsulta;
				$this -> db -> query($sConsulta);
			}

			$sConsulta = "UPDATE td_reembolso SET estatus = 3 WHERE  codigo='" . $sClave . "'";
			$this -> db -> query($sConsulta);
		} else {
			$msj = "No se pudo rentener Reembolso ya esta en otro estado  (" . $sClave . ")";
		}
		return $msj;
	}

	function Improcedente($sClave) {
		$msj = "Proceso Exitoso Improcedente (" . $sClave . ")";
		$sConsulta = "UPDATE td_reembolso SET estatus = 4 WHERE  codigo='" . $sClave . "'";
		$this -> db -> query($sConsulta);
		return $msj;
	}

	function ObtenerPendientesTentativos() {
		$oFil = array();

		$sConsulta = "SELECT td_personas.cedula, 
		td_personas.nombre AS nm,contratantes,estado,ciudad,cargo,profesion,telefono,td_reembolso.estatus,
		codigo,titular,fechar,fechaf,numero,SUM(monto) AS mnt,concepto,cubierto,observacion,tipo,dependiente,td_personas.nombre,creador,autor,
		DATE_ADD(fechar, INTERVAL 30 DAY) AS fap,marca	FROM td_personas
		JOIN td_personascontratantes ON td_personas.cedula = td_personascontratantes.oid
		JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_reembolso ON td_personas.cedula = td_reembolso.titular
		WHERE td_reembolso.estatus < 2 GROUP BY td_reembolso.codigo  ORDER BY fechar;";

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px");
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "ESTATUS", "atributos" => "width:80px");
		$oCabezera[5] = array("titulo" => "TIPO", "atributos" => "width:80px");
		$oCabezera[6] = array("titulo" => "F.SOLC", "atributos" => "width:80px");
		$oCabezera[7] = array("titulo" => "F.APROX", "atributos" => "width:80px");

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$estatus = "Procesando";
				switch ($row -> estatus) {
					case '0' :
						//Procesando
						$estatus = "Recepcionado";
						break;
					case '1' :
						//Retenido
						$estatus = "Procesado";
						break;
					case '2' :
						//Confirmado
						$estatus = "Confirmado";
						break;
					case '3' :
						$estatus = "Cancelado";
						break;
					case '4' :
						$estatus = "Improcedente";
						break;
					default :
						$estatus = "Anulado";
						break;
				}

				$oFil[$i++] = array(//
				'1' => $row -> codigo, //
				'2' => $row -> cedula, //
				'3' => $row -> nm, //
				'4' => $estatus, //
				'5' => $row -> marca, //
				'6' => date("d/m/Y", strtotime($row -> fechar)), //
				'7' => date("d/m/Y", strtotime($row -> fap)) //
				);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

}
?>