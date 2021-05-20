<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['codigoUsuario'])){
      
        header("Location: /login.php");
    }
    if($_SESSION['rol']==1){
      header("Location: /index.php");
    }
    
    $usuario=$_SESSION['codigoUsuario'];
  
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSU</title>
     <!-- Bootstrap -->
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
                  { data: null},
                  
                ], 
                //aqui agrego una columna;
                //con el primer targets le digo cual columna quiero que se vea.
                //con el segundo target le digo en donde van a estar los botones
                columnDefs: [
                  { targets: [0,1], visible: false },
				          { targets: 5, width: 60, orderable: false, searchable: false, 
                    render: function (data, type, row) {
                    data="";
                    data+='<span class="accion modificSuc" title="Configuración de seciones" width="30" height="30" border="0" style="pading:1px"><input type="image" src="./img/editar.png"></span> <span &nbsp; class="accion delSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/del.png"></span>';
                    return data;}}
                          
                ],
                
                  
          });
          //funciones para modificar y eliminar una sucursal
          $( "#tabla1 tbody" ).on( "click", ".modificSuc", function() {
              var item = $("#tabla1").DataTable().row( $(this).parents('tr') ).data();
              $('#modiSucursal').modal('show');
              document.getElementById("idSucursal").value = item['codigoSucursal'];
              document.getElementById("nombreSuc").value = item['nombre'];
              document.getElementById("responsableSuc").value = item['roc'];
		      });
          $( "#tabla1 tbody" ).on( "click", ".delSucursal", function() {
              var item = $("#tabla1").DataTable().row( $(this).parents('tr') ).data();
              $('#deleteSucursal').modal('show');
              document.getElementById("codigoSuc").value = item['codigoSucursal'];
              
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
            { data: "nombre", sTitle: "Nombre"},
            { data: "nombreProvincia", sTitle: "Provincia"},
            { data: "codigoCadena", sTitle: "ID"},
            { data: "provincia", sTitle: "codigoProvincia"},
            { data: null, sTitle:"Acciones"}
                  
                ], 
                //aqui agrego una columna;
                //con el primer targets le digo cual columna quiero que se vea.
                //con el segundo target le digo en donde van a estar los botones
                columnDefs: [
                  { targets: [2,3,4], visible: false },
				          { targets: 5, width: 80, orderable: false, searchable: false, 
                    render: function (data, type, row) {
                    data="";

                    data+='<span class="accion modifCadena" title="Configuración de seciones" width="30" height="30" border="1" style="pading:1px"><input type="image" src="./img/editar.png"></span> <span &nbsp; class="accion registroSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/plus.png"></span> <span &nbsp; class="accion delCadena" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="./img/del.png"></span>'; 
                        
                        
                        
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
      colocarProvinciasSelect();
        //lleno el select de clientes
        $("#select_provincias").select2({
        data: array_colocar_provincias,
        width: '100%',
        allowClear: false,
        language: "es"
    });
      //AGREGAR CADENA
      $("#regCadena").click(function(e){
              
          if($("#cadenaNombre").val()=='' || $("#select_provincias").val()=='')
          {
              alert('Datos Incompletos, Por favor completar los campos con *');
          }else{
            
              $("#cadenaReg").modal('hide');//ocultamos el modal
              
              registrarCadena($("#cadenaNombre").val(), $("#select_provincias").val());
              $("#tabla").DataTable().ajax.reload();     
            }
           
       });
       $("#registroSucursal").click(function(e){
              
        if($("#sucursalNombre").val()=='' || $("#encargadoSuc").val()=='')
          {
              alert('Datos Incompletos, Por favor completar los campos con *');
          }else{
              $("#SucursalReg").modal('hide');//ocultamos el modal
                 
              registrarSucursal($("#idCadenaSuc").val(), $("#sucursalNombre").val(), $("#encargadoSuc").val());
              $("#tabla1").DataTable().ajax.reload(); 
          } 
       });
      
      //MODIFICAR CADENA
      $("#modificarCadena").click(function(e){
              
        if($("#nombreCad").val()=='' || $("#provCadena").val()=='')
          {
              alert('Datos Incompletos, Por favor completar los campos con *')
          }else{
                        
             $("#cadenaModificar").modal('hide');//ocultamos el modal
                
             modificCadena($("#idCadena").val(), $("#nombreCad").val(), $("#provCadena").val());
             $("#tabla").DataTable().ajax.reload(); 
          }
      });
      $("#delCadena").click(function(e){
              
             $("#deleteCadena").modal('hide');//ocultamos el modal
              
             deleteCadena($("#CadenaCodigo").val());
             $("#tabla").DataTable().ajax.reload(); 
        
      });
      $("#modificarSucursal").click(function(e){
       
        if($("#nombreSuc").val()=='' || $("#responsableSuc").val()=='')
          {
              alert('Datos Incompletos, Por favor completar los campos con *')
          }else{
                        
              $("#modiSucursal").modal('hide');//ocultamos el modal
                 
              modificSucursal($("#idSucursal").val(), $("#nombreSuc").val(), $("#responsableSuc").val());
              $("#tabla1").DataTable().ajax.reload(); 
          }
       });
       $("#borrasSucursal").click(function(e){
               
              $("#deleteSucursal").modal('hide');//ocultamos el modal
               
              deleteSucursal($("#codigoSuc").val());
              $("#tabla1").DataTable().ajax.reload(); 
         
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
        <li><a href="index.php" class="active">Inicio</a></li>
		<li><a href="reclamos.php">Reclamos</a></li>
        <li><a href="cadenas.php">Cadenas</a></li>
        
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
    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#cadenaReg">
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
                                  <h3 class="control-label " >Nombre de la Cadena *</h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="nombre" id="cadenaNombre" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Provincia a la que pertenece *</h3>
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
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Sucursal</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre de la Sucursal *</h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="sucursalNombre" id="sucursalNombre">
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Nombre del Encargado *</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="encargadoSuc" id="encargadoSuc">
                                  
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                              <input type="text" name="idCadenaSuc" id="idCadenaSuc" >
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="registroSucursal">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>
          
           <!-- Modal Modificar Cadena-->
            <div class="modal fade" id="cadenaModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Modificar Candena</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                        <div class="form-row">
                            <div class="col form-group">
                                  <h3 class="control-label " >Nombre Cadena *</h3>   
                                  <input type="text" class="form-control input-lg"  name="nombreCad" id="nombreCad" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Provincia *</h3>
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
                                  <h3 class="control-label " >Nombre Sucursal *</h3>   
                                  <input type="text" class="form-control input-lg"  name="nombreCad" id="nombreSuc" required>
                              </div> <!-- form-group end.// -->
                           
                              <div class="col form-group">
                                  <h3 class="control-label " >Responsable de Sucursal *</h3>
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




