var pedido=[];

function colocarOfertas(){
	$.ajax({
		url:'/php/sud/controller.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo: 'exportar_ofertas'},
		success:function(data){
			if(data=="OK"){
				var a = document.getElementById("link");
				a.href="../php/sud/ofertas.xls";
				a.download="ofertas.xls";
				a.click();
			}
			else{
				alert(data);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
}

function colocarPedido(codigo){
	$.ajax({
		url:'/php/sud/controller.php',
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
		url:'/php/sud/controller.php',
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
				axls.href="../php/sud/faltas.xls";
				axls.download="faltas.xls";
				axls.click();
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}