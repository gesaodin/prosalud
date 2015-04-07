/**
 * Presionar la tecla Enter en el sistema
 */

$(function() {
	$("#mbuzon").removeClass('active');
	$("#mreporte").removeClass('active');
	$("#mvarios").removeClass('active');
	$("#mcliente").addClass('active');
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
	ced = $("#txtCedula").val();
	if (ced == "") {
		ced = $("#txtBuscando").val();
		$("#txtCedula").val(ced);
	}
	$.ajax({
		url : Url,
		type : "post",
		data : "id=" + ced,
		dataType : "json",
		success : function(json) {
			if (json['estatus'] != 0) {
			
			} else {
				$('#msj_alertas').html("<br><font color=red><center><b>El Cliente esta Actualmente Suspendido</b><br><br> Motivo: "	+ json["obs"] +	"</center><font>");
				$('#msj_alertas').dialog("open");
			}
			if (json['nombre'] != undefined) {
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

				$("#txtEdad").val(json["edad"]);

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
				$("#txtCoberturaFamiliar").val(json['afiliacion']['monto_familiar']);
				$("#txtActivoF").val(json['afiliacion']['fecha_activacion']);
				$("#txtCoberturaDisponible").val(json['afiliacion']['cobertura_disponible']);
				$("#txtRetenido").val(json['afiliacion']['retencion']);
				$("#txtConsultas").val(json['afiliacion']['consultas']);
				$("#txtConsultasD").val(json['afiliacion']['consultas'] - json['afiliacion']['consultas_usadas']);

				$("#txtExamen").val(json['afiliacion']['laboratorio']);

				$("#txtExamenD").val(json['afiliacion']['laboratorio'] - json['afiliacion']['laboratorio_usado']);
				$("#txtEstatus").val(json['afiliacion']['activo']);
				$("#txtLimpiezasD").val(json['afiliacion']['LD']);
				$("#txtResinaD").val(json['afiliacion']['OR']);
				$("#txtExodonciaD").val(json['afiliacion']['ES']);
				
				$("#txtMT").val(json['afiliacion']['MT']);
				$("#txtEE").val(json['afiliacion']['EE']);
				$("#EspecialesD").val(json['afiliacion']['EE']);
				
				$("#txtG1").val(json['afiliacion']['G1']);
				$("#txtG2").val(json['afiliacion']['G2']);
				$("#txtG3").val(json['afiliacion']['G3']);
				$("#txtG4").val(json['afiliacion']['G4']);
				
				$("#txtG1R").val(json['afiliacion']['G1R']);
				$("#txtG2R").val(json['afiliacion']['G2R']);
				$("#txtG3R").val(json['afiliacion']['G3R']);
				$("#txtG4R").val(json['afiliacion']['G4R']);
				
				
				Consultar_Cobertura_AUX(json["estado"],json["contratantes"]);

				Estado_Cuenta();
				Listar_Caso(ced);
				Historial();
				$("#txtBreveInforme").val(json["obs"]);
				$("#divBuscar").hide();
				$("#divConsultar").show();

			} else {
				alert("El Usuario no existe...");
				$("#divBuscar").show();
				$("#divConsultar").hide();
				$("#txtCedula").val('');
				$("#txtBuscando").val('');
			}

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
	$("#txtCoberturaFamiliar").val('');

	$("#txtEstadoContratante").val('');
	$("#txtCiudadContratante").val('');
	$("#txtCargo").val('');
	$("#txtProfesion").val('')
}

function Consultar_Depende() {
	var titular = $("#txtdependede option:selected").val();
	Url = sUrlP + "Consultar_Afiliado";
	$("#txtCedula").val(titular);
	Consultar();

	/**$.ajax({
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
	 });**/

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

function Listar_Caso(cedula) {
	if (cedula != '') {
		$.ajax({
			url : sUrlP + "Listar_Casos",
			type : "POST",
			data : "id=" + cedula,
			dataType : "json",
			success : function(oEsq) {
				Grid = new TGrid(oEsq, 'ReportesHCM', '');
				Grid.SetXls(false);
				Grid.SetNumeracion(true);
				Grid.SetName("ReportesHCM");
				Grid.SetDetalle();
				Grid.Generar();
				Grid.Origen();
			}
		});

	}

}

function Historial() {
	if ($('#txtCedula').val() != '') {
		$.ajax({
			url : sUrlP + "Listar_ReembolsoPersonal",
			type : "POST",
			data : "id=" + $('#txtCedula').val(),
			dataType : "json",
			success : function(oEsq) {
				Grid = new TGrid(oEsq, 'Servicios', '');
				Grid.SetXls(false);
				Grid.SetNumeracion(true);
				Grid.SetName("Servicios");
				Grid.SetDetalle();
				Grid.Generar();
				Grid.Origen();
			}
		});

	}
}

function Listar_Cobertura_Dependiente() {
	$.ajax({
		url : sUrlP + "Listar_Cobertura_Dependiente",
		type : 'POST',
		data : 'oid=' + $("#txtafiliados option:selected").val(),
		dataType : "json",
		success : function(data) {
			//$("#txtParentescoD").val(data['parentesco']);
			$("#txtMontoD").val(data['monto']);
			$("#txtRetenidoD").val(data['retenido']);

		}
	});
}

function Imprimir_Carnet() {
	Url = sUrlP + "Imprimir_Carnet/" + $("#txtCedula").val();
	window.open(Url, "ventana1", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=460,height=400");
}

function Ver_Dependientes() {
	Url = sUrlP + "dependientesconsultar/" + $("#txtCedula").val() + "/" + $("#txtafiliados option:selected").val();
	window.open(Url, "ventana1", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=700,height=450")
}


function Consultar_Cobertura_AUX(est, org) {
	$("#carga_busqueda").dialog('open');
	$.ajax({
		url : sUrlP + "Consutlar_Cobertura",
		data : 'est=' + est + '&con=' + org,
		type : 'POST',
		dataType : "json",
		success : function(oEsq) {

			$('#txtCodigo').val(oEsq['codigo']);
			$('#txtTipoServicio').val(oEsq['plan']);
			$('#txtActivoR').val(oEsq['renovacion']);
			$('#txtCobertura').val(oEsq['cobertura']);

			$('#txtCoberturaFamiliar').val(oEsq['monto_dependiente']);
			$('#txtCoberturaMT').val(oEsq['MT']);
			$('#txtCoberturaMF').val(oEsq['MC']);
			$("#txtDirectivo").val(oEsq['directivo']);

			$('#txtConsultas').val(oEsq['consultas']);
			$('#txtExamen').val(oEsq['examenes']);
			$('#txtLimpiezas').val(oEsq['LD']);
			$('#txtResina').val(oEsq['OR']);
			$('#txtExodoncia').val(oEsq['ES']);
			$('#txtEstudiosEspeciales').val(oEsq['EE']);

			$('#txtGrupo1').val(oEsq['G1']);
			$('#txtGrupo2').val(oEsq['G2']);
			$('#txtGrupo3').val(oEsq['G3']);
			$('#txtGrupo4').val(oEsq['G4']);

			$("#carga_busqueda").dialog('close');
		}
	});
}

