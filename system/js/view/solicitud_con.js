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
			
			if (json['estatus'] != 0) {
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
				$("#txtConsultasR").val(json['afiliacion']['consultas_usadas']);

				$("#lstOrden").find('option').remove().end();
				$("#lstOrden").append(new Option('-', '-'));
				examenes_max = parseInt($("#txtConsultasD").val()) + 1;
				for ( i = 1; i < examenes_max; i++) {
					$("#lstOrden").append(new Option(i, i));
				}

			} else {
				$('#msj_alertas').html("<br><font color=red><center><b>El Cliente esta Actualmente Suspendido</b></center><font>");
				$('#msj_alertas').dialog("open");
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
	$("#txtOrganismoContratante").val('');
	$("#txtEstadoContratante").val('');
	$("#txtCiudadContratante").val('');
	$("#txtConsultasD").val('0');
	$("#txtConsultasR").val('0');
		
	$("#txtDireccionHabitacion").val('');
	$("#txtTelefono").val('');
	$("#txtafiliados").find('option').remove().end();
	$("#txtafiliados").append(new Option('----------', '----------'));
	$("#txtdependede").find('option').remove().end();
	$("#txtdependede").append(new Option('----------', '----------'));

		$("#txtNombreCentro").val('');
		$("#txtAnalista").val('');
		$("#txtEspecialidades").val('');
		

		$("#txtDiagnostico").val('');
		$("#txtBreveInforme").val('');

		$("#txtFechaCentro").val('');
		$("#txtHora").val('');

		$("#txtMotivoConsulta").val('');
		$("#txtObservacion").val('');
		$("#txtClave").val('');
	
	
}

function Guardar_Solicitud() {
	
	var msj = "En caso de emergencia, solicitar previa autorizacion para aumentar consultas disponibles";
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
		var especialidad = $("#txtEspecialidades").val();
		var consultas = 1; //$("#lstOrden").val();

		var diag = ''; //$("#txtDiagnostico").val();
		var tratamiento = ''; //$("#txtBreveInforme").val();

		var fecha = $("#txtFechaCentro").val();
		var hora = $("#txtHora").val();

		var motivo = ''; //$("#txtMotivoConsulta").val();
		var obs = $("#txtObservacion").val();

		var cadena = "codigo=" + codigo + "&cedula_titular=" + titular + "&cedula_beneficiario=" + beneficiario + "&estado=" + estado 
		+ "&ciudad=" + ciudad + "&centro=" + centro + "&analista=" + analista  + "&consultas=" + consultas  + "&especialidad=" + especialidad
		+ "&tratamiento=" + tratamiento + "&fecha=" + fecha + "&hora=" + hora + "&diagnostico=" + diag  + "&motivo=" + motivo + "&observacion=" + obs;

		if($("#txtConsultasD").val() != 0){
		Url = sUrlP + "Guardar_Consultas";
		$.ajax({
			url : Url,
			type : "post",
			data : cadena,
			success : function(sHtml) {
				$('#msj_alertas').html(sHtml);
				$('#msj_alertas').dialog("open");
				Limpiar();
			}
		});
		}else{
			alert(msj);
		}
		
	} else {
		alert("Debe Seleccionar en datos del paciente quien sera el beneficiario");
	}

}



function Verificar_Especialidad(){
	if ($('#txtCedula').val() != '') {
		$.ajax({
			url : sUrlP + "Verificar_Especialidad",
			type : "POST",
			data : "cedula_titular=" + $('#txtCedula').val() + "&especialidad=" + $('#txtEspecialidades option:selected').val(),
			success : function(oEsq) {
				$("#txtCantidadesD").val(oEsq);
				//alert(oEsq);
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

function Seleccion() {
	valor = $("#txtTitularU option:selected").val();
	if (valor == 0) {
		$("#divDependiente").hide();
	} else if (valor == 1) {

		$("#divDependiente").show();
	}
}

