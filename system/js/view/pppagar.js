/**
 * @pakacge system.js.views
 */
$( function() {
	Pendientes(0,'Reportes');	
	Pendientes(1,'ReportesI');


});


function Pendientes(estado, div) {
	
	strUrl_Proceso = sUrlP + "Listar_PPP";
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

