<style>
input[type=time] {
  
  color: #2a2c2d;
  font-size: 20px;
  font-family: helvetica;
  width: 180px;
  
  border: 1px solid #ccc;
  color: #888;
 
 
  border-radius: 4px;
 
  

}
input[type=date] {
  
  color: #2a2c2d;
  font-size: 20px;
  font-family: helvetica;
  width: 180px;
  
  border: 1px solid #ccc;
  color: #888;
 
 
  border-radius: 4px;
 
  

}



</style>

<!DOCTYPE html PUBLIC "FORO">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
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

var idUsuarioUt=<?php echo $usuario;?>;


//tabla    
    $("#tabla").DataTable( {
                  
                  language: {
                    url: './js/Spanish.json',
                   },
                  
                  ajax: {
                    url: "/php/controller.php",
                    type: "POST",
                    data: {tipo: "traerReclamosCab"},
                    dataSrc: ""
                  },
                  destroy: true,
                  columns: [
                    { data: "codigoReclamo"},
                    { data: "nombre"},
                    { data: "titulo"},
                    { data: "hora"},
                    { data: "fechaReclamo"},
                    { data: "estado"},
                    { data: "nombreUsuario"},
                    { data: null}
                    
                  ], 
                  //aqui agrego una columna;
                  //con el primer targets le digo cual columna quiero que se vea.
                  //con el segundo target le digo en donde van a estar los botones
                  columnDefs: [
                    //{ targets: [9,10], visible: false },
                    { targets: 0, width: 30 },
                    { targets: 1, width: 180 },
                    { targets: 3, width: 60},
                    { targets: 4, width: 60 },
                    { targets: 5, width: 60 },
                    { targets: 6, width: 60 },
                    { targets: 7, width: 130, orderable: false, searchable: false, render: function (data, type, row) {
                      if(row.estado=='PENDIENTE'){
                      data="";
                      data+='<span class="accion modReclamo" title="Modificar" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/editar.png"></span> <span &nbsp; class="accion delReclamos" title="Eliminar" width="30" height="30" border="1" pading:1px><input type="image" src="../img/del.png"></span> <span class="accion detalleReclamo" title="Detalle" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/buscar.png"></span><span class="accion modEstado" title="Pasar a OK" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/comprobado.png"></span> '
                      
                      }else{
                      
                      data="";
                      data+='<span class="accion modReclamo" title="Modificar" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/editar.png"></span> <span &nbsp; class="accion delReclamos" title="Eliminar" width="30" height="30" border="1" pading:1px><input type="image" src="../img/del.png"></span> <span class="accion detalleReclamo" title="Detalle" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/buscar.png"></span>'
                      }
                      return data;}}
                      
                            
                  ],
                  dom: 'Bfrtip',
		              pageLength: 50,
                  initComplete: function () {
		
                        $("#tabla").DataTable().column(7).visible(true);
                        $("#tabla").DataTable().columns.adjust().draw();
            
                        $('#tabla thead .trFiltros th').each(function(index) {
                        $($('#tabla thead .trFiltros th')[index]).css('width', $('#tabla thead .trFiltros th')[index].clientWidth);
                        $($('#tabla thead .trFiltros .dFiltro')[index]).css('display', 'block');
                        });
                        $('#tabla_filter').css('height', '45px');
                        $('#tabla_filter label').css('margin-top', '11px');
                      }
                  });
                        $(".trFiltros .dFiltro").click(function(e) {
                          e.stopPropagation();
                        });
                        $('#tabla .celdaFiltro').on( 'keyup change', function ()	{   
                          var i =$(this).attr('id');  
                          var v =$(this).val();  
                          $("#tabla").DataTable().columns(i).search(v).draw();
                        
	                      });
       


//selects
    $( "#select_Empresa" ).on( "change", function() {
        colocarSucursalSelect($("#select_Empresa").val());
        //lleno el select de clientes
        $("#select_Sucursal").select2({
        data: array_colocar_sucursales,
        width: '100%',
        allowClear: false,
        language: "es"
    });  
              
              
		});
    colocarEmpresaSelect();
        //lleno el select de clientes
        $("#select_Empresa").select2({
        data: array_colocar_empresas,
        width: '100%',
        allowClear: false,
        language: "es"
    });
