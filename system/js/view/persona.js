/**
 * Presionar la tecla Enter en el sistema
 */

$(function() {

	$("#mbuzon").removeClass('active');

	$("#mreporte").removeClass('active');

	$("#mvarios").removeClass('active');
	$("#mcliente").addClass('active');

	var dates = $("#txtFechaCentro").datepicker({
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
		dateFormat : 'dd/mm/yy',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$("#txtFechaCentro").datepicker("option", "dateFormat", "yy-mm-dd");

	/**
	 * Lista de Proveedores
	 */
	$("#txtNombreCentro").autocomplete({
		source : function(request, response) {
			var estado = $("#txtEstados").val();
			var ciudad = $("#txtCiudades").val();
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
 * Consutlar Persona
 *
 * @return bool
 */
function Consultar() {
	Url = sUrlP + "Consultar_Persona";
	Limpiar();
	$.ajax({
		url : Url,
		type : "post",
		data : "id=" + $("#txtCedula").val(),
		dataType : "json",
		success : function(json) {
			
			//$("#txtCedula").val(json['cedula']);
			$("#txtNacionalidad").val(json['nacionalidad']);
			$("#txtEdocivil").val(json['estadocivil']);
			$("#txtNombre1").val(json['nombre']);
			$("#txtTipoUsuario").val(json['titular']);
			fecha_nacimiento = json["fecha"];
			var fechaN = new String(fecha_nacimiento);
			var fechaAux = fechaN.split("-");
			diaN = fechaAux[2] * 1;
			mesN = fechaAux[1] * 1;
			anoN = fechaAux[0] * 1;

			$("#txtCargo").val(json["cargo"]);
			$("#txtProfesion").val(json["profesion"]);
			$("#txtDireccionHabitacion").val(json["direccion"]);
			$("#txtTelefono").val(json["telefono"]);
			$("#txtOrganismoContratante").val(json["contratantes"]);
			$("#txtEstadoContratante").val(json["estado"]);
			$("#txtCiudadContratante").val(json["ciudad"]);

			$("#txtDiaNacimiento").val(diaN);
			$("#txtMesNacimiento").val(mesN);
			$("#txtAnoNacimiento").val(anoN);
			$("#txtSexo").val(json["sexo"]);

			$("#txtafiliados").find('option').remove().end();

			$.each(json['dependiente'], function(item, valor) {
				$("#txtafiliados").append(new Option('V- ' + valor['cedula'] + ' ' + valor['nombre'] + ' ( ' + valor['parentesco'] + ' )', valor['cedula']));
			});
			$("#txtafiliados").append(new Option('----------', '----------'));
			$("#txtdependede").find('option').remove().end();
			$.each(json['depende'], function(item, valor) {
				$("#txtdependede").append(new Option('V- ' + valor['titular'] + ' ' + valor['nombre'] + ' ( ' + valor['parentesco'] + ' )', valor['titular']));
			});
			$("#txtdependede").append(new Option('----------', '----------'));

			//Contratacion
			$("#txtCobertura").val(json['afiliacion']['cobertura']);
			$("#txtCoberturaDisponible").val(json['afiliacion']['cobertura_disponible']);
			$("#txtRetenido").val(json['afiliacion']['retencion']);
			$("#txtConsultas").val(json['afiliacion']['consultas']);
			$("#txtConsultasD").val(json['afiliacion']['consultas_usadas']);
			$("#txtExamen").val(json['afiliacion']['laboratorio']);
			$("#txtExamenD").val(json['afiliacion']['laboratorio_usado']);
			$("#txtEstatus").val(json['afiliacion']['activo']);

			Estado_Cuenta();
		}
	});
}

/**
 * Cargar Afiliados
 */
function Afiliado() {
	Url = sUrlP + "Consultar_Afiliado";
	$.ajax({
		url : Url,
		type : "post",
		data : "id=" + $("#txtCedula").val(),
		dataType : "json",
		success : function(json) {
			$("#txtCedula").val(json['cedula']);
		}
	});
}

/**
 * Limpiar formularios de Campos
 */
function Limpiar() {
	//$("#txtCedula").val('');
	$("#txtNacionalidad").val('');
	$("#txtEdocivil").val('');
	$("#txtNombre1").val('');
	$("#txtDiaNacimiento").val('');
	$("#txtMesNacimiento").val('');
	$("#txtAnoNacimiento").val('');
	$("#txtSexo").val('');

	$("#txtDireccionHabitacion").val('');
	$("#txtTelefono").val('');
	$("#txtafiliados").find('option').remove().end();
	$("#txtafiliados").append(new Option('----------', '----------'));
	$("#txtdependede").find('option').remove().end();
	$("#txtdependede").append(new Option('----------', '----------'));

	//Contrataciones
	$("#txtCobertura").val('');
	$("#txtCoberturaDisponible").val('');
	$("#txtRetenido").val('');
	$("#txtConsultas").val('');
	$("#txtConsultasD").val('');
	$("#txtExamen").val('');
	$("#txtExamenD").val('');


	$("#txtEstadoContratante").val('');
	$("#txtCiudadContratante").val('');
	$("#txtCargo").val('');
	$("#txtProfesion").val('')
}

function Guardar_Solicitud() {
	if ($("#txtTitularU option:selected").val() != 2) {
		var beneficiario = "";
		if ($("#txtTitularU option:selected").val() == 0) {
			beneficiario = $("#txtCedula").val()
		} else {
			beneficiario = $("#txtafiliados option:selected").val()
		}
		var codigo = $("#txtClave").val();
		var titular = $("#txtCedula").val();

		var estado = $("#txtEstados option:selected").text();
		var ciudad = $("#txtCiudades option:selected").text();
		var centro = $("#txtNombreCentro").val();
		var analista = $("#txtAnalista").val();
		var fecha = $("#txtFechaCentro").val();
		var hora = $("#txtHora").val();
		var motivo = $("#txtMotivoConsulta").val();
		var tratamiento = $("#txtBreveInforme").val();

		var cadena = "codigo=" + codigo + "&cedula_titular=" + titular + "&cedula_beneficiario=" + beneficiario + "&estado=" + estado + "&ciudad=" + ciudad + "&fecha=" + fecha + "&hora=" + hora + "&motivo=" + motivo + "&tratamiento=" + tratamiento + "&centro=" + centro + "&analista=" + analista;

		Url = sUrlP + "Guardar_Solicitud";
		$.ajax({
			url : Url,
			type : "post",
			data : cadena,
			success : function(sHtml) {
				$('#msj_alertas').html(sHtml);
				$('#msj_alertas').dialog("open");
			}
		});
	} else {
		alert("Debe Seleccionar en datos del paciente quien sera el beneficiario");
	}

}

function Consultar_Depende() {
	var titular = $("#txtdependede option:selected").val();
	Url = sUrlP + "Consultar_Afiliado";
	$.ajax({
		url : Url,
		type : "post",
		data : "id=" + titular,
		dataType : "json",
		success : function(json) {
			sHtml = "<table class='TGrid'><thead><tr><th>Consultas</th><th>Laboratorio</th><th>Cobertura</th><th>Retencion</th></tr></thead><tbody><tr>";
			sHtml += "<td>&nbsp;" + json['consultas'] + "</td><td>&nbsp;" + json['laboratorio'] + "</td><td>&nbsp;" + json['cobertura'] + "</td><td>&nbsp;" + json['retencion'] + "</td>";
			sHtml += "</tr></tbody></table>";
			$('#msj_alertas').html(sHtml);
			$('#msj_alertas').dialog("open");
		}
	});

}

function Seleccion_Solicitud() {
	var Sel = $("#solicitud option:selected").val();
	$('#solicitudC').hide('slow');
	$('#solicitudR').hide('slow');
	$('#solicitudE').hide('slow');
	$('#solicitudH').hide('slow');
	$('#solicitudO').hide('slow');
	$('#solicitudOAM').hide('slow');
	$('#solicitud' + Sel).show('slow');
}

function Agregar_Facturas() {

	var fecha = $('#txtAnoFactura').val() + '-' + $('#txtMesFactura').val() + '-' + $('#txtDiaFactura').val();
	var numero = $('#txtNumeroFactura').val();
	var concepto = $('#txtConceptoFactura').val();
	var monto = $('#txtMontoFactura').val();
	var seleccion = numero + ';' + fecha + ';' + concepto + ';' + monto;

	$("#txtListaFactura").append(new Option(seleccion, seleccion));
}

function Quitar_Facturas() {
	$("#txtListaFactura option:selected").remove();
}

function Estado_Cuenta() {
	if ($('#txtCedula').val() != '') {
		$.ajax({
			url : sUrlP + "Estado_Cuenta",
			type : "POST",
			data : "id=" + $('#txtCedula').val(),
			dataType : "json",
			success : function(oEsq) {
				Grid = new TGrid(oEsq, 'Reportes', 'Historial de Pagos');
				Grid.SetXls(false);
				Grid.SetNumeracion(true);
				Grid.SetName("Reportes");
				Grid.SetDetalle();
				Grid.Generar();
				Grid.Origen();
			}
		});

	}
}

/**
 * Generar Clave de Servicio
 */
function Generar_Clave() {
	$.ajax({
		url : sUrlP + "Generar_Clave",
		success : function(Htm) {
			$('#txtClave').val(Htm);
		}
	});
}

function Listar_Cobertura_Dependiente() {
	$.ajax({
		url : sUrlP + "Listar_Cobertura_Dependiente",
		type : 'POST',
		data : 'oid=' + $("#txtafiliados option:selected").val(),
		dataType : "json",
		success : function(data) {
			$("#txtParentescoD").val(data['parentesco']);
			$("#txtMontoD").val(data['monto']);
			$("#txtRetenidoD").val(data['retenido']);

		}
	});
}

//Listar Linajes
function Listar_Ciudades() {
	$("#txtCiudades").find('option').remove().end();

	$.ajax({
		url : sUrlP + "Listar_Ciudades",
		type : 'POST',
		data : 'oid=' + $("#txtEstados").val(),
		dataType : "json",
		success : function(data) {
			$.each(data['ciudad'], function(item, valor) {
				$("#txtCiudades").append(new Option(valor, valor));
			});
		}
	});
}

function Imprimir_Carnet() {
	Url = sUrlP + "Imprimir_Carnet/" + $("#txtCedula").val();
	window.open(Url, "ventana1", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=460,height=400")

}