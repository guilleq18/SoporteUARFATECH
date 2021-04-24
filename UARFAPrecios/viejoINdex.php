<?php
    /*session_start();
    if(!isset($_SESSION['inventarioUser'])){
        header("Location: /inventario/login.php");
    }*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Herramienta para Inventarios</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-essentials.min.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/table.css">
<link rel="stylesheet" href="/css/prop.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.js"></script>
<link rel="stylesheet" href="/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/buttons.dataTables.min.css">
<script src="/js/jquery.dataTables.min.js"></script>
<script type = "text/javascript" src="/js/ajax_inventario.js"></script>
<script type="text/javascript">
/*var usuario = "<?php echo $_SESSION['inventarioUser'];?>";*/
//var dataTable;
function lectura(e){
	if($('#mueble').val().trim()!=""){
		if (e.keyCode == 13){
			if($('#codigo').val().trim()!=""){
				if(isNaN($('#codigo').val().trim())==false){
					agregarRelevamiento($('#codigo').val(), $('#mueble').val()/*, usuario*/); 
					$('#codigo').val("");
				}else{
					document.getElementById('error').play();
					alert("El texto ingresado no es numerico");
					$('#codigo').val("");
				}
			}
		}
	}
	else{
		document.getElementById('error').play();
		alert("Se debe ingresar el mueble antes de escanear.");
		e.preventDefault();
	}
}
function editar(e, item, fecha){
	if (e.originalEvent.keyCode == 13 ){
		var imagen=e.target.parentElement.children[1];
		editarRelevamiento(usuario, fecha, e.target.value, imagen);
	}else{
		e.target.parentElement.children[1].src="/images/err.png";
	}
}
function borrar(fecha){
	if(confirm("¿Desea borrar este escaneo?")){
		eliminarRelevamiento(usuario, fecha);
	}
}
window.onload = function() {	
	$('.dFiltro').click(function(e) {
	   e.stopPropagation();
	});
	$('#tabla').DataTable( {
		language: {
			url: '/js/Spanish.json'},
		ajax: {
			url: '/php/inventario/controller.php',
			type: 'POST',
			data: function ( d ) {
				d.tipo = 'listarRelevamientoUsuario';
				d.usuario = usuario;
			}
		},
		columns: [
			{ data: null},
			{ data: 'fecha'},
			{ data: 'codigoRelacionado'},
			{ data: 'cantidad'},
			{ data: 'mueble'},
			{ data: 'producto'}
		],
		columnDefs: [
			{ targets: 0, width: 41, searchable: false, orderable: false, render: function (data, type, row) {
				return '<img class="accBorrarEscaneo" src="/images/del.png" style="cursor: pointer;">';}},
			{ targets: 1, width: 170},
			{ targets: 2, width: 180},
			{ targets: 3, width: 110, render: function (data, type, row) {
				return '<input class="accEditar" type="tel" style="width: 60px; margin-right: 5px;" value="'+row.cantidad+'"><img src="/images/ok.png">';}}
		],
		//bDestroy: true,
		lengthChange:false,
		dom: 'Bfrtip',
		buttons: [
			{	
				text: 'Buscar productos por nombre',
				className: 'btnNombre',
				action: function ( e, dt, node, config ) {
					if($('#mueble').val().trim()!=""){
						$('#tablaProductos thead .trFiltros .dFiltro').css('display', 'none');
						$('#tablaProductos thead .trFiltros th').css('width', 'auto');
						$("#tablaProductos").DataTable( {
							language: {
								url: '/js/Spanish.json'},
							ajax: {
								url: '/php/inventario/controller.php',
								type: 'POST',
								data: function ( d ) {
									d.tipo = 'listarProductos';
								}
							},
							columns: [
								{ data: "codigoProducto"},
								{ data: "descripcion"},
								{ data: "codigoRelacionado"},
								{ data: "laboratorio"},
								{ data: "tipoProducto"},
								{ data: null}
							],
							columnDefs: [
								{ targets: 5, width: 41, searchable: false, orderable: false, render: function (data, type, row) {
									return '<img class="accAgregarEscaneo" src="/images/agr.png" style="cursor: pointer;">';}}
							],
							pageLength: 50,
							order: [ 1, "asc" ],
							serverSide: true,
							initComplete: function () {
								var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
								var largo=$("#tabla")[0].clientWidth;
								var total=$("#contenido")[0].clientWidth;
								if(largo<total){
									$(".popupContent").css('width', largo-20);
									$(".popupContent").css('left', (total-largo+20)/2);
								}else{
									$(".popupContent").css('width', total-20);
									$(".popupContent").css('left', 10);
								}
								document.getElementById('popProductos').style.display = "block";
								$('#tablaProductos thead .trFiltros th').each(function(index) {
									$($('#tablaProductos thead .trFiltros th')[index]).css('width', $('#tablaProductos thead .trFiltros th')[index].clientWidth);
									$($('#tablaProductos thead .trFiltros .dFiltro')[index]).css('display', 'block');
								});
								$('#tablaProductos tbody').off('click', '.accAgregarEscaneo');
								$('#tablaProductos tbody').on('click', '.accAgregarEscaneo', function(e) {
									var item = $('#tablaProductos').DataTable().row( $(this).parents('tr') ).data();
									agregarRelevamiento(item.codigoRelacionado, $('#mueble').val(), usuario);
									document.getElementById('popProductos').style.display='none';
								});
							},
							bDestroy: true,
							autoWidth: false
						});
						$('#tablaProductos .celdaFiltro').on( 'keyup change', function ()	{   
							var i =$(this).attr('id');  
							var v =$(this).val();  
							$("#tablaProductos").DataTable().columns(i).search(v).draw();
						} );
					}
					else{
						document.getElementById('error').play();
						alert("Se debe ingresar el mueble para poder ver el listado de productos.");
						e.preventDefault();
					}
				}
			}
		],
		pageLength: 20,
		order: [ 1, "desc" ],
		//processing: true,
		serverSide: true,
		initComplete: function () {
			$('#tabla thead tr .dFiltro').each(function(index) {
				$($('#tabla thead th')[index]).css('width', $('#tabla thead th')[index].clientWidth);
				$($('#tabla thead .dFiltro')[index]).css('display', 'block');
			});
			$('#tabla .celdaFiltro').on( 'keyup change', function ()	{   
				var i =$(this).attr('id');  
				var v =$(this).val();
				$('#tabla').DataTable().columns(i).search(v).draw();
			} );
			$('#tabla tbody').off('keydown', '.accEditar');
			$('#tabla tbody').on('keydown', '.accEditar', function(e) {
				var item = $('#tabla').DataTable().row( $(this).parents('tr') ).data();
				editar(e, this, item.fecha);
			});
			$('#tabla tbody').off('click', '.accBorrarEscaneo');
			$('#tabla tbody').on('click', '.accBorrarEscaneo', function() {
				var item = $('#tabla').DataTable().row( $(this).parents('tr') ).data();
				borrar(item.fecha);
			});
		}
	});
};
</script>
</head>

