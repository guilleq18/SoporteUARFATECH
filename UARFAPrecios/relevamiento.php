	<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Herramienta para Inventarios</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/table.css">
<link rel="stylesheet" href="/css/jquery.dataTables.min.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script type = "text/javascript" src="/js/ajax_inventario.js"></script>
<script type="text/javascript">
	window.onload = function() {	
		colocarExportacion();
		$("#tabla").DataTable( {
			language: {
				url: '/js/Spanish.json'
			},
			data: array_exportacion,
			autoWidth: true,
			aoColumns: [
				{ mData: "descripcion", sTitle: "Producto"},
				{ mData: "codigoRelacionado", sTitle: "Codigo EAN"},
				{ mData: "cantidad", sTitle: "Stock", sWidth: "100px"}					
			]
		});
		$('#escaneados').html(array_exportacion.length);
		var stock=0;
		for(var i = 0, len = array_exportacion.length; i < len; ++i){
			stock = stock+ parseInt(array_exportacion[i].cantidad);
		}
		$('#stock').html(stock);
		$("#bLimpiar").click(function (e) {
			if(confirm("Esto eliminara todos los datos escaneados y las incidencias. ¿Desea continuar?")){
				limpiarRelevamiento();
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
        <li><a href="/inventario/">Inicio</a></li>
		<li><a href="/inventario/comparativo.php">Comparativo</a></li>
		<li><a href="/inventario/incidencias.php">Incidencias</a></li>
		<li><a href="#" class="active">Relevamiento</a></li>
		<li><a href="/inventario/login.php">Cerrar sesión</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- SECTION -->
<section>
  <div class="container">
    <div class="row" style="margin-top: 30px;">
		<span><strong>Productos escaneados:  </strong></span><span id="escaneados"></span>
		<br>
		<span><strong>Stock escaneado:  </strong></span><span id="stock"></span>
		<br>
		<div class="col-lg-10 col-md-10 col-sm-10">
			<form class="form-signin" method="post" action="/php/inventario/controller.php">
				<input type="hidden" name="tipo" value="exportar">
				<button class="btn btn-lg btn-primary btn-block" type="submit" style="width: auto; margin: 10px 0;">Exportar a txt</button>
	    	</form>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1">
			<button class="btn btn-lg btn-primary btn-block" type="submit" id="bLimpiar" style="width: auto; margin: 10px 0;">Limpiar datos</button>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
      <div class="col-lg-12 col-md-12 col-sm-12">
		  <table id="tabla" class="table table-bordered"></table>
      </div>
    </div>
  </div>
</section>
<!-- / SECTION --> 

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