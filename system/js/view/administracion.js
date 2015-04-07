/**
 * @author Servidor
 */

$(function() {
	var dates = $("#txtFechaR, #txtFechaF, #txtFechaCheque").datepicker({
		showOn : "button",
		buttonImage : sImg + "calendar.gif",
		buttonImageOnly : true,
		onSelect : function(selectedDate) {
			var option = this.id == "txtfechas", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
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
		dateFormat : 'yy-mm-dd',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	/**
	 * Lista de Proveedores
	 */

	$('#frmAdministracion').dialog({
		autoOpen : false,
		show : {
			effect : "blind",
			duration : 1000
		},
		hide : {
			effect : "explode",
			duration : 1000
		},
		width : 600,
		height : 350,
		buttons : {
			"Guardar" : function() {

				$(this).dialog("close");
				Guardar();

			},
			"Cerrar" : function() {
				Limpiar();
				$(this).dialog("close");
			},
		}
	});
	//Fin de lista Proveedores
	
		$('#frmControlCheque').dialog({
		autoOpen : false,
		show : {
			effect : "blind",
			duration : 1000
		},
		hide : {
			effect : "explode",
			duration : 1000
		},
		width : 550,
		height : 200,
		buttons : {
			"Guardar" : function() {
				Guardar_Cheques();
				$(this).dialog("close");

			},
			"Cerrar" : function() {
				
				$(this).dialog("close");
				Limpiar_Asociar_Cheques();
			},
		}
	});

});

//Listar Linajes
function Listar_Ciudades() {
	$("#txtCiudadCentroOAM").find('option').remove().end();

	$.ajax({
		url : sUrlP + "Listar_Ciudades",
		type : 'POST',
		data : 'oid=' + $("#txtEstadoCentroOAM").val(),
		dataType : "json",
		success : function(data) {
			$.each(data['ciudad'], function(item, valor) {
				$("#txtCiudadCentroOAM").append(new Option(valor, valor));
			});
		}
	});
}

function Listar_Centros() {
	var estado = $("#txtEstadoCentroOAM").val();
	var ciudad = $("#txtCiudadCentroOAM").val();
	$("#txtProveedoresOAM").find('option').remove().end();
	$.ajax({
		type : "POST",
		url : sUrlP + "Listar_Proveedores",
		data : "estado=" + estado + "&ciudad=" + ciudad,
		dataType : "json",
		success : function(data) {
			$.each(data['nombres'], function(item, valor) {

				$("#txtProveedoresOAM").append(new Option(valor, valor));
			});
		},
	});
}

function Ver_Listado() {
	//$("#centros").hide("fade", {}, 1000);

	$("#lblClinica").text($("#txtProveedoresOAM").val());
	$("#txtClinica").val($("#txtProveedoresOAM").val());
	$("#txtEstado").val($("#txtEstadoCentroOAM").val());
	$("#txtCiudad").val($("#txtCiudadCentroOAM").val());

	strUrl_Proceso = sUrlP + "Recepcion_HCM";
	$.ajax({
		type : "POST",
		url : strUrl_Proceso,
		data : "id=" + $("#txtProveedoresOAM").val(),
		dataType : "json",
		success : function(oEsq) {
			Grid = new TGrid(oEsq, 'DivReportes', 'FACTURAS PENDIENTES POR HCM');
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName('DivReportes');
			Grid.SetDetalle();
			Grid.Generar();
		}
	});
}

function Ver_Cuentas() {
	strUrl_Proceso = sUrlP + "Cuentas_Por_Pagar";
	$("#txtest").val($("#txtEstadoCentroOAM").val());
	$("#txtciu").val($("#txtCiudadCentroOAM").val());
	
	$.ajax({
		type : "POST",
		url : strUrl_Proceso,
		data : "id=" + $("#txtProveedoresOAM").val(),
		dataType : "json",
		success : function(oEsq) {
		
			Grid = new TGrid(oEsq, 'DivReportes', 'CUENTAS POR PAGAR A: ' + $("#txtProveedoresOAM").val());
			Grid.SetXls(false);
			Grid.SetNumeracion(true);
			Grid.SetName('DivReportes');
			Grid.SetDetalle();
			Grid.Generar();

		}
	});

}

function Limpiar() {
	$("#txtMonto").val("");
	$("#txtFechaR").val("");
	$("#txtFechaF").val("");
	$("#txtISRL").val("");
	$("#txtNFactura").val("");
	$("#txtMontoT").val("");
	$("#txtMontoC").val("");
	$("#txtMontoPP").val("");

}

/**
 * Calculo de Impuesto Sobre la Renta
 */
function ISRL() {
	var dSolicitado = 0;
	var dResultado = 0;
	var dPPago = $("#cmbPPago").val();
	var dMPPago = 0;
	var dMontoT = 0;
	if ($("#cmbSeleccion").val() == 1) {
		dSolicitado = $("#txtMonto").val();
	} else if ($("#cmbSeleccion").val() == 2) {
		dSolicitado = $("#txtMontoC").val();
	}
	dResultado = (dSolicitado * 5) / 100;
	if (dPPago != 0)
		dMPPago = (dSolicitado * dPPago) / 100;
	dMontoT = (dSolicitado - dResultado) - dMPPago;
	$("#txtISRL").val(dResultado);
	$("#txtMontoPP").val(dMPPago);
	$("#txtMontoT").val(dMontoT);

}

function Asociar_Factura(cod, tit, nom, mon, diag) {
	var sClave = "Clave: " + cod + " Titular: " + nom;
	$("#lblClave").text(sClave);
	$("#txtClave").val(cod);
	$("#txtMontoC").val(mon);
	$("#txtDiagnostico").val(diag);
	
	strUrl_Proceso = sUrlP + "Consultar_Recepcion";
	$.ajax({
		type : "POST",
		url : strUrl_Proceso,
		data : "id=" + cod,
		dataType : "json",
		success : function(json) {
			if(json['mcom'] != "NA"){
				$("#txtFechaR").val(json['frec']);
				$("#txtMontoC").val(json['mcom']);
				$("#cmbPPago").val(json['ppp']);			
				$("#txtNFactura").val(json['nfac']);
				$("#txtFechaF").val(json['ffac']);
				$("#txtMonto").val(json['mfac']);
				$("#cmbSeleccion").val(json['desp']);	//Factura o Compromiso
				$("#txtISRL").val(json['isrl']);
				$("#txtMontoPP").val(json['mpp']);
				$("#txtMontoT").val(json['mtot']);
			}
		}
	});

	$("#frmAdministracion").dialog("open");
}

function Asociar_Cheques(rif,emp,fch,mnt){
	
	$("#frmControlCheque").dialog("open");
	$("#txtrif").val(rif);
	$("#txtemp").val(emp);
	$("#txtfch").val(fch);
	
	$("#txtMontoCheque").val(mnt);
	
}
function Limpiar_Asociar_Cheques(){
	$("#txtNumeroCheque").val('')
	$("#txtFechaCheque").val('');
}

function Guardar_Cheques(){
	
	var rif = $("#txtrif").val();
	var clin = $("#txtemp").val();
	var fch = $("#txtfch").val();
	var mnt = $("#txtMontoCheque").val();
	var bnc = $("#txtBanco").val();
	var fchq = $("#txtFechaCheque").val();
	var ciu = $("#txtciu").val();
	var est = $("#txtest").val();	
	var nche = $("#txtNumeroCheque").val();
	
	var cadena = "rif=" + rif + "&clin=" + clin + "&frec=" + fch + "&ciud=" + ciu 
	+ "&esta=" + est + "&fchq=" + fchq + "&bnc=" + bnc + "&nche=" + nche;
	
	strUrl_Proceso = sUrlP + "Guardar_Cheques";
	$.ajax({
		type : "POST",
		url : strUrl_Proceso,
		data : cadena,
		success : function(oHtml) {
			$('#msj_alertas').html(oHtml);
			$('#msj_alertas').dialog("open");
		}
	});
		
	$("#frmAdministracion").dialog("close");
	Limpiar_Asociar_Cheques();
}

function Guardar() {

	var frec = $("#txtFechaR").val();
	var mcom = $("#txtMontoC").val();
	var ppp = $("#cmbPPago").val();
	var nfac = $("#txtNFactura").val();
	var ffac = $("#txtFechaF").val();
	var mfac = $("#txtMonto").val();
	var desp = $("#cmbSeleccion").val();
	//Factura o Compromiso
	var isrl = $("#txtISRL").val();
	var mpp = $("#txtMontoPP").val();
	var mtot = $("#txtMontoT").val();
	var clav = $("#txtClave").val();
	var clin = $("#txtClinica").val();
	var esta = $("#txtEstado").val();
	var ciud = $("#txtCiudad").val();

	var cadena = "frec=" + frec + "&mcom=" + mcom + "&ppp=" + ppp + "&nfac=" + nfac + "&ffac=" + ffac + "&mfac=" + mfac + "&desp=" + desp + "&isrl=" + isrl + "&mpp=" + mpp + "&mtot=" + mtot + "&clav=" + clav + "&clin=" + clin + "&esta=" + esta + "&ciud=" + ciud;

	strUrl_Proceso = sUrlP + "Guardar_Recepcion";
	$.ajax({
		type : "POST",
		url : strUrl_Proceso,
		data : cadena,
		success : function(oHtml) {
			$('#msj_alertas').html(oHtml);
				$('#msj_alertas').dialog("open");
		}
	});

	Limpiar();

}

