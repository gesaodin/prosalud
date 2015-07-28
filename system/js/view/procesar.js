 	
 	/**	
 	 * 	Controlador system.js.view.procesar.js
 	 * 	
 	 */
 	if (document.addEventListener) {
   		document.addEventListener("DOMContentLoaded", cargando, false);
	} 
	function cargando(){
		//$("#carga_busqueda").dialog('open');
	}
	
 	$(function(){
 		
		$('#dialog').dialog({
			autoOpen: false,
			position: 'top',
			width: "50%",
			height: 500,
			buttons: {
				"Aceptar": function() { 
					Enviar(); 
				},
				"Imprimir": function() { 
					Imprime_Contrato(); 
				}, 					
				"Cancelar": function() {
					
					$(this).dialog("close"); 
				}	
			}
		});
		
		
	});
	$("#mbuzon").removeClass('active');
	$("#mcliente").addClass('active');
 	
  
  function Eliminar_Contrato(documento_id, contrato_id, fecha, monto){
		strUrl_Proceso = sUrlP + "Eliminar_Cobros";
		$.ajax({
			url: strUrl_Proceso,
			type: 'post',
			data: 'documento_id=' + documento_id	+ '&contrato_id=' + contrato_id + '&fecha=' + fecha + '&monto=' + monto,
			success: function(htm) {
				$('#tabla_creditos').html(htm);		
			} 
		});
	}

	function Mostrar_Detalles(id){	$('#divDetalles'+id).show("blind");	}

	function Ocultar_Detalles(id){	$('#divDetalles'+id).hide("blind");	}
		
	function Consultar(documento_id, contrato_id){
		strUrl_Proceso = sUrlP + "DataSource_Cobros";
		document.getElementById("txtDocumento_Id").value = documento_id;
		document.getElementById("txtNumero_Contrato").value = contrato_id;
		$.ajax({
				url: strUrl_Proceso,
				type: 'POST',
				data: 'documento_id=' + documento_id	+ '&contrato_id=' + contrato_id,
				success: function(htm) {
					$('#tabla_creditos').html(htm);				
				} 
		});
		$('#dialog').dialog("open");
	}
		
	function Consultar_Asociado(cedula){
		if(cedula != "No Aplica"){
			$("#txtBuscar").val(cedula);
			$("#frmBuscar").submit();
		}
	}
		
	function Enviar(){
		strUrl_Proceso = sUrlP + "Agregar_Cobros";
		var documento_id = $("#txtDocumento_Id").val();
		var contrato_id = $("#txtNumero_Contrato").val();
		var monto = $("#txtmontocobrado").val();		
		var diaC = $("#txtDiaCobro").val();
		var mesC = $("#txtMesCobro").val();
		var anoC = $("#txtAnoCobro").val();
		var fecha = anoC + "-" + mesC + "-" + diaC;
		var descripcion = document.getElementById("txtDescripcion").value;
		$("#msj_alertas").html('POR FAVOR ESPERE MIENTRAS SE CARGA EL COBRO');
		$("#msj_alertas").dialog("open");
		$.ajax({
				url: strUrl_Proceso,
				type: 'POST',
				data: 'documento_id=' + documento_id
						+ '&contrato_id=' + contrato_id
						+ '&fecha=' + fecha
						+ '&mes=0'
						+ '&descripcion=' + descripcion
						+ '&monto=' + monto,
				success: function(htm) {
					$("#msj_alertas").html('La cuota se cargo con exito...');
					$('#tabla_creditos').html(htm);		 	
				}					
		})
 	}
		

	function Imprime_Contrato(){
 		var cedula = $("#txtDocumento_Id").val();
 		var contrato = $("#txtNumero_Contrato").val();
 		strUrl_Proceso = sUrlP + "Imprimir_Estado_Cuenta_Contrato/"+cedula+"/"+contrato; 	 		
 		window.open(strUrl_Proceso,"Width=450,Height=450,Location =No,Menubar =No,Status =No"); 		
 	}
	function Imprimir_Estado() {	
		strUrl  =  sUrlP + "Imprimir_Estado/" + $("#documento_id").val() ;
		window.open(strUrl,"ventana1","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=800,height=800")
	}
	
function PInventarioAsociar(sUrl, sSerial) {
	//var sUrlP = sUrl;
	var sCont = "";
	var factura = $("#txtnfactura").val();
	if(factura != ''){
		var iPos = 1;
		$.ajax({
			url : sUrl,
			type : "POST",
			data : "serial=" + sSerial + "&factura=" + factura,
			success : function(html) {
				alert('Se asocio serial');
				$("#divDetalles" + iPos).html(html);

			}
		});
	}else{
		alert('Debe ingresar una factura');
	}
}




function CFactura(cedula) {
	$.ajax({
		url : sUrlP + "TG_Cedula",
		type : "POST",
		data : 'id=' + cedula,
		dataType : "json",
		success : function(oEsq) {			
			Grid = new TGrid(oEsq,'Procesar',"titulo");
			Grid.SetNumeracion(true);			
			Grid.SetName("Procesar");
			Grid.SetDetalle();
			Grid.Generar();
			if(oEsq.alerta != ''){
				$("#msj_alertas").html(oEsq.alerta);
				$("#msj_alertas").dialog("open");
			}
		}
	});
}


