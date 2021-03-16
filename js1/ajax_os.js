var array_archivos=[];
var array_descargas=[];
var array_entidades=[];
var array_planes=[];
var array_coberturas=[];
var array_vinculos=[];

function traerUltimoArchivo(){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'ultimoArchivo'},
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
		url:'/php/os.php',
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
function descargarAlfabetaOS(archivo, url){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: true,
		dataType:'json',
		data:{tipo:'descarga', archivo: archivo, url: url},
		success:function(data){
			$.unblockUI();
			if(data[0].estado=='OK'){
				window.location.href="../os.php";
			}else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function manualAlfabetaOS(archivo){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'integrarManual', archivo:archivo},
		success:function(data){
			$.unblockUI();
			if(data[0].estado=='OK'){
				window.location.href="../os.php";
			}else{
				alert(data[0].mensaje);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerEntidades(){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'entidades'},
		success:function(data){
			array_entidades=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerPlanes(){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'planes'},
		success:function(data){
			array_planes=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerCoberturas(){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'coberturas'},
		success:function(data){
			array_coberturas=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerVinculos(){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'vinculos'},
		success:function(data){
			array_vinculos=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function procesarCoberturas(){
	var actual=0;
	var total=array_coberturas.length;
	array_coberturas.forEach(function(item,index){
		$.ajax({
			url:'/php/os.php',
			type:'POST',
			async: false,
			dataType:'html',
			data:{tipo:'procesar', plan: item.codigoPlan},
			beforeSend : function() {
				actual=index+1;
				var mensaje='<h1>Procesando '+actual+' de '+total+'</h1>';
               	$.blockUI({fadeIn:0, fadeOut:0, message: mensaje, applyPlatformOpacityRules: false});
            }, 
			success:function(data){
				$.unblockUI();	
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log(jqXHR+" " +textStatus+ " " +errorThrown);
			}
		});	
	});
}
function vincularVademecumPlan(cliente, plan, vademecum){
	$.ajax({
		url:'/php/os.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'vincular', cliente: cliente, plan: plan, vademecum: vademecum},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}