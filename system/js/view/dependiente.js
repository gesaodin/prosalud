$(function() {
	
	cedula = $("#txtCedulaDependiente").val();
		if (cedula != '') {
		$.ajax({
			url : sUrlP + "Listar_Casos",
			type : "POST",
			data : "id=" + cedula,
			dataType : "json",
			success : function(oEsq) {
				
				Grid = new TGrid(oEsq, 'Reportes', '');
				Grid.SetXls(false);
				Grid.SetNumeracion(true);
				Grid.SetName("Reportes");
				Grid.SetDetalle();
				Grid.Generar();
				Grid.Origen();
			}
		});

	}
	
});

/**
 * 
 */
function Limpiar(){
	$("#txtNacionalidad1").val('');
	$("#txtnombreTitular").val('');	
	$("#txtCedulaTitular").val('');
	$("#txtNacionalidad2").val('');
	$("#txtCedulaDependiente").val('');
	$("#txtCedulaDependiente2").val('');
	$("#txtParentesco").val('');
	$("#txtNombre1").val('');
	$("#txtDiaNacimiento").val('');
	$("#txtMesNacimiento").val('');
	$("#txtAnoNacimiento").val('');
	$("#txtSexo").val('');
	$("#txtEdad").val('');
	$("#txtGrupo").val('');
	$("#txtCargo").val('');
	$("#txtEdocivil").val('');
	$("#txtCiudad").val('');
	$("#txtEstado").val('');
	$("#txtTlfHabitacion").val('');
	$("#txtTlfCelular").val('');
	$("#txtCoberturaD").val('');
	$("#txtCoberturaR").val('');
}

function Registrar(){
	Url = sUrlP + "Registrar_Dependiente";
	
	nac = $("#txtNacionalidad2").val();
	titu = $("#txtCedulaTitular").val();
	ced2 = $("#txtCedulaDependiente").val();
	ced = $("#txtCedulaDependiente2").val();
	
	par = $("#txtParentesco").val();
	nom = $("#txtNombre1").val();
	dia = $("#txtDiaNacimiento").val();
	mes = $("#txtMesNacimiento").val();
	ano = $("#txtAnoNacimiento").val();
	var fec = ano + "-" + mes + "-" + dia;
	
	//--10-06-2015
	diaI = $("#txtDiaIngreso").val();
	mesI = $("#txtMesIngreso").val();
	anoI = $("#txtAnoIngreso").val();
	var fecI = anoI + "-" + mesI + "-" + diaI;
	
	
	
	sex = $("#txtSexo").val();	
	gru = $("#txtGrupo").val();	
	tel = $("#txtTlfHabitacion").val();
	cel = $("#txtTlfCelular").val();
	cob = $("#txtCoberturaD").val();
	ret = $("#txtCoberturaR").val();
	act = $("#txtEstatus option:selected").val();
	
	var cadena = "cob=" + cob + "&ret=" + ret + "&act=" + act + "&sex=" + sex + "&ced=" + ced2 + "&nom=" + nom 
	+ "&fec=" + fec + "&feci=" + fecI + "&tel=" + tel + "&cel=" + cel + "&par=" + par + "&gru=" + gru + "&nac=" + nac + "&ced2=" + ced + "&titular=" + titu;
	
	if ($("#txtNombre1").val() == "" || $("#txtCoberturaD").val() == "" || $("#txtCoberturaR").val() == "") {
		alert("No puede tener actualizacion en blanco la cedula...");
	} else {
		$.ajax({
			url : Url,
			type : "POST",
			data : cadena,
			success : function(sHtml) {
				alert(sHtml);
				Limpiar();
			}
		});
	}
}
