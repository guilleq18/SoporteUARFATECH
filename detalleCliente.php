<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['codigoUsuario'])){
        header("Location: /login.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGD</title>
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

    var codigo=<?php echo $_POST['codigo']; ?>;
  
    detalleCliente(codigo);
    
    //pego en los input el valor que traigo del json
    $("#codigoCliente").val(array_detalle_cliente[0].codigoCliente);
    $("#tipoCliente").val(array_detalle_cliente[0].tipoCliente);
    $("#nombre").val(array_detalle_cliente[0].nombre);
    $("#numeroDocumento").val(array_detalle_cliente[0].numeroDocumento);
    $("#telefono").val(array_detalle_cliente[0].telefono);
    $("#email").val(array_detalle_cliente[0].email);
    $("#direccion").val(array_detalle_cliente[0].direccion);
    $("#ciudad").val(array_detalle_cliente[0].ciudad);

    $("#cambio").click(function(e){
              
        if (validarClienteModificar()==false){

          } else{  
              
              modCliente($("#codigoCliente").val(), $("#tipoCliente").val(), $("#nombre").val(), $("#numeroDocumento").val(), $("#telefono").val(), $("#email").val(), $("#direccion").val(), $("#ciudad").val());
          }

    });

    $("#baja").click(function(e){
              
              
              bajaCliente($("#codigoCliente").val());
             
            
              
    });

});

      </script>

    </head>

<body>

  	<div class="row" style="margin-top: 5px;">
	  <div class="col-lg-2 col-sm-2"></div>
      <div class="col-lg-8 page-header">
        
      </div>
	</div>
	
<div class="row" style="margin-bottom: 20px;">
		<div class="col-lg-1 col-sm-1"></div>
		<div class="col-md-10">
	  		<table id="tabla" class="table table-bordered"></table>
		</div>
  	</div>
  </div>

<div class="col-md-3 col-md-3"></div>
    <div class="col-md-6">
                         
                             <div class="form-row">
                              <div class="col form-group">
                                <h3 class="control-label">Detalle Cliente</h3>
                                <input type="text" style="visibility:hidden" name="codigoCliente" id="codigoCliente"  >
                                    <select class="form-control" name="tipoCliente" id="tipoCliente" required>
                                        <option selected></option>
                                        <option  value="empresa">Empresa</option>
                                        <option  value="particular">Particular</option>
                                    </select>
                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label"> Nombre </h3>   
                                  <input type="text" class="form-control input-lg" value="" name="nombre" id="nombre"  required>
                              </div>
                              <div class="col form-group">
                                  <h3 class="control-label " >DNI/CUIT </h3>   
                                  <input type="text" value="" class="form-control input-lg" placeholder="" name="numeroDocumento" id="numeroDocumento" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Teléfono</h3>
                                  <input type="text" value="" class="form-control input-lg" placeholder=" " name="telef" id="telefono" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >E-Mail</h3>
                                  <input type="email" value="" class="form-control input-lg" placeholder="" name="email" id="email" required>
                              </div> <!-- form-group end.// -->
                                
                              <div class="col form-group">
                                  <h3 class="control-label " >Dirección</h3>
                                  <input type="text" value="" class="form-control input-lg" placeholder="" name="direcc" id="direccion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Ciudad</h3>
                                  <input type="text" value="" class="form-control input-lg" placeholder="" name="ciudad" id="ciudad" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <div class="form-row">
                                <div class="form-group col-md-2">
                                <p ><button class="btn btn-lg btn-danger" id="baja">Eliminar </button></p>
                                </div> 
                                <div class="form-group col-md-2">
                                <p ><button class="btn btn-lg btn-primary" id="cambio">Guardar Cambios</button></p>
                                </div> 
	                          </div> 

                              
                               
                        
                              </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                             
                            
                    </div>
                </div>

</body>
</html>