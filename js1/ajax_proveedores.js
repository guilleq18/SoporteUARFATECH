var array_fuentes=[];
var array_referencias=[];
var array_incidenciasA=[];
var array_incidenciasB=[];
var array_incidenciasM=[];
var array_incidenciasN=[];
var array_incidenciasR=[];
var array_incidenciasT=[];
var array_incidenciasU=[];
var array_incidenciasE=[];
var array_incidenciasS=[];
var array_incidenciasC=[];
var array_incidenciasP=[];
var array_incidenciasI=[];
var array_actualizaciones=[];
var array_nuevos=[];

function colocarFuentes(){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'lista'},
		success:function(data){
			array_fuentes=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarFuente(descripcion){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregar', descripcion: descripcion},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function procesarFuente(fuente){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesar', fuente: fuente},
		success:function(data){
			if(data[0].estado=='OK'){
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'referencias', fuente: fuente},
					success:function(data){
						array_referencias=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasA', fuente: fuente},
					success:function(data){
						array_incidenciasA=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasB', fuente: fuente},
					success:function(data){
						array_incidenciasB=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasM', fuente: fuente},
					success:function(data){
						array_incidenciasM=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasN', fuente: fuente},
					success:function(data){
						array_incidenciasN=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasR', fuente: fuente},
					success:function(data){
						array_incidenciasR=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasT', fuente: fuente},
					success:function(data){
						array_incidenciasT=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasU', fuente: fuente},
					success:function(data){
						array_incidenciasU=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasE', fuente: fuente},
					success:function(data){
						array_incidenciasE=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasS', fuente: fuente},
					success:function(data){
						array_incidenciasS=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasC', fuente: fuente},
					success:function(data){
						array_incidenciasC=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasP', fuente: fuente},
					success:function(data){
						array_incidenciasP=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasI', fuente: fuente},
					success:function(data){
						array_incidenciasI=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'actualizaciones', fuente: fuente},
					success:function(data){
						array_actualizaciones=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/proveedores.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'nuevos', fuente: fuente},
					success:function(data){
						array_nuevos=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
			}
			else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarProductos(array){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'productos', array: array},
		success:function(data){
			alert(data);
			$("#t_incidencias").click().trigger("click");
			$("#t_nuevos").css({"opacity": "0.5", "pointer-events": "none"});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function actualizarPrecios(array){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'precios', array: array},
		success:function(data){
			alert(data);
			$("#t_incidencias").click().trigger("click");
			$("#t_actualizaciones").css({"opacity": "0.5", "pointer-events": "none"});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function actualizarPrecioReferencia(producto){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'precio_referencia', producto: producto},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarCodigo(producto){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'codigo', producto: producto},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function reactivarBaja(producto){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'reactivar', producto: producto},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function asociarProducto(producto){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'asociar', producto: producto},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function vincularProducto(producto){
	$.ajax({
		url:'/php/proveedores.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'vincular', producto: producto},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}