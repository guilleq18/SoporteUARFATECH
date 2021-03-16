var array_modulos = [];
var array_permisos = [];
var array_familiasLista=[];
var array_laboratoriosLista=[];
/*var array_iva=[];
var array_productos=[];
var array_relacionados=[];
var array_fuentes=[];
var array_referencias=[];
var array_libres=[];*/

function buscarPermiso(menu){
    for (var i=0; i < array_permisos.length; i++) {
        if (array_permisos[i].codigoMenu == menu) {
            return array_permisos[i];
        }
    }
}

//Menu
function colocarModulos(){
	$.ajax({
		url:'./php/generales.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'modulos'},
		success:function(data){
			array_modulos=data;
			var menu=document.getElementById("modulos")
			array_modulos.forEach(function(item, index){
				var li= document.createElement("li");
				li.id="liModulo"+item.codigoModulo;
				li.className="dropdown";
				li.style.display="none";
				var a=document.createElement("a");
				a.href="#";
				a.className="dropdown-toggle";
				a.setAttribute("aria-expanded","true");
				var spanLabel=document.createElement("span");
				spanLabel.innerHTML=item.descripcion;
				var spanCaret=document.createElement("span");
				spanCaret.className="caret";
				var ul=document.createElement("ul");
				ul.id="ulModulo"+item.codigoModulo;
				ul.className="dropdown-menu";
				a.appendChild(spanLabel);
				a.appendChild(spanCaret);
				li.appendChild(a);
				li.appendChild(ul);
				menu.appendChild(li);
			});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarPermisos(usuario){
	$.ajax({
		url:'./php/generales.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'permisos', usuario: usuario},
		success:function(data){
			array_permisos=data;
			array_permisos.forEach(function(item, index){
				if(item.nivelAcceso!='N'){
					var modulo=document.getElementById("ulModulo"+item.codigoModulo);
					document.getElementById("liModulo"+item.codigoModulo).style.display="block";
					if(item.descripcion.includes("/")==true){
						var split=item.descripcion.split("/");
						var submenu = document.getElementById("modulo"+item.codigoModulo+split[0]);
						if (submenu === null){
							var liSub=document.createElement("li");
							liSub.className="dropdown-submenu";
							var aSub=document.createElement("a");
							aSub.href="#";
							aSub.className="dropdown-toggle";
							aSub.setAttribute("aria-expanded","true");
							var spanLabelSub=document.createElement("span");
							spanLabelSub.innerHTML=split[0];
							var spanCaretSub=document.createElement("span");
							spanCaretSub.className="caret";
							var ulSub=document.createElement("ul");
							ulSub.id="modulo"+item.codigoModulo+split[0]
							ulSub.className="dropdown-menu";
							aSub.appendChild(spanLabelSub);
							aSub.appendChild(spanCaretSub);
							liSub.appendChild(aSub);
							liSub.appendChild(ulSub);
							modulo.appendChild(liSub);
							submenu = document.getElementById("modulo"+item.codigoModulo+split[0]);
						}
						var li=document.createElement("li");
						li.id="liMenu"+item.codigoMenu;
						var a=document.createElement("a");
						a.href=item.url;
						a.innerHTML=split[1];
						li.appendChild(a);
						submenu.appendChild(li);
					}else{
						var li=document.createElement("li");
						li.id="liMenu"+item.codigoMenu;
						var a=document.createElement("a");
						a.href=item.url;
						a.innerHTML=item.descripcion;
						li.appendChild(a);
						modulo.appendChild(li);
					}
				}
			});
			$(".dropdown-toggle").attr("data-toggle", "dropdown");
			$(".dropdown-toggle").attr("role", "button");
			$(".dropdown-toggle").attr("aria-haspopup", "true");
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function restablecerContraseña(codigoUsuario, contraseña, seccion){
	var r=false;
	if(seccion==1){
		r=confirm("¿Desea restablecar la contraseña de este usuario?");
	}else{
		r=true;
	}
	if(r==true){
		$.ajax({
			url:'/php/seguridad.php',
			type:'POST',
			async: false,
			dataType:'html',
			data:{tipo:'cambiar', codigoUsuario: codigoUsuario, contraseña: contraseña},
			success:function(data){
				alert(data);
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log(jqXHR+" " +textStatus+ " " +errorThrown);
			}
		});	
	}
}

function colocarFamiliasLista(){
	$.ajax({
		url:'/php/generales.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'familias'},
		success:function(data){
			array_familiasLista=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarLaboratoriosLista(){
	$.ajax({
		url:'/php/generales.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'laboratorios'},
		success:function(data){
			array_laboratoriosLista=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
/*
function colocarIvas(){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'iva'},
		success:function(data){
			array_iva=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarProductos(){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'productos'},
		success:function(data){
			array_productos=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarRelacionados(producto){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'productoRelacionados', producto: producto},
		success:function(data){
			array_relacionados=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarFuentes(producto){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'productoFuentes', producto: producto},
		success:function(data){
			array_fuentes=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarReferencias(producto){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'productoReferencias', producto: producto},
		success:function(data){
			array_referencias=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function colocarReferenciasLibres(){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'json',
		data:{tipo:'referencias'},
		success:function(data){
			array_libres=data;
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarReferencia(producto, referencia, porcentaje){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregarReferencia', producto: producto, referencia: referencia, porcentaje: porcentaje},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function desvincularReferencia(producto, referencia){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'desvincular', producto: producto, referencia: referencia},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function actualizarProducto(producto){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'actualizar', producto: producto},
		success:function(data){
			alert(data);
			window.location.href="../index.php";
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function agregarRelacionado(codigoProducto, codigoRelacionado, unidades){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'agregarCodigo', codigoProducto: codigoProducto, codigoRelacionado:codigoRelacionado, unidades:unidades},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function cambiarFuente(codigoProducto, codigoFuente){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'cambiarFuente', codigoProducto: codigoProducto, codigoFuente:codigoFuente},
		success:function(data){
			alert(data);
			location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function bajaDefinitiva(codigoProducto){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'baja', codigoProducto: codigoProducto},
		success:function(data){
			alert(data);
			window.location.href="../index.php";
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
		}
	});	
}
function traerExportacion(tipoE){
	$.ajax({
		url:'/php/catalogos.php',
		type:'POST',
		async: false,
		dataType:'html',
		data:{tipo:'exportacion', tipoE: tipoE},
		success:function(data){
			alert(data);
			if(data=="Archivos generados correctamente."){
				var aCat = document.getElementById("lCatalogo");
				aCat.href="archivos/catalogo.txt";
				aCat.download="catalogo.txt";
				var aEx = document.getElementById("lExtra");
				aEx.href="archivos/extra.txt";
				aEx.download="extra.txt";
				aCat.click();
				aEx.click();
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(jqXHR+" " +textStatus+ " " +errorThrown);
			$.unblockUI();
		}
	});	
}*/