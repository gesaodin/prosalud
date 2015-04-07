/**
 * @pakacge system.js.views
 */
$( function() {
	Pendientes('Reportes');	
	CE('ReportesCE');
});


function Pendientes(div) {
	
	strUrl_Proceso = sUrlP + "ObtenerPendientesTentativos";
	$.ajax({
		url : strUrl_Proceso,
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, div, 'RECEPCION DE CONSULTAS Y LABORATORIO');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName(div);
			Grid.SetDetalle();
			Grid.Generar();
		}
	});
}

function CE(div){
	strUrl_Proceso = sUrlP + "Listar_PendientesCE/0/0";
	$.ajax({
		url : strUrl_Proceso,
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, div, 'CIRUGIA ELECTIVA');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName(div);
			Grid.SetDetalle();
			Grid.Generar();
		}
	});
	
}
