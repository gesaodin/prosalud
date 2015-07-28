<?php

class MProveedor extends CI_Model {

	var $tbl = "td_proveedores";
	var $oid = null;
	var $estado;
	var $ciudad;
	var $tipo;
	var $nombre;
	var $rif;
	var $direccion;
	var $telefono;

	function Listar( $arr) {
		$tipo = array(//
		'CLINICA' => 'CLINICA', //
		'LBORATORIO' => 'LABORATORIO', //
		'APS' => 'APS',
		'MEDICO ESPECIALISTA' => 'MEDICO ESPECIALISTA'
		);
		$estatus = array(//
		'ACTIVO' => 'ACTIVO', //
		'INACTIVO' => 'INACTIVO' //
		);
		$oFil = array();
		$oCabezera[1] = array("titulo" => "", "atributos" => "width:80px", "oculto" => 1);
		$oCabezera[2] = array("titulo" => "ESTADO", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "CIUDAD", "tipo" => "texto", "atributos" => "width:80px", "buscar" => 0);
		$oCabezera[4] = array("titulo" => "TIPO", "tipo" => "combo", "atributos" => "width:150px");
		$oCabezera[5] = array("titulo" => "NOMBRE", "tipo" => "texto", "atributos" => "width:250px", "buscar" => 0);
		$oCabezera[6] = array("titulo" => "RIF", "tipo" => "texto", "atributos" => "width:250px");
		$oCabezera[7] = array("titulo" => "DIRECCION", "tipo" => "texto", "atributos" => "width:250px");
		$oCabezera[8] = array("titulo" => "TELEFONO", "tipo" => "texto");
		$oCabezera[9] = array("titulo" => "FAX", "tipo" => "texto");
		$oCabezera[10] = array("titulo" => "CORREO", "tipo" => "texto");
		$oCabezera[11] = array("titulo" => "BANCO", "tipo" => "texto");
		$oCabezera[12] = array("titulo" => "CUENTA", "tipo" => "texto");
		$oCabezera[13] = array("titulo" => "PRS. CONTACTO", "tipo" => "texto");
		$oCabezera[14] = array("titulo" => "ESTATUS", "tipo" => "combo", "atributos" => "width:80px");
		$oCabezera[15] = array( //
			"titulo" => "ACC", //
			"tipo" => "bimagen", // 
			"metodo" => "2", //
			"ruta" => __IMG__ . "botones/add.png", // 
			"atributos" => "width:20px", //
			"funcion" => "Actualizar_Proveedores", // 
			"mantiene" => 1, //
			"parametro" => "1,3,4,5,6,7,8,9,10,11,12,13,14" //
		);
		if ($_SESSION['usuario'] == "Oswaldo" || $_SESSION['usuario'] == "Crash" || $_SESSION['usuario'] == "anaisbiaggi") {
			$oCabezera[16] = array(
				"titulo" => " ", "tipo" => "bimagen", // 
				"funcion" => "Eliminar_Proveedor", //
				"parametro" => "1", //
				"atributos" => "width:24px", // 
				"ruta" => __IMG__ . "botones/quitar.png" //
			);
		} else {
			$oCabezera[16] = array("titulo" => " ", "oculto" => 1);
		}
		
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE estado = '" . $arr['est'] . "' AND estatus = '" . $arr['tipo'] . "'  ORDER BY estado";
		if($arr['tipo'] == 'TODOS'){
			$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE estado = '" . $arr['est'] . "' ORDER BY estado";
			
		}
		
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "Listado de Proveedores En General...";
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$etiqueta1 = "";
				$etiqueta2 = "";
				if ($row -> estatus == "INACTIVO") {
					$etiqueta1 = "<font color=red>";
					$etiqueta2 = "</font>";
				}
				
				$oFil[$i++] = array(//
				'1' => $etiqueta1 . $row -> oid . $etiqueta2, //
				'2' => $etiqueta1 . trim($row -> estado) . $etiqueta2, //
				'3' => $etiqueta1 . trim($row -> ciudad) . $etiqueta2, //
				'4' => $etiqueta1 . trim($row -> tipo) . $etiqueta2, //
				'5' => $etiqueta1 . trim($row -> nombre) . $etiqueta2, //
				'6' => $etiqueta1 . trim($row -> rif) . $etiqueta2, //
				'7' => $etiqueta1 . trim($row -> direccion) . $etiqueta2, //
				'8' => $etiqueta1 . trim($row -> telefono) . $etiqueta2, //
				'9' => $etiqueta1 . trim($row -> fax) . $etiqueta2, //
				'10' => $etiqueta1 . trim($row -> correo) . $etiqueta2, //
				'11' => $etiqueta1 . trim($row -> banco) . $etiqueta2, //
				'12' => $etiqueta1 . trim($row -> cuenta) . $etiqueta2, //
				'13' => $etiqueta1 . trim($row -> personacontacto) . $etiqueta2, //
				'14' => $etiqueta1 . trim($row -> estatus) . $etiqueta2, //
				'15' => '', //
				'16' => ''//
				);
			}
		}
		$Objeto = array("4" => $tipo, "14" => $estatus);
		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Objetos" => $Objeto, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}


	function Actualizar($arr, $oid){
		$this->db->where("oid", $oid);
		$this->db->update("td_proveedores",  $arr);	
		
	}

}

?>
