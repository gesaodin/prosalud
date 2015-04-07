function Editar_Tabla(nombre_aux, funcion) {
	var json = '{ ';
	
	var inicio = 0;
	var inicio2 = 0;
	var fecha = new Date();
	
	$("#tabla_tgrid" + nombre_aux + " tbody tr").each(function(index) {
		var i = 0;
		
		var ubica_radio = 0;
		arr_id = this.id.split('_');
		//alert(arr_id[arr_id.length-1]);
		if (arr_id[arr_id.length-1] != 'Detalle' && arr_id[arr_id.length-1] != '' && arr_id[arr_id.length-1] == nombre_aux) {
			if (inicio != 0) {
				json += ',';
			}
			inicio++;
			json += ' " ' + this.id + ' " : { ';
			inicio2 = 0;
			$(this).children("td").each(function(index2) {
				if (inicio2 != 0) {
					json += ",";
				}
				inicio2++;
				if (this.id.charAt(0) == 'R') {//PARA OBTENER EL VALOR EN CASO DE OPTION BUTTON
					if (ubica_radio == 0) {
						ubica_radio = 1;
						var rad = 'radio_' + this.id.substring(1);
						var cont = $("input[name='" + rad + "']:checked").val();
						json += '"' + i + '" : "' + cont + '"';
						i++;
					}
				} else {//OBTENER EL VALOR TEXT DE LA CELDA
					if (this.childNodes.length > 1) {
						var algo = this.childNodes.item(0);
						json += '"' + i + '" : "' + algo.innerHTML + '"';
						i++;
					} else {
						json += '"' + i + '" : "' + $(this).text() + '"';
						i++;
					}
				}
			});
			json += '} ';
		}
	
	});
	json += '} ';
	inicio = 0;


	$('#dialog_pie' + nombre_aux).dialog({
		modal : true,
		title : 'BAJAR ARCHIVO',
		hide : 'explode',
		show : 'slide',
		width : 650,
		height : 400,
		buttons : {
			"Cerrar" : function() {
				$(this).dialog("close");
			}
		}

	});

	$("#dialog_pie" + nombre_aux).html("<br><br><br><p><center>Cargando por favor espere un momento<br><img src='" + sImg + "cargando.gif'></center></p>");
	$("#dialog_pie" + nombre_aux).show();
	//$("#dialog_pie" + nombre_aux).html(json);
	$.ajax({
		url : sUrlP + funcion,
		type : "POST",
		data : "cuerpo=" + json,
		success : function(data_r) {
			$("#dialog_pie" + nombre_aux).html(data_r);
		}
	});

}