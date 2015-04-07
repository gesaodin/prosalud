<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MPerfil extends CI_Model {
  
  public $tbl = 'ts_pefil';
  
  public $oid;
  
  
  public $nombre;
   
  public $descripcion;
  

  function __construct() {
    parent::Model();
  }

}
?>