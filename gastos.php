<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['codigoUsuario'])){
        header("Location: /login.php");
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGD</title>
     <!--librerias-->
     <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="css/select2.min.css">
      <link rel="stylesheet" href="css/table.css">
      <link rel="stylesheet" href="css/prop.css">
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/select2.min.js"></script>
      <script src="js/ajax.js"></script>
      <script src="js/validar.js"></script>
      <script type="text/javascript">
       
     $(document).ready(function(){
   
        colocarGastos();
            var datos = [];
            for (var i = 0, len = array_gastos.length; i < len; ++i) {
            dato = array_gastos[i];
           
            datos.push(dato);
        }  
        
        $("#tabla").DataTable( {
            language: {
                  url: 'js/Spanish.json'
            },
               data: datos,
               aoColumns: [
                  { mData: "codigoGasto", sTitle: "ID"},
                  { mData: "tipoGasto", sTitle: "Tipo de Egreso"},
                  { mData: "alias", sTitle: "Alias"},
                  { mData: "importe", sTitle: "Importe"},
                  { mData: "descripcion", sTitle: "Descripcion"},
                  { mData: "fecha", sTitle: "Fecha "},
                  
        ]
          
        });
       
        //funcion para enviar los parametros de los inputs al ajax
        $("#carga").click(function(e){
            
          if (validarGasto()==false){
            
          }else{ 

            $("#agregarCLiente").modal('hide');//ocultamos el modal
            
            agregarGasto($("#tipoGasto").val(), $("#alias").val(), $("#descripcion").val(), $("#fecha").val(), $("#importe").val());
          }  
        });
        
   });
 
	</script>


</head>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Cambiar navegación</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button></div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php" class="active">inicio</a></li>
        <li><a href="clientes.php" class="active">Clientes</a></li>
        <li><a href="ingresos.php">Ingresos</a></li>
		<li><a href="balances.php">Balances</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="php/cerrar.php">Cerrar Sesion</a></li>
        </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<body>
<section>
  <div class="container-fluid">
  	<div class="row">
	  <div class="col-lg-1 col-sm-1"></div>
      <div class="col-lg-10 page-header">
        <h3>Lista de Egresos</i></h3>
      </div>
	  <div class="col-lg-1 col-sm-1"></div>
	</div>
	<div class="row">
	  <div class="col-lg-1 col-sm-1"></div>
      <div class="col-lg-10">
        
      </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
    <div class="row" style="margin: 10px 0px;">
		<div class="col-lg-1 col-md-1 "></div>
		<div class="col-md-2">
    <button type="button" class="" data-toggle="modal" data-target="#agregarGasto">
      Agregar Egreso
    </button>
    <form action="detalleGasto.php" formtarget="_blank" method="POST" id="detalleG">
        <h3>Ver Egreso</h3>
        <input class="float-left form-control" type="text" name="codigo" id="codigo">
        </form>
      </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
<br>
          <!-- Modal--> 
          <div class="modal fade" id="agregarGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Egreso</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                              <div class="col form-group">
                              <h3 class="control-label ">Seleccionar Tipo de Egreso</h3>
                                    <select class="form-control" name="tipoGasto" id="tipoGasto" 
                                    required>
                                    <option value=""></option>
                                    <option value="Pago">Pago </option>
                                    <option value="Compra">Compra</option>
                                    </select>
                              </div>
                              <div class="col form-group">
                                  <h3 class="control-label " >Alias </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="alias" id="alias" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Descripción</h3>
                                  <input type="text" class="form-control input-lg" placeholder=" " name="descripcion" id="descripcion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Fecha</h3>
                                  <input type="date" class="form-control input-lg" placeholder="" name="fecha" id="fecha" required>
                              </div> <!-- form-group end.// -->
                                
                              <div class="col form-group">
                                  <h3 class="control-label " >Importe</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="importe" id="importe" required>
                              </div> <!-- form-group end.// -->
                              
                            </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="carga">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>
		</div>	
    </div>
    <!--datatable-->
    <div class="row" style="margin-bottom: 20px;">
		<div class="col-lg-1 col-sm-1"></div>
		<div class="col-md-10">
	  		<table id="tabla" class="table table-bordered"></table>
		</div>
  	</div>
  </div>
</section>


   
          

      
</body>


    
  
</html>




