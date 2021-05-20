var pedido=[];

function colocarPedido(codigo){
	$.ajax({
		url:'/php/monroe/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'pedido', folio: codigo},
		success:function(data){
			pedido=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}

function procesarPedido(codigo, estado){
	$.ajax({
		url:'/php/monroe/controller.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'procesar', folio: codigo, estado: estado},
		success:function(data){
			alert(data);
			$("#in_codigo").val("");
			$("#in_codigo").trigger('input');
			if(data=="Pedido procesado correctamente"){
				var axls = document.getElementById("faltas");
				axls.href="../php/monroe/faltas.xls";
				axls.download="faltas.xls";
				axls.click();
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
