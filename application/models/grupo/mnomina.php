<?php


/**
 * Cargar nominas load data
 * 
 	LOAD DATA LOCAL INFILE 'Q-01fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
 
  	LOAD DATA LOCAL INFILE 'Q-02fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
  
  	LOAD DATA LOCAL INFILE 'Q-03fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
  
  	LOAD DATA LOCAL INFILE 'Q-04fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
 
 	LOAD DATA LOCAL INFILE 'Q-05fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
 
  	LOAD DATA LOCAL INFILE 'Q-06fetra.csv'
  INTO TABLE td_personasnominas
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,quincena,monto);
 * 
 *   
 */

 /**
  * DELIMITER //
CREATE TRIGGER d_personasubicacion BEFORE DELETE ON td_personasubicacion 
 FOR EACH ROW BEGIN
 	DELETE FROM td_personascontratantes WHERE oid=OLD.cedula;
 END //
   	LOAD DATA LOCAL INFILE 'fetra2.csv'
  INTO TABLE td_personasubicacion
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(cedula,ubicacion,telefono_trabajo,correo,ciudad,estado,colectivo,cargo,profesion,estatus);
 
     	LOAD DATA LOCAL INFILE 'contratantes.csv'
  INTO TABLE td_personascontratantes
  FIELDS TERMINATED BY ','
 	LINES TERMINATED BY '\n'
 	(oid,contratantes); 
  
  *  */
 
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */
class MNomina extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_personasnominas";

	/**
	 * @var string
	 */
	var $cedula;

	/**
	 * @var int
	 */
	var $quincena;

	/**
	 * @var decimal(10,2)
	 */
	var $monto;

	/**
	 * @var decimal(10,2)
	 */
	var $deposito;

	/**
	 * @var muchos pago
	 */
	var $lstnomina = array();

	function Cargar() {
	}

	/**
	 * Detalles de los monto
	 */
	function Buscar() {
		$oFil = array();
		$oCabezera[1] = array("titulo" => "QUINCENAS", "atributos" => "width:80px");
		$oCabezera[2] = array("titulo" => "MONTO", "atributos" => "width:150px");
		$oCabezera[3] = array("titulo" => "DESCRIPCION DEPOSITOS", "atributos" => "width:250px");
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE cedula='" . $this -> cedula . "'";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "CUOTA TOTAL MENSUAL A PAGAR : (" . $rsC[0] -> monto . " Bs.)<br><br>";
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$oFil[$i++] = array('1' => $row -> quincena, '2' => $row -> monto, '3' => $row -> deposito);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Listar_Titulares($arr) {
		$oFil = array();
		
		if($arr['est'] == '0'){
			$arr['est'] = '%';
		}
		$activo = ' ORDER BY td_personas.cedula';
		if($arr['estatus'] != 'Todos'){
			$activo = ' AND activo = \'' . $arr['estatus'] . '\' ORDER BY td_personas.cedula';
		}
		
		
		$sConsulta = '
			SELECT td_personas.cedula, nombre, td_personas.fecha,(YEAR(CURDATE())-YEAR(td_personas.fecha)) - (RIGHT(CURDATE(),5)<RIGHT(td_personas.fecha,5)) AS edad, 
			cobertura,cobertura_disponible,retencion,consultas-consultas_usadas AS CU,laboratorio-laboratorio_usado AS LU, activo, fecha_activacion,contratantes,estado
			FROM td_personas
			RIGHT JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
			JOIN td_afiliacion ON td_personas.cedula = td_afiliacion.cedula
			LEFT JOIN td_personascontratantes ON td_personasubicacion.cedula = td_personascontratantes.oid
			WHERE estado LIKE \'' . $arr['est'] . '\' AND contratantes = \'' . $arr['con'] . '\'' . $activo;

		$oCabezera[1] = array("titulo" => " ", "tipo" => "detallePost", "atributos" => "width:24px", "funcion" => "NL_Dependientes", "parametro" => "2");
		$oCabezera[2] = array("titulo" => "CEDULA", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "FECHA", "atributos" => "width:120px");
		$oCabezera[5] = array("titulo" => "EDAD", "atributos" => "width:25px");
		$oCabezera[6] = array("titulo" => "ESTADO", "atributos" => "width:25px");
		$oCabezera[7] = array("titulo" => "COBERTURA", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[8] = array("titulo" => "DISPONIBLE", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[9] = array("titulo" => "RETENCION", "tipo" => "texto", "atributos" => "width:80px", "total" => 1);
		$oCabezera[10] = array("titulo" => "CONSULTA", "tipo" => "texto", "atributos" => "width:50px");
		$oCabezera[11] = array("titulo" => "LABOTARIO", "tipo" => "texto", "atributos" => "width:50px");
		$oCabezera[12] = array("titulo" => "ESTATUS", "tipo" => "texto", "atributos" => "width:25px");
		if ( $_SESSION['usuario'] == "luisany" || $_SESSION['usuario'] == "Crash" ) {
			$oCabezera[13] = array(
				"titulo" => " ", // 
				"tipo" => "bimagen", // 
				"funcion" => "Actualizar_Cobertura", // 
				"parametro" => "2,7,8,9,10,11,12", //
				"atributos" => "width:24px", //
				"ruta" => __IMG__ . "botones/aceptar1.png" //
			);
		} else {
			$oCabezera[13] = array("titulo" => " ", "oculto" => 1);
		}

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "Contratante " . $arr['con'] . " Del Estado " . $arr['est'] . "<br><br>";

		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$etiqueta1 = "";
				$etiqueta2 = "";
				if ($row -> activo == 0) {
					$etiqueta1 = "<font color=red>";
					$etiqueta2 = "</font>";
				}
				$oFil[$i++] = array(
				'1' => '',  //
				'2' => $etiqueta1 . $row -> cedula . $etiqueta2,  //
				'3' => $etiqueta1 . $row -> nombre . $etiqueta2,  //
				'4' => $etiqueta1 . $row -> fecha . $etiqueta2,  //
				'5' => $etiqueta1 . $row -> edad . $etiqueta2,  //
				'6' => $etiqueta1 . $row -> estado . $etiqueta2,  //
				'7' => $etiqueta1 . $row -> cobertura . $etiqueta2,  //
				'8' => $etiqueta1 . $row -> cobertura_disponible . $etiqueta2,  //
				'9' => $row -> retencion,  //
				'10' => $etiqueta1 . $row -> CU . $etiqueta2,  //
				'11' => $etiqueta1 . $row -> LU . $etiqueta2,  //
				'12' => $etiqueta1 . $row -> activo . $etiqueta2,  //
				'13' => '');
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Listar_Dependientes($arr) {
		$oFil = array();
		$sConsulta = '
			SELECT td_personas.cedula, nombre, td_personas.fecha,(YEAR(CURDATE())-YEAR(td_personas.fecha)) - (RIGHT(CURDATE(),5)<RIGHT(td_personas.fecha,5)) AS edad,
			monto,retenido, estatus, parentesco FROM td_personas
			JOIN td_dependientes ON td_personas.cedula = td_dependientes.cedula
			WHERE titular=\'' . $arr[0] . '\'';

		$oCabezera[1] = array("titulo" => "CEDULA", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[2] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[3] = array("titulo" => "FECHA", "atributos" => "width:120px");
		$oCabezera[4] = array("titulo" => "EDAD", "atributos" => "width:25px");
		$oCabezera[5] = array("titulo" => "PARENTESCO", "atributos" => "width:100px");
		$oCabezera[6] = array("titulo" => "DISPONIBLE", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[7] = array("titulo" => "RETENCION", "tipo" => "texto", "atributos" => "width:80px");
		$oCabezera[8] = array("titulo" => "ESTATUS", "tipo" => "texto", "atributos" => "width:25px");
		//luisany
		if ( $_SESSION['usuario'] == "luisany" || $_SESSION['usuario'] == "Crash") {
			$oCabezera[9] = array( //
				"titulo" => " ", //
				"tipo" => "bimagen", // 
				"funcion" => "Actualizar_Dependientes", // 
				"parametro" => "1,6,7,8", //
				"atributos" => "width:24px", // 
				"ruta" => __IMG__ . "botones/aceptar1.png" //
			);
		} else {
			$oCabezera[9] = array("titulo" => " ", "oculto" => 1);
		}

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "<br>";

		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$etiqueta1 = "";
				$etiqueta2 = "";
				if ($row -> estatus == 0) {
					$etiqueta1 = "<font color=red>";
					$etiqueta2 = "</font>";
				}
				$oFil[$i++] = array('1' => $etiqueta1 . $row -> cedula . $etiqueta2, //
				'2' => $etiqueta1 . $row -> nombre . $etiqueta2, //
				'3' => $etiqueta1 . $row -> fecha . $etiqueta2, //
				'4' => $etiqueta1 . $row -> edad . $etiqueta2, //
				'5' => $etiqueta1 . $row -> parentesco . $etiqueta2, //
				'6' => $etiqueta1 . $row -> monto . $etiqueta2, //
				'7' => $etiqueta1 . $row -> retenido . $etiqueta2, //
				'8' => $etiqueta1 . $row -> estatus . $etiqueta2, //
				'9' => '');
			}
		}
		$leyenda = "<br>";
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo, "leyenda" => $leyenda);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}
	
		

	/**
	 * Define Valores del Orden
	 */
	function _Def_Valores($sCed = null){
		$sC = 'SELECT * FROM td_pagos LEFT JOIN td_personasnominas ON td_pagos.quincena=td_personasnominas.quincena WHERE td_personasnominas.cedula=\'' . $sCed . '\'';
		$rs = $this -> db -> query($sC);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {	
			foreach ($rsC as $row) {
				
			}
		}
	}
	
	
	
	function EstadisticasServicios($arr) {
		
	
		
		
		if($arr['estatus'] == 0){
			return $this->EstadisticasHCM($arr);
		}elseif($arr['estatus'] == 1)  {
			return $this->EstadisticasConsultas($arr);			
		}else {
			$this->EstadisticasLaboratorio($arr);
		}		
				
	
	}
	
	
	function EstadisticasHCM($arr){
		$oFil = array();
		$sConsulta = "SELECT *, wt_doc.fecha as Afecha FROM wt_doc
				INNER JOIN td_personas ON wt_doc.cedula_titular=td_personas.cedula
				INNER JOIN td_personasubicacion ON td_personas.cedula=td_personasubicacion.cedula
				INNER JOIN td_personascontratantes ON td_personas.cedula=td_personascontratantes.oid
				WHERE
				td_personasubicacion.estado='" . $arr['est'] . "' AND
				td_personascontratantes.contratantes='" . $arr['con'] . "' AND
				wt_doc.fecha BETWEEN '" . $arr['desde'] . "' AND '" . $arr['hasta'] . "'";
		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "BENEFICIARIO", "atributos" => "width:200px");
		$oCabezera[5] = array("titulo" => "CENTRO", "atributos" => "width:120px");
		$oCabezera[6] = array("titulo" => "TRATAMIENTO", "atributos" => "width:400px");
		$oCabezera[7] = array("titulo" => "TIPO SERVICIO", "atributos" => "width:25px");
		$oCabezera[8] = array("titulo" => "FECHA", "atributos" => "width:45px");
		
		
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "<br><br>";
		
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
		
				$oFil[$i++] = array(
						'1' => $row -> codigo,  //
						'2' =>  $row -> cedula,  //
						'3' => $row -> cedula_beneficiario,  //
						'4' => $row -> nombre,  //
						'5' => $row -> centro,  //
						'6' => $row -> tratamiento,  //
						'7' => $row -> tipos,
						'8' => $row -> Afecha
				);
			}
		}
		
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}
	
	function EstadisticasConsultas($arr){
		$oFil = array();
		$sConsulta = "SELECT *, wt_doccon.fecha as Afecha FROM wt_doccon
				INNER JOIN td_personas ON wt_doccon.cedula_titular=td_personas.cedula
				INNER JOIN td_personasubicacion ON td_personas.cedula=td_personasubicacion.cedula
				INNER JOIN td_personascontratantes ON td_personas.cedula=td_personascontratantes.oid
				WHERE
				td_personasubicacion.estado='" . $arr['est'] . "' AND
				td_personascontratantes.contratantes='" . $arr['con'] . "' AND
				wt_doccon.fecha BETWEEN '" . $arr['desde'] . "' AND '" . $arr['hasta'] . "'";
		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "BENEFICIARIO", "atributos" => "width:200px");
		$oCabezera[5] = array("titulo" => "CENTRO", "atributos" => "width:120px");
		$oCabezera[6] = array("titulo" => "ESPECIALIDAD", "atributos" => "width:400px");		
		$oCabezera[7] = array("titulo" => "FECHA", "atributos" => "width:45px");
		
		
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "<br><br>";
		
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
		
				$oFil[$i++] = array(
						'1' => $row -> codigo,  //
						'2' =>  $row -> cedula,  //
						'3' => $row -> cedula_beneficiario,  //
						'4' => $row -> nombre,  //
						'5' => $row -> centro,  //
						'6' => $row -> especialidad,  //						
						'7' => $row -> Afecha
				);
			}
		}
		
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}
	
	function EstadisticasLaboratorio($arr){
		$oFil = array();
		$sConsulta = "SELECT *, wt_doclab.fecha as Afecha FROM wt_doclab
				INNER JOIN td_personas ON wt_doclab.cedula_titular=td_personas.cedula
				INNER JOIN td_personasubicacion ON td_personas.cedula=td_personasubicacion.cedula
				INNER JOIN td_personascontratantes ON td_personas.cedula=td_personascontratantes.oid
				WHERE
				td_personasubicacion.estado='" . $arr['est'] . "' AND
				td_personascontratantes.contratantes='" . $arr['con'] . "' AND
				wt_doclab.fecha BETWEEN '" . $arr['desde'] . "' AND '" . $arr['hasta'] . "'";
		
		
		
		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:80px");
		$oCabezera[4] = array("titulo" => "BENEFICIARIO", "atributos" => "width:200px");
		$oCabezera[5] = array("titulo" => "CENTRO", "atributos" => "width:120px");
		$oCabezera[6] = array("titulo" => "EXAMENES", "atributos" => "width:400px");		
		$oCabezera[7] = array("titulo" => "COSTO", "atributos" => "width:45px");
		$oCabezera[8] = array("titulo" => "CANTIDAD", "atributos" => "width:45px");
		$oCabezera[9] = array("titulo" => "FECHA", "atributos" => "width:45px");
		
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "<br><br>";
		
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
		
				$oFil[$i++] = array(
						'1' => $row -> codigo,  //
						'2' =>  $row -> cedula,  //
						'3' => $row -> cedula_beneficiario,  //
						'4' => $row -> nombre,  //
						'5' => $row -> centro,  //
						'6' => $row -> examenes,  //
						'7' => $row -> costo,  //
						'8' => $row -> cantidad,  //
						'9' => $row -> Afecha
				);
			}
		}
		
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}
	

}
?>