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
    
   
  
    detalleTrabajo(codigo);
    
    //pego en los input el valor que traigo del json
    //$("#codigoTrabajo").val(array_detalle_trabajo[0].codigoTrabajo);
    colocarClientesModSelect(codigo);
    $("#select_clientes").select2({
        data: array_colocar_clientes_mod,
        width: '100%',
        allowClear: false,
        language: "es"
	});


    //$("#select_clientes").val(array_detalle_trabajo[0].codigoCliente);
    $("#codigoTrabajo").val(array_detalle_trabajo[0].codigoTrabajo);
    $("#nombre_corto").val(array_detalle_trabajo[0].nombreCorto);
    $("#descripcion").val(array_detalle_trabajo[0].descripcion);
    $("#fecha_inicio").val(array_detalle_trabajo[0].fechaInicio);
    $("#fecha_entrega").val(array_detalle_trabajo[0].fechaEntrega);
    $("#importe").val(array_detalle_trabajo[0].importe);
    $("#referente").val(array_detalle_trabajo[0].referente);
    $("#telefono_referente").val(array_detalle_trabajo[0].telefonoReferente);
    $("#puesto_referente").val(array_detalle_trabajo[0].puestoEmpresa);
    $("#tipoTrabajoSelect").val(array_detalle_trabajo[0].tipoTrabajo);
   
    $("#cambio").click(function(e){
              
       if (validarTrabajoMod()==false){

       } else{
        modTrabajo($("#codigoTrabajo").val(), $("#select_clientes").val(), $("#nombre_corto").val(), $("#descripcion").val(), $("#fecha_inicio").val(), $("#fecha_entrega").val(), $("#importe").val(), $("#referente").val(), $("#telefono_referente").val(),$("#puesto_referente").val(), $("#tipoTrabajoSelect").val(),);
           
       }    
              
              

    });

    $("#baja").click(function(e){
              
              
              bajaTrabajo($("#codigoTrabajo").val());
             
             
              
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
                                <h3 class="control-label">Detalle Trabajo</h3>
                                <input type="text" style="visibility:hidden" name="codigoTrabajo" id="codigoTrabajo"  >
                                <h3 class="control-label " >Seleccionar Cliente</h3>
                                    <select class="form-control" name="selectClientes" id="select_clientes" required></select>
                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                              <h3 class="control-label " >Seleccionar Tipo de Trabajo</h3>
                                    <select class="form-control" name="tipoTrabajoSelect" id="tipoTrabajoSelect" 
                                    required>
                                    <option selected></option>
                                    <option value="Reparacion">Reparación</option>
                                    <option value="Venta">Venta</option>
                                    <option value="Modificacion">Modificación</option>
                                    <option value="Recambio">Recambio</option>
                                    <option value="Fabricacion">Fabricacion</option>
                                    </select>
                              </div>
                              
                              <div class="col form-group">
                              <h3 class="control-label " >Nombre Corto </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="nombre_corto" id="nombre_corto" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                              <h3 class="control-label " >Descripción</h3>
                                  <textarea type="text" class="form-control"  name="descripcion" id="descripcion" required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Fecha de Inicio</h3>
                                  <input type="date" class="form-control input-lg" placeholder="" name="fecha_inicio" id="fecha_inicio" required>
                              </div> <!-- form-group end.// -->
                                
                              <div class="col form-group">
                              <h3 class="control-label " >Fecha de Entrega</h3>
                                  <input type="date" class="form-control input-lg" placeholder="" name="fecha_entrega" id="fecha_entrega" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Importe</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="importe" id="importe" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Nombre del Referente</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="referente" id="referente" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Teléfono del Referente</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="telefono_referente" id="telefono_referente" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                              <h3 class="control-label " >Puesto del Referente</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="puesto_referente" id="puesto_referente" required>
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