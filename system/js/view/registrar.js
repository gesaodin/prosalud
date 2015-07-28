function Organismos() {
	$("#txtContratante").find('option').remove().end();
	valor = $("#txtOrganismoContratante").val();
	$.ajax({
		url : sUrlP + "LOrganismos/" + valor,
		type : "POST",
		data : "valor=" + valor,
		dataType : "json",
		success : function(data) {
			$.each(data, function(item, valor) {
				$("#txtContratante").append(new Option(valor, valor));
			});
		}
	});
}

$(function() {
	$("#mbuzon").removeClass('active');
	$("#mreporte").removeClass('active');
	$("#mvarios").removeClass('active');
	$("#mcliente").addClass('active');

	$("#txtOrganismoContratante").autocomplete({
		source : function(request, response) {
			$.ajax({
				type : "POST",
				url : sUrlP + "Listar_Contratantes",
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

	var dates = $("#txtActivoF").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
	});
	$("#txtActivoF").datepicker("option", "dateFormat", "yy-mm-dd");

});

function Presionar(e) {
	if (e.keyCode == 13) {

		Consultar();
	}
}

/**
 * Consutlar Persona
 *
 * @return bool
 */
function Consultar() {

	Url = sUrlP + "Consultar_Persona";
	cedula = $("#txtCedula").val();

	Limpiar();
	$.ajax({
		url : Url,
		type : "post",
		data : "id=" + cedula,
		dataType : "json",
		success : function(json) {
			$("#txtCedula").val(cedula);
			$("#txtNacionalidad").val(json['nacionalidad']);
			$("#txtEdocivil").val(json['estadocivil']);
			$("#txtNombre1").val(json['nombre']);
			
			
			
			

			fecha_nacimiento = json["fecha"];
			var fechaN = new String(fecha_nacimiento);
			var fechaAux = fechaN.split("-");
			diaN = fechaAux[2] * 1;
			mesN = fechaAux[1] * 1;
			anoN = fechaAux[0] * 1;
			$("#txtDiaNacimiento").val(diaN);
			$("#txtMesNacimiento").val(mesN);
			$("#txtAnoNacimiento").val(anoN);
			$("#txtSexo").val(json["sexo"]);
			$("#txtCargo").val(json["cargo"]);
			$("#txtProfesion").val(json["profesion"]);
			$("#txtDireccionTrabajo").val(json["ubicacion"]);
			$("#txtDireccionHabitacion").val(json["direccion"]);
			
			// Tramo nuevo de codigo para los estados y cuenta por persona
			$("#txtEstado").val(json["esta"]);
			$("#txtCiudad").val(json["ciud"]);
			
			$("#txtbanco_1").val(json["banco"]);
			$("#txtcuenta_1").val(json["cuenta"]);
			$("#txtTipo_1").val(json["tcue"]);
			$("#txtCorreo").val(json["corr"]);
			$("#txtDomi").val(json["domi"]);
			
			
			$("#txtTelefono").val(json["telefono"]);
			$("#txtOrganismoContratante").val(json["contratantes"]);

			$("#txtEstadoContratante").val(json["estado"]);
			
			$("#txtBreveInforme").val(json["obs"]);

			$("#txtOrganismoContratante").find('option').remove().end();
			$("#txtOrganismoContratante").append(new Option(json["contratantes"], json["contratantes"]));
			Consultar_Cobertura_AUX(json["estado"], json["contratantes"]);
			//});

			$("#txtCiudadContratante").val(json["ciudad"]);
			$("#txtActivoF").val(json['afiliacion']['fecha_activacion']);
			$("#txtActivoR").val(json['afiliacion']['fecha_renovacion']);

			$("#txtafiliados").find('option').remove().end();

			$.each(json['dependiente'], function(item, valor) {
				$("#txtafiliados").append(new Option('V- ' + valor['cedula'] + ' ' + valor['nombre'] + ' ( ' + valor['parentesco'] + ' )', valor['cedula']));
			});
			$("#txtafiliados").append(new Option('----------', '----------'));
			//Contratacion
			$("#txtCobertura").val(json['afiliacion']['cobertura']);
			$("#txtCoberturaDisponible").val(json['afiliacion']['cobertura_disponible']);
			$("#txtRetenido").val(json['afiliacion']['retencion']);
			//$("#txtConsultas").val(json['afiliacion']['consultas']);
			$("#txtConsultasD").val(json['afiliacion']['consultas'] - json['afiliacion']['consultas_usadas']);
			//$("#txtExamen").val(json['afiliacion']['laboratorio']);
			$("#txtExamenD").val(json['afiliacion']['laboratorio'] - json['afiliacion']['laboratorio_usado']);
			$("#txtEstatus").val(json['afiliacion']['activo']);
			
			
			if (json['estatus'] == 0) {
				$('#msj_alertas').html("<br><font color=red><center><b>El Cliente esta Actualmente Suspendido</b></center><font>");
				$('#msj_alertas').dialog("open");
			}
			
			

		}
	});

}

/**
 * Cargar Afiliados
 */
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
	
	//10-06-2015
	$("#txtEstado").val('');
	$("#txtCiudad").val('');
	$("#txtbanco_1").val("----------");
	$("#txtTipo_1").val("----------");	
	$("#txtcuenta_1").val('');	
	$("#txtCorreo").val('');
	$("#txtDomi").val('');
	$("#txtDireccionTrabajo").val('');
	

	$("#txtOrganismoContratante").val('');
	//Contrataciones
	$("#txtCobertura").val('');
	$("#txtCoberturaDisponible").val('');
	$("#txtRetenido").val('');
	$("#txtConsultas").val('');
	$("#txtConsultasD").val('');
	$("#txtExamen").val('');
	$("#txtExamenD").val('');

	$("#txtBreveInforme").val('');
	$("#txtCiudadContratante").val('');
	$("#txtCargo").val('');
	$("#txtProfesion").val('');

}

function Registrar() {
	Url = sUrlP + "Registrar_Titular";

	ced = $("#txtCedula").val();
	nac = $("#txtNacionalidad").val();
	edo = $("#txtEdocivil").val();
	nom = $("#txtNombre1").val();
	dia = $("#txtDiaNacimiento").val();
	mes = $("#txtMesNacimiento").val();
	ano = $("#txtAnoNacimiento").val();
	fecha = ano + "-" + mes + "-" + dia
	sex = $("#txtSexo").val();

	estado = $("#txtEstadoContratante").val();
	ciudad = $("#txtCiudadContratante").val();
	
	estadop = $("#txtEstado").val();
	ciudadp = $("#txtCiudad").val();
	
	banco = $("#txtbanco_1").val();
	cuenta = $("#txtcuenta_1").val();
	tipo = $("#txtTipo_1").val();
	correo = $("#txtCorreo").val();
	domi = $("#txtDomi").val();
	
	
	
	cargo = $("#txtCargo").val();
	profesion = $("#txtProfesion").val();
	dirtraba = $("#txtDireccionTrabajo").val();
	contratantes = $("#txtOrganismoContratante").val();
	activacionf = $("#txtActivoF").val();

	dire = $("#txtDireccionHabitacion").val();
	telf = $("#txtTelefono").val();

	//Plan Por Primera Vez
	cplan = $('#txtTipoServicio').val();
	crenovacion = $('#txtActivoF').val();
	ccobertura = $('#txtCobertura').val();
	cmonto_dependiente = $('#txtCoberturaFamiliar').val();
	cMT = $('#txtCoberturaMT').val();
	cMC = $('#txtCoberturaMF').val();
	obs = $("#txtBreveInforme").val();
	//cdirectivo = $("#txtDirectivo").val(oEsq['directivo']);
	cconsultas = $('#txtConsultas').val();
	cexamenes = $('#txtExamen').val();
	cLD = $('#txtLimpiezas').val();
	cOR = $('#txtResina').val();
	cES = $('#txtExodoncia').val();
	cEE = $('#txtEstudiosEspeciales').val();
	cG1 = $('#txtGrupo1').val();
	cG2 = $('#txtGrupo2').val();
	cG3 = $('#txtGrupo3').val();
	cG4 = $('#txtGrupo4').val();
	//Fin de Cobertura

	//Contrataciones

	disponible = $("#txtCoberturaDisponible").val();
	retencion = $("#txtRetenido").val();
	consulta = $("#txtConsultas").val();
	consultad = $("#txtConsultasD").val();
	examen = $("#txtExamen").val();
	examend = $("#txtExamenD").val();
	activo = $("#txtEstatus").val();

	var cadena = "ccobertura=" + ccobertura + "&cplan=" + cplan + "&crenovacion=" + crenovacion + "&cmonto_dependiente=" + cmonto_dependiente + "&cMT=" + cMT 
	+ "&cMC=" + cMC + "&cconsultas=" + cconsultas + "&cexamenes=" + cexamenes + "&cLD=" + cLD + "&cOR=" + cOR + "&cES=" + cES + "&cEE=" + cEE + "&cG1=" 
	+ cG1 + "&cG2=" + cG2 + "&cG3=" + cG3 + "&cG4=" + cG4 + "&dirtraba=" + dirtraba + "&disponible=" + disponible + "&retencion=" 
	+ retencion + "&consulta=" + consulta + "&consultad=" + consultad + "&activo=" + activo + "&estado=" + estado + "&ciudad=" + ciudad + "&estadop=" + estadop 
	+ "&ciudadp=" + ciudadp + "&cargo=" + cargo + "&profesion=" + profesion + "&contratantes=" + contratantes + "&examen=" + examen + "&examend=" + examend 
	+ "&sex=" + sex + "&ced=" + ced + "&nom=" + nom + "&edo=" + edo + "&fecha=" + fecha + "&dir=" + dire + "&tel=" + telf + "&activacionf=" + activacionf
	+ "&obs=" + obs + "&banco=" + banco + "&tcue=" + tipo + "&cuenta=" + cuenta + "&correo=" + correo + "&domi=" + domi;
	
	if ($("#txtNombre1").val() == "" || $("#txtActivoF").val() == "") {
		alert("No puede tener actualizacion en blanco la cedula...");
	} else {
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

function Ver_Dependientes() {
	Url = sUrlP + "dependiente/" + $("#txtCedula").val() + "/" + $("#txtafiliados option:selected").val();
	window.open(Url, "ventana1", "toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=700,height=500")
}

function Add_Dependientes() {
	Url = sUrlP + "dependiente/" + $("#txtCedula").val() + "/N";
	window.open(Url, "ventana1", "toolbar=0,location=1,menubar=0,scroConsultarllbars=1,resizable=1,width=700,height=500")
}

function Organismos() {
	$("#txtOrganismoContratante").find('option').remove().end();
	valor = $("#txtEstadoContratante").val();
	$.ajax({
		url : sUrlP + "LOrganismos/" + valor,
		type : "POST",
		data : "valor=" + valor,
		dataType : "json",
		success : function(data) {
			$.each(data, function(item, valor) {
				$("#txtOrganismoContratante").append(new Option(valor, valor));
			});
		}
	});
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

function Consultar_Cobertura() {
	$("#carga_busqueda").dialog('open');
	$.ajax({
		url : sUrlP + "Consutlar_Cobertura",
		data : 'est=' + $('#txtEstadoContratante').val() + '&con=' + $('#txtOrganismoContratante').val(),
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

