/**
 * @author Carlos Peña
 */
$(function() {
	$("#mbuzon").removeClass('active');
	$("#mpanel").addClass('active');

	$('#r_cedula').dialog({
		modal : true,
		autoOpen : false,
		width : 450,
		height : 300,
	});
	
	$('#r_contrato').dialog({
		modal : true,
		autoOpen : false,
		width : 450,
		height : 300,
	});
	
	$('#r_factura').dialog({
		modal : true,
		autoOpen : false,
		width : 450,
		height : 300,
	});
	$('#r_inventario').dialog({
		modal : true,
		autoOpen : false,
		width : 450,
		height : 300,
	});
	$('#r_boucher').dialog({
		modal : true,
		autoOpen : false,
		width : 450,
		height : 300,
	});

	$("#img_eliminar_cedula").hide();
	$("#img_bloquear_cedula").hide();
	$("#img_activar_cliente").hide();
	$("#img_modificar_cedula").hide();
	$("#img_eliminar_nomina").hide();
	$("#img_modificar_contrato").hide();
	$("#img_eliminar_contrato").hide();
	$("#img_modificar_factura").hide();
	$("#img_modifica_datos_factura").hide();
	$("#img_eliminar_factura").hide();
	$("#img_inactivar_contrato").hide();
	$("#img_inactivar_factura").hide();
	$("#img_eliminar_serial").hide();
	$("#img_eliminar_modelo").hide();
	$("#img_modificar_boucher").hide();
});

