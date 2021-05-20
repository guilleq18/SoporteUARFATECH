var array_relevamiento=[];
var array_incidencias=[];
var array_exportacion=[];
var array_muebles=[];
var array_comparativo=[];
var array_faltantes=[];

function agregarRelevamiento(codigo, mueble, usuario){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'ag_relevamiento', codigo: codigo, mueble: mueble, usuario: usuario},
		success:function(data){
			if(data[0].estado=='OK'){
				$('#tabla').DataTable().ajax.reload();
			}else{
				document.getElementById('adv').play();
				do{
					var codigo = prompt("Codigo no encontrado, escaneelo nuevamente para corroborar que no sea un error de lectura.", "");
					if(codigo==null){
						break;
					}
					if(codigo.trim()!="" && isNaN(codigo.trim())==false){
					   $.ajax({
							url:'/php/inventario/controller.php',
							type:'POST',
							async: false,
							dataType:'json',
							data:{tipo:'ag_relevamiento', usuario: usuario, mueble: mueble, codigo: codigo},
							success:function(data){
								if(data[0].estado=='OK'){
									$('#tabla').DataTable().ajax.reload();
								}else{
									document.getElementById('adv').play();
									do{
										descripcion = prompt("Incidencia encontrada, cargue una descripcion del producto para ubicarlo más facilmente.", "");
										if(descripcion==null){
											break;
										}
										if(descripcion.trim()!=""){
											if(isNaN(descripcion.trim())==true){
											   $.ajax({
													url:'/php/inventario/controller.php',
													type:'POST',
													async: false,
													dataType:'html',
													data:{tipo:'ag_incidencias', usuario: usuario, mueble: mueble, codigo: codigo, descripcion: descripcion},
													success:function(data){
														$('#tabla').DataTable().ajax.reload();
													},
													error: function (jqXHR, textStatus, errorThrown){
														console.log(jqXHR+" " +textStatus+ " " +errorThrown);
													}
												});
											}else{
												document.getElementById('error').play();
												alert("La descripcion no puede ser solo numerica");
											}
										}else{
											document.getElementById('error').play();
											alert("La descripcion no puede estar vacia");
										}
									} while (isNaN(descripcion.trim())==false || descripcion.trim()=="");
								}
							},
							error: function (jqXHR, textStatus, errorThrown){
								console.log(jqXHR+" " +textStatus+ " " +errorThrown);
							}
						});
					}else{
						document.getElementById('error').play();
						alert("El reescaneo no puede estar vacio y debe ser solo numerico");
					}
				} while (isNaN(codigo.trim())==true || codigo.trim()=="");
			}		
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function editarRelevamiento(usuario, fecha, cantidad, imagen){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'editar', usuario: usuario, fecha: fecha, cantidad: cantidad},
		success:function(data){
			if(data=="OK"){
				$('#tabla').DataTable().ajax.reload();
				imagen.src="/images/ok.png";
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
}
function eliminarRelevamiento(usuario, fecha){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'borrar', usuario: usuario, fecha: fecha},
		success:function(data){
			if(data=="OK"){
				$('#tabla').DataTable().ajax.reload();
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
}
function limpiarRelevamiento(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'limpiar'},
		success:function(data){
			if(data[0].estado=='OK'){
				alert("Datos eliminados");
				window.location.href='/';
			}
			else{
				alert("Error eliminando los datos");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});
}
function colocarExportacion(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'exportacion'},
		success:function(data){
			array_exportacion= data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarIncidencias(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'incidencias'},
		success:function(data){
			array_incidencias= data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarMuebles(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'muebles'},
		success:function(data){
			array_muebles= data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarComparativo(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'comparativo'},
		success:function(data){
			array_comparativo= data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarFaltantes(){
	$.ajax({
		url:'/php/inventario/controller.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'faltantes'},
		success:function(data){
			array_faltantes= data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}