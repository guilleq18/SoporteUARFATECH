<?php
    session_start();
    if(!isset($_SESSION['inventarioUser'])){
        header("Location: /inventario/login.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Herramienta para Inventarios</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/table.css">
<link rel="stylesheet" href="/css/jquery.dataTables.min.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script type = "text/javascript" src="/js/ajax_inventario.js"></script>
<script type="text/javascript">
	var usuario = "<?php echo $_SESSION['inventarioUser'];?>";
	var dataTable;
	function lectura(e){
		if($('#mueble').val().trim()!=""){
			if (e.keyCode == 13){
				if($('#codigo').val().trim()!=""){
					agregarRelevamiento($('#codigo').val(), $('#mueble').val(), usuario); 
					$('#codigo').val("");
				}
			}	
		}
		else{
			alert("Se debe ingresar el mueble antes de escanear.");
			e.preventDefault();
		}
	}
	function editar(e,fecha){
		var id=e.target.className;
		if (e.keyCode == 13){
			var imagen=e.target.parentElement.children[1];
			editarRelevamiento(usuario, fecha, e.target.value, imagen);
    	}else{
			e.target.parentElement.children[1].src="/images/err.png";
		}
	}
	function borrar(e, fecha){
		if(confirm("¿Desea borrar este escaneo?")){
			eliminarRelevamiento(usuario, fecha);
		}
	}
	window.onload = function() {	
		colocarTabla(usuario);
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
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- SECTION -->
<section>
  <div class="container-fluid">
    <div class="row" style="margin-top: 40px;">
      <div class="col-lg-2 col-md-2 col-sm-2">
		  <p><strong>Mueble:</strong>
		<input type="text" class="form-control" id="mueble" style="width:100%;"></p>
		  <p><strong>Escaneo de codigo:</strong>
		<input type="text" class="form-control" id="codigo" onKeyPress="lectura(event)"  style="width:100%;"></p>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10">
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