//CLIENTES
function Respaldo_Eliminar_Cedula() {
	if ($("#txtCedula").val() != '') {
		$("#r_cedula").dialog({
			buttons : {
			"Aceptar" : function() {
				Eliminar_Cedula();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_cedula").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR LA CEDULA A ELIMINAR");
		$("#msj_alertas").dialog('open');
	}
}

function Eliminar_Cedula() {
	var cedula = $("#txtCedula").val();
	var peticion = $("#txtRPeticion_Ced").val();
	var motivo = $("#txtRMotivo_Ced").val();
	//alert(motivo);
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ELIMINAR LA PERSONA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Ced").val('');
		$("#txtRPeticion_Ced").val('');
		$("#txtCedula").val("");
		$("#img_eliminar_cedula").show();
		$.ajax({
			url : sUrlP + 'Eliminar_Cedula',
			type : "POST",
			data : "cedula=" + cedula + "&peticion=" + peticion + "&motivo=" + motivo,
			success : function(html) {
				$("#img_eliminar_cedula").hide();
				$("#msj_alertas").html(html);
				$("#r_cedula").dialog("close");
				$("#msj_alertas").dialog('open');

			},
			error : function(html) {
				alert('FALLO LA OPERACION.....');
			},
		});
	}
}

function Respaldo_Bloquear_Cedula() {
	if ($("#txtCedulaBloquear").val() != '') {
		$("#r_cedula").dialog({
			buttons : {
			"Aceptar" : function() {
				Bloquear_Cedula();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_cedula").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR LA CEDULA A BLOQUEAR");
		$("#msj_alertas").dialog('open');
	}
}

function Bloquear_Cedula() {
	var cedula = $("#txtCedulaBloquear").val();
	var peticion = $("#txtRPeticion_Ced").val();
	var motivo = $("#txtRMotivo_Ced").val();
	//alert(motivo);
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A BLOQUEAR LA PERSONA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Ced").val('');
		$("#txtRPeticion_Ced").val('');
		$("#txtCedulaBloquear").val("");
		$("#img_bloquear_cedula").show();
		$.ajax({
			url : sUrlP + 'DBaja',
			type : "POST",
			data : "cedula=" + cedula + "&val=2"+ "&peticion=" + peticion + "&motivo=BLOQUEO/" + motivo,
			success : function(html) {
				$("#img_bloquear_cedula").hide();
				$("#msj_alertas").html(html);
				$("#r_cedula").dialog("close");
				$("#msj_alertas").dialog('open');

			},
			error : function(html) {
				alert('FALLO LA OPERACION.....');
			},
		});
	}
}

function Respaldo_Alta() {
	var cedula = $("#txtCedulaA").val();
	
	if (cedula != '') {
		$("#r_cedula").dialog({
			buttons : {
			"Aceptar" : function() {
				btnDAlta();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_cedula").dialog("open");
	} else {
		$("#msj_alertas").html('INGRESE LA C&Eacute;DULA A ACTIVAR...');
		$("#msj_alertas").dialog('open');
	}
}

function btnDAlta() {
	var cedula = $("#txtCedulaA").val();
	$("#txtCedulaA").val('');
	var peticion = $("#txtRPeticion_Ced").val();
	var motivo = $("#txtRMotivo_Ced").val();
	//alert(motivo);
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ACTIVAR LA PERSONA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ACTIVACI&Oacute;N</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Ced").val('');
		$("#txtRPeticion_Ced").val('');
		$("#txtCedulaA").val("");
		$("#img_activar_cliente").show();
		$.ajax({
			url : sUrlP + 'DBaja',
			type : "POST",
			data : "cedula=" + cedula + "&val=0"+ "&peticion=" + peticion + "&motivo=" + motivo,
			success : function(htm) {
				//msg = '<p><strong>Se ha activado nuevamente el cliente...</strong></p>';
				$("#img_activar_cliente").hide();
				$("#msj_alertas").html(htm);
				$("#r_cedula").dialog("close");
				$("#msj_alertas").dialog('open');
	
			},
			error : function(html) {
				alert('FALLO LA OPERACION');
			},
		});
	}
}

function Respaldo_Modificar_Cedula() {
	var cedula_a = $("#txtCedula_A").val();
	var cedula_n = $("#txtCedula_N").val();
	if (cedula_a != '' && cedula_n != '') {
		$("#r_cedula").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Cedula();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_cedula").dialog("open");
	} else {
		$("#msj_alertas").html('LOS NUMEROS DE CEDULA NO DEBEN ESTAR EN BLANCO...');
		$("#msj_alertas").dialog('open');
	}
}

function Modificar_Cedula() {
	var cedula_a = $("#txtCedula_A").val();
	var cedula_n = $("#txtCedula_N").val();
	var peticion = $("#txtRPeticion_Ced").val();
	var motivo   = $("#txtRMotivo_Ced").val();
	//alert(motivo);
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A MODIFICAR LA C&Eacute;DULA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA MODIFICACI&Oacute;N</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtCedula_A").val("");
		$("#txtCedula_N").val("");
		$("#txtRPeticion_Ced").val("");
		$("#txtRMotivo_Ced").val("");  
		
		$("#img_consultar_cedula").show();
		$.ajax({
			url : sUrlP + 'Modificar_Cedula',
			type : "POST",
			data : "cedula_a=" + cedula_a + "&cedula_n=" + cedula_n +"&peticion=" +peticion + "&motivo=" + motivo,
			success : function(html) {
				$("#r_cedula").dialog("close");
				$("#img_modificar_cedula").hide();
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
			},
			error : function(html) {
				alert('FALLO LA OPERACION');
			},
		});
	}
}

//NOMINAS Y ZONAS POSTALES
function Crear_Nomina() {
	var nombre = $("#txtNombre").val();
	var desc = $("#txtDescrip").val();
	$("#txtNombre").val('');
	$("#txtDescrip").val('');
	if (nombre != "") {
		$.ajax({
			url : sUrlP + 'Inserta_Nomina',
			type : "POST",
			data : "&nombre=" + nombre + "&desc=" + desc,
			success : function(html) {
				$("#msj_alertas").html("LA NOMINA FUE CREADA");
				$("#msj_alertas").dialog('open');
			},
			error : function(html) {
				alert('FALLO LA OPERACION');
			},
		});
	} else {
		document.getElementById("txtDescrip").value = "";
		alert("Debe ingresar un Nombre");
	}
}

function Crear_Zona() {
	var estado = $("#cmbEstados").val();
	var zona = $("#txtZona").val();
	var codigo = $("#txtCodigo").val();

	if (estado != "" && estado != "0" && zona != "" && codigo != "") {
		$.ajax({
			url : sUrlP + 'Inserta_Zona',
			type : "POST",
			data : "estado=" + estado + "&zona=" + zona + "&codigo=" + codigo,
			success : function(html) {
				$("#cmbEstados").val("");
				$("#txtZona").val("");
				$("#txtCodigo").val("");
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
			}
		});
	} else {
		$("#msj_alertas").html("DEBE INGRESAR TODOS LOS DATOS");
		$("#msj_alertas").dialog('open');
	}
}

function Eliminar_Nomina() {
	var nombre = $("#cmbNomina").val();
	$("#img_eliminar_nomina").show();
	$.ajax({
		url : sUrlP + 'Eliminar_Nomina',
		type : "POST",
		data : "nombre=" + nombre,
		success : function(html) {
			$("#img_eliminar_nomina").hide();
			$("#msj_alertas").html(html);
			$("#msj_alertas").dialog('open');
		}
	});
}

//CONTRATOS
function Respaldo_Modificar_Contrato() {
	var contrato_a = $("#txtContrato_A").val();
	var contrato_n = $("#txtContrato_N").val();
	if (contrato_a != '' && contrato_n != '' ) {
		$("#r_contrato").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Contrato();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_contrato").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR LOS NUMEROS DE CONTRATO");
		$("#msj_alertas").dialog('open');
	}
}

function Modificar_Contrato() {
	var contrato_a = $("#txtContrato_A").val();
	var contrato_n = $("#txtContrato_N").val();
	var peticion = $("#txtRPeticion_Cont").val();
	var motivo = $("#txtRMotivo_Cont").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A MODIFICAR EL NUMERO DE CONTRATO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA MODIFICACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtContrato_A").val("");
		$("#txtContrato_N").val("");
		$("#txtRMotivo_Cont").val('');
		$("#txtRPeticion_Cont").val('');	
		$("#img_modificar_contrato").show();
		$.ajax({
			url : sUrlP + 'Modificar_Contratos',
			type : "POST",
			data : "contrato_a=" + contrato_a + "&contrato_n=" + contrato_n + "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_modificar_contrato").hide();
				$("#msj_alertas").html(html);
				$("#r_contrato").dialog("close");
				$("#msj_alertas").dialog('open');
			}
		});
		
	}
}

function Respaldo_Eliminar_Contrato() {
	if ($("#txtContrato").val() != '') {
		$("#r_contrato").dialog({
			buttons : {
			"Aceptar" : function() {
				Eliminar_Contrato_C();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_contrato").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR EL CONTRATO A ELIMINAR");
		$("#msj_alertas").dialog('open');
	}
}

function Eliminar_Contrato_C() {
	var contrato = $("#txtContrato").val();
	var peticion = $("#txtRPeticion_Cont").val();
	var motivo = $("#txtRMotivo_Cont").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ELIMINAR EL CONTRATO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Cont").val('');
		$("#txtRPeticion_Cont").val('');
		$("#txtContrato").val("");
		$("#img_eliminar_contrato").show();
		$.ajax({
			url : sUrlP + 'Eliminar_Contrato_C',
			type : "POST",
			data : "contrato=" + contrato + "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_eliminar_contrato").hide();
				$("#msj_alertas").html(html);
				$("#r_contrato").dialog("close");
				$("#msj_alertas").dialog('open');
			}
		});
	}
}

function Respaldo_Inactivar_Contrato() {
	if ($("#txtContratoInactivar").val() != '') {
		$("#r_contrato").dialog({
			buttons : {
			"Aceptar" : function() {
				Inactivar_Contrato();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_contrato").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR EL CONTRATO A INACTIVAR");
		$("#msj_alertas").dialog('open');
	}
}

function Inactivar_Contrato() {
	var contrato = $("#txtContratoInactivar").val();
	var peticion = $("#txtRPeticion_Cont").val();
	var motivo = $("#txtRMotivo_Cont").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A INACTIVAR EL CONTRATO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA INACTIVACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Cont").val('');
		$("#txtRPeticion_Cont").val('');
		$("#txtContrato").val("");
		$("#img_inactivar_contrato").show();
		$.ajax({
			url : sUrlP + 'Inactivar_Contrato',
			type : "POST",
			data : "contrato=" + contrato + "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_inactivar_contrato").hide();
				$("#msj_alertas").html(html);
				$("#r_contrato").dialog("close");
				$("#msj_alertas").dialog('open');
			}
		});
	}
}

//FACTURAS
function Respaldo_Modificar_Factura() {
	var factura_a = $("#txtFactura_A").val();
	var factura_n = $("#txtFactura_N").val();
	if (factura_a != '' || factura_n != '') {
		$("#r_factura").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Factura();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_factura").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR TODOS LOS DATOS PARA MODIFICAR EL NUMERO");
		$("#msj_alertas").dialog('open');
	}
}

function Modificar_Factura() {
	var factura_a = $("#txtFactura_A").val();
	var factura_n = $("#txtFactura_N").val();
	var peticion = $("#txtRPeticion_Fact").val();
	var motivo = $("#txtRMotivo_Fact").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("DEBE INGRESAR TODOS LOS DATOS");
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtFactura_A").val("");
		$("#txtFactura_N").val("");
		$("#txtRMotivo_Fact").val('');
		$("#txtRPeticion_Fact").val('');
		$("#img_modificar_factura").show();
		$.ajax({
			url : sUrlP + 'Modificar_Facturas',
			type : "POST",
			data : "factura_a=" + factura_a + "&factura_n=" + factura_n + "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_modificar_factura").hide();
				$("#r_factura").dialog("close");
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
			}
		});
	}
}

