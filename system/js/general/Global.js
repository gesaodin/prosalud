/**
 * ENTORNO GLOBAL DE ACCIONES DEL SISTEMA
 *
 * DESARROLLADO POR: CARLOS PEÑA
 * FECHA DE ELABORACION: 27/05/2012
 */
var sUrl = 'http://' + window.location.hostname + '/prosalud';
var sUrlP = sUrl + '/index.php/gprosalud/';
var sImg = sUrl + '/system/img/';

setInterval(function() {
	_getUsrConect();
}, 1000);
//Funcion de Cargar Usuarios

$(function() {
	//Funciones del Chat Controlan la salida...
	originalTitle = document.title;
	startChatSession(sUrl);
	$([window, document]).blur(function() {
		windowFocus = false;
	}).focus(function() {
		windowFocus = true;
		document.title = originalTitle;
	});
	$("button").button();
	//Control del Boton Buscar en general Estilo
	$('#btnTodo').hover(function() {
		$(this).addClass('ui-state-hover');
	}, function() {
		$(this).removeClass('ui-state-hover');
	});
	$("#general").accordion({
		collapsible : false,
		active : 0,
	});
	$("button").button();
	$("#buscar").button({
		icons : {
			primary : 'ui-icon-circle-zoomin',
		}
	});
	$('#tabs').tabs();

	$('#msj_alertas').dialog({
		modal : true,
		autoOpen : false,
		title : 'Informaci&oacute;n General',
		width : 270,
		height : 160,
		buttons : {
			"Cerrar" : function() {
				$(this).dialog("close");
			},
		}
	});

	$('#carga_busqueda').dialog({
		modal : true,
		autoOpen : false,
		width : 260,
		height : 160,
	});

	$.datepicker.regional['es'] = {
		closeText : 'Cerrar',
		prevText : '&#x3c;Ant',
		nextText : 'Sig&#x3e;',
		currentText : 'Hoy',
		monthNames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		dayNames : ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
		dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
		dayNamesMin : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
		weekHeader : 'Sm',
		dateFormat : 'dd/mm/yy',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);

});

/**
 * Control de Usuarios Conectados al Sistema.
 */
function _getUsrConect() {
	$.ajax({
		url : sUrlP + 'getUsrConnect',
		dataType : 'json',
		success : function(json) {
			$('#iContador').html('Hcm Emergencia (' + json["cant"] + ')');
		}
	});
}