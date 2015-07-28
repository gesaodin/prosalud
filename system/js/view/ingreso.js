$(function() {
	var dates = $("#txtfechas, #txtFechaF, #txtfechae").datepicker({
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
		dateFormat : 'yy-mm-dd',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	
	
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
function Calcular_NOCubierto() {

	var dSolicitado = $("#txtMontoS").val();
	var dCubierto = $("#txtMontoNC").val();
	var dResultado = dSolicitado - dCubierto;
	$("#txtMontoC").val(dResultado);

}
/**
 *
 */
function Guardar() {
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
	fechae = $("#txtfechae").val();
	tipof = $("#txtTipoF").val();
	tipoc = $("#txtTipoCobertura").val();
	motivo = $("#txtMotivo").val();
	monton = $("#txtMontoNC").val();
	descuento = $("#txtDescuento").val();
	
	observaciones = $("#txtObservacion").val();

	var cadena = "fechas=" + fechas + "&codigo=" + codigo + "&tipos=" 
	+ tipoS + "&tipot=" + tipoT + "&tipoi=" + tipoI + "&diagnostico=" + diagnostico + "&factura=" 
	+ factura + "&fechaf=" + fechaF + "&montos=" + montoS + "&montoc=" + montoT + "&centro=" + centro 
	+ "&analista=" + analista + "&ciudad=" + ciudad + "&estado=" + estado + "&observacion=" + observaciones 
	+ "&monton=" + monton + "&tipoc=" + tipoc + "&tipof=" + tipof + "&tratamiento=" + tratamiento + "&titular=" 
	+ titular + "&dependiente=" + dependiente + "&motivo=" + motivo + "&fechae=" + fechae + "&descuento=" + descuento;

	strUrl_Proceso = sUrlP + "Registrar_Ingreso";
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