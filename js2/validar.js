
function validarCliente(){

    var tipoCliente, nombre, numeroDocumento, telefono, email, direccion, ciudad, expresion;
    tipoCliente=document.getElementById("tipoCliente").value;
    nombre=document.getElementById("nombre").value;
    numeroDocumento=document.getElementById("numeroDocumento").value;
    telefono=document.getElementById("telefono").value;
    email=document.getElementById("email").value;
    direccion=document.getElementById("direccion").value;
    ciudad=document.getElementById("ciudad").value;

    //expresiones regulares para evaluar lo ingresado en email
    expresion=/\w+@\w+\.+[a-z]/; 


    if(tipoCliente==""){
        alert("Campo 'Tipo de Cliente' Esta Vacio");
        return false;
    }else if(nombre=="" || nombre.length>40){
        alert("Campo 'Nombre' Esta Vacio o es Muy Largo");
        return false;
    }else if(numeroDocumento==""){
        alert("Campo 'DNI/CUIT' Esta Vacio");
        return false;
    }else if(numeroDocumento.length<8 || numeroDocumento.length>14){
        alert("Campo 'DNI/CUIT' Invalido");
        return false;
    }else if(isNaN(numeroDocumento)){
        alert("Campo 'DNI/CUIT' Contiene Caracteres Invalidos");
        return false;
    }else if(telefono=="" || telefono.length>20){
        alert("Campo 'Telefono' Esta Vacio o es Muy Largo");
        return false;
    }else if (isNaN(telefono)){
        alert("Campo 'Telefono' Contiene Caracteres Invalidos");
        return false;
    }else if(email=="" || email.length>50){
        alert("Campo 'E-Mail' Esta Vacio o es Muy Largo");
        return false;
    }else if(expresion.test(email)){
        alert("Campo 'E-Mail' Es Invalido");
        return false;
    }else if(direccion=="" || direccion.length>50){
        alert("Campo 'Direccion' Esta Vacio o es Muy Largo");
        return false;
    }else if (ciudad=="" || ciudad.length>25){
        alert("Campo 'Ciudad' Esta Vacio o es Muy Largo");
        return false;
    }

}
function validarClienteModificar(){

    var tipoCliente, nombre, numeroDocumento, telefono, email, direccion, ciudad, expresion;
    tipoCliente=document.getElementById("tipoCliente").value;
    nombre=document.getElementById("nombre").value;
    numeroDocumento=document.getElementById("numeroDocumento").value;
    telefono=document.getElementById("telefono").value;
    email=document.getElementById("email").value;
    direccion=document.getElementById("direccion").value;
    ciudad=document.getElementById("ciudad").value;

    //expresiones regulares para evaluar lo ingresado en email
    expresion=/\w+@\w+\.+[a-z]/; 


    if(tipoCliente==""){
        alert("Campo 'Tipo de Cliente' Esta Vacio");
        return false;
    }else if(nombre=="" || nombre.length>40){
        alert("Campo 'Nombre' Esta Vacio o es Muy Largo");
        return false;
    }else if(numeroDocumento==""){
        alert("Campo 'DNI/CUIT' Esta Vacio");
        return false;
    }else if(numeroDocumento.length<8 || numeroDocumento.length>14){
        alert("Campo 'DNI/CUIT' Invalido");
        return false;
    }else if(isNaN(numeroDocumento)){
        alert("Campo 'DNI/CUIT' Contiene Caracteres Invalidos");
        return false;
    }else if(telefono=="" || telefono.length>20){
        alert("Campo 'Telefono' Esta Vacio o es Muy Largo");
        return false;
    }else if (isNaN(telefono)){
        alert("Campo 'Telefono' Contiene Caracteres Invalidos");
        return false;
    }else if(email=="" || email.length>50){
        alert("Campo 'E-Mail' Esta Vacio o es Muy Largo");
        return false;
    }else if(expresion.test(email)){
        alert("Campo 'E-Mail' Es Invalido");
        return false;
    }else if(direccion=="" || direccion.length>50){
        alert("Campo 'Direccion' Esta Vacio o es Muy Largo");
        return false;
    }else if (ciudad=="" || ciudad.length>25){
        alert("Campo 'Ciudad' Esta Vacio o es Muy Largo");
        return false;
    }
    

}
function validarTrabajo(){

    var cliente, tipoTrabajo, nombre, descripcion, fechaInicial, referente, telReferente, puestoreferente, importe;
    cliente=document.getElementById("select_clientes").value;
    tipoTrabajo=document.getElementById("select_tipo_trabajo").value;
    nombre=document.getElementById("nombre_corto").value;
    descripcion=document.getElementById("descripcion").value;
    fechaInicial=document.getElementById("fecha_inicio").value;
    referente=document.getElementById("referente").value;
    telReferente=document.getElementById("telefono_referente").value;
    puestoreferente=document.getElementById("puesto_referente").value;
    importe=document.getElementById("importe").value;

    if(cliente==""){
        alert("Campo 'Cliente' Esta Vacio");
        return false;
    }else if(tipoTrabajo=="" ){
        alert("Campo 'Tipo de Trabajo' Esta Vacio");
        return false;
    }else if(nombre=="" || nombre.length>30){
        alert("Campo 'Nombre Corto' Esta Vacio o Es Demasiado Largo");
        return false;
    }else if(descripcion=="" || descripcion.length>1000){
        alert("Campo 'Descripcion' Vacio o Demasiado Largo");
        return false;
    }else if(fechaInicial==""){ 
        alert("Campo 'Fecha Inicial' Vacio");
        return false;
    
    }else if(referente.length>25){
        alert("Campo 'Referente' Es Demasiado Largo");
        return false;
    }else if (puestoreferente.length>25){
        alert("Campo 'Puesto del Referente 'es Demasiado Largo");
        return false;
    }else if(telReferente!="" ){
        
        if(isNaN(telReferente)){ 
            alert("Campo 'Telefono del Referente' Es Invalido");
            return false;
        }else if(telReferente.length>25) {
            alert("Campo 'Telefono del Referente' Es Demasiado Largo");
            return false;
        }
    }else if(importe!=""){
        if(importe.length>25){ 
            alert("Campo 'Importe' Es Demasiado largo");
            return false;
        }else if(isNaN(importe)){
            alert("Campo 'Importe' Es Invalido");
            return false;
        }
    }



}
function validarTrabajoMod(){

    var cliente, tipoTrabajo, nombre, descripcion, fechaInicial, referente, telReferente, puestoreferente, importe;
    cliente=document.getElementById("select_clientes").value;
    tipoTrabajo=document.getElementById("tipoTrabajoSelect").value;
    nombre=document.getElementById("nombre_corto").value;
    descripcion=document.getElementById("descripcion").value;
    fechaInicial=document.getElementById("fecha_inicio").value;
    referente=document.getElementById("referente").value;
    telReferente=document.getElementById("telefono_referente").value;
    puestoreferente=document.getElementById("puesto_referente").value;
    importe=document.getElementById("importe").value;

    if(cliente==""){
        alert("Campo 'Cliente' Esta Vacio");
        return false;
    }else if(tipoTrabajo=="" ){
        alert("Campo 'Tipo de Trabajo' Esta Vacio");
        return false;
    }else if(nombre=="" || nombre.length>30){
        alert("Campo 'Nombre Corto' Esta Vacio o Es Demasiado Largo");
        return false;
    }else if(descripcion=="" || descripcion.length>1000){
        alert("Campo 'Descripcion' Vacio o Demasiado Largo");
        return false;
    }else if(fechaInicial==""){ 
        alert("Campo 'Fecha Inicial' Vacio");
        return false;
    
    }else if(referente.length>25){
        alert("Campo 'Referente' Es Demasiado Largo");
        return false;
    }else if (puestoreferente.length>25){
        alert("Campo 'Puesto del Referente 'es Demasiado Largo");
        return false;
    }else if(telReferente!="" ){
        
        if(isNaN(telReferente)){ 
            alert("Campo 'Telefono del Referente' Es Invalido");
            return false;
        }else if(telReferente.length>25) {
            alert("Campo 'Telefono del Referente' Es Demasiado Largo");
            return false;
        }
    }else if(importe!=""){
        if(importe.length>25){ 
            alert("Campo 'Importe' Es Demasiado largo");
            return false;
        }else if(isNaN(importe)){
            alert("Campo 'Importe' Es Invalido");
            return false;
        }
    }



}
function validarGasto(){

    let  tipoGasto, alias, descripcion, fecha, importe;
    tipoGasto=document.getElementById("tipoGasto").value;
    alias=document.getElementById("alias").value;
    descripcion=document.getElementById("descripcion").value;
    fecha=document.getElementById("fecha").value;
    importe=document.getElementById("importe").value;

    if(tipoGasto==""){
        alert("Campo 'Tipo de Gasto' Esta Vacio");
        return false;
    }else if(alias=="" ||alias.length>50 ){
        alert("Campo 'Alias' Esta Vacio o es Demasiado Largo");
        return false;
    }else if(descripcion=="" || descripcion.length>1000){
        alert("Campo 'Descripcion' Vacio o Demasiado Largo");
        return false;
    }else if(fecha==""){ 
        alert("Campo 'Fecha' Esta Vacio");
        return false;
    }else if(importe.length>25 || importe==""){ 
        alert("Campo 'Importe' Esta Vacio o Es Demasiado largo");
        return false;
    }
}
function validarGastoMod(){

    let  tipoGasto, alias, descripcion, fecha, importe;
    tipoGasto=document.getElementById("tipoGasto").value;
    alias=document.getElementById("alias").value;
    descripcion=document.getElementById("descripcion").value;
    fecha=document.getElementById("fecha").value;
    importe=document.getElementById("importe").value;

    if(tipoGasto==""){
        alert("Campo 'Tipo de Gasto' Esta Vacio");
        return false;
    }else if(alias=="" ||alias.length>50 ){
        alert("Campo 'Alias' Esta Vacio o es Demasiado Largo");
        return false;
    }else if(descripcion=="" || descripcion.length>1000){
        alert("Campo 'Descripcion' Vacio o Demasiado Largo");
        return false;
    }else if(fecha==""){ 
        alert("Campo 'Fecha' Esta Vacio");
        return false;
    }else if(importe.length>25 || importe==""){ 
        alert("Campo 'Importe' Esta Vacio o Es Demasiado largo");
        return false;
    }
}