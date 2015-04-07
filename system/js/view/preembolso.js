/**
 * @pakacge system.js.views
 */
$( function() {
	Pendientes(3,'ReportesR');

	var dates = $( "#fecha_desde, #fecha_hasta" ).datepicker({
		showOn: "button",
		buttonImage: sImg + "calendar.gif",
		buttonImageOnly: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "fecha_desde" ? "minDate" : "maxDate",
			instance = $( this ).data( "datepicker" ),
			date = $.datepicker.parseDate(
			instance.settings.dateFormat ||
			$.datepicker._defaults.dateFormat,
			selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
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
	$( "#fecha_desde" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#fecha_hasta" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

});


function Pendientes(estado, div) {
	
	strUrl_Proceso = sUrlP + "Listar_Pendientes/" + estado;
	$.ajax({
		url : strUrl_Proceso,
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, div, '');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName(div);
			Grid.SetDetalle();
			Grid.Generar();
		}
	});
}

function Obetener(div) {	
	strUrl_Proceso = sUrlP + "Listar_Compromiso";
	$.ajax({
		url : strUrl_Proceso,
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, div, '');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName(div);
			Grid.SetDetalle();
			Grid.Generar();
		}
	});
}


function Imprimir(cod,ced){
	Url = sUrlP + "Imprimir_ReembolsoF/" + cod;
	window.open(Url, "reembolso", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=800,height=600");
}
function ImprimirS(cod,ced){
	Url = sUrlP + "Imprimir_Reembolso/" + cod;
	window.open(Url, "reembolso", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=800,height=600");
}
function Retener(cod,ced){
	strUrl_Proceso = sUrlP + "Retener_Reembolso/"+ cod  + "/" + ced;	
	$.ajax({
		url : strUrl_Proceso,
		success : function(oHtml) {
			alert(oHtml);
		}
	});
}

function Confirmar(cod,ced){
	strUrl_Proceso = sUrlP + "Confirmar_Reembolso/"+ cod  + "/" + ced;	
	$.ajax({
		url : strUrl_Proceso,
		success : function(oHtml) {
			alert(oHtml);
		}
	});
}

function Anular(cod,ced){
	strUrl_Proceso = sUrlP + "Anular_Reembolso/"+ cod  + "/" + ced;	
	$.ajax({
		url : strUrl_Proceso,
		success : function(oHtml) {
			alert(oHtml);
		}
	});
}
function Reversar(cod,ced){
	strUrl_Proceso = sUrlP + "Reversar_Reembolso/"+ cod  + "/" + ced;	
	$.ajax({
		url : strUrl_Proceso,
		success : function(oHtml) {
			alert(oHtml);
		}
	});
}