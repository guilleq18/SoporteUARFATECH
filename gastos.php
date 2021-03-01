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

      //Codigo para obtener el id de una celda presionada del datatable
      $('#tabla').on('click', 'tbody tr', function () {

       
          
        
        var taibol = $('#tabla').DataTable();
        var item = taibol.row(this).data();
        var id = item['codigoCadena'];
        //levanto el datatable que necesito 
              $("#tabla1").DataTable( {
                  
                language: {
                  url: './js/Spanish.json',
                  buttons: {pageLength: { _: "Mostrar %d filas"}}
                },
                
                ajax: {
                  url: "/php/controller.php",
                  type: "POST",
                  data: {tipo: "traerSucursales", idCadena:id},
                  dataSrc: ""
                },
                destroy: true,
                columns: [
                  { data: "codigoSucursal"},
                  { data: "codigoCadena"},
                  { data: "nombreCadena", sTitle:"Cadena"},
                  { data: "nombre", sTitle:"Sucursal"},
                  { data: "roc", sTitle:"ROC"},
                  { data: null, sTitle:"Acciones"},
                  
                ], 
                //aqui agrego una columna;
                //con el primer targets le digo cual columna quiero que se vea.
                //con el segundo target le digo en donde van a estar los botones
                columnDefs: [
                  { targets: [0,1], visible: false },
				          { targets: 5, width: 30, orderable: false, searchable: false, render: function (data, type, row) {
                    data="";
                    data+='<span class="accion modifSucursal" title="Configuración de seciones" width="30" height="30" border="1" style="pading:1px"><input type="image" src="./img/editar.png"> <span &nbsp; class="accion delSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/del.png"></span>';
                    return data;}}
                          
                ],
                
                  
              });
            
			
		  
      });




   
      $("#tabla").DataTable( {
          language: {
            url: './js/Spanish.json',
            buttons: {pageLength: { _: "Mostrar %d filas"}}
          },
          ajax: {
            url: "/php/controller.php",
            type: "POST",
            data: {tipo: "traerCadenas"},
            dataSrc: ""
          },
          columns: [
            { data: "codigoCadena", sTitle: "ID"},
            { data: "nombre", sTitle: "Nombre"},
            { data: "provincia", sTitle: "Provincia"},
            { data: "estatus", sTitle: "Status"},
            { data: null, sTitle:"Acciones"}
                  
                ], 
                //aqui agrego una columna;
                //con el primer targets le digo cual columna quiero que se vea.
                //con el segundo target le digo en donde van a estar los botones
                columnDefs: [
                  { targets: 0, visible: false },
				          { targets: 4, width: 30, orderable: false, searchable: false, 
                    render: function (data, type, row) {
                    data="";

                    data+='<span class="accion modifCadena" title="Configuración de seciones" width="30" height="30" border="1" style="pading:1px"><input type="image" src="./img/editar.png"></span> <span &nbsp; class="accion delCadena" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/del.png"></span>'; 
                        //data+=;
                        
                        
                        return data;}}
                          
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
      $( "#tabla tbody" ).on( "click", ".delCadena", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#deleteCadena').modal('show');
              document.getElementById("CadenaCodigo").value = item['codigoCadena'];
              
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
          
           <!-- Modal Modificar-->
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
                            <input type="text" name="CadenaCodigo" id="CadenaCodigo" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="delCadena">Registrar</button></p>
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




