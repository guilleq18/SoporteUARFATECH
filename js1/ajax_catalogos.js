var array_proveedores=[];
var array_productosProveedor=[];

//Familias
function configurarRecargo(codigoUno, codigoDos, codigoTres, codigoCuatro, recargo){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'configurar_familia', codigoUno: codigoUno, codigoDos: codigoDos, codigoTres: codigoTres, codigoCuatro: codigoCuatro, recargo: recargo},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
//Proveedores
function configurarSuscripcion(codigoProveedor){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'suscripcion', codigoProveedor: codigoProveedor},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarSeccion(codigoProveedor, descripcion){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregar_seccion', codigoProveedor: codigoProveedor, descripcion: descripcion},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function eliminarSeccion(codigoProveedor, codigoSeccion){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'eliminar_seccion', codigoProveedor:codigoProveedor, codigoSeccion:codigoSeccion},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}