<!DOCTYPE html PUBLIC "FORO">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>forum</title>
    <link rel="stylesheet" href="foter.css" type="text/css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/ajax.js"></script>

<script type="text/javascript"> 

$(document).ready(function(){

   
   //Codigo para obtener el id de una celda presionada del datatable
    $('#table').on('click', 'tbody tr', function () {
        var taibol = $('#table').DataTable();
        var item = taibol.row(this).data();
        var id = item['CodigoCaso'];

      //var item = $("#table").DataTable().row( $(this).parents('tr') ).data();
			var form = document.createElement("form");
			form.setAttribute('method',"post");
			form.setAttribute('action',"/forum/detalleReclamo.php");
			var codigoProveedor = document.createElement("input"); 
			codigoProveedor.setAttribute('type',"hidden");
			codigoProveedor.setAttribute('name',"CodigoReclamo");
			codigoProveedor.setAttribute('value',id);
			form.appendChild(codigoProveedor);
			document.getElementsByTagName('body')[0].appendChild(form);
			form.submit()
 

    
    });

    
    $("#table").DataTable( {
                  
                  language: {
                    url: './js/Spanish.json',
                    buttons: {pageLength: { _: "Mostrar %d filas"}}
                  },
                  
                  ajax: {
                    url: "/php/controller.php",
                    type: "POST",
                    data: {tipo: "traerReclamos"},
                    dataSrc: ""
                  },
                  destroy: true,
                  columns: [
                    { data: "CodigoCaso", sTitle:"CodCaso"},
                    { data: "CodigoCadena"},
                    { data: "nombre", sTitle:"Cadena"},
                    { data: "tipoCaso", sTitle:"Tipo Caso"},
                    { data: "FechaCaso", sTitle:"Fecha"},
                    { data: "estado", sTitle:"Estado"},
                    { data: null, sTitle:"Acciones"},
                    
                  ], 
                  //aqui agrego una columna;
                  //con el primer targets le digo cual columna quiero que se vea.
                  //con el segundo target le digo en donde van a estar los botones
                  columnDefs: [
                    { targets: [1], visible: false },
                            { targets: 6, width: 30, orderable: false, searchable: false, 
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
<h1>My forum</h1>
    <div id="wrapper">
    <div id="menu">
        <a class="item" href="/forum/index.php">Home</a> -
        <a class="item" href="/forum/create_topic.php">Create a topic</a> -
        <a class="item" href="/forum/create_cat.php">Create a category</a>
         
        <div id="userbar">
        <div id="userbar">Hello Example. Not you? Log out.</div>
    </div>
        <div id="content">
            <!--datatable-->
            <div class="row" style="margin-bottom: 20px;">
		        <div class="col-lg-1 col-sm-1"></div>
		            <div class="col-md-10">
	  	    	        <table border='1'; id="table" class="table table-bordered"></table>
		            </div>
  	            </div>
            </div>
        </div><!-- content -->
    </div><!-- wrapper -->
    <!--<div id="footer">Created for Nettuts+</div>-->
    </body>
    </html>