//form de modificar estado
    $( "#tabla tbody" ).on( "click", ".modEstado", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#modificarEstado').modal('show');
              document.getElementById("codigoReclamo").value = item['codigoReclamo'];
		});
//form de modificar
    $( "#tabla tbody" ).on( "click", ".modReclamo", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              var reclamo = item['codigoReclamo'];
              $('#modificarReclamo').modal('show');

              detalleReclamoCab(reclamo);
              colocarEmpresaSelect();
                //lleno el select de clientes
                $("#select_EmpresaMod").select2({
                data: array_colocar_empresas,
                width: '100%',
                allowClear: false,
                language: "es"
              });

              $( "#select_EmpresaMod" ).on( "change", function() {
                colocarSucursalSelect($("#select_EmpresaMod").val());
                //lleno el select de clientes
                $("#select_SucursalMod").select2({
                data: array_colocar_sucursales,
                width: '100%',
                allowClear: false,
                language: "es"
              });  
                  
              });
              

              if(array_reclamo.length>0){        
                 
                document.getElementById("codigoReclamoMod").value=array_reclamo[0].codigoReclamo;
                
                document.getElementById("select_SucursalMod").value=array_reclamo[0].codigoSucursal;
                document.getElementById("tituloMod").value=array_reclamo[0].titulo;
                document.getElementById("select_MotivoMod").value=array_reclamo[0].tipoReclamo;
                document.getElementById("timeMod").value=array_reclamo[0].hora;
                document.getElementById("fechaMod").value=array_reclamo[0].fechaReclamo;
                document.getElementById("descripcionMod").value=array_reclamo[0].descripcion;
                document.getElementById("RespuestaMod").value=array_reclamo[0].respuesta;
                document.getElementById("usuarioMod").value=array_reclamo[0].usuarioReclamo;
                document.getElementById("usuarioUtMod").value=array_reclamo[0].nombreUsuario;
                document.getElementById("select_EstadoMod").value=array_reclamo[0].codEstado;
                
                
   
              }

             
		});
//form borrar reclamo
    $( "#tabla tbody" ).on( "click", ".delReclamos", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#delReclamo').modal('show');
              document.getElementById("codigoReclamoDel").value = item['codigoReclamo'];
		});
//form detalle del reclamo
    $( "#tabla tbody" ).on( "click", ".detalleReclamo", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              var reclamo = item['codigoReclamo'];
              $('#verReclamo').modal('show');

              detalleReclamoCab(reclamo);

              if(array_reclamo.length>0){        
                 
                document.getElementById("codigoReclamoVer").value=array_reclamo[0].codigoReclamo;
                document.getElementById("tituloVer").value=array_reclamo[0].titulo;
                document.getElementById("motivoVer").value=array_reclamo[0].reclamo;
                document.getElementById("sucursalVer").value=array_reclamo[0].nombre;
                document.getElementById("timeVer").value=array_reclamo[0].hora;
                document.getElementById("fechaVer").value=array_reclamo[0].fechaReclamo;
                document.getElementById("descripcionVer").value=array_reclamo[0].descripcion;
                document.getElementById("respuestaVer").value=array_reclamo[0].respuesta;
                document.getElementById("usuarioRVer").value=array_reclamo[0].usuarioReclamo;
                document.getElementById("estadoVer").value=array_reclamo[0].estado;
                document.getElementById("usuarioUtVer").value=array_reclamo[0].nombreUsuario;
                document.getElementById("capturaVer").src="img/"+array_reclamo[0].codigoimagen;
                
              }

              

		});
 
