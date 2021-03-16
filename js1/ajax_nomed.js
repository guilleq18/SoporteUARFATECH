//////////////////////////////////////////////////////////////
// Catalogos												//
//////////////////////////////////////////////////////////////
function altaNuevoProducto(descripcion, codigoLaboratorio, codigoFamilia, codigoDepartamento, codigoRelacionado){
	return $.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'altaNuevoProducto', descripcion: descripcion, codigoLaboratorio: codigoLaboratorio, codigoFamilia: codigoFamilia, codigoDepartamento: codigoDepartamento, codigoRelacionado: codigoRelacionado},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	}).responseText;	
}
function traerProducto(codigoProducto){
	return JSON.parse($.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'traerProducto', codigoProducto: codigoProducto},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	}).responseText);	
}
function actualizarProducto(codigoProducto, descripcion, codigoLaboratorio, codigoFamilia, codigoDepartamento, especial){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'actualizarProducto', codigoProducto: codigoProducto, descripcion: descripcion, codigoLaboratorio: codigoLaboratorio, codigoFamilia: codigoFamilia, codigoDepartamento: codigoDepartamento, especial: especial},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Producto actualizado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function bajaDefinitivaProducto(codigoProducto){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'bajaDefinitivaProducto', codigoProducto: codigoProducto},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Producto dado de baja");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function altaRelacionadoProducto(codigoProducto, codigoRelacionado, unidades){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'altaRelacionadoProducto', codigoProducto: codigoProducto, codigoRelacionado: codigoRelacionado, unidades: unidades},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Codigo EAN agregado");
			}else{
				alert(data[0].error);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function eliminarCodigoRelacionado(codigoRelacionado, codigoProducto){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'eliminarCodigoRelacionado', codigoRelacionado: codigoRelacionado, codigoProducto: codigoProducto},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Codigo EAN eliminado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function vincularProductoReferencia(codigoProducto, codigoProductoReferencia, porcentajeReferencia){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'vincularProductoReferencia', codigoProducto: codigoProducto, codigoProductoReferencia: codigoProductoReferencia, porcentajeReferencia: porcentajeReferencia},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Vinculación procesada");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
//////////////////////////////////////////////////////////////
// Listas													//
//////////////////////////////////////////////////////////////
function procesarVinculacion(proveedor, seccion, codigoRelacionado, codigoProducto, estado){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesar_vinculacion', proveedor: proveedor, seccion: seccion, codigoRelacionado: codigoRelacionado, codigoProducto: codigoProducto, estado: estado},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Procesado correctamente");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function procesarExclusionRelacionado(codigoRelacionado, observacion){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarExclusionRelacionado', codigoRelacionado: codigoRelacionado, observacion: observacion},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Cod. EAN procesado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function cambiarProveedorProducto(codigoProducto, codigoProveedor, codigoSeccion, codigoInterno, codigoRelacionado, alfabeta){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'cambiarProveedorProducto', codigoProducto: codigoProducto, codigoProveedor: codigoProveedor, codigoSeccion: codigoSeccion, codigoInterno: codigoInterno, codigoRelacionado: codigoRelacionado, alfabeta: alfabeta},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Proveedor principal actualizado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function integrarSeccionPrecios(proveedor, seccion, json){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'integrarSeccionPrecios', proveedor: proveedor, seccion: seccion, json: json},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Nuevos precios integrados");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
//////////////////////////////////////////////////////////////
// DDS														//
//////////////////////////////////////////////////////////////
function procesarSudLista(){
	return JSON.parse($.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarSudLista'},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	}).responseText);	
}
function procesarExclusionLaboratorioSud(laboratorio, observacion){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarExclusionLaboratorioSud', laboratorio: laboratorio, observacion: observacion},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Laboratorio procesado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function procesarExclusionJerarquia(jerarquia, observacion){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarExclusionJerarquia', jerarquia: jerarquia, observacion: observacion},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Jerarquia procesada");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
//////////////////////////////////////////////////////////////
// Monroe													//
//////////////////////////////////////////////////////////////
function procesarMonroeLista(){
	return JSON.parse($.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarMonroeLista'},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	}).responseText);	
}
function procesarExclusionLaboratorioMonroe(laboratorio, observacion){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesarExclusionLaboratorioMonroe', laboratorio: laboratorio, observacion: observacion},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Laboratorio procesado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
//////////////////////////////////////////////////////////////
// Otros proveedores										//
//////////////////////////////////////////////////////////////
function integrarCatalogoProveedor(proveedor, seccion){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'integrarCatalogoProveedor', proveedor: proveedor, seccion: seccion},
		success:function(data){
			if(data[0].estado=='OK'){
				document.forms["formProcesado"].submit();
			}
			else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText);
			console.log(jqXHR.responseText+" | " +textStatus+ " | " +errorThrown);
		}
	});	
}
//////////////////////////////////////////////////////////////
// Ajustes													//
//////////////////////////////////////////////////////////////
function ajusteMasivoProductos(json){
	$.ajax({
		url:'/php/nomed.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'ajusteMasivoProductos', json: json},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Productos modificados correctamente");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}