<?php

/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */
class MPerfilExamenes extends CI_Model {

  /**
   * Tabla del Usuario
   * @var string
   */
  var $tbl = "_tdr_perfil_examenes";

  /**
   * @var string
   */
  var $cedula;
  
 
  /**
   * @var muchos pago
   */
  var $lstafiliacion = array();
  
  function Cargar() {
  } 

  /**
   * Detalles de los monto
   */
  function Listar(){
    $oTable = array();  
    $sConsulta = "SELECT * FROM td_examen_perfil INNER JOIN _tdr_perfil_examenes 
    ON td_examen_perfil.nombre=_tdr_perfil_examenes.perfil GROUP BY perfil";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
					$oTable[$sCla->oid] = $sCla->nombre;	
			}	
		}
		
    $oValor['php'] = $oTable;
    $oValor['json'] = json_encode($oTable);
    return $oValor;
  } 

  function ListarCategoria(){
    $oTable = array();  
    $sConsulta = "SELECT * FROM td_examen_categorias
		INNER JOIN _tdr_perfil_examenes ON td_examen_categorias.nombre = _tdr_perfil_examenes.perfil
		GROUP BY perfil";
		
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
					$oTable[$sCla->oid] = $sCla->nombre;	
			}	
		}
		
    $oValor['php'] = $oTable;
    $oValor['json'] = json_encode($oTable);
    return $oValor;
  } 


	
	function Perfil_Examenes($sPerfil){
		 $sum = 0;
		 $oTable = array();
		 $sConsulta = "SELECT perfil,examen,monto FROM td_examen_perfil INNER JOIN _tdr_perfil_examenes 
	    ON td_examen_perfil.nombre=_tdr_perfil_examenes.perfil 
	 		INNER JOIN td_examenen_lista
	    ON _tdr_perfil_examenes.examen=td_examenen_lista.nombre
		 	WHERE td_examen_perfil.nombre='" . $sPerfil . "' AND tipo='Perfil'";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
					$oTable[$sCla->examen] = $sCla->monto;
					$sum += $sCla->monto; 
			}	
		}
    $oValor['sum'] = number_format($sum,2);
    $oValor['php'] = $oTable;
    return $oValor;
		 
	}
		
	function Categorias_Examenes($sPerfil){
		 $sum = 0;
		 $oTable = array();
		 $sConsulta = "SELECT perfil,examen,monto FROM td_examen_categorias INNER JOIN _tdr_perfil_examenes 
	    ON td_examen_categorias.nombre=_tdr_perfil_examenes.perfil 
	 		INNER JOIN td_examenen_lista
	    ON _tdr_perfil_examenes.examen=td_examenen_lista.nombre
		 	WHERE td_examen_categorias.nombre='" . $sPerfil . "' AND tipo !='Perfil'";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
					$oTable[$sCla->examen] = $sCla->monto;
					$sum += $sCla->monto; 
			}	
		}
    $oValor['sum'] = number_format($sum,2);
    $oValor['php'] = $oTable;
    return $oValor;
		 
	}
	
	
}
?>