//REGISTRAR RECLAMO
    $("#regReclamo").click(function(e){
      var formData = new FormData();
      var files = $('#uploadedfile')[0].files[0];
      formData.append('file',files);
        $.ajax({
            url: 'php/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response =="File not uploaded" || response =="Formato Invalido" || response =="Nombre Demasiado Largo") {
                  alert(response);
                } else {
                  if ( $("#select_Motivo").val()=='' || $("#fecha").val()=='' || $("#titulo").val()=='' || $("#descripcion").val()=='' || $("#Respuesta").val()=='' || $("#select_Estado").val()==''){

                      alert('Datos Incompletos, Por favor completar los campos con *');

                  }else{
                  document.getElementById("uploadedfile").value = "";
                      var usuarioUt=1;
                       $("#reclamoReg").modal('hide');//ocultamos el modal
                       registrarProblema($("#select_Empresa").val(), idUsuarioUt, $("#select_Sucursal").val(), $("#select_Motivo").val(), $("#fecha").val(),$("#titulo").val(), $("#time").val(), $("#descripcion").val(), $("#Respuesta").val(), $("#select_Estado").val(), $("#usuarioR").val(), response);
                       $("#tabla").DataTable().ajax.reload(); 
                  }   
                }
            }
        });
         
    });
//MODIFICAR RECLAMO
  $("#modifReclamo").click(function(e){
      var formData = new FormData();
      var files = $('#uploadedfileMod')[0].files[0];
      formData.append('file',files);
        $.ajax({
            url: 'php/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response =="File not uploaded" || response =="Formato Invalido" || response =="Nombre Demasiado Largo") {
                  alert(response);
                } else {
                  
                  if ($("#select_MotivoMod").val()=='' || $("#fechaMod").val()=='' || $("#tituloMod").val()=='' || $("#descripcionMod").val()=='' || $("#RespuestaMod").val()=='' || $("#select_EstadoMod").val()==''){

                      alert('Datos Incompletos, Por favor completar los campos con *');


                  }else{
                    
                        document.getElementById("uploadedfile").value = "";
                          
                        
                          $("#modificarReclamo").modal('hide');//ocultamos el modal
                          modificarProblema($("#codigoReclamoMod").val(), idUsuarioUt, $("#select_SucursalMod").val(), $("#select_MotivoMod").val(), $("#fechaMod").val(),$("#tituloMod").val(), $("#timeMod").val(), $("#descripcionMod").val(), $("#RespuestaMod").val(), $("#select_EstadoMod").val(), $("#usuarioMod").val(), response);
                          $("#tabla").DataTable().ajax.reload(); 
                          document.getElementById('modificarReclamo').reset();
                        
                     
                      }
                    
                }
            }
        });
         
  });

//MODIFICAR ESTADO 
    $("#estadoModificar").click(function(e){
              
              $("#modificarEstado").modal('hide');//ocultamos el modal
               
              estadoMod($("#codigoReclamo").val());
              $("#table").DataTable().ajax.reload(); 
             
         
    });

//BORRAR RECLAMO
    $("#deleteReclamo").click(function(e){
              
              $("#delReclamo").modal('hide');//ocultamos el modal
               
              deleteReclamo($("#codigoReclamoDel").val());
              $("#tabla").DataTable().ajax.reload(); 
         
    });
   
})



</script>


</head>
<!-- menu-->
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

<!-- Modal Modificar Estado--> 
  <div class="modal fade" id="modificarEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Cambiar Estado</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">

                            <div class="form-row">
                            <h3 class="control-label " >¿Desea Cambiar el Estado a Ok? </h3>   
                            <input type="text" name="codigoReclamo" id="codigoReclamo" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                        
                    </div>
                </div>

              
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="estadoModificar">SI</button></p>
                </div>
              </div>
            </div>
          </div>
		</div>	
    </div>

<!-- Modal Eliminar Reclamo--> 
  <div class="modal fade" id="delReclamo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Eliminar Reclamo</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">

                            <div class="form-row">
                            <h3 class="control-label " >¿Desea Eliminar el Reclamo? </h3>   
                            <input type="text" name="codigoReclamoDel" id="codigoReclamoDel" style="visibility:hidden">
                              
                            </div> <!-- form-row end.// -->
                        
                    </div>
                </div>

              
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="deleteReclamo">SI</button></p>
                </div>
              </div>
            </div>
          </div>
		</div>	
    </div>



