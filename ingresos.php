<!DOCTYPE html>


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
   
         colocarCadenas();
          var datos = [];
          for (var i = 0, len = array_trabajos.length; i < len; ++i) {
          dato = array_trabajos[i];
          datos.push(dato);
        }  
        
        $("#tabla").DataTable( {
            language: {
              url: 'js/Spanish.json'
            },
            data: datos,
            aoColumns: [
              { mData: "codigoCadena", sTitle: "ID"},
              { mData: "nombre", sTitle: "Tipo de Trabajo"},
              { mData: "estatus", sTitle: "Cliente"},
            ]
          
        });
        colocarClientesSelect(codigo);
        //lleno el select de clientes
        $("#select_clientes").select2({
        data: array_colocar_clientes,
        width: '100%',
        allowClear: false,
        language: "es"
		});
        //funcion para enviar los parametros de los inputs al ajax
        $("#carga").click(function(e){
              
          if(validarTrabajo()==false){

          }else{ 
            $("#agregarCLiente").modal('hide');//ocultamos el modal
            
            agregarTrabajo($("#select_clientes").val(), $("#select_tipo_trabajo").val(), $("#nombre_corto").val(), $("#descripcion").val(), $("#fecha_inicio").val(), $("#fecha_entrega").val(), $("#referente").val(), $("#telefono_referente").val(), $("#puesto_referente").val(), $("#importe").val());
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
        <h3>Lista de Trabajos</i></h3>
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
    
    <button type="button" class="" data-toggle="modal" data-target="#agregarCLiente">
      Agregar Trabajos
    </button>
    <form action="detalleTrabajo.php" formtarget="_blank" method="POST" id="detalleC">
        <h3>Ver Trabajo</h3>
        <input class="float-left form-control" type="text" name="codigo" id="codigo">
        </form>
      </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
<br>
          <!-- Modal--> 
          <div class="modal fade" id="agregarCLiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Trabajo</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                             <div class="form-row">
                              <div class="col form-group">
                                <h3 class="control-label " >Seleccionar Cliente</h3>
                                    <select class="form-control" name="selectClientes" id="select_clientes" required>
                                    <option value=""></option>
                                    </select>

                              </div>
                            </div>   

                            <div class="form-row">
                              <div class="col form-group">
                              <h3 class="control-label " >Seleccionar Tipo de Trabajo</h3>
                                    <select class="form-control" name="tipoTrabajo" id="select_tipo_trabajo" 
                                    required>
                                    <option value=""></option>
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
                                  <input type="text" class="form-control input-lg" placeholder=" " name="descripcion" id="descripcion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Fecha de Inicio</h3>
                                  <input type="date" value="" class="form-control input-lg" placeholder="" name="fecha_inicio" id="fecha_inicio" required>
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




