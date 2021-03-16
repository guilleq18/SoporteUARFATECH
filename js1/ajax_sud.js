var array_incidenciasE=[];
var array_incidenciasA=[];
var array_incidenciasB=[];
var array_incidenciasM=[];
var array_incidenciasN=[];
var array_incidenciasR=[];
var array_incidenciasT=[];
var array_incidenciasU=[];
var array_incidenciasS=[];
var array_incidenciasC=[];
var array_incidenciasP=[];
var array_incidenciasI=[];
var array_incidenciasX=[];
var array_packs=[];
var array_actualizaciones=[];
var array_nuevos=[];

function importarCatalogo(){
	$.ajax({
		url:'/php/sud.php',
		type:'POST',
		async: true,
		dataType:'html',
		data:{tipo:'descarga', autorizacion: "Basic "+btoa("101215:dE$f_45d$70fs")},
		success:function(data){
			$.unblockUI();
			if(data==' OK'){
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: true,
					dataType:'json',
					data:{tipo:'integrar'},
					success:function(data){
						if(data[0].status=='OK'){
							document.getElementById("estado").innerHTML="Importado correctamente: "+data[0].fechaImportacion;
							alert("Importado correctamente");
						}else{
							alert("Error importando el catalogo.");
						}
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});	
			}else{
				alert("Error descargando el catalogo. "+data);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	})
}
function procesarFuente(){
	$.ajax({
		url:'/php/sud.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'procesar'},
		success:function(data){
			if(data[0].estado=='OK'){
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'nuevos'},
					success:function(data){
						array_nuevos=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'actualizaciones', fuente: 1},
					success:function(data){
						array_actualizaciones=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasE'},
					success:function(data){
						array_incidenciasE=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasA'},
					success:function(data){
						array_incidenciasA=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasB', fuente: 1},
					success:function(data){
						array_incidenciasB=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasM', fuente: 1},
					success:function(data){
						array_incidenciasM=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasN', fuente: 1},
					success:function(data){
						array_incidenciasN=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasR', fuente: 1},
					success:function(data){
						array_incidenciasR=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasT', fuente: 1},
					success:function(data){
						array_incidenciasT=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasU', fuente: 1},
					success:function(data){
						array_incidenciasU=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasS', fuente: 1},
					success:function(data){
						array_incidenciasS=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasC', fuente: 1},
					success:function(data){
						array_incidenciasC=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasP', fuente: 1},
					success:function(data){
						array_incidenciasP=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasI', fuente: 1},
					success:function(data){
						array_incidenciasI=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'incidenciasX'},
					success:function(data){
						array_incidenciasX=data;
					},
					error: function (jqXHR, textStatus, errorThrown){
						console.log(jqXHR+" " +textStatus+ " " +errorThrown);
					}
				});
				$.ajax({
					url:'/php/sud.php',
					type:'POST',
					async: false,
					dataType:'json',
					data:{tipo:'packs'},
					success:function(data){
						array_packs=data;
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
		url:'/php/sud.php',
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
		url:'/php/sud.php',
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
function agregarCodigo(producto){
	$.ajax({
		url:'/php/sud.php',
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
		url:'/php/sud.php',
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
		url:'/php/sud.php',
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
		url:'/php/sud.php',
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