<!-- Modal agregar Reclamo--> 
 <div class="modal fade" id="reclamoReg" tabindex="-1" role="dialog"  enctype="multipart/form-data" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Reclamo</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                              
                              <div class="col form-group">
                                  <h3 class="control-label">Empresa</h3>
                                    <select class="form-control" name="selectEmpresa" id="select_Empresa"   required>
                                     <option value=""></option>
                                    </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Sucursal</h3>
                                    <select class="form-control" name="selectSucursal" id="select_Sucursal"   required>
                                     <option value=""></option>
                                    </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Titulo Problema </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="titulo" id="titulo" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Motivo</h3>
                                    <select class="form-control" name="selectMotivo" id="select_Motivo"   required>
                                     <option value="1">Capacitacion</option>
                                     <option value="2">Duda</option>
                                     <option value="3">Error</option>
                                     <option value="4">Configuracion</option>
                                     <option value="5">Replicacion</option>
                                     <option value="6">Operativo</option>
                                     <option value="7">Productos</option>
                                     </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Fecha </h3>   
                                  <input type="date" class="form-control" name="fecha" id="fecha" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Hora </h3>   
                                  <input type="time" class="form-control" value="00:00" id='time'>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Usuario Reclamo </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="usuarioR" id="usuarioR" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Reclamo </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="problema" id="descripcion" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Respuesta </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="Respuesta" id="Respuesta" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Captura </h3>   
                                  <input type="file" class="form-control input-file" value='NULL' name="uploadedfile" id="uploadedfile">
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Estado</h3>
                                    <select class="form-control" name="selectEstado" id="select_Estado"   required>
                                     <option value="1">Pendiente</option>
                                     <option value="2">Ok</option>
                                     </select>
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="regReclamo">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>







<!-- Modal Visualizar Reclamo--> 
  <div class="modal fade" id="verReclamo" tabindex="-1" role="dialog"  enctype="multipart/form-data" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Detalle Reclamo</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                            <input type="text" class="form-control input-lg" placeholder="" name="sucursalVer" id="codigoReclamoVer" style="margin: 10px 0px;  visibility: hidden;" required>
                              <div class="col form-group">
                                  <h3 class="control-label">Sucursal</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="sucursalVer" id="sucursalVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Titulo Problema </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="tituloVer" id="tituloVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Motivo</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="motivoVer" id="motivoVer" readonly=readonly required>
                                    
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Fecha </h3>   
                                  <input type="date" class="form-control" name="fechaVer" id="fechaVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Hora </h3>   
                                  <input type="time" class="form-control" readonly=readonly id='timeVer'>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Usuario Reclamo </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="usuarioRVer" id="usuarioRVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Reclamo </h3>   
                                  <textarea type="text" class="form-control input-lg" placeholder="" name="problemaVer" id="descripcionVer" readonly=readonly required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Respuesta </h3>   
                                  <textarea type="text" class="form-control input-lg" placeholder="" name="respuestaVer" id="respuestaVer" readonly=readonly required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Captura </h3>   
                                  <img type="image" alt="" style="max-height:400px;max-width:500px;" id="capturaVer" >
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Estado</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="estadoVer" id="estadoVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Usuario UT</h3>
                                  <input type="text" class="form-control input-lg" placeholder="" name="usuarioUtVer" id="usuarioUtVer" readonly=readonly required>
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Cerrar</button>
                  
                </div>
              </div>
            </div>
  </div>


 <!-- Modal Modificar Reclamo--> 
 <div class="modal fade" id="modificarReclamo" tabindex="-1" role="dialog"  enctype="multipart/form-data" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Modificar Reclamo</h3>
                </div>
                      <div class="modal-body"> 
                        <div class="card">
                         
                            <div class="form-row">
                            <input type="text" class="form-control input-lg" placeholder="" name="codigoReclamoMod" id="codigoReclamoMod" style="visibility: hidden;" required>
                            <!-- CODIGO PROVISIORIO PARA CAMBIAR EL USUARIO ENCARGADO-->
                            <input type="text" class="form-control input-lg" placeholder="" name="usuarioUtMod" id="usuarioUtMod" style="visibility: hidden;" required>
                               <!-- ......................................................-->
                              <div class="col form-group">
                                  <h3 class="control-label">Empresa</h3>
                                    <select class="form-control" name="selectEmpresaMod" id="select_EmpresaMod"   required>
                                     <option selected="selected" value=""></option>
                                    </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Sucursal</h3>
                                    <select class="form-control" name="selectSucursalMod" id="select_SucursalMod"   required>
                                     <option selected="selected" value=""></option>
                                    </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Titulo Problema </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="tituloMod" id="tituloMod" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Motivo</h3>
                                    <select class="form-control" name="selectMotivoMod" id="select_MotivoMod"   required>
                                     <option value="1">Capacitacion</option>
                                     <option value="2">Duda</option>
                                     <option value="3">Error</option>
                                     <option value="4">Configuracion</option>
                                     <option value="5">Replicacion</option>
                                     <option value="6">Operativo</option>
                                     <option value="7">Productos</option>
                                     </select>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Fecha </h3>   
                                  <input type="date" class="form-control" name="fechaMod" id="fechaMod" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Hora </h3>   
                                  <input type="time" class="form-control" value="00:00" id='timeMod'>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Usuario Reclamo </h3>   
                                  <input type="text" class="form-control input-lg" placeholder="" name="usuarioMod" id="usuarioMod" required>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Reclamo </h3>   
                                  <textarea  class="form-control input-lg" placeholder="" name="problemaMod" id="descripcionMod" required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Respuesta </h3>   
                                  <textarea  class="form-control input-lg" placeholder="" name="RespuestaMod" id="RespuestaMod" required></textarea>
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label " >Captura </h3>   
                                  <input type="file" class="form-control input-file" value='NULL' name="uploadedfileMod" id="uploadedfileMod">
                              </div> <!-- form-group end.// -->
                              <div class="col form-group">
                                  <h3 class="control-label">Estado</h3>
                                    <select class="form-control" name="select_EstadoMod" id="select_EstadoMod"   required>
                                     <option value="1">Pendiente</option>
                                     <option value="2">Ok</option>
                                     </select>
                              </div> <!-- form-group end.// -->
                              </div> <!-- form-row end.// -->
                             
                        
                    </div>
                </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="modifReclamo">Guardar</button></p>
                </div>
              </div>
            </div>
          </div>





