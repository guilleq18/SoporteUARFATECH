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
    

    
    $("#table").DataTable( {
                  
                  language: {
                    url: './js/Spanish.json',
                    //buttons: {pageLength: { _: "Mostrar %d filas"}}
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
                    { data: "hora"},
                    { data: "fechaReclamo"},
                    { data: "reclamo"},
                    { data: "usuarioReclamo"},
                    { data: "descripcion"},
                    { data: "respuesta"},
                    { data: "estado"},
                    { data: "nombreUsuario"},
                    { data: "codigoSucursal"},
                    { data: null, sTitle:"Acciones"}
                    
                  ], 
                  //aqui agrego una columna;
                  //con el primer targets le digo cual columna quiero que se vea.
                  //con el segundo target le digo en donde van a estar los botones
                  columnDefs: [
                    { targets: [10], visible: false },
                    { targets: 6, width: 150, orderable: false, searchable: false, render: function (data, type, row) {
                      data='<textarea disabled  rows="2">'+row.descripcion+'</textarea>';
                      
                      return data;}},
                      { targets: 7, width: 150, orderable: false, searchable: false, render: function (data, type, row) {
                      data='<textarea disabled  rows="2">'+row.respuesta+'</textarea>';
                      
                      return data;}},
                    { targets: 11, width: 30, orderable: false, searchable: false, render: function (data, type, row) {
                      data="";
                      data+='<span class="accion modificSuc" title="Configuración de seciones" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/editar.png"></span> <span &nbsp; class="accion delSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="../img/del.png"></span>';
                      return data;}}
                            
                  ],
                  dom: 'Bfrtip',
		              pageLength: 50,
                  initComplete: function () {
		
                        $("#table").DataTable().column(9).visible(true);
                        $("#table").DataTable().columns.adjust().draw();
            
                        $('#table thead .trFiltros th').each(function(index) {
                        $($('#table thead .trFiltros th')[index]).css('width', $('#table thead .trFiltros th')[index].clientWidth);
                        $($('#table thead .trFiltros .dFiltro')[index]).css('display', 'block');
                        });
                        $('#tabla_filter').css('height', '45px');
                        $('#tabla_filter label').css('margin-top', '11px');
                  }
              });
                        $(".trFiltros .dFiltro").click(function(e) {
                          e.stopPropagation();
                        });
                        $('#table .celdaFiltro').on( 'keyup change', function ()	{   
                          var i =$(this).attr('id');  
                          var v =$(this).val();  
                          $("#table").DataTable().columns(i).search(v).draw();
                        
	                      });
       



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
                if (response !="File not uploaded") {
                      document.getElementById("uploadedfile").value = "";
                      var usuarioUt=1;
                       $("#reclamoReg").modal('hide');//ocultamos el modal
                       registrarProblema($("#select_Empresa").val(), usuarioUt, $("#select_Sucursal").val(), $("#select_Motivo").val(), $("#fecha").val(), $("#time").val(), $("#descripcion").val(), $("#Respuesta").val(), $("#select_Estado").val(), $("#usuarioR").val(), response);
                       $("#table").DataTable().ajax.reload(); 
                } else {
                    alert('captura no cargada');
                }
            }
        });
         
    });
   
})



</script>


</head>
<body>

 <!-- Modal agregar Cadena--> 
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
                                  <h3 class="control-label">Motivo</h3>
                                    <select class="form-control" name="selectMotivo" id="select_Motivo"   required>
                                     <option value="1">Capacitacion</option>
                                     <option value="2">Duda</option>
                                     <option value="3">Error</option>
                                     <option value="4">Configuracion</option>
                                     <option value="5">Replicacion</option>
                                     <option value="6">Operativo</option>
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
                                  <h3 class="control-label">Motivo</h3>
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
    <button type="button" class="" data-toggle="modal" data-target="#reclamoReg">
      Agregar Reclamo
    </button>
    </div>
		<div class="col-lg-1 col-md-1"></div>
	</div>
<!--datatable-->
    <div class="row" style="margin-bottom: 20px;">
		<div class="col-lg-1 col-sm-1"></div>
		<div class="col-md-10">
	  		<table id="table" class="table table-bordered">
        <thead>
        <tr 
        class="trFiltros">
          <th><div class="dTitulo">Cod. Reclamo</div><div class="dFiltro"><input id="0" class="form-control celdaFiltro" type="text"></div></th>
        
          <th><div class="dTitulo">Sucursal</div><div class="dFiltro"  style="display: block;"><input id="1" class="form-control celdaFiltro" type="text"></div></th>
          
          <th><div class="dTitulo">Hora</div><div class="dFiltro"><input id="2" class="form-control celdaFiltro" type="text"></div></th>
          
          <th><div class="dTitulo">Fecha Reclamo</div><div class="dFiltro"><input id="3" class="form-control celdaFiltro" type="text"></div></th>
          
          <th><div class="dTitulo">Reclamo</div><div class="dFiltro"><input id="4" class="form-control celdaFiltro" type="text"></div></th>
          <th><div class="dTitulo">Usuario</div><div class="dFiltro"><input id="5" class="form-control celdaFiltro" type="text"></div></th>
          <th><div class="dTitulo">Descripcion</div><div class="dFiltro"><input id="6" class="form-control celdaFiltro" type="text"></div></th>
          <th><div class="dTitulo">Respuesta</div><div class="dFiltro"><input id="7" class="form-control celdaFiltro" type="text"></div></th>
          <th><div class="dTitulo">Estado</div><div class="dFiltro"><input id="8" class="form-control celdaFiltro" type="text"></div></th>
          <th><div class="dTitulo">Encargado UT</div><div class="dFiltro"><input id="9" class="form-control celdaFiltro" type="text"></div></th>
          
          <th></th><th><div class="dFiltro" style="display: block;"><input type="text" disabled="" class="form-control celdaFiltro"></div></th>
          </tr>
          </thead>
        </table>



        
		</div>
  	</div>
  </div>
  
</section>
    </body>
    </html>