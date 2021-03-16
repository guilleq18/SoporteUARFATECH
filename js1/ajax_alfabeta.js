var array_archivos=[];
var array_descargas=[];
var array_incidencias=[];
var array_pausados=[];
var array_otrosProveedores=[];
var array_revision=[];
var array_altasLaboratorio=[];
var array_bajasLaboratorio=[];
var array_activosLaboratorio=[];

function traerUltimoAlfabeta(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'ultimoAlfabeta'},
		success:function(data){
			array_archivos=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function listaDescargas(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'lista'},
		success:function(data){
			array_descargas=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function descargarAlfabeta(tipoD, archivo, url){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'importarDescarga', tipoD: tipoD, archivo: archivo, url: url},
		success:function(data){
			$.unblockUI();
			if(data[0].estado=='OK'){
				$("#pArchivo").val(data[0].archivo);
				$("#pFechaDescarga").val(data[0].fechaDescarga);
				$("#pTipo").val(data[0].tipo);
				document.forms["formProcesar"].submit();
			}else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function manualAlfabeta(tipoD, archivo){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'importarManual', tipoD: tipoD, archivo:archivo},
		success:function(data){
			$.unblockUI();
			if(data[0].estado=='OK'){
				$("#pArchivo").val(data[0].archivo);
				$("#pFechaDescarga").val(data[0].fechaDescarga);
				$("#pTipo").val(data[0].tipo);
				$("#pUsuario").val(data[0].usuario);
				document.forms["formProcesar"].submit();
			}else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerIncidencias(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'incidencias'},
		success:function(data){
			array_incidencias=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerPausados(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'pausados'},
		success:function(data){
			array_pausados=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerOtrosProveedores(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'proveedores'},
		success:function(data){
			array_otrosProveedores=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerRevision(){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'revision'},
		success:function(data){
			array_revision=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerAltasLaboratorio(laboratorio){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'altas_laboratorio', laboratorio: laboratorio},
		success:function(data){
			array_altasLaboratorio=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerBajasLaboratorio(laboratorio){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'bajas_laboratorio', laboratorio: laboratorio},
		success:function(data){
			array_bajasLaboratorio=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerActivosLaboratorio(laboratorio){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'activos_laboratorio', laboratorio: laboratorio},
		success:function(data){
			array_activosLaboratorio=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function desactivarBajas(laboratorio){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'pausar_bajas', laboratorio:laboratorio},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function actualizarVinculo(vinculo, producto){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'vinculo', vinculo:vinculo, producto:producto},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function descartarArchivo(archivo, fecha, usuario){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'descartar', archivo: archivo, fecha: fecha, usuario: usuario},
		success:function(data){
			$.unblockUI();
			if(data[0].estado=="OK"){
				alert("Archivo procesado descartado");
				window.location.href="../alfabeta_importacion.php";
			}else{
				alert("Error eliminando el archivo descargado");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function procesarAlfabetaBOC(tipoD, fecha, archivo){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: true,
		dataType:'html',
		data:{tipo:'procesar', tipoD: tipoD, fecha: fecha, archivo: archivo},
		success:function(data){
			$.unblockUI();
			alert(data);
			if(data==' El proceso de Alfabeta se completo, pero hubo incidencias.'){
				var axls = document.getElementById("incidencias");
				axls.href="../archivos/incidenciasAlfabeta.xls";
				axls.download="incidenciasAlfabeta.xls";
				axls.click();
			}
			window.location.href="../alfabeta_importacion.php";			
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function adecuarIva(numeroRegistro, iva, ivaNuevo){
	$.ajax({
		url:'/php/alfabeta.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'adecuarIva', numeroRegistro:numeroRegistro, iva:iva, ivaNuevo:ivaNuevo},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}