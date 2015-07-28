function Limpiar() {
	$('#txtCiudad').val('');
	$('#txtRif').val('');
	$('#txtNom').val('');
	$('#txtPer').val('');
	$('#txtCor').val('');
	$('#txtTel').val('');
	$('#txtNomA').val('');
	$('#txtRaz').val('');
	$('#txtDir').val('');
	$('#txtTelO').val('');
	$('#txtFax').val('');
	$('#txtBan').val('');
	$('#txtCue').val('');
}

function Guardar(){	
	estado = $('#txtEstado').val();
	ciudad = $('#txtCiudad').val();
	tipo = $('#txtTipo').val();
	nombre = $('#txtNom').val();
	rif = $('#txtRif').val();
	direccion = $('#txtDir').val();
	telefono = 	$('#txtTelO').val();
	fax = $('#txtFax').val();
	correo = $('#txtCor').val();
	personacontacto = $('#txtPer').val();	
	telefonocon = $('#txtTel').val();
	nombreadm = $('#txtNomA').val();
	razon = $('#txtRaz').val();	
	banco = $('#txtBan').val();
	cuenta = $('#txtCue').val();
	
	cadena = "estado=" + estado + "&ciudad=" + ciudad + "&tipo=" + tipo +
					 "&nombre=" + nombre + "&rif=" + rif + "&direccion=" + direccion +
					 "&telefono=" + telefono + "&fax=" + fax + "&correo=" + correo +
					 "&personacontacto=" + personacontacto + "&telefonocon=" + telefonocon + "&nombreadm=" + nombreadm +
					 "&razon=" + razon + "&banco=" + banco + "&cuenta=" + cuenta + "&estatus=" + "ACTIVO";	
	$.ajax({
		url : sUrlP + "Guardar_Proveedor",
		data : cadena,
		type : 'POST',		
		success : function(oHtml) {
			alert(oHtml);
			Limpiar();
		}
	});
}


