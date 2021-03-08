
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
if ($tipo=='traerBalanceGasto'){

	$registros['fechaInicial']=$_POST['fechaInicial'];
	$registros['fechaFinal']=$_POST['fechaFinal'];
	$result = $modelo->traerBalanceGasto($registros);
	echo $result;

}
if ($tipo=='colocarBalanceIngEg'){

	$registros['fechaInicial']=$_POST['fechaInicial'];
	$registros['fechaFinal']=$_POST['fechaFinal'];
	$result = $modelo->colocarBalanceIngEg($registros);
	echo $result;

}
if ($tipo=='colocarBalanceGeneral'){

	$registros['fechaInicial']=$_POST['fechaInicial'];
	$registros['fechaFinal']=$_POST['fechaFinal'];
	$result = $modelo->colocarBalanceGeneral($registros);
	echo $result;

}
if ($tipo=='traerTrabajos'){

		$result = $modelo->traerTrabajos();
		echo $result;
	
	}
if ($tipo=='traerGastos'){

		$result = $modelo->traerGastos();
		echo $result;
	
	}
if($tipo=='selectProvincias'){
		$result = $modelo->traerProvinciasSelect();
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
if($tipo=="deleteSucursal")
{
			$registros['codigoSucursal']=$_POST['codigoSucursal'];
			
			
			$result = $modelo->deleteSucursal($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}