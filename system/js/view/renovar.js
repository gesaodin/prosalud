function Organismos() {
	$("#txtContratante").find('option').remove().end();
	valor = $("#txtEstado").val();
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

function Limpiar() {
	$('#txtCodigo').val('');
	$('#txtTipoServicio').val('');
	$('#txtActivoF').val('');
	$('#txtCobertura').val('');

	$('#txtCoberturaFamiliar').val('');
	$("#txtDirectivo").val('');
	$('#txtCoberturaMT').val('');
	$('#txtCoberturaMF').val('');

	$('#txtConsultas').val('');
	$('#txtExamen').val('');
	$('#txtLimpiezas').val('');
	$('#txtResina').val('');
	$('#txtExodoncia').val('');
	$('#txtEstudiosEspeciales').val('');

	$('#txtGrupo1').val('');
	$('#txtGrupo2').val('');
	$('#txtGrupo3').val('');
	$('#txtGrupo4').val('');

}

function Consultar() {
	$("#carga_busqueda").dialog('open');
	$.ajax({
		url : sUrlP + "Consutlar_Cobertura",
		data : 'est=' + $('#txtEstado').val() + '&con=' + $('#txtContratante').val(),
		type : 'POST',
		dataType : "json",
		success : function(oEsq) {

			$('#txtCodigo').val(oEsq['codigo']);
			$('#txtTipoServicio').val(oEsq['plan']);
			$('#txtActivoF').val(oEsq['renovacion']);
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

function Renovar() {
	estado = $('#txtEstado').val();
	contratante = $('#txtContratante').val();
	codigo = $('#txtCodigo').val();
	plan = $('#txtTipoServicio').val();
	renovacion = $('#txtActivoF').val();
	cobertura = $('#txtCobertura').val();
	monto_dependiente = $('#txtCoberturaFamiliar').val();
	directivo = $("#txtDirectivo").val();
	mt = $('#txtCoberturaMT').val();
	mc = $('#txtCoberturaMF').val();
	consultas = $('#txtConsultas').val();
	examenes = $('#txtExamen').val();
	ld = $('#txtLimpiezas').val();
	or = $('#txtResina').val();
	es = $('#txtExodoncia').val();
	ee = $('#txtEstudiosEspeciales').val();
	g1 = $('#txtGrupo1').val();
	g2 = $('#txtGrupo2').val();
	g3 = $('#txtGrupo3').val();
	g4 = $('#txtGrupo4').val();

	cadena = "codigo=" + codigo + "&plan=" + plan + "&renovacion=" + renovacion + "&cobertura=" + cobertura + 
	"&dependientes=" + monto_dependiente + "&directivo=" + directivo + "&MT=" + mt + "&MC=" + mc + "&consultas=" + 
	consultas + "&examenes=" + examenes + "&LD=" + ld + "&OR=" + or + "&ES=" + es + "&EE=" + ee + "&G1=" + g1 + "&G2=" +
	g2 + "&G3=" + g3 + "&G4=" + g4 + "&estado=" + estado + "&contratante=" + contratante;

	cargando = '<center><br><img src="' + sImg + 'cargando.gif"><br>Por Favor Espere un momento</center>';
	
	
	$('#msj_alertas').html(cargando);
	$('#msj_alertas').dialog("open");
	$.ajax({
		url : sUrlP + "Renovar_Cobertura",
		data : cadena,
		type : 'POST',
		success : function(sHtml) {
			$('#msj_alertas').dialog("close");
			$('#msj_alertas').html('<center><br>' + sHtml + '</center>');
			$('#msj_alertas').dialog("open");
		}
	});

}
