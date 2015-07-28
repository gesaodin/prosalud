/**
 * @author Servidor
 */
$(function() {
	var dates = $("#txtfechas, #txtFechaF").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
		onSelect : function(selectedDate) {
			var option = this.id == "txtfechas", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
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
	$("#txtfechas").datepicker("option", "dateFormat", "yy-mm-dd");
	$("#txtFechaF").datepicker("option", "dateFormat", "yy-mm-dd");

});

function Limpiar() {
	$("#txtTitular").val('');
	$("#txtDependiente").val('');
	$("#txtCodigoOAM").val('');
	$("#txtCoberturaDOAM").val('');
	$("#txtEstadoCentroOAM").val('');
	$("#txtCiudadCentroOAM").val('');
	$("#txtNombreCentroOAM").val('');
	$("#txtNombreMedicoOAM").val('')
	$("#txtTipoS").val('');
	$("#txtTipoT").val('');
	$("#txtTipoI").val('');
	$("#txtDiagnostico").val('');
	$("#txtFactura").val('');
	$("#txtBreveInforme").val('');
	$("#txtFechaF").val('');
	$("#txtMontoS").val('');
	$("#txtMontoC").val('');
	$("#txtfechas").val('');
	$("#txtTipoF").val('');
	$("#txtTipoCobertura").val('');
	$("#txtMontoNC").val('');
}

/**
 *
 */
function Calcular_Cubierto() {

	var dSolicitado = $("#txtMontoS").val();
	var dCubierto = $("#txtMontoC").val();
	var dResultado = dSolicitado - dCubierto;
	$("#txtMontoNC").val(dResultado);

}

/**
 *
 */
function Confirmar() {
	titular = $("#txtTitular").val();
	dependiente = $("#txtDependiente").val();
	codigo = $("#txtCodigoOAM").val();
	cobertura = $("#txtCoberturaDOAM").val();
	estado = $("#txtEstadoCentroOAM").val();
	ciudad = $("#txtCiudadCentroOAM").val();
	centro = $("#txtNombreCentroOAM").val();
	analista = $("#txtNombreMedicoOAM").val()
	tipoS = $("#txtTipoS").val();
	tipoT = $("#txtTipoT").val();
	tipoI = $("#txtTipoI").val();
	diagnostico = $("#txtDiagnostico").val();
	factura = $("#txtFactura").val();
	tratamiento = $("#txtBreveInforme").val();
	fechaF = $("#txtFechaF").val();
	montoS = $("#txtMontoS").val();
	montoT = $("#txtMontoC").val();
	fechas = $("#txtfechas").val();
	tipof = $("#txtTipoF").val();
	tipoc = $("#txtTipoCobertura").val();
	monton = $("#txtMontoNC").val();
	observaciones = $("#txtObservacion").val();
	
	var cadena = "fechas=" + fechas + "&codigo=" + codigo + "&tipos=" + tipoS + "&tipot=" + tipoT + "&tipoi=" + tipoI 
	+ "&diagnostico=" + diagnostico + "&factura=" + factura + "&fechaf=" + fechaF + "&montos=" + montoS + "&montoc=" + montoT
	+ "&centro=" + centro + "&analista=" + analista + "&ciudad=" + ciudad + "&estado=" + estado
	+ "&observacion=" + observaciones + "&monton=" + monton + "&tipoc=" + tipoc + "&tipof=" + tipof + "&tratamiento=" + tratamiento + "&titular=" + titular + "&dependiente=" + dependiente;
	
	strUrl_Proceso = sUrlP + "Confirmar_Egreso";
	$.ajax({
		url : strUrl_Proceso,
		type : "POST",
		data : cadena,
		success : function(sHtml) {
			
			$('#msj_alertas').html(sHtml);
			$('#msj_alertas').dialog("open");
			Limpiar();
			
		}
	});
}