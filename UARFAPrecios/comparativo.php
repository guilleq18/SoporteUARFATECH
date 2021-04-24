	<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema para inventarios</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/table.css">
<link rel="stylesheet" href="/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/select2.min.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/select2.min.js"></script>
<script type = "text/javascript" src="/js/ajax_inventario.js"></script>
<script type="text/javascript">
	window.onload = function() {
		colocarComparativo();
		colocarFaltantes();
		colocarMuebles();
		$("#select_mueble").select2({
			data:array_muebles,
			width: '100%',
			placeholder: {id: -1, text: 'Seleccione un mueble'},
			allowClear: true,
			language: "es"
		});
		$("#select_mueble").on("change",function(){
			if($("#select_mueble").val()!=null){
				$("#mueble").val($("#select_mueble").val())
				document.forms["form"].submit();
			}
		});
		$("#select_mueble").val("").trigger("change");
		var correctos=0; 
		var incorrectos=0;
		var diferencia=0;
		for(var i = 0, len = array_comparativo.length; i < len; ++i){
			if(array_comparativo[i].diferencia!=0){
			   incorrectos=incorrectos+1;
				diferencia=diferencia+parseInt(array_comparativo[i].diferencia);
		   }else{
			   correctos=correctos+1;
		   }
		}
		$('#correctos').html(correctos);
		$('#incorrectos').html(incorrectos);
		$('#faltante').html(diferencia);
		$("#tablaC").DataTable( {
			language: {
				url: '/js/Spanish.json'
			},
			data: array_comparativo,
			autoWidth: true,
			aoColumns: [
				{ mData: "codigoProducto", sTitle: "Cod."},
				{ mData: "descripcion", sTitle: "Producto"},
				{ mData: "codigoRelacionado", sTitle: "Cod. EAN"},
				{ mData: "cantidad", sTitle: "Cant."},
				{ mData: "distribucion", sTitle: "Muebles"},
				{ mData: "existencia", sTitle: "Cant. PhS"},
				{ mData: "diferencia", sTitle: "Dif."}
			]
		});
		$("#tablaF").DataTable( {
			language: {
				url: '/js/Spanish.json'
			},
			data: array_faltantes,
			autoWidth: true,
			aoColumns: [
				{ mData: "codigoProducto", sTitle: "Cod."},
				{ mData: "descripcion", sTitle: "Producto"},
				{ mData: "existencia", sTitle: "Cant. en PhS"}					
			]
		});
		$('#noRelevados').html(array_faltantes.length);
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
        <li><a href="/inventario">Inicio</a></li>
		<li><a href="#" class="active">Comparativo</a></li>
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
  <div class="container">
    <div class="row" style="margin-top: 30px;">
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-10 col-md-10 col-sm-10">
			<p><span><strong>Stock correcto:  </strong></span><span id="correctos"></span><br>
			<span><strong>Stock incorrecto:  </strong></span><span id="incorrectos"></span><br>
			<span><strong>Diferencia total:  </strong></span><span id="faltante"></span><br>
			<span><strong>Productos no relevados:  </strong></span><span id="noRelevados"></span></p>
			<p><strong>Exportar mueble para control: </strong>
			<select id="select_mueble"></select></p>
			<form id="form" class="form-signin" method="post" action="/php/inventario/controller.php">
				<input type="hidden" name="tipo" value="lista_mueble">
				<input type="hidden" name="mueble" id="mueble" value="">
	    	</form>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-8 col-md-8 col-sm-8">
			<form id="fFaltantes" class="form-signin" method="post" action="/php/inventario/controller.php">
				<input type="hidden" name="tipo" value="exportar_comparativo">
				<button class="btn btn-lg btn-primary btn-block" type="submit" style="width: auto; margin: 10px 0;">Exportar comparativo</button>
	    	</form>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2">
			<form id="fFaltantes" class="form-signin" method="post" action="/php/inventario/controller.php">
				<input type="hidden" name="tipo" value="exportar_faltantes">
				<button class="btn btn-lg btn-primary btn-block" type="submit" style="width: auto; margin: 10px 0;">Exportar productos no relevados</button>
	    	</form>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
	</div>
	<div class="row" style="margin-top: 0px;">
      <div class="col-lg-12 col-md-12 col-sm-12">
		<ul class="nav nav-tabs" style="margin-bottom: 20px; margin-top: 20px;">
		  <li class="active"><a id="t_comparativo" data-toggle="tab" href="#comparativo">Comparativo</a></li>
		  <li><a id="t_faltantes" data-toggle="tab" href="#faltantes">No relevados</a></li>
		</ul>
		<div class="tab-content">
		  <div id="comparativo" class="tab-pane fade in active">
			  <table id="tablaC" class="table table-bordered"></table>
		  </div>
		  <div id="faltantes" class="tab-pane fade">
			  <table id="tablaF" style="width: 100%" class="table table-bordered"></table>
		  </div>
		</div>
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