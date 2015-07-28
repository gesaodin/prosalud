function Consultar(){
	valor = $("#txtConsultar").val();
	$.ajax({
		url :  sUrlP + "Consultar_Operador",
		type : "POST",
		data: "valor=" + valor,
		//dataType : "json",
		success : function(data) {
			$("#Resultado").html(data);	
		}
	});
}