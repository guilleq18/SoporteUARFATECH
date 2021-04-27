
<?php
header('Content-Type: text/html; charset=utf-8');

require_once('modelo/modelo.php');
$modelo=new Modelo();


$tipo=$_POST['tipo'];

if ($tipo=='traerCadenas'){

		$result = $modelo->traerCadenas();
		echo $result;
	
	}
if ($tipo=='traerSucursales'){

		$registros['id']=$_POST['idCadena'];
		$result = $modelo->traerSucursales($registros);
	    echo $result;
	
}

if ($tipo=='traerReclamos'){

	$result = $modelo->traerReclamos();
	echo $result;

}
if ($tipo=='traerReclamosCab'){

	$result = $modelo->traerReclamosCab();
	echo $result;

}
if ($tipo=='traerReclamosDetalle'){
	$registros['reclamo']=$_POST['reclamo'];
	$result = $modelo->traerReclamosDetalle($registros);
	echo $result;

}

if ($tipo=='traerBalanceGasto'){

	$registros['fechaInicial']=$_POST['fechaInicial'];
	$registros['fechaFinal']=$_POST['fechaFinal'];
	$result = $modelo->traerBalanceGasto($registros);
	echo $result;

}
if($tipo=='selectProvincias'){
		$result = $modelo->traerProvinciasSelect();
		if(isset($result)){
			echo $result;
		}
	}
	
if($tipo=='selectEmpresa'){
		$result = $modelo->traerEmpresaSelect();
		if(isset($result)){
			echo $result;
		}
	}
if($tipo=='selectSucursal'){
		$registros['empresa']=$_POST['select_Empresa'];
		$result = $modelo->traerSucursalSelect($registros);
		if(isset($result)){
			echo $result;
		}
	}
if($tipo=='selectImagenes'){
	$result = $modelo->cambiarImagenJS();
	if(isset($result)){
		echo $result;
	}
}
if($tipo=='selectModTrabajos'){

		$registros['codigo'] =$_POST['codigo'];
		$result = $modelo->traerClienteSelectMod($registros);
		echo $result;

		
}
	
if($tipo=='registrarCadena')
	{
		
			$registros['cadenaNombre']=$_POST['cadenaNombre'];
			$registros['cadenaProvincia']=$_POST['select_provincias'];
			$result = $modelo->registrarCadena($registros);		
			$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
			
	}	
	if($tipo=='registrarSucursal')
	{
		
			$registros['idCadena']=$_POST['idCadenaSuc'];
			$registros['nombre']=$_POST['sucursalNombre'];
			$registros['roc']=$_POST['encargadoSuc'];
			$result = $modelo->registrarSucursal($registros);		
			$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
			
	}

if($tipo=="modCadena")
{
			$registros['codigoCadena']=$_POST['codigoCadena'];
			$registros['nombreCad']=$_POST['nombreCad'];
			$registros['provCadena']=$_POST['provCadena'];
			
			$result = $modelo->modCadena($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="modSucursal")
{
			$registros['codigoSucursal']=$_POST['codigoSucursal'];
			$registros['nombreSuc']=$_POST['nombreSuc'];
			$registros['responsableSuc']=$_POST['responsableSuc'];
			
			$result = $modelo->modSucursal($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="modEstado")
{
			$registros['codigoReclamo']=$_POST['codigoReclamo'];
			
			$result = $modelo->modEstado($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="deleteCadena")
{
			$registros['codigoCadena']=$_POST['codigoCadena'];
			
			
			$result = $modelo->deleteCadena($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="deleteReclamo")
{
			$registros['codigoReclamo']=$_POST['codigoReclamoDel'];
			
			
			$result = $modelo->deleteReclamo($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="registrarProblema")
{
	
	$registros['empresa']=$_POST['select_Empresa'];
	$registros['usuarioUt']=$_POST['usuarioUt'];
	$registros['sucursal']=$_POST['select_Sucursal'];
	$registros['motivo']=$_POST['select_Motivo'];
	$registros['fecha']=$_POST['fecha'];
	$registros['titulo']=$_POST['titulo'];
	$registros['time']=$_POST['time'];
	$registros['descripcion']=$_POST['descripcion'];
	$registros['Respuesta']=$_POST['Respuesta'];
	$registros['estado']=$_POST['select_Estado'];
	$registros['usuarioR']=$_POST['usuarioR'];
	$registros['imagen']=$_POST['response'];

	
	$result = $modelo->registrarProblema($registros);		
	if(isset($result)){
		$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
	}
	

}

