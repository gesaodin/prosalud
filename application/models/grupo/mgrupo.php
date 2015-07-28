<?php
/**
 * EXPLAIN SELECT t_patologias.nombre, t_patologias.descripcion
FROM `t_grupos`
JOIN _tr_gruposistemas ON t_grupos.oid = _tr_gruposistemas.oidg
JOIN t_sistemas ON _tr_gruposistemas.oids = t_sistemas.oid
JOIN _tr_sistemassubsistemas ON t_sistemas.oid = _tr_sistemassubsistemas.oids
JOIN t_subsistemas ON _tr_sistemassubsistemas.oidb = t_subsistemas.oid
JOIN _tr_subsistemapatologias ON t_subsistemas.oid = _tr_subsistemapatologias.oids
JOIN t_patologias ON _tr_subsistemapatologias.oidp = t_patologias.oid
WHERE t_grupos.oid =2 AND t_subsistemas.oid=1 AND t_patologias.descripcion='LEPORINO'
 */
 ?>
