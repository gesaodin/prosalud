/**
 * @author Servidor
 */

$(function() {

	$("#mbuzon").removeClass('active');
	$("#mcliente").removeClass('active');	
	$("#mvarios").removeClass('active');
	$("#mreporte").addClass('active');
	
	
	
	var dates = $("#fecha_desde, #fecha_hasta").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
		onSelect : function(selectedDate) {
			var option = this.id == "fecha_desde" ? "minDate" : "maxDate", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$("#fecha_desde").datepicker("option", "dateFormat", "yy-mm-dd");
	$("#fecha_hasta").datepicker("option", "dateFormat", "yy-mm-dd");
	
	
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
	

		$("#estadisticas_imp").dialog({
			buttons : {
				"Generar" : function() {
					EstadisticasServicios();
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


function Organismos(ele){
	$("#txtContratante" + ele).find('option').remove().end();
	valor = $("#txtEstado" + ele).val();
	
	$.ajax({
		url :  sUrlP + "LOrganismos/" + valor,
		type : "POST",
		data: "valor=" + valor,
		dataType : "json",
		success : function(data) {		
			$.each(data, function(item, valor) {						
				$("#txtContratante" + ele).append(new Option(valor, valor));
			});		
		}
	});
}



function EstadisticasServicios() {
	$("#carga_busqueda").dialog('open');
	alert("asdf");
	$.ajax({
		url : sUrlP + "EstadisticasServicios",
		data : 'est=' + $('#txtEstadoEs').val() + '&con=' + $('#txtContratanteEs').val() + "&estatus=" + $('#txtTipoEs').val() + "&desde=" + $('#fecha_desde').val() + "&hasta=" + $('#fecha_hasta').val(),
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







