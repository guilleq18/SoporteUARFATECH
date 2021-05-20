<style>

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="css2/bootstrap.min.css">
    <link rel="stylesheet" href="css2/bootstrap.css">
    <link rel="stylesheet" href="css2/login.css">  
    <link rel="stylesheet" href="css2/jquery.dataTables.min.css">
      <link rel="stylesheet" href="css2/select2.min.css">
      <link rel="stylesheet" href="css2/table.css">
      <link rel="stylesheet" href="css2/prop.css">


    <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/select2.min.js"></script>
      <script src="js/ajax.js"></script>
      <script src="js/validar.js"></script>
      
      
      
    <title>Soporte UARFATECH</title>

<script type="text/javascript">
    $(document).ready(function(){

        $("#regModalUsuario").click(function(e){
            
            $('#regUsuario').modal('show');
            
              
        });
        /*$("#usuarioReg").click(function(e){
            
           


           // if(pass==pass1){
                
                if($("#nombre").val()==='' || $("#apellido").val()==='' || $("#nombreUsuario").val()==='' || $("#pass").val()==='' || $("#pass1").val()===''){
                    alert('¡Ningun Campo Debe estar Vacio, Complete para continuar!')
                }else{ 
                $('#regUsuario').modal('hide');
                registrarUsuario($("#nombre").val(), $("#apellido").val(), $("#nombreUsuario").val(), $("#pass").val(),$("#pass1").val());
                }
            /*}else{
                alert('Las contraseñas no coinciden')
            }
            
                       
                      
            
              
        });*/


        $("#usuarioReg").click(function(e){
              
            
            if($("#contraseña").val()===$("#contraseñas").val()){ 
                if($("#nombre").val()==='' || $("#apellido").val()==='' || $("#nombreUsuario").val()==='' || $("#contraseñas").val()==='' || $("#contraseña").val()===''){        
                    alert('se deben completar todos los campos')
                    
                }else{
                    $("#regUsuario").modal('hide');//ocultamos el modal
                
                    registrarUsuario($("#nombre").val(), $("#apellido").val(), $("#nombreUsuario").val(), 
                    $("#contraseña").val());
                
                }
            }else{
                    alert('¡las contraseñas deben ser identicas!');
            }
       });
        
})



    
</script>

</head>
<body>
    


<!--****************************************FORMULARIO********************************************** -->
<div class="container">
<br><p class="text-center">SI-REG</p>
<hr>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card" >
<header class="card-header">
	<a id="regModalUsuario" class="float-right btn btn-outline-success mt-1">Registrarse</a>
	<h4 class="card-title mt-2 ">Iniciar Sesión</h4>
</header>
<article class="card-body" >
<form action="php/usuarios.php" method="POST">
	
	<div class=" form-group">
			<label>Usuario </label>   
		  	<input type="text" class="form-control" placeholder="" name="dni" id="dni">
	</div> 
		
		<label>Contraseña</label>
		<input type="password" class="form-control" placeholder="" name="pass" id="pass">
   </div> 
   <br> 
    <div class="form-group">
        <button style="background:#006a72;" type="submit" class="btn btn-success btn-block"> Entrar  </button>
    </div>      
    <small class="text-muted">Completa los datos y pulsa "entrar" para acceder al sistema.</small>                                          
</form>
</article> 
<div class="border-top card-body text-center">Olvidaste tu contraseña? <a href="rest_contrasena.php">Reestablecer Contraseña!</a></div>
</div> 
</div> 

</div> 
<li>

<li>

<!--  AGREGAR CLIENTE-->
    <div class="modal fade" id="regUsuario" tabindex="-1" role="dialog"  enctype="multipart/form-data" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h3>
                </div>
                    <div class="modal-body"> 
                        <div class="card">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Nombre </label>   
                                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                                </div> 
                                <div class="col form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                                </div> 
                            </div> 
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Nombre Usuario </label>   
                                    <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
                                </div> 
                            </div> 
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Contraseña </label>   
                                    <input type="password" class="form-control" name="nombreUsuario" id="contraseña" required>
                                </div> 
                                <div class="col form-group">
                                    <label>Repita la Contraseña</label>
                                    <input type="password" class="form-control" name="nombreUsuario" id="contraseñas" required>
                                </div> 
                            </div>
                        </div>
                    </div>
           
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <p style="margin: 10px 0px;"><button class="btn btn-lg btn-primary" id="usuarioReg">Registrar</button></p>
                </div>
              </div>
            </div>
          </div>



    
</body>
</html>
