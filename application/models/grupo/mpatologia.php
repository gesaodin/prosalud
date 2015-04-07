<?php
/**
 * 
    SELECT *
    FROM td_patologias
    JOIN _tdr_subsistemapatologias ON td_patologias.oid = _tdr_subsistemapatologias.oidp
    JOIN td_subsistemas ON _tdr_subsistemapatologias.oids = td_subsistemas.oid
    JOIN _tdr_sistemassubsistemas ON td_subsistemas.oid = _tdr_sistemassubsistemas.oidb
    JOIN td_sistemas ON _tdr_sistemassubsistemas.oids = td_sistemas.oid
    JOIN _tdr_grupossistemas ON td_sistemas.oid = _tdr_grupossistemas.oids
    JOIN td_grupos ON _tdr_grupossistemas.oidg = td_grupos.oid
    WHERE MATCH (
    td_patologias.nombre, td_patologias.descripcion, td_patologias.clave, td_patologias.define
    )
    AGAINST (
    'LABIO HENDIDO'
    )
 */

?>