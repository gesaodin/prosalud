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

				$("#txtExamenD").val(json['afiliacion']['laboratorio']);

				$("#lstOrden").find('option').remove().end();
				$("#lstOrden").append(new Option('-', '-'));
				examenes_max = parseInt($("#txtExamenD").val()) + 1;
				for ( i = 1; i < examenes_max; i++) {
					$("#lstOrden").append(new Option(i, i));
				}

				$("#txtExamenR").val(json['afiliacion']['laboratorio_usado']);

				$("#txtEstatus").val(json['afiliacion']['activo']);
			} else {
				$('#msj_alertas').html("<br><font color=red><center><b>El Cliente esta Actualmente Suspendido</b></center><font>");
				$('#msj_alertas').dialog("open");
			}
		}
	});
}

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

function Ver_Precio() {
	val = parseInt($("#txtListaPerfil option:selected").val());
	$("#txtCosto").val(val);
}

function Eliminar_Examen() {
	valor = $("#txtListaPerfil option:selected").val();
	texto = $("#txtListaPerfil option:selected").text()

	val = parseInt($("#txtListaPerfil option:selected").val());
	totla = 0;
	if ($("#txtCostoE").val() != "") {
		totla = parseInt($("#txtCostoE").val());
	}

	costo = totla + val;

	$("#txtCostoE").val(costo);

	$("#txtListaPerfil option:selected").remove();
	$("#lstExamen").append(new Option(texto, valor));
}

function Eliminar_Examen_D() {
	val = 0;
	if ($("#lstExamen option:selected").val() != "") {
		val = parseInt($("#lstExamen option:selected").val());
	}

	totla = 0;

	if ($("#txtCostoE").val() != "") {
		totla = parseInt($("#txtCostoE").val());
	}

	costo = totla - val;

	$("#txtCostoE").val(costo);

	$("#lstExamen option:selected").remove();
}

function Perfil() {
	Url = sUrlP + "Consultar_Perfil";
	$("#txtListaPerfil").find('option').remove().end();
	$.ajax({
		url : Url,
		type : "POST",
		data : "id=" + $("#txtPerfil option:selected").val(),
		dataType : "json",
		success : function(json) {
			//$("#txtCosto").val(json['sum']);

			$.each(json['php'], function(item, valor) {
				$("#txtListaPerfil").append(new Option(item, valor));
			});

		}
	});
}

function Categoria() {
	Url = sUrlP + "Consultar_Categoria";
	$("#txtListaPerfil").find('option').remove().end();
	$.ajax({
		url : Url,
		type : "POST",
		data : "id=" + $("#txtCategoria option:selected").val(),
		dataType : "json",
		success : function(json) {
			//$("#txtCosto").val(json['sum']);

			$.each(json['php'], function(item, valor) {
				$("#txtListaPerfil").append(new Option(item, valor));
			});

		}
	});
}

function Guardar() {
	Url = sUrlP + "Guardar_Laboratorio";

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
		var obs = $("#txtObservacion").val();
		var examenes = $("#lstOrden").val();

		lstexamen = new Array();
		i = 0;
		$("#lstExamen option").each(function() {
			aux = $(this).text();
			//val = $(this).val();
			lstexamen[i] = aux;
			i++;
		});
		costoe = $("#txtCostoE").val();

		var cadena = "codigo=" + codigo + "&cedula_titular=" + titular + "&cedula_beneficiario=" + beneficiario + "&estado=" + estado + "&ciudad=" + ciudad + "&fecha=" + fecha + "&hora=" + hora + "&centro=" + centro + "&observacion=" + obs + "&examenes=" + lstexamen + "&costoe=" + costoe + "&cantidad=" + examenes;

		$.ajax({
			url : Url,
			type : "POST",
			data : cadena,
			success : function(sHtml) {

				$('#msj_alertas').html(sHtml);
				$('#msj_alertas').dialog("open");
				Limpiar();
			}
		});

	}
}

