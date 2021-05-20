





<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSU</title>
     <!--librerias-->
	 <?php
		//include 'scripts.php';
	?>

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


		$("#regCadena").click(function(e){
              
            registrarUsuarioUT($("#cadenaNombre").val(), $("#select_provincias").val(),$("#cadenaNombre").val(),$("#cadenaNombre").val());
            
        });
	  
	  </script>
</header>




<div class="container">
<br>  <p class="text-center">My Vet Animalia </p>
<hr>
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

</article> 
<div class="border-top card-body text-center">Ya tienes una cuenta? <a href="index.php">Inicia Sesión</a></div>
</div>
</div>

</div> 


</div> 


