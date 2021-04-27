
var array_clientes=[];
var array_trabajos=[];
var array_gastos=[];
var array_balance_ingreso=[];
var array_balance_gasto=[];
var arrayinsert=[];
var array_colocar_provincias=[];
var array_balance_ingeg=[];
var array_balance_general=[];
var array_detalle_cliente=[];
var array_detalle_trabajo=[];
var array_colocar_clientes_mod=[];
var array_colocar_imagen=[];
var array_colocar_detalleReclamos=[];
var array_colocar_empresas=[];
var array_colocar_sucursales=[];

function colocarCadenas(){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'traerCadenas'},
	    success:function(data){
            array_trabajos=data;
            
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	

}
function registrarProblema(select_Empresa, usuarioUt, select_Sucursal,select_Motivo,fecha, titulo,time,descripcion,Respuesta,select_Estado, usuarioR, response){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'registrarProblema',select_Empresa:select_Empresa, usuarioUt:usuarioUt, select_Sucursal:select_Sucursal, select_Motivo:select_Motivo,fecha:fecha, titulo:titulo,time:time, descripcion:descripcion,Respuesta:Respuesta,select_Estado:select_Estado,usuarioR:usuarioR, response:response},
	    success:function(data){
            alert("Reclamo Agregado con Exito")
            
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	

}

function colocarProvinciasSelect(){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'selectProvincias'},
		success:function(data){
			array_colocar_provincias=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	})
}
function colocarEmpresaSelect(){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'selectEmpresa'},
		success:function(data){
			array_colocar_empresas=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	})
}
function colocarSucursalSelect(select_Empresa){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'selectSucursal',select_Empresa:select_Empresa},
		success:function(data){
			array_colocar_sucursales=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	})
}
function cambiarImagenJS(){
	$.ajax({
		url:'php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'selectImagenes'},
		success:function(data){
			array_colocar_imagen=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	})
}
function detalleReclamo(id){
	
	
	$.ajax({
		url:'../forum/detalleReclamo.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{id:id},
		
		success:function(data){
			
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
	//recibo los parametros del modal 
function registrarCadena(cadenaNombre, select_provincias){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'registrarCadena', cadenaNombre: cadenaNombre, select_provincias: select_provincias},
		
		success:function(data){
			//pregunto si el estado es ok. 
			if (data.estado=="OK")
			{	//de serlo indico que el cliente se agrego con exito y recargo la pagina
				alert("Cadena agregada con exito");
				window.location.href='/gastos.php';
			}else{// de no serlo indico porque
				alert("Cadena ya existe");
			}
			
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function registrarSucursal(idCadenaSuc, sucursalNombre, encargadoSuc){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'registrarSucursal', idCadenaSuc: idCadenaSuc, sucursalNombre: sucursalNombre, encargadoSuc:encargadoSuc },
		
		success:function(data){
			//pregunto si el estado es ok. 
			if (data.estado=="OK")
			{	//de serlo indico que el cliente se agrego con exito y recargo la pagina
				alert("Sucursal agregada con exito");
				window.location.href='/gastos.php';
			}else{// de no serlo indico porque
				alert("Sucursal ya existe");
			}
			
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function modificCadena(codigoCadena, nombreCad, provCadena){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'modCadena', codigoCadena:codigoCadena, nombreCad:nombreCad, provCadena:provCadena},
		
		success:function(data){
			if (data.estado=="OK")
			{	//de serlo indico que el trabajo se agrego con exito y recargo la pagina
				alert("Cambios Realizados con Exito!");
				
			}else{// de no serlo indico porque
				alert("La cadena no pudo ser modificada");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function estadoMod(codigoReclamo){
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'modEstado', codigoReclamo:codigoReclamo},
		
		success:function(data){
			if (data.estado=="OK")
			{	//de serlo indico que el trabajo se agrego con exito y recargo la pagina
				alert("Cambios Realizados con Exito!");
				
			}else{// de no serlo indico porque
				alert("La accion no se pudo Realizar!");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function deleteCadena(codigoCadena){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'deleteCadena', codigoCadena:codigoCadena},
		
		success:function(data){
			if (data.estado=="OK")
			{	
				//window.open("/clientes.php");
				//window.close("/detalleCliente.php");
				alert("Cliente Eliminado con exito!");
				
			}else{// de no serlo indico porque
				alert("El Cliente no pudo ser Eliminado");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function modificSucursal(codigoSucursal, nombreSuc, responsableSuc){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'modSucursal', codigoSucursal:codigoSucursal, nombreSuc:nombreSuc, responsableSuc:responsableSuc},
		
		success:function(data){
			if (data.estado=="OK")
			{	
				alert("Cambios Realizados con Exito!");
				
			}else{
				alert("La Sucursal no pudo ser modificada");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function deleteSucursal(codigoSucursal){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'deleteSucursal', codigoSucursal:codigoSucursal},
		
		success:function(data){
			if (data.estado=="OK")
			{	
				//window.open("/clientes.php");
				//window.close("/detalleCliente.php");
				alert("Sucursal Eliminada con exito!");
				
			}else{// de no serlo indico porque
				alert("La Sucursal no pudo ser Eliminada");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}
function deleteReclamo(codigoReclamoDel){
	
	
	$.ajax({
		url:'/php/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		//paso a json los datos que recibo de parametro y el ajax los manda a controller
		data:{tipo:'deleteReclamo', codigoReclamoDel:codigoReclamoDel},
		
		success:function(data){
			if (data.estado=="OK")
			{	
				//window.open("/clientes.php");
				//window.close("/detalleCliente.php");
				alert("Reclamo Eliminado con exito!");
				
			}else{// de no serlo indico porque
				alert("El Reclamo no pudo ser Eliminado");
			}
				
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
		
}