function Respaldo_Eliminar_Factura() {
	if ($("#txtFactura").val() != '') {
		$("#r_factura").dialog({
			buttons : {
			"Aceptar" : function() {
				Eliminar_Factura();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_factura").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR LA FACTURA A ELIMINAR");
		$("#msj_alertas").dialog('open');
	}
}


function Eliminar_Factura() {
	
	var factura = $("#txtFactura").val();
	var peticion = $("#txtRPeticion_Fact").val();
	var motivo = $("#txtRMotivo_Fact").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ELIMINAR LA FACTURA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Fact").val('');
		$("#txtRPeticion_Fact").val('');
		$("#txtFactura").val("");
		$("#img_eliminar_factura").show();
		$.ajax({
			url: sUrlP + "Eliminar_Factura_C",
			type : "post",
			data : "factura=" + factura+ "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
					$("#img_eliminar_factura").hide();
					$("#msj_alertas").html(html);
					$("#r_factura").dialog("close");
					$("#msj_alertas").dialog('open');
			}
		});
	}
}

function Respaldo_Inactivar_Factura() {
	if ($("#txtFacturaInactivar").val() != '') {
		$("#r_factura").dialog({
			buttons : {
			"Aceptar" : function() {
				Inactivar_Factura();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_factura").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR LA FACTURA A INACTIVAR");
		$("#msj_alertas").dialog('open');
	}
}

function Inactivar_Factura() {
	var factura = $("#txtFacturaInactivar").val();
	var peticion = $("#txtRPeticion_Fact").val();
	var motivo = $("#txtRMotivo_Fact").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A INACTIVAR LA FACTURA<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA INACTIVACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtRMotivo_Fact").val('');
		$("#txtRPeticion_Fact").val('');
		$("#txtFacturaInactivar").val("");
		$("#img_inactivar_factura").show();
		$.ajax({
			url : sUrlP + 'Inactivar_Factura',
			type : "POST",
			data : "factura=" + factura + "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_inactivar_factura").hide();
				$("#msj_alertas").html(html);
				$("#r_factura").dialog("close");
				$("#msj_alertas").dialog('open');
			}
		});
	}
}


function BFactura_Modificar() {
	var num_factura = $("#txtNumero_Factura").val();
	if(num_factura != '') {
		$.ajax({
		url : sUrlP + "BFactura_Modificar",
		type : "POST",
		data : "factura=" + num_factura,
		success : function(data) {
			eval("var tipo = " + data);
			var motivo = tipo["motivo"];
			var condicion = tipo["condicion"];
			var monto = tipo["monto_operacion"];
			var deposito = tipo["num_operacion"];
			var fecha_operacion = tipo["fecha_operacion"];
			var fechaAuxO = fecha_operacion.split("-");
			var dia = fechaAuxO[2] * 1;
			var mes = fechaAuxO[1] * 1;
			var ano = fechaAuxO[0] * 1;
			$("#txtCondicion").val(condicion);
			$("#txtDeposito").val(deposito);
			$("#txtMonto").val(monto);
			$("#txtMotivo").val(motivo);
			$("#txtDiaO").val(dia);
			$("#txtMesO").val(mes);
			$("#txtAnoO").val(ano);
		}
		});
	}else{
		alert('DEBE INGRESAR NUMERO DE FACTURA');
	}
}

function Modificar_Datos_Factura() {
	var factura = $("#txtNumero_Factura").val();
	var motivo = $("#txtMotivo").val();
	var condicion = $("#txtCondicion").val();
	var deposito = $("#txtDeposito").val();
	var monto = $("#txtMonto").val();
	var dia = $("#txtDiaO").val();
	var mes = $("#txtMesO").val();
	var ano = $("#txtAnoO").val();
	var fecha_o = ano + '-' + mes + '-' + dia; 
	$("#img_modifica_datos_factura").show("blind");
	$.ajax({
		url : sUrlP + "Modificar_Datos_Factura",
		type : "POST",
		data : "factura=" + factura + "&motivo=" + motivo + "&condicion=" + condicion + "&deposito=" + deposito + "&monto=" + monto + "&fecha_o=" + fecha_o,
		success : function(data) {
			$("#msj_alertas").html(data);
			$("#msj_alertas").dialog('open');
			$("#img_modifica_datos_factura").hide();
			$("#txtNumero_Factura").val('');
			$("#txtCondicion").val('');
			$("#txtMotivo").val('');
			$("#txtMonto").val('');
			$("#txtDiaO").val('');
			$("#txtMesO").val('');
			$("#txtAnoO").val('');
			$("#txtDeposito").val('');
			
		}
	});
}

//inventario
function Respaldo_Eliminar_Serial() {
	if ($("#txtSerial_E").val() != '') {
		$("#r_inventario").dialog({
			buttons : {
			"Aceptar" : function() {
				Eliminar_Serial();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_inventario").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE INGRESAR EL SERIAL A ELIMINAR");
		$("#msj_alertas").dialog('open');
	}
}

function Eliminar_Serial() {
	var serial = $("#txtSerial_E").val();
	var peticion = $("#txtRPeticion_Inv").val();
	var motivo = $("#txtRMotivo_Inv").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ELIMINAR EL SERIAL<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#img_eliminar_serial").show();
		$("#txtRMotivo_Inv").val('');
		$("#txtRPeticion_Inv").val('');
		$("#txtSerial_E").val("");
		
		$.ajax({
			url : sUrlP + "Eliminar_Serial",
			type : "POST",
			data : "serial=" + serial+ "&peticion="+peticion +"&motivo="+motivo,
			success : function(html) {
				$("#img_eliminar_serial").hide();
				$("#msj_alertas").html(html);
				$("#r_inventario").dialog("close");
				$("#msj_alertas").dialog('open');		

			}
		});
	}
	
}

function Respaldo_Eliminar_Modelo() {
	if ($("#cmbModelo option:selected").text() != '') {
		$("#r_inventario").dialog({
			buttons : {
			"Aceptar" : function() {
				Eliminar_Modelo();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_inventario").dialog("open");
	} else {
		$("#msj_alertas").html("DEBE SELECCIONAR EL MODELO A ELIMINAR");
		$("#msj_alertas").dialog('open');
	}
}

function Eliminar_Modelo() {
	var cantidad = $("#cmbModelo option:selected").val();
	var indice = $("#cmbModelo option:selected").text();
	var mod = $("#cmbModelo option:selected").text();
	var peticion = $("#txtRPeticion_Inv").val();
	var motivo = $("#txtRMotivo_Inv").val();
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A ELIMINAR EL MODELO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA ELIMINACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		var entrar = confirm("¿De verdad desea eliminar el modelo " + mod + " ?\n Tiene asociado " + cantidad + " productos");
		$("#img_eliminar_modelo").show();
		$("#txtRMotivo_Inv").val('');
		$("#txtRPeticion_Inv").val('');
		
		if(cantidad > 0) {
			if(entrar) {
				$.ajax({
					url : sUrlP + "Eliminar_Modelo",
					type : "POST",
					data : "modelo=" + mod+ "&peticion="+peticion +"&motivo="+motivo,
					success : function(html) {
						$("#cmbModelo option:selected").remove();
						$("#img_eliminar_modelo").hide();
						$("#msj_alertas").html(html);
						$("#r_inventario").dialog("close");
						$("#msj_alertas").dialog('open');		
					}
				});
			}else{
				$("#msj_alertas").html("SE CANCELO LA ELIMINACION DEL MODELO");
				$("#msj_alertas").dialog('open');	
			}
		}else{
			$.ajax({
				url : sUrlP + "Eliminar_Modelo",
				type : "POST",
				data : "modelo=" + mod+ "&peticion="+peticion +"&motivo="+motivo,
				success : function(html) {
					$("#cmbModelo option:selected").remove();
					$("#img_eliminar_modelo").hide();
					$("#msj_alertas").html(html);
					$("#r_inventario").dialog("close");
					$("#msj_alertas").dialog('open');		
				}
			});
		}
	}
}


function Respaldo_Modificar_Boucher() {
	var boucher_a = $("#txtBoucher_A").val();
	var boucher_n = $("#txtBucher_N").val();
	if (boucher_a != '' && boucher_n != '') {
		$("#r_boucher").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Boucher();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_boucher").dialog("open");
	} else {
		$("#msj_alertas").html('LOS NUMEROS DE VOUCHER NO DEBEN ESTAR EN BLANCO...');
		$("#msj_alertas").dialog('open');
	}
}

function Modificar_Boucher() {
	var boucher_a = $("#txtBoucher_A").val();
	var boucher_n = $("#txtBoucher_N").val();
	var peticion = $("#txtRPeticion_Boucher").val();
	var motivo   = $("#txtRMotivo_Boucher").val();
	var causa = $("#cmbCausa option:selected").val();
	//alert(motivo);
	if (motivo == '' || peticion == '') {
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A MODIFICAR EL VOUCHER<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA MODIFICACI&Oacute;N</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	} else {
		$("#txtBoucher_A").val("");
		$("#txtBoucher_N").val("");
		$("#txtRPeticion_Boucher").val("");
		$("#txtRMotivo_Boucher").val("");  
		
		$("#img_consultar_boucher").show();
		$.ajax({
			url : sUrlP + 'Modificar_Boucher',
			type : "POST",
			data : "boucher_a=" + boucher_a + "&boucher_n=" + boucher_n +"&peticion=" +peticion + "&motivo=" + motivo + "&causa=" + causa,
			success : function(html) {
				$("#r_boucher").dialog("close");
				$("#img_modificar_boucher").hide();
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
			},
			error : function(html) {
				alert('FALLO LA OPERACION'+html);
			},
		});
	}
}

function Respaldo_Modificar_Posesion() {
	contrato = $("#txtContrato_P").val();
	lugar = $("#cmbContrato_P option:selected").val();
	if (contrato != '' && lugar != '' && lugar != 0) {
		$("#r_contrato").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Posesion();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_contrato").dialog("open");
	} else {
		$("#msj_alertas").html('Debe ingresar todos los datos...');
		$("#msj_alertas").dialog('open');
	}
}


function Modificar_Posesion(){
	contrato = $("#txtContrato_P").val();
	lugar = $("#cmbContrato_P option:selected").val();
	var peticion = $("#txtRPeticion_Cont").val();
	var motivo = $("#txtRMotivo_Cont").val();
	if(contrato == '' || lugar == '' || lugar == 0 || peticion == '' || motivo == ''){
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A MODIFICAR POSESION DEL CONTRATO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA MODIFICACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	}else{
		$("#txtRMotivo_Cont").val('');
		$("#txtRPeticion_Cont").val('');
		$.ajax({
			url : sUrlP + 'Modificar_EEjecucion',
			type : "POST",
			data : "contrato=" + contrato + "&lugar=" + lugar + "&peticion=" + peticion + "&motivo=" + motivo,
			success : function(html) {
				$("#r_contrato").dialog("close");
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
				$("#txtContrato_P").val('');
				$("#etiqueta").html('');
			},
			error : function(html) {
				alert('FALLO LA OPERACION '+html);
			},
		});
	}
}

function Ver_Posesion(){
	contrato = $("#txtContrato_P").val();
	lugar = $("#cmbContrato_P option:selected").val();
	if(contrato == '' || lugar == ''){
		alert("Debe ingresar los datos para modificar");
	}else{
		$.ajax({
			url : sUrlP + 'Ver_EEjecucion',
			type : "POST",
			data : "contrato=" + contrato ,
			success : function(html) {
				$("#cmbContrato_P").val(0);
				if(html == 'No se Puede Ubicar El contrato'){
					$("#txtContrato_P").val('');	
				}
				$("#etiqueta").html(html);				
			},
			error : function(html) {
				alert('FALLO LA OPERACION'+html);
			},
		});
	}
}

function Respaldo_Modificar_Ubicacion() {
	contrato = $("#txtContrato_Ub").val();
	lugar = $("#cmbContrato_Ub option:selected").text();
	if (contrato != '' && lugar != '' && lugar != 'SELECCIONE') {
		$("#r_contrato").dialog({
			buttons : {
			"Aceptar" : function() {
				Modificar_Ubicacion();
			},
			"Cerrar" : function() {
				$(this).dialog("close");
			}
			}
		});
		$("#r_contrato").dialog("open");
	} else {
		$("#msj_alertas").html('Debe ingresar todos los datos...');
		$("#msj_alertas").dialog('open');
	}
}


function Modificar_Ubicacion(){
	contrato = $("#txtContrato_Ub").val();
	lugar = $("#cmbContrato_Ub option:selected").text();
	var peticion = $("#txtRPeticion_Cont").val();
	var motivo = $("#txtRMotivo_Cont").val();
	if(contrato == '' || lugar == '' || lugar == 'SELECCIONE' || peticion == '' || motivo == ''){
		$("#msj_alertas").html("<h2>DEBE INGRESAR<BR>-MOTIVO POR EL CUAL SE VA A MODIFICAR UBICACION DEL CONTRATO<BR>-NOMBRE DE LA PERSONA QUE SOLICITO LA MODIFICACION</h2> ");
		$("#msj_alertas").dialog({
			width : 500,
			height : 200,
		});
		$("#msj_alertas").dialog('open');
	}else{
		$("#txtRMotivo_Cont").val('');
		$("#txtRPeticion_Cont").val('');
		$.ajax({
			url : sUrlP + 'Modificar_Ubicacion',
			type : "POST",
			data : "contrato=" + contrato + "&lugar=" + lugar + "&peticion=" + peticion + "&motivo=" + motivo,
			success : function(html) {
				$("#r_contrato").dialog("close");
				$("#msj_alertas").html(html);
				$("#msj_alertas").dialog('open');
				$("#txtContrato_Ub").val('');
				$("#etiqueta2").html('');
			},
			error : function(html) {
				alert('FALLO LA OPERACION '+html);
			},
		});
	}
}

function Ver_Ubicacion(){
	contrato = $("#txtContrato_Ub").val();
	lugar = $("#cmbContrato_Ub option:selected").text();
	if(contrato == '' || lugar == ''){
		alert("Debe ingresar los datos para modificar");
	}else{
		$.ajax({
			url : sUrlP + 'Ver_Ubicacion',
			type : "POST",
			data : "contrato=" + contrato ,
			success : function(html) {
				$("#cmbContrato_Ub").val(0);
				if(html == 'No se Puede Ubicar El contrato'){
					$("#txtContrato_Ub").val('');	
				}
				$("#etiqueta2").html(html);				
			},
			error : function(html) {
				alert('FALLO LA OPERACION'+html);
			},
		});
	}
}