<!--seccion su-->
 <section>
  <div class="container-fluid">
  	<div class="row">
	  <div class="col-lg-1 col-sm-1"></div>
      <div class="col-lg-10 page-header">
        <h3>Informacion de Reclamos</i></h3>
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
    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#reclamoReg">
      Agregar Reclamo
    </button>
    </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>



<!--DATATABLE-->
    <div class="row" style="margin-bottom: 20px;">
		<div class="col-lg-1 col-sm-1"></div>
		<div class="col-md-10">
	  		<table id="tabla" class="table table-bordered">
        <thead>
        <tr 
        class="trFiltros">
          <th><div class="dTitulo">Codigo</div><div class="dFiltro"><input id="0" class="form-control celdaFiltro" type="text"></div></th>
        
          <th><div class="dTitulo">Sucursal</div><div class="dFiltro"><input id="1" class="form-control celdaFiltro" type="text"></div></th>

          <th><div class="dTitulo">Titulo </div><div class="dFiltro"><input id="2" class="form-control celdaFiltro" type="text"></div></th>
          
          <th><div class="dTitulo">Hora</div><div class="dFiltro"><input id="3" class="form-control celdaFiltro" type="text"></div></th>
          
          <th><div class="dTitulo">Fecha</div><div class="dFiltro"><input id="4" class="form-control celdaFiltro" type="text"></div></th>
         
           <th><div class="dTitulo">Estado</div><div class="dFiltro"><input id="5" class="form-control celdaFiltro" type="text"></div></th>
         
          <th><div class="dTitulo">Encargado </div><div class="dFiltro"><input id="6" class="form-control celdaFiltro" type="text"></div></th>

          <th>
          <div class="dFiltro" style="display: block;"><input type="text" disabled="" class="form-control celdaFiltro"></div></th>
          </tr>
          </thead>
        </table>



        
		</div>
  	</div>
  </div>
  
</section>
    </body>
    </html>