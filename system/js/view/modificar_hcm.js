$(function() {

	var dates = $("#txtfechae, #txtfechas").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
		onSelect : function(selectedDate) {
			var option = this.id == "txtFechaCentro", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
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
		dateFormat : 'yy-mm-dd',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	//$("#txtfechae, #txtfechas").datepicker("option", "dateFormat", "yy-mm-dd");

	/**
	 * Lista de Proveedores
	 */
	$("#txtNombreCentroOAM").autocomplete({
		source : function(request, response) {
			var estado = $("#txtEstadoCentroOAM").val();
			var ciudad = $("#txtCiudadCentroOAM").val();
			$.ajax({
				type : "POST",
				url : sUrlP + "Listar_Proveedores",
				data : "estado=" + estado + "&ciudad=" + ciudad,
				dataType : "json",
				success : function(data) {
					response($.map(data.nombres, function(item) {
						return {
							label : item,
							value : item
						}
					}));
				},
			});
		}
	});
	//Fin de lista Proveedores

});

function Presionar(e) {
	if (e.keyCode == 13) {
		Consultar();
		$("#txtafiliados").focus();
	}
}
/**
 * Seleccion de Tipo de Servicio
 */
function STServicio() {
	var valor = $("#txtTipoS option:selected").val();
	$("#txtTipoT").find('option').remove().end();
	$("#txtTipoI").find('option').remove().end();

	switch (valor) {
		case "Ambulatorio":
			$("#txtTipoT").append(new Option('Medico', 'Medico'));
			$("#txtTipoI").append(new Option('Emegencia', 'Emergencia'));
			break;
		
		case "Hospitalizacion":
			$("#txtTipoT").append(new Option('Medico', 'Medico'));
			$("#txtTipoI").append(new Option('Emegencia', 'Emergencia'));
			break;
			
		case "Cirugia":
			$("#txtTipoT").append(new Option('Quirurgico', 'Quirurgico'));
			$("#txtTipoI").append(new Option('Emegencia', 'Emergencia'));
			$("#txtTipoI").append(new Option('Servicio Electivo', 'Servicio Electivo'));
			break;
			
		case "Maternidad":
			$("#txtTipoT").append(new Option('Martenidad', 'Martenidad'));
			$("#txtTipoI").append(new Option('Emegencia', 'Emergencia'));
			$("#txtTipoI").append(new Option('Servicio Electivo', 'Servicio Electivo'));
			break;
	}
}
function Limpiar() {
	$("#txtTitular").val('');
	$("#txtDependiente").val('');
	$("#txtCodigoOAM").val('');
	$("#txtCoberturaDOAM").val('');
	$("#txtEstadoCentroOAM").val('');
	$("#txtCiudadCentroOAM").val('');
	$("#txtNombreCentroOAM").val('');
	$("#txtAnalistaMedicoOAM").val('');
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
function Guardar() {
	
	
	codigo = $("#txtCodigoOAM").val();
	estado = $("#txtEstadoCentroOAM").val();
	ciudad = $("#txtCiudadCentroOAM").val();
	centro = $("#txtNombreCentroOAM").val();
	analista = $("#txtAnalistaMedicoOAM").val();
	tipoS = $("#txtTipoS").val();
	tipoT = $("#txtTipoT").val();
	tipoI = $("#txtTipoI").val();
	diagnostico = $("#txtDiagnostico").val();
	factura = $("#txtFactura").val();
	tratamiento = $("#txtBreveInforme").val();	
	motivo = $("#txtObservacion").val();
	modulo = $("#txtSolicitud").val();
	fecha = $("#txtfechas").val();
	fechae = $("#txtfechae").val();

	var cadena = "codigo=" + codigo + "&tipos=" + tipoS + "&tipot=" + tipoT + "&tipoi=" + tipoI + "&diagnostico=" + diagnostico + 
	"&centro=" + centro + "&analista=" + analista + "&ciudad=" + ciudad + "&estado=" + estado + "&motivo=" + motivo 
	+ "&tratamiento=" + tratamiento + "&modulo=" + modulo + "&fecha=" + fecha + "&fechae=" + fechae;

	strUrl_Proceso = sUrlP + "Actualizar_HCM";
	$.ajax({
		url : strUrl_Proceso,
		type : "POST",
		data : cadena,
		success : function(sHtml) {
			Limpiar();
			$('#msj_alertas').html(sHtml);
			$('#msj_alertas').dialog("open");

		}
	});
}



//Listar Linajes
function Listar_Ciudades() {
	$("#txtCiudadCentroOAM").find('option').remove().end();

	$.ajax({
		url : sUrlP + "Listar_Ciudades",
		type : 'POST',
		data : 'oid=' + $("#txtEstadoCentroOAM").val(),
		dataType : "json",
		success : function(data) {
			$.each(data['ciudad'], function(item, valor) {
				$("#txtCiudadCentroOAM").append(new Option(valor, valor));
			});
		}
	});
}