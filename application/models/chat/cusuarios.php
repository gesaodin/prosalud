<?php
/*
 */

class CUsuarios extends CI_Model {

	public $lstUsr;

	public $usuario;


	/**
	 * Listar Tareas Pendientes del Usuario
	 *
	 * @param $user | object WUsuario
	 * @return array | Lista de Tareas
	 */
	public function Usuarios_Conectados_Chat($sUsr) {
		$data0 = "";
		$usuario_chat = '';
		$query = "SELECT * FROM ts_usuario
		JOIN _tsr_usuarioperfil ON _tsr_usuarioperfil.oidu = ts_usuario.oid
		WHERE ts_usuario.conectado = 1 AND seudonimo != '$sUsr'";
		$rsConsulta = $this -> db -> query($query);
		$usuario_chat .= '<ul style="lista_chat">';
		if ($rsConsulta -> num_rows() > 0) {
			foreach ($rsConsulta->result() as $Consulta_Usuario) {				
				$ruta_imagen = BASEPATH . "img/usuarios/" . trim($Consulta_Usuario -> seudonimo) . ".png";
				if (file_exists($ruta_imagen)) {
					$ruta_imagen = __IMG__ . "usuarios/" . trim($Consulta_Usuario -> seudonimo) . ".png";
				} else {
					$ruta_imagen = __IMG__ . "usuarios/default.jpg";
				}
				$usuario_chat .= '<li><a href="javascript:void(0)" 
						ondblclick="javascript:chatWith(\'' . $Consulta_Usuario -> seudonimo . '\',\'' . __LOCALWWW__ . '\');">' . $Consulta_Usuario -> seudonimo . '
							<div><center>
    							<table width="350">
									<tr>
										<td align="right" colspan="2"><b>' . $Consulta_Usuario -> descripcion . '</b>
											<hr style="border:1px dotted #DFD9C3; width:auto" />
										</td>
									</tr>
									<tr>
										<td rowspan="2">
											<center><img src="' . $ruta_imagen . '" style="width:70px;border: 1px solid #fff;" /></center>
										</td>
									</tr>
									<tr><td></td></tr>
								</table>
    							<br><br>
    							</center>   							
    						</div>
						</a></li>';


			}
			$data0 = $usuario_chat . "</ul>";

		} else {
			$data0 = "<br>Ningun Usuario...";
		}

		return $data0;
	}

}
?>
