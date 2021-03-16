<!DOCTYPE html PUBLIC "FORO">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>forum</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/ajax.js"></script>

<script type="text/javascript"> 

<?php $rec=$_POST['id'];?>

$(document).ready(function(){


    
    var reclamo= <?php echo $_POST['CodigoReclamo'];?>;
    //alert(reclamo);

    $("#tabla").DataTable( {
                  
                  language: {
                    url: './js/Spanish.json',
                    buttons: {pageLength: { _: "Mostrar %d filas"}}
                  },
                  
                  ajax: {
                    url: "/php/controller.php",
                    type: "POST",
                    data: {tipo: "traerReclamosDetalle",reclamo:reclamo},
                    dataSrc: ""
                  },
                  destroy: true,
                  columns: [
                    { data: "codigoDiscusion"},
                    { data: "usuarioRespuesta", sTitle:"Usuario"},
                    { data: "respuesta",sTitle:"Respuesta"},
                    { data: "urlImagen", sTitle:"Imagen"},
                   
                    { data: null, sTitle:"Acciones"},
                    
                  ], 
                  //aqui agrego una columna;
                  //con el primer targets le digo cual columna quiero que se vea.
                  //con el segundo target le digo en donde van a estar los botones
                  columnDefs: [
                    { targets: [0], visible: false },
                            { targets: 4, width: 30, orderable: false, searchable: false, 
                      render: function (data, type, row) {
                      data="";
                      data+='<span class="accion modificSuc" title="Configuración de seciones" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/editar.png"></span> <span &nbsp; class="accion delSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="../img/del.png"></span>';
                      return data;}}
                            
                  ],
                  
                    
            });

})



</script>


</head>
<body>

    
        <div id="content">

              <div class="row">
                  <div class="col-lg-1 col-sm-1"></div>
                    <div class="col-md-10">
                      <h1 style="color:#000">Este es el titulo del problema</h1>
                        <h3> <span style="color:#000">Estado:<span style="color:#01e524">OK</span></span></h3>
                          <h5><span style="color:#000">FALOPA<span style="color:#01e524"> 2020-03-15</span></span></h5> 
                           
                         
                            <br>
                            <p style="color:#000">Este es el probmea y como no se que mas agregar lo dejamos de esta manera, pero recordar que siempre es necesario revisar este tipo de cosas para evitar problemas futuros de cualquier indole</p>

                           <img id="imagen1" src='../img/PP723-1.jpg'  width="800" height="500">
                            <br>
                            <img id="imagen2" src='../img/PP723-1.jpg'  width="800" height="500">
                            <br>
                            <img id="imagen3" src='../img/PP723-1.jpg'  width="800" height="500"></img>
                            <br>
                            <img id="imagen4" ></img>
                            <br>
                          
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
        </div><!-- content -->
    </div><!-- wrapper -->
    <!--<div id="footer">Created for Nettuts+</div>-->
    </body>
    </html>