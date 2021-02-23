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
   
          colocarClientes();
          var datos = [];
          for (var i = 0, len = array_clientes.length; i < len; ++i) {
          dato = array_clientes[i];
          datos.push(dato);
        }  
        
        $("#tabla").DataTable( {
            language: {
              url: 'js/Spanish.json'
            },
            data: datos,
            aoColumns: [
              { mData: "codigoCliente", sTitle: "ID", sWidth:"20px"},
              { mData: "nombre", sTitle: "Nombre", sWidth:"200px"},
              { mData: "telefono", sTitle: "Teléfono",sWidth:"30px" },
              { mData: "ciudad", sTitle: "Ciudad", sWidth: "30px"},
              { mData: "direccion", sTitle: "Dirección",sWidth:"60px"},
              { mData: "email", sTitle: "E-mail", sWidth:"40px"},
              { mData: "numeroDocumento", sTitle: "Nº de Documento", sWidth:"20px"},
              { mData: "tipoCliente", sTitle: "Tipo Cliente", sWidth:"30px"},
             
             
            ]
          
        });

        $("#carga").click(function(e){
              
            
            if (validarCliente()==false){

          
          }else{ 

            $("#agregarCLiente").modal('hide');//ocultamos el modal
            
            agregarCliente($("#tipoCliente").val(), $("#nombre").val(), $("#numeroDocumento").val(), $("#telefono").val(), $("#email").val(), $("#direccion").val(), $("#ciudad").val());
          }
        
        });
                
        
    })
        
   
 
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
    <li><a href="ingresos.php">Ingresos</a></li>
    <li><a href="gastos.php">Gastos</a></li>
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
        <h3>Lista de Clientes</i></h3>
      </div>
	  <div class="col-lg-1 col-sm-1"></div>
	</div>
	<div class="row">
	  <div class="col-lg-1 col-sm-1"></div>
      <div class="col-lg-2">
            <button type="button" class=" " data-toggle="modal" data-target="#agregarCLiente">
              Agregar Cliente
            </button>
      <!--formulario de detalle de cliente-->
      <form action="detalleCliente.php" formtarget="_blank" method="POST" id="detalleC">
        <h3>Ver Cliente</h3>
        <input class="float-left form-control" type="text" name="codigo" id="codigo">
        </form>
      </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
  
    <div class="row" style="margin: 10px 0px;">
		<div class="col-lg-1 col-md-1 "></div>
		<div class="col-md-10">
    

          <!-- Modal--> 
          <div class="modal fade" id="agregarCLiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                             <div class="form-row">
                              <div class="col form-group">
                                <h3 class="control-label " >Tipo de Cliente</h3>
                                    <select class="form-control" name="tipoCliente" id="tipoCliente" required>
                                        <option selected></option>
                                        <option  value="empresa">Empresa</option>
                                        <option  value="particular">Particular</option>
                                    </select>
                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="nombre" id="nombre" required>
                              </div>
                              <div class="col form-group">
                                  <h3 class="control-label " >DNI/CUIT </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="numeroDocumento" id="numeroDocumento" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Teléfono</h3>
                                  <input type="text" class="form-control input-lg" placeholder=" " name="telef" id="telefono" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >E-Mail</h3>
                                  <input type="email" class="form-control input-lg" placeholder="" name="email" id="email" required>
                              </div> <!-- form-group end.// -->
                                
                              <div class="col form-group">
                                  <h3 class="control-label " >Dirección</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="direcc" id="direccion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Ciudad</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="ciudad" id="ciudad" required>
                              </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="carga" >Registrar</button></p>
                </div>
              </div>
            </div>
          </div>
		</div>	
    </div>
    <!-- Modal--> 
    <div class="modal fade" id="detalleCLiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                             <div class="form-row">
                              <div class="col form-group">
                                <h3 class="control-label " >Tipor de Cliente</h3>
                                    <select class="form-control" name="tipoCliente" id="tipoCliente" required>
                                        <option selected>Seleccionar Tipo Cliente</option>
                                        <option  value="empresa">Empresa</option>
                                        <option  value="particular">Particular</option>
                                    </select>
                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="nombre" id="detalleNombre" required>
                              </div>
                              <div class="col form-group">
                                  <h3 class="control-label " >DNI/CUIT </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="numeroDocumento" id="numeroDocumento" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Teléfono</h3>
                                  <input type="text" class="form-control input-lg" placeholder=" " name="telef" id="telefono" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >E-Mail</h3>
                                  <input type="email" class="form-control input-lg" placeholder="" name="email" id="email" required>
                              </div> <!-- form-group end.// -->
                                
                              <div class="col form-group">
                                  <h3 class="control-label " >Dirección</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="direcc" id="direccion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Ciudad</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="ciudad" id="ciudad" required>
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




