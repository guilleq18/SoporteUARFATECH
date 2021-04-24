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


        function agregarProducto(e) {
         //See notes about 'which' and 'key'
         if (e.keyCode == 13) {
            registrarProducto($("#eanExibir").val());
         
         }
        }
       
    $(document).ready(function(){
   
      $("#tabla").DataTable( {
          language: {
            url: 'js/Spanish.json',
            buttons: {pageLength: { _: "Mostrar %d filas"}}
          },
          ajax: {
            url: "php/controller.php",
            type: "POST",
            data: {tipo:"traerProductosExibidos"},
            dataSrc: ""
          },
          columns: [
            { data: "codigoProducto", sTitle: "codigoProducto"},
            { data: "codigoRelacionado", sTitle: "EAN"},
            { data: "fechaPrecio", sTitle: "Fecha"},
            { data: "precioPublico", sTitle: "Precio Público"},
            { data: null, sTitle:"Acciones"}
                  
                ], 
                //aqui agrego una columna;
                //con el primer targets le digo cual columna quiero que se vea.
                //con el segundo target le digo en donde van a estar los botones
                columnDefs: [
                  
				          /*{ targets: 4, width: 80, orderable: false, searchable: false, 
                    render: function (data, type, row) {
                    data="";

                    data+='<span class="accion modifCadena" title="Configuración de seciones" width="30" height="30" border="1" style="pading:1px"><input type="image" src="./img/editar.png"></span> <span &nbsp; class="accion registroSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/plus.png"></span> <span &nbsp; class="accion delCadena" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/del.png"></span>'; 
                        
                        
                        
                        return data;}}*/
                          
                ],
                
                  
      });
      //paso los datos de las cadenas al modal para modificarlos
      $( "#tabla tbody" ).on( "click", ".modifCadena", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#cadenaModificar').modal('show');
              document.getElementById("idCadena").value = item['codigoCadena'];
              document.getElementById("nombreCad").value = item['nombre'];
              document.getElementById("provCadena").value = item['provincia'];
		  });
      $( "#tabla tbody" ).on( "click", ".registroSucursal", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#SucursalReg').modal('show');
              document.getElementById("idCadenaSuc").value = item['codigoCadena'];
              
              
		  });
      $( "#tabla tbody" ).on( "click", ".delCadena", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#deleteCadena').modal('show');
              document.getElementById("CadenaCodigo").value = item['codigoCadena'];
              
		  });
      
      //AGREGAR CADENA
      /*$("#eanExibir").onkeypress(function(e){
              
            
              
                 
              registrarProducto($("#eanExibir").val());
               
           
       });*/
       $("#regSucursal").click(function(e){
              
            
              $("#SucursalReg").modal('hide');//ocultamos el modal
                 
              registrarSucursal($("#idCadenaSuc").val(), $("#sucursalNombre").val(), $("#encargadoSuc").val());
               
           
       });
      
      //MODIFICAR CADENA
      $("#modificarCadena").click(function(e){
              
                        
             $("#cadenaModificar").modal('hide');//ocultamos el modal
                
             modificCadena($("#idCadena").val(), $("#nombreCad").val(), $("#provCadena").val());
              
          
      });
      $("#delCadena").click(function(e){
              
             $("#deleteCadena").modal('hide');//ocultamos el modal
              
             deleteCadena($("#CadenaCodigo").val());
            
        
      });
      $("#modificarSucursal").click(function(e){
              
                        
              $("#modiSucursal").modal('hide');//ocultamos el modal
                 
              modificSucursal($("#idSucursal").val(), $("#nombreSuc").val(), $("#responsableSuc").val());
               
           
       });
       $("#borrasSucursal").click(function(e){
               
              $("#deleteSucursal").modal('hide');//ocultamos el modal
               
              deleteSucursal($("#codigoSuc").val());
             
         
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
        <h3>Informacion de Cadenas y Sucursales</i></h3>
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
    <button type="button" class="" data-toggle="modal" data-target="#cadenaReg">
      Agregar Cadena
    </button>
    </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
<br>
          <!-- Modal agregar Cadena--> 
          <div class="modal fade" id="cadenaReg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Cadena</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre de la Cadena </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="nombre" id="cadenaNombre" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Provincia a la que pertenece</h3>
                                    <select class="form-control" name="selectClientes" id="select_provincias"   required>
                                     <option value=""></option>
                                    </select>
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="regCadena">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal agregar Sucursal--> 
          <div class="modal fade" id="SucursalReg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Cadena</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre de la Sucursal </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="sucursalNombre" id="sucursalNombre">
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Encargado</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="encargadoSuc" id="encargadoSuc">
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                              <input type="text" name="idCadenaSuc" id="idCadenaSuc" style="visibility:hidden">
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="regSucursal">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>
          
           <!-- Modal Modificar Cadena-->
            <div class="modal fade" id="cadenaModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Egreso</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                        <div class="form-row">
                            <div class="col form-group">
                                  <h3 class="control-label " >Nombre </h3>   
                                  <input type="text" class="form-control input-lg"  name="nombreCad" id="nombreCad" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Provincia</h3>
                                  <input type="text" class="form-control input-lg"  name="Provincia" id="provCadena" required>
                              </div> <!- form-group end.// ->
                              <input type="text" name="idCadena" id="idCadena" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="modificarCadena">Registrar</button></p>
                </div>
              </div>
            </div>
          </div> 
          <!-- Modal Modificar Sucursal-->
          <div class="modal fade" id="modiSucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Modificar Sucursal</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                        <div class="form-row">
                            <div class="col form-group">
                                  <h3 class="control-label " >Nombre </h3>   
                                  <input type="text" class="form-control input-lg"  name="nombreCad" id="nombreSuc" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Responsable de Sucursal</h3>
                                  <input type="text" class="form-control input-lg"  name="Provincia" id="responsableSuc" required>
                              </div> <!- form-group end.// ->
                              <input type="text" name="idSucursal" id="idSucursal" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="modificarSucursal">Registrar</button></p>
                </div>
              </div>
            </div>
          </div> 


          <!-- Modal Eliminar cadena--> 
          <div class="modal fade" id="deleteCadena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Eliminar Cadena</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">

                            <div class="form-row">
                            <h3 class="control-label " >¿Desea Eliminar la Cadena? </h3>   
                            <input type="text" name="CadenaCodigo" id="CadenaCodigo" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                        
                    </div>
                </div>

              
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="delCadena">SI</button></p>
                </div>
              </div>
            </div>
          </div>
		</div>	
    </div>

    <!-- Modal Eliminar Sucursal--> 
    <div class="modal fade" id="deleteSucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Eliminar Sucursal</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">

                            <div class="form-row">
                            <h3 class="control-label " >¿Desea Eliminar la Sucursal? </h3>
                            <input type="text" name="codigoSuc" id="codigoSuc" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                        
                    </div>
                </div>

              
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="borrasSucursal">SI</button></p>
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
    <!--TOMO EL EAN A AGREGAR-->
    <div class="col form-group">
        <h3 class="control-label " >Codigo de Barra </h3>   
        <input type="text" class="form-control input-lg" onkeypress="agregarProducto(event)"  name="eanExibir" id="eanExibir">
    </div> <!-- form-group end.// -->

	  		<table id="tabla" class="table table-bordered"></table>
		</div>
  	</div>
  </div>
  <div style="clear:both; margin:10px" > </div>
  <!--datatable-->
  <div class="row" style="margin-bottom: 20px;">
		<div class="col-lg-1 col-sm-1"></div>
		<div class="col-md-10">
	  		<table id="tabla1" class="table table-bordered"></table>
		</div>
  	</div>
  </div>
</section>


   
          

      
</body>


    
  
</html>




