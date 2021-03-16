var array_menus = [];
var array_permisosrol = [];

function colocarMenus(){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'menus'},
		success:function(data){
			array_menus=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarPermisosRol(codigoRol){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'permisos_rol', codigoRol: codigoRol},
		success:function(data){
			array_permisosrol=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarRol(descripcion, permisos){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregar_rol', descripcion: descripcion, permisos: permisos},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function editarRol(codigoRol, descripcion, permisos){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'editar_rol', codigoRol: codigoRol, descripcion: descripcion, permisos: permisos},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarUsuario(rol, suscriptor, usuario, nombre, permisos){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregar_usuario', rol: rol, suscriptor: suscriptor, usuario: usuario, nombre: nombre, permisos: permisos},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function editarUsuario(codigoUsuario, codigoRol, codigoSuscriptor, usuario, nombre, permisos){
	$.ajax({
		url:'/php/seguridad.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'editar_usuario', codigoUsuario: codigoUsuario, codigoSuscriptor: codigoSuscriptor, codigoRol: codigoRol, usuario: usuario, nombre: nombre, permisos: permisos},
		success:function(data){
			alert(data);
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function editarUsuarioEstado(codigoUsuario, estado){
	var r=false;
	if(estado=="A"){
		r = confirm("¿Desea reactivar este usuario?");
	}else{
		r = confirm("¿Desea inactivar este usuario?");
	}
	if(r==true){
		$.ajax({
			url:'/php/seguridad.php',
			type:'POST',
			async: false,
			dataType:'html',
			data:{tipo:'estado_usuario', codigoUsuario: codigoUsuario, estado: estado},
			success:function(data){
				alert(data);
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log(jqXHR+" " +textStatus+ " " +errorThrown);
			}
		});
	}
}