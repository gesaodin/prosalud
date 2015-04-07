/**
 * Presionar la tecla Enter en el sistema
 */

$(function() {
	$("#mbuzon").removeClass('active');
	$("#mreporte").removeClass('active');
	$("#mvarios").removeClass('active');
	$("#mcliente").removeClass('active');
	$("#msolicitud").addClass('active');

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
			
			if (json['estatus'] == 0) {
				$('#msj_alertas').html("<br><font color=red><center><b>El Cliente esta Actualmente Suspendido</b></center><font>");
				$('#msj_alertas').dialog("open");
			}
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

			$("#txtCoberturaDisponible").val(json['afiliacion']['cobertura_disponible']);
			$("#txtRetenido").val(json['afiliacion']['retencion']);
			$("#txtConsultasD").val(json['afiliacion']['consultas'] - json['afiliacion']['consultas_usadas']);
			$("#txtExamenD").val(json['afiliacion']['laboratorio'] - json['afiliacion']['laboratorio_usado']);
			$("#txtEstatus").val(json['afiliacion']['activo']);
			Estado_Cuenta();
		}
	});
}

/**
 * Limpiar formularios de Campos
 */
function Limpiar() {
	$("#txtClave").val('');
	$("#txtNacionalidad").val('');
	$("#txtEdocivil").val('');
	$("#txtNombre1").val('');
	$("#txtDiaNacimiento").val('');
	$("#txtMesNacimiento").val('');
	$("#txtAnoNacimiento").val('');
	$("#txtSexo").val('');

	$("#txtDireccionHabitacion").val('');
	$("#txtTelefono").val('');
	$("#txtListaFactura").find('option').remove().end();

	$("#txtNumeroFactura").val('');
	$("#txtConceptoFactura").val('');
	$("#txtMontoFactura").val('');
}

function Guardar_Solicitud() {
	facturas = new Array();
	i = 0;
	$("#txtListaFactura option").each(function() {
		aux = $(this).text();
		facturas[i] = aux;
		i++;
	});	
	
	var codigo = $("#txtClave").val();
	var titular = $("#txtCedula").val();
	var fechar = $("#txtAnoRecepcion").val() + '-' + $("#txtMesRecepcion").val() + '-' + $("#txtDiaRecepcion").val();
	var fechaf = $("#txtAnoFactura").val() + '-' + $("#txtMesFactura").val() + '-' + $("#txtDiaFactura").val();
	var obs = $("#txtObservacion").val();
	var titularc = $("#txtTitularc").val();
	var numeroc = $("#txtCuenta").val();
	var banco = $("#txtBancoc").val();
	var tipoc = $("#txtTipoc").val();
	
	if (facturas != "" || banco == "") {
		var cadena = "facturas=" + facturas + "&codigo=" + codigo + "&titular=" + titular + "&fechar=" + fechar + "&obs=" + obs + "&titularc=" + titularc + "&numeroc=" + numeroc + "&tipoc=" + tipoc + "&banco=" + banco;
		Url = sUrlP + "Guardar_Reembolso/Lab";
		$.ajax({
			url : Url,
			type : "post",
			data : cadena,
			success : function(sHtml) {
				$('#msj_alertas').html(sHtml);
				$('#msj_alertas').dialog("open");
			}
		});
		Limpiar();
	}else{
		$("#txtTitularc").val('-');
		$("#txtCuenta").val('-');
		alert("Verifique Datos Bancarios y/o Lista de Facturas");
	}
}

function Agregar_Facturas() {
	var fecha = $('#txtAnoFactura').val() + '-' + $('#txtMesFactura').val() + '-' + $('#txtDiaFactura').val();
	var numero = $('#txtNumeroFactura').val();
	var concepto = $('#txtConceptoFactura').val();

	if ($('#txtAnoFactura').val() != 0 || $('#txtMesFactura').val() != 0 || $('#txtDiaFactura').val() != 0) {
		monto = 0;
		if ($("#txtMontoFactura").val() != "") {
			monto = parseInt($("#txtMontoFactura").val());
		}
		var seleccion = numero + '|' + fecha + '|' + concepto + '|' + $("#txtMontoFactura").val() + '|' + $("#lstTipo").val();
		$("#txtListaFactura").append(new Option(seleccion, seleccion));
		mt = 0;
		if ($("#txtMontoTo").val() != "") {
			mt = parseInt($("#txtMontoTo").val());
		}
		$("#txtMontoTo").val(mt + monto);
		$("#txtNumeroFactura").val('');
		$("#txtConceptoFactura").val('');
		$("#txtMontoFactura").val('');
	}else{
		alert('Por favor verifique la fecha y/o datos de la factura');
	}

	

}

function Quitar_Facturas() {
	$("#txtListaFactura option:selected").remove();
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

