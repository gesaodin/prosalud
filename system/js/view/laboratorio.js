$(function() {
	$("#msolicitud").removeClass('active');
	$("#mreporte").removeClass('active');
	$("#mvarios").removeClass('active');
	$("#mcliente").removeClass('active');
	$("#mbuzon").addClass('active');

	var dates = $("#txtFechaCentro").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
		onSelect : function(selectedDate) {
			var option = this.id == "txtFechaCentro", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
	$("#txtFechaCentro").datepicker("option", "dateFormat", "yy-mm-dd");
	
	Obetener('ReportesR');

});


function Obetener(div) {	
	strUrl_Proceso = sUrlP + "Listar_Laboratorio";
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
