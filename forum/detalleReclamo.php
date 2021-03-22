<style>
  
</style>
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
    <script src="../js/select2.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/ajax.js"></script>

<script type="text/javascript"> 

<?php $rec=$_POST['id'];?>

$(document).ready(function(){
//////////////////////////////////////////
$('section.awSlider .carousel').carousel({
	pause: "hover",
  //interval: 2000
});

var startImage = $('section.awSlider .item.active > img').attr('src');
$('section.awSlider').append('<img src="' + startImage + '">');

$('section.awSlider .carousel').on('slid.bs.carousel', function () {
 var bscn = $(this).find('.item.active > img').attr('src');
	$('section.awSlider > img').attr('src',bscn);
});


/* 
Philips ambilight tv
Üzerine gleince duruyor slide
*/

  //////////////////////////////////////  
    var reclamo= <?php echo $_POST['CodigoReclamo'];?>;


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
                    { data: "nombreUsuario", sTitle:"Usuario"}, 
                    { data: "respuesta",sTitle:"Respuesta"},
                    { data: null, sTitle:"Imagen"},
                    { data: null, sTitle:"Acciones"}
                    
                  ], 
                  //aqui agrego una columna;
                  //con el primer targets le digo cual columna quiero que se vea.
                  //con el segundo target le digo en donde van a estar los botones
                  columnDefs: [
                    { targets: [0,1], visible: false },
                      { targets: 5, width: 30, orderable: false, searchable: false, 
                      render: function (data, type, row) {
                      data="";
                      data+='<span class="accion modificSuc" title="Configuración de seciones" width="30" height="30" border="0" style="pading:1px"><input type="image" src="../img/editar.png"></span> <span &nbsp; class="accion delSucursal" title="Configuración de seciones" width="30" height="30" border="1" pading:1px><input type="image" src="../img/del.png"></span>';
                      return data;}},
                      {targets: 4, render: function (data, type, row) {
                      data="";
                      data+=
                      
                      '<span class="accion verImagen"><input type="image" alt="" style="max-height:400px;max-width:500px;" src="' + row.urlImagen + '" ></span>'
                      
                    
                      return data;}}
                  ],
                  
                    
            });
              
            $( "#tabla tbody" ).on( "click", ".verImagen", function() {
              var item = $("#tabla").DataTable().row( $(this).parents('tr') ).data();
              $('#imgModal').modal('show');
              document.getElementById("ImagenVer").src = item['urlImagen'];
		        
            });

            function cambiarImagenJS(){

              document.getElementById("img1").src="image2.jpg";
            
            }
    
})



</script>
    

</head>
<body>

<!--////////////////////////  MODAL PARA VER EIMAGENES DE COMENTARIOS /////////////////////////////-->
<div id="imgModal" class="modal fade bd-example-modal-lg" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
        <img style="max-height:1280px;max-width:1024px;" id="ImagenVer">
  </div>
</div>
   

    <!--///////////////////////////////////////////////////////////////////////-->
        <div id="content">

              <div class="row">
                  <div class="col-lg-1 col-sm-1"></div>
                    <div class="col-md-10">
                      <h1 style="color:#000">Este es el titulo del problema</h1>
                        <h3> <span style="color:#000">Estado:<span style="color:#01e524">OK</span></span></h3>
                          <h5><span style="color:#000">FALOPA<span style="color:#01e524"> 2020-03-15</span></span></h5> 
                           
                         
                            <br>
                            <p style="color:#000">Este es el probmea y como no se que mas agregar lo dejamos de esta manera, pero recordar que siempre es necesario revisar este tipo de cosas para evitar problemas futuros de cualquier indole</p>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////-->



<div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img id="img1" class="d-block w-100" src="../img/PP646-1.jpg" alt="First slide">
    </div>
    <div class="item">
      <img id="img2" class="d-block w-100" src="../img/PP723-1.jpg" alt="Second slide">
    </div>
    <div id="img3" class="item">
      <img class="d-block w-100" src="..." alt="...">
    </div>
  </div>
  <a class="left carousel-control" href=".carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href=".carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                            <!--
                           <img id="imagen1" src='../img/PP723-1.jpg'  width="800" height="500">
                            <br>
                            <img id="imagen2" src='../img/PP723-1.jpg'  width="800" height="500">
                            <br>
                            <img id="imagen3" src='../img/PP723-1.jpg'  width="800" height="500"></img>
                            <br>
                            <img id="imagen4" ></img>
                            <br>
                               -->
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
                <button id='responder'>Responder</button>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <button id='responder'>Responder</button>
            </div>


        </div><!-- content -->
    </div><!-- wrapper -->
    <!--<div id="footer">Created for Nettuts+</div>-->
    </body>
    </html>