<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Cambiar navegación</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	</div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#" class="active">Inicio</a></li>
		<li><a href="/inventario/comparativo.php">Comparativo</a></li>
		<li><a href="/inventario/incidencias.php">Incidencias</a></li>
		<li><a href="/inventario/relevamiento.php">Relevamiento</a></li>
		<li><a href="/inventario/login.php">Cerrar sesión</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- SECTION -->
<section>
  <div class="container-fluid" id="contenido">
    <div class="row" style="margin-top: 40px;">
      <div class="col-lg-2 col-md-2 col-sm-2">
		  <p><strong>Mueble:</strong>
		<input type="text" class="form-control" id="mueble" style="width:100%;"></p>
		  <p><strong>Escaneo de codigo:</strong>
		<input type="text" class="form-control" id="codigo" onKeyPress="lectura(event)"  style="width:100%;"></p>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10">
		  <audio id="adv" src="../media/adv.mp3" preload="auto"></audio>
		  <audio id="error" src="../media/error.mp3" preload="auto"></audio>
		  <table id="tabla" class="table table-bordered"><thead><tr class="trFiltros"><th><div class="dFiltro" style="display: block;"><input type="text" disabled="" class="form-control celdaFiltro"></div></th>  <th><div class="dTitulo">Fecha y hora</div><div class="dFiltro"><input id="1" class="form-control celdaFiltro" type="text" maxlength="23"></div></th><th><div class="dTitulo">Codigo EAN</div><div class="dFiltro"><input id="2" class="form-control celdaFiltro" type="text" maxlength="24"></div></th><th><div class="dTitulo">Cant.</div><div class="dFiltro"><input id="3" class="form-control celdaFiltro" type="tel" maxlength="5"></div></th><th><div class="dTitulo">Mueble</div><div class="dFiltro"><input id="4" class="form-control celdaFiltro" type="text" maxlength="100"></div></th><th><div class="dTitulo">Nombre</div><div class="dFiltro"><input id="5" class="form-control celdaFiltro" type="text" maxlength="150"></div></th></tr></thead></table>
      </div>
    </div>
  </div>
</section>
<!-- / SECTION --> 

<!-- POPS -->
<div class="popup" id="popProductos">
	<div class="popupContent">
		<div class="popform">
			<img class="imgclose" src="/images/popup.png" onclick ="document.getElementById('popProductos').style.display='none';">
			<h3>Listado de productos</h3>
			<table id="tablaProductos" class="table table-bordered"><thead><tr class="trFiltros"><th><div class="dTitulo">Cod.</div><div class="dFiltro"><input id="0" class="form-control celdaFiltro" type="text"></div></th><th><div class="dTitulo">Producto</div><div class="dFiltro"><input id="1" class="form-control celdaFiltro" type="text"></div></th><th><div class="dTitulo">Cod. EAN</div><div class="dFiltro"><input id="2" class="form-control celdaFiltro" type="text"></div></th><th><div class="dTitulo">Laboratorio</div><div class="dFiltro"><input id="3" class="form-control celdaFiltro" type="text"></div></th><th><div class="dTitulo">Tipo</div><div class="dFiltro"><input id="4" class="form-control celdaFiltro" type="text"></div></th><th><div class="dFiltro" style="display: block;"><input type="text" disabled="" class="form-control celdaFiltro"></div></th></tr></thead></table>
		</div>
	</div>
</div>
<!-- / POPS -->
	
<!-- FOOTER -->
<footer class="text-center" style="background:#f0f0f0 none repeat scroll 0 0;">
<div class="container">
    <div class="row">
      <div class="col-xs-12"  style="padding:6px !important;">
        <p style="margin:0 !important">Desarrollado por <strong>UARFA TECHNOLOGY</strong></p>
      </div>
    </div>
  </div> 
</footer>
<!-- / FOOTER --> 
</body>
</html>