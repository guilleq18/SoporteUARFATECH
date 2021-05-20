
function modificarImpresion(codigoImpresion){
	$.ajax({
		url:'/php/sic/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'modImpresion', codigoImpresion:codigoImpresion},
	    success:function(data){
            alert("Datos Guardados");
            
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	

}
