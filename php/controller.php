
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
if($tipo=='selectClientes'){
		$result = $modelo->traerClienteSelect();
		if(isset($result)){
			echo $result;
		}
	}
if($tipo=='selectModTrabajos'){

		$registros['codigo'] =$_POST['codigo'];
		$result = $modelo->traerClienteSelectMod($registros);
		echo $result;

		
}
	
if($tipo=='agregarC')
	{
		$dni=$_POST['numeroDocumento'];
		$resultComparacion = $modelo->consultaRegistros($dni);
		//decodifico el json que devuelve consultaRegistros()
		$array = json_decode($resultComparacion);
		//pregunto si lo que devolvio es igual al dato que estoy mandando
		if($array[0]->numeroDocumento==$dni)
		{
		//de serlo significa que ya existe un registro con ese numero de documento
		$array=new stdClass;
			$array->estado="NO";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;

					
		}else { 
			//de no existir procedo a crear el registro solicitado
			$registros['tipoCliente']=$_POST['tipoCliente'];
			$registros['nombre']=$_POST['nombre'];
			$registros['numeroDocumento']=$_POST['numeroDocumento'];
			$registros['telefono']=$_POST['telefono'];
			$registros['email']=$_POST['email'];
			$registros['direccion']=$_POST['direccion'];
			$registros['ciudad']=$_POST['ciudad'];
			
			$result = $modelo->agregarCliente($registros);		
			//genero la bandera para que si se ejecuta el script de arriba se envie la validacion
			$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
			
			

		}
	}	

if($tipo=="agregarTrabajo"){
	$registros['codigoCliente']=$_POST['codigoCliente'];
	$registros['tipoTrabajo']=$_POST['tipoTrabajo'];
	$registros['nombreCorto']=$_POST['nombreCorto'];
	$registros['descripcion']=$_POST['descripcion'];
	$registros['fechaInicio']=$_POST['fechaInicio'];
	$registros['fechaEntrega']=$_POST['fechaEntrega'];
	$registros['referente']=$_POST['referente'];
	$registros['telefonoReferente']=$_POST['telefonoReferente'];
	$registros['puestoEmpresa']=$_POST['puestoEmpresa'];
	$registros['importe']=$_POST['importe'];
	$result = $modelo->agregarTrabajo($registros);
	//pregunto si el registro fue agregado
	if(isset($result)){
		$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
	}


}
if($tipo=="agregarGasto")
{
	$registros['tipoGasto']=$_POST['tipoGasto'];
	$registros['alias']=$_POST['alias'];
	$registros['descripcion']=$_POST['descripcion'];
	$registros['fecha']=$_POST['fecha'];
	$registros['importe']=$_POST['importe'];
	
	$result = $modelo->agregarGasto($registros);
	//pregunto si el registro fue agregado
	if(isset($result)){
		$array=new stdClass;
			$array->estado="OK";
			$json=json_encode($array, JSON_FORCE_OBJECT);
			echo $json;
	}


}
if($tipo=="detalleCliente")
{
	$registros['codigoCliente']=$_POST['codigoCliente'];
	
	$result = $modelo->detalleCliente($registros);
	if(isset($result)){
		echo $result;
	}
	

}
if($tipo=="modCliente")
{
			$registros['codigoCliente']=$_POST['codigoCliente'];
			$registros['tipoCliente']=$_POST['tipoCliente'];
			$registros['nombre']=$_POST['nombre'];
			$registros['numeroDocumento']=$_POST['numeroDocumento'];
			$registros['telefono']=$_POST['telefono'];
			$registros['email']=$_POST['email'];
			$registros['direccion']=$_POST['direccion'];
			$registros['ciudad']=$_POST['ciudad'];
			
			$result = $modelo->modCliente($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="bajaCliente")
{
			$registros['codigoCliente']=$_POST['codigoCliente'];
			
			
			$result = $modelo->bajaCliente($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="detalleTrabajo")
{
	$registros['codigoTrabajo']=$_POST['codigoTrabajo'];
	
	$result = $modelo->detalleTrabajo($registros);
	if(isset($result)){
		echo $result;
	}
	

}
if($tipo=="modTrabajo")
{
			$registros['codigoTrabajo']=$_POST['codigoTrabajo'];
			$registros['cliente']=$_POST['select_clientes'];
			$registros['nombre']=$_POST['nombre_corto'];
			$registros['descripcion']=$_POST['descripcion'];
			$registros['fechaInicio']=$_POST['fecha_inicio'];
			$registros['fechaEntrega']=$_POST['fecha_entrega'];
			$registros['importe']=$_POST['importe'];
			$registros['referente']=$_POST['referente'];
			$registros['telReferente']=$_POST['telefono_referente'];
			$registros['puestoReferente']=$_POST['puesto_referente'];
			$registros['tipoTrabajo']=$_POST['select_tipo_trabajo'];
			
			$result = $modelo->modTrabajo($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="bajaTrabajo")
{
			$registros['codigoTrabajo']=$_POST['codigoTrabajo'];
			
			
			$result = $modelo->bajaTrabajo($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="detalleGasto")
{
	$registros['codigoGasto']=$_POST['codigoGasto'];
	
	$result = $modelo->detalleGasto($registros);
	if(isset($result)){
		echo $result;
	}
	

}
if($tipo=="modGasto")
{			$registros['codigoGasto']=$_POST['codigoGasto'];
			$registros['tipoGasto']=$_POST['tipoGasto'];
			$registros['alias']=$_POST['alias'];
			$registros['descripcion']=$_POST['descripcion'];
			$registros['fecha']=$_POST['fecha'];
			$registros['importe']=$_POST['importe'];
			
			
			$result = $modelo->modGasto($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}
if($tipo=="bajaGasto")
{
			$registros['codigoGasto']=$_POST['codigoGasto'];
			
			
			$result = $modelo->bajaGasto($registros);		
			if(isset($result)){
				$array=new stdClass;
					$array->estado="OK";
					$json=json_encode($array, JSON_FORCE_OBJECT);
					echo $json;
			}
	

}