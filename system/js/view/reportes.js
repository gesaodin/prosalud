/**
 * @author Servidor
 */

$(function() {

	$("#mbuzon").removeClass('active');
	$("#mcliente").removeClass('active');	
	$("#mvarios").removeClass('active');
	$("#mreporte").addClass('active');
	$(".dialogo").dialog({
		modal : true,
		autoOpen : false,
		position : 'top',
		hide : 'explode',
		show : 'slide',
		width : 600,
		height : 240
	});

	$("#nomina_imp").dialog({
		buttons : {
			"Generar" : function() {
				Nominas();
				$(this).dialog("close");
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	
		$("#proveedores_imp").dialog({
		buttons : {
			"Generar" : function() {
				Proveedores();
				$(this).dialog("close");
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
		}
	});
	

});
function muestra_div(elemento) {
	$("#" + elemento).dialog('open');
}

/**
 * Control de Reportes
 */
function Contratantes() {
	$("#carga_busqueda").dialog('open');
	$.ajax({
		url : sUrlP + "Contratantes_Listar",
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, 'Reportes', '');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName("Reportes");
			Grid.SetDetalle();
			Grid.Generar();
			$("#carga_busqueda").dialog('close');
		}
	});
}

function Proveedores() {
	$("#carga_busqueda").dialog('open');	
	$.ajax({
		url : sUrlP + "Proveedores_Listar",
		data : 'est=' + $('#txtEstadoP').val() + '&tipo=' + $('#txtTipoP').val(),
		type : 'POST',
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, 'Reportes', '');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName("Reportes");
			Grid.SetDetalle();
			Grid.Generar();
			$("#carga_busqueda").dialog('close');
		}
	});
}


function Nominas() {
	$("#carga_busqueda").dialog('open');
	$.ajax({
		url : sUrlP + "Nominas_Listar_Titulares",
		data : 'est=' + $('#txtEstado').val() + '&con=' + $('#txtContratante').val() + "&estatus=" + $('#txtTipo').val(),
		type : 'POST',
		dataType : "json",
		success : function(oEsq) {
			//alert(oEsq);
			Grid = new TGrid(oEsq, 'Reportes', '');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName("Reportes");
			Grid.SetDetalle();
			Grid.Generar();
			$("#carga_busqueda").dialog('close');
		}
	});

}

function Organismos(){
	$("#txtContratante").find('option').remove().end();
	valor = $("#txtEstado").val();
	$.ajax({
		url :  sUrlP + "LOrganismos/" + valor,
		type : "POST",
		data: "valor=" + valor,
		dataType : "json",
		success : function(data) {		
			$.each(data, function(item, valor) {						
				$("#txtContratante").append(new Option(valor, valor));
			});		
		}
	});
}
