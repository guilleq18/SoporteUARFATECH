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
    
   
  
    detalleGasto(codigo);
    
    //pego en los input el valor que traigo del json
    //$("#codigoTrabajo").val(array_detalle_trabajo[0].codigoTrabajo);
    

    //$("#select_clientes").val(array_detalle_trabajo[0].codigoCliente);
    $("#codigoGasto").val(array_detalle_gasto[0].codigoGasto);
    $("#tipoGasto").val(array_detalle_gasto[0].tipoGasto);
    $("#descripcion").val(array_detalle_gasto[0].descripcion);
    $("#importe").val(array_detalle_gasto[0].importe);
    $("#alias").val(array_detalle_gasto[0].alias);
    $("#fecha").val(array_detalle_gasto[0].fecha);
   
    $("#cambio").click(function(e){
              
        if (validarGastoMod()==false){
            
        }else{ 
        modGasto($("#codigoGasto").val(), $("#tipoGasto").val(), $("#alias").val(), $("#descripcion").val(), $("#fecha").val(), $("#importe").val());
        }
       
              
              

    });

    $("#baja").click(function(e){
              
              
              bajaGasto($("#codigoGasto").val());
             
             
              
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
                                <h3 class="control-label">Detalle Egreso</h3>
                                <input type="text" style="visibility:hidden" name="codigoGasto" id="codigoGasto"  >
                                <h3 class="control-label ">Seleccionar Tipo de Egreso</h3>
                                    <select class="form-control" name="tipoGasto" id="tipoGasto" 
                                    required>
                                    <option value=""></option>
                                    <option value="Pago">Pago </option>
                                    <option value="Compra">Compra</option>
                                    </select>
                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                              <h3 class="control-label " >Alias </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="alias" id="alias" required>
                              </div>
                              <div class="col form-group">
                              <h3 class="control-label " >Descripción</h3>
                                  <textarea type="text" class="form-control"  name="descripcion" id="descripcion" required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Fecha</h3>
                                  <input type="date" class="form-control input-lg" placeholder="" name="fecha" id="fecha" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Importe</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="importe" id="importe" required>
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