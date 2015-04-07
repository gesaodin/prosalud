<html>
<head>
	<!-- 
		/*
		 *  @author Carlos Enrique Peña Albarrán
		 *  Modificado por: Mauricio Barrios
		 *  @package prosalud.system.application
		 *  @version 1.0.0
		 */
	-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo __TITLE__ ?></title>
	<meta name="keywords" content="GrupoProsalud" >
	<meta name="description" content="Grupo ProSalud, te da la oportunidad de: Consultar historial de pagos, Imprimir Constancias."/> 
	<link rel='stylesheet' href='<?php echo __CSS__ ?>login.css'>
	<link type="text/css" href="<?php echo __CSS__ ?>ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

 	</script>
	</head>
	<body>
<div class="capa">

<input type="hidden" id="dest_uri" value="/" />

<div id="login-wrapper" class="login-whisp">
    <div id="notify">
        <div id='login-status' class="error-notice" style="visibility: hidden">
            <span class='login-status-icon'></span>
            <div id="login-status-message">Ha finalizado la sesión</div>
        </div>
    </div>

    <div style="display:none">
        <div id="locale-container" style="visibility:hidden">
            <div id="locale-inner-container">
                <div id="locale-map">
                    <div class="scroller clear">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content-container">
        <div id="login-container">
            <div id="login-sub-container">
                <div id="login-sub-header">
                    <img src="<?php echo __IMG__;?>gpsn.png" alt="logo" />
                </div>
                <div id="login-sub">
                    <div id="forms">                        
                        <form id="login_form" action="<?php echo __LOCALWWW__ ?>/index.php/gprosalud/verificacion " method="post" target="_top">
                            <div class="input-req-login"><label for="user"><img src="<?php echo __IMG__;?>usuario.png"></img>&nbsp;Nombre de Usuario</label></div>
                            <div class="input-field-login icon username-container">
                                <input name="txtUsuario" id="user" autofocus="autofocus" value="" placeholder="Introduzca su nombre de usuario." class="std_textbox" type="text"  tabindex="1" required>
                            </div>
                            <div style="margin-top:30px;" class="input-req-login"><label for="pass"><img src="<?php echo __IMG__;?>clave.png"></img>&nbsp;Contraseña</label></div>
                            <div class="input-field-login icon password-container">
                                <input name="txtClave" id="pass" placeholder="Ingrese su contraseña de la cuenta." class="std_textbox" type="password" tabindex="2"  required>
                            </div>
                            <div style="width: 285px;">
                                <div class="login-btn">
                                    <button name="login" type="submit" id="login_submit" tabindex="3">Acceder</button>
                                </div>
                            </div>
                            <div class="clear" id="push"></div>
                        </form>

                    <!--CLOSE forms -->
                    </div>

                <!--CLOSE login-sub -->
                </div>
            <!--CLOSE login-sub-container -->
            </div>
        <!--CLOSE login-container -->
        </div>
        <div id="locale-footer">

            <div class="locale-container">
                <noscript>
                    <form method="get" action=".">
                        <button style="margin-left: 10px" type="submit">Cambiar</button>
                    </form>
                    <style type="text/css">#locales_list {display:none}</style>
                </noscript>
                <ul id="locales_list">                  
	                <li><a href="#">+ Principal</a></li>      
	                <li><a href="http://www.grupoprosalud.com/webmail">+ Correo</a></li>
	             </ul>
            </div>
        </div>
    </div>
<!--Close login-wrapper -->

</body>

</html>