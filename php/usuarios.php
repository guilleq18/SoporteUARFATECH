<?php
header('Content-Type: text/html; charset=utf-8');
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once('modelo/modelo.php');

//ENCRIPTAR
function encrypt($string, $key) {
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
	   $char = substr($string, $i, 1);
	   $keychar = substr($key, ($i % strlen($key))-1, 1);
	   $char = chr(ord($char)+ord($keychar));
	   $result.=$char;
	}
	return base64_encode($result);
 }
//FIN ENCRIPTAR


$usuario=new Modelo();
$registros['usuario']=$_POST['dni'];
$registros['pass']=encrypt($_POST['pass'],'SHA');
$result = $usuario->traerUsuario($registros);
if(isset($result)){
	$result=$result[0];
	echo $result['codigoUsuario'];
	session_start();
	$_SESSION['codigoUsuario'] = $result['codigoUsuario'];
	$_SESSION['usuario'] = $result['nombreUsuario'];
	$_SESSION['rol'] = $result['rol'];
	$_SESSION['nombre'] = $result['nombre'];
	header("Location: ../");
}else{
	header("Location: ../login.php");
}
?>

