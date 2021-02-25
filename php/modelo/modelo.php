<?php
error_reporting(0);
require_once('db.php');
class Modelo {
    //variable en donde guardo los datos de la conexion
    private $gestorBD;

    public function __construct() {
        //instancio los datos de la conexion en la variable gestorBD
        $this->gestorBD = new db;
    }

    //Traer Usuarios
    public function consultaRegistros ($dni){

        $sql="
        
        declare @dni nvarchar(20)='".$dni."';

        SELECT numeroDocumento FROM clientes where numeroDocumento=@dni;";

        $datos = $this->gestorBD->hacerConsulta($sql);
        
        return $datos;

    }



	

    //metodo que realiza la consulta de clientes
    public function traercadenas()
    {
        $sql = "SELECT * FROM CadenasCat; ";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    //llenar datatable de trabajos
    public function traerTrabajos()
    {
        $sql = "SELECT tr.codigoTrabajo, cl.nombre, tr.tipoTrabajo, tr.nombreCorto, tr.descripcion, tr.fechaInicio, case when cast(tr.fechaEntrega as nvarchar) <= '1900-01-01' then 'Pendiente' else cast(tr.fechaEntrega as nvarchar) end as fechaEntrega, tr.referente, tr.telefonoReferente, tr.puestoEmpresa, tr.importe FROM clientes cl INNER JOIN trabajos tr ON cl.codigoCliente=tr.codigoCliente";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    //llenar datatable de Gastos
    public function traerGastos()
    {
        $sql = "SELECT * FROM gastos";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    public function traerBalanceIngreso($registros)
    {
        $sql = "  
                DECLARE @fechaInicial date='".$registros['fechaInicial']."';
                DECLARE @fechaFinal date='".$registros['fechaFinal']."';
                
                SELECT tr.tipoTrabajo, sum(tr.importe) as importe FROM trabajos tr where fechaEntrega>=@fechaInicial and fechaEntrega<=@fechaFinal
                group by tr.tipoTrabajo
                order by tr.tipoTrabajo";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    public function traerBalanceGasto($registros)
    {
        $sql = "  
                DECLARE @fechaInicial date='".$registros['fechaInicial']."';
                DECLARE @fechaFinal date='".$registros['fechaFinal']."';
                
                SELECT gs.tipoGasto, sum(gs.importe) as importe FROM gastos gs
                where gs.fecha>=@fechaInicial and gs.fecha<=@fechaFinal
                group by gs.tipoGasto
                order by gs.tipoGasto";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    public function colocarBalanceIngEg($registros)
    {
        $sql = "  
                DECLARE @fechaInicial date='".$registros['fechaInicial']."';
                DECLARE @fechaFinal date='".$registros['fechaFinal']."';
                
                select importe from (select sum(importe) as importe,'0' as id from gastos
                where fecha>=@fechaInicial and fecha<=@fechaFinal
                union
                select  sum(importe)as importe,'1' as id from trabajos
                where fechaEntrega>=@fechaInicial and fechaEntrega<=@fechaFinal)as t
                order by id";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    public function colocarBalanceGeneral($registros)
    {
        $sql = "  
                DECLARE @fechaInicial date='".$registros['fechaInicial']."';
                DECLARE @fechaFinal date='".$registros['fechaFinal']."';
                DECLARE @contador as int;
                
                select @contador=sum(importe) from gastos
                where fecha>=@fechaInicial and fecha<=@fechaFinal
                
                select  sum(importe)-@contador as importe from trabajos
                where fechaEntrega>=@fechaInicial and fechaEntrega<=@fechaFinal";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }


    //insert de clientes
    public function agregarCliente($registros){
  
        $sql="           

            DECLARE @tipoCliente nvarchar(15)='".$registros['tipoCliente']."';
            DECLARE @nombre nvarchar(40)='".$registros['nombre']."';
            DECLARE @numeroDocumento nvarchar(20)='".$registros['numeroDocumento']."';
            DECLARE @telefono nvarchar(20)='".$registros['telefono']."';
            DECLARE @email nvarchar(50)='".$registros['email']."';
            DECLARE @direccion nvarchar(50)='".$registros['direccion']."';
            DECLARE @ciudad nvarchar(25)='".$registros['ciudad']."';
            
            INSERT INTO dbo.clientes (tipoCliente, nombre, numeroDocumento, telefono, email, direccion, ciudad,baja) VALUES(@tipoCliente, @nombre, @numeroDocumento, @telefono, @email, @direccion, @ciudad, 0);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function modCliente($registros){
  
        $sql="           
            DECLARE @codigoCliente int='".$registros['codigoCliente']. "';
            DECLARE @tipoCliente nvarchar(15)='".$registros['tipoCliente']."';
            DECLARE @nombre nvarchar(40)='".$registros['nombre']."';
            DECLARE @numeroDocumento nvarchar(20)='".$registros['numeroDocumento']."';
            DECLARE @telefono nvarchar(20)='".$registros['telefono']."';
            DECLARE @email nvarchar(50)='".$registros['email']."';
            DECLARE @direccion nvarchar(50)='".$registros['direccion']."';
            DECLARE @ciudad nvarchar(25)='".$registros['ciudad']."';
            
            UPDATE dbo.clientes SET tipoCliente=@tipoCliente, nombre=@nombre, numeroDocumento=@numeroDocumento, telefono=@telefono, email=@email, direccion=@direccion, ciudad=@ciudad WHERE codigoCliente=@codigoCliente;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function bajaCliente($registros){
  
        $sql="           
            DECLARE @codigoCliente int='".$registros['codigoCliente']. "';
           
            
            UPDATE dbo.clientes SET baja=1 WHERE codigoCliente=@codigoCliente;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
    //traer clientes para llenar el select de clientes para los trabajos
    public function traerClienteSelect(){
                //con la primera parte de la consulta genero un campo por defecto
		$sql = "SELECT '0' as id, '' as text UNION SELECT cl.codigoCliente  as id,  cl.nombre as text FROM clientes cl order by id;";
		$datos = $this->gestorBD->hacerConsulta($sql);
		return $datos;
    }
    public function traerClienteSelectMod($registros){
        //con la primera parte de la consulta genero un campo por defecto
        
        $sql = "
        DECLARE @codigo nvarchar(15)='".$registros['codigo']."';

        select cl.codigoCliente  as id,  cl.nombre as text from trabajos tr 
        inner join clientes cl on cl.codigoCliente=tr.codigoCliente
        where tr.codigoTrabajo=@codigo;";
        
        $datos = $this->gestorBD->hacerConsulta($sql);
        return $datos;
    }
    public function agregarTrabajo($registros){
  
        $sql="           

            DECLARE @codigoCliente nvarchar(15)='".$registros['codigoCliente']."';
            DECLARE @tipoTrabajo nvarchar(30)='".$registros['tipoTrabajo']."';
            DECLARE @nombreCorto nvarchar(30)='".$registros['nombreCorto']."';
            DECLARE @descripcion nvarchar(1000)='".$registros['descripcion']."';
            DECLARE @fechaInicio date='".$registros['fechaInicio']."';
            DECLARE @fechaEntrega date='".$registros['fechaEntrega']."';
            DECLARE @referente nvarchar(25)='".$registros['referente']."';
            DECLARE @telefonoReferente nvarchar(25)='".$registros['telefonoReferente']."';
            DECLARE @puestoEmpresa nvarchar(25)='".$registros['puestoEmpresa']."';
            DECLARE @importe nvarchar(15)='".$registros['importe']."';
            
            INSERT INTO dbo.trabajos (codigoCliente, nombreCorto, descripcion, fechaInicio, fechaEntrega, referente, telefonoReferente, puestoEmpresa, tipoTrabajo, importe) VALUES(@codigoCliente, @nombreCorto, @descripcion, @fechaInicio, @fechaEntrega, @referente, @telefonoReferente, @puestoEmpresa, @tipoTrabajo, @importe);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function modTrabajo($registros){
  
        $sql="           
            DECLARE @codigoTrabajo int='".$registros['codigoTrabajo']. "';
            DECLARE @cliente nvarchar(25)='".$registros['cliente']."';
            DECLARE @nombre nvarchar(40)='".$registros['nombre']."';
            DECLARE @descripcion nvarchar(1000)='".$registros['descripcion']."';
            DECLARE @fechaInicio date='".$registros['fechaInicio']."';
            DECLARE @fechaEntrega date='".$registros['fechaEntrega']."';
            DECLARE @importe nvarchar(50)='".$registros['importe']."';
            DECLARE @referente nvarchar(25)='".$registros['referente']."';
            DECLARE @telReferente nvarchar(25)='".$registros['telReferente']."';
            DECLARE @puestoReferente nvarchar(25)='".$registros['puestoReferente']."';
            DECLARE @tipoTrabajo nvarchar(25)='".$registros['tipoTrabajo']."';
            
            UPDATE dbo.trabajos SET codigoCliente=@cliente, nombreCorto=@nombre, descripcion=@descripcion, fechaInicio=@fechaInicio, fechaEntrega=@fechaEntrega, importe=@importe, referente=@referente, telefonoReferente=@telReferente, puestoEmpresa=@puestoReferente, tipoTrabajo=@tipoTrabajo  WHERE codigoTrabajo=@codigoTrabajo;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function bajaTrabajo($registros){
  
        $sql="           
            DECLARE @codigoTrabajo nvarchar(15)='".$registros['codigoTrabajo']. "';
           
            DELETE FROM dbo.trabajos WHERE codigoTrabajo=@codigoTrabajo;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function agregarGasto($registros){
  
        $sql="           

            DECLARE @tipoGasto nvarchar(15)='".$registros['tipoGasto']."';
            DECLARE @alias nvarchar(50)='".$registros['alias']."';
            DECLARE @descripcion nvarchar(200)='".$registros['descripcion']."';
            DECLARE @fecha date='".$registros['fecha']."';
            DECLARE @importe nvarchar(25)='".$registros['importe']."';
           
            
            INSERT INTO dbo.gastos (tipoGasto, alias, descripcion, fecha, importe) VALUES(@tipoGasto, @alias, @descripcion, @fecha, @importe);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function detalleCliente($registros){

        $sql="
            DECLARE @id int='".$registros['codigoCliente']."';


            SELECT * FROM dbo.clientes where codigoCliente=@id;";
            $datos=$this->gestorBD->hacerConsulta($sql);
            return $datos;

     }
     public function detalleTrabajo($registros){

        $sql="
            DECLARE @id int='".$registros['codigoTrabajo']."';


            SELECT * FROM dbo.trabajos where codigoTrabajo=@id;";
            $datos=$this->gestorBD->hacerConsulta($sql);
            return $datos;

     }
     public function detalleGasto($registros){

        $sql="
            DECLARE @id int='".$registros['codigoGasto']."';


            SELECT * FROM dbo.gastos where codigoGasto=@id;";
            $datos=$this->gestorBD->hacerConsulta($sql);
            return $datos;

     }
     public function modGasto($registros){
  
        $sql="           
            DECLARE @codigoGasto nvarchar(15)='".$registros['codigoGasto']. "';
            DECLARE @tipoGasto nvarchar(25)='".$registros['tipoGasto']."';
            DECLARE @alias nvarchar(40)='".$registros['alias']."';
            DECLARE @descripcion nvarchar(1000)='".$registros['descripcion']."';
            DECLARE @fecha date='".$registros['fecha']."';
            DECLARE @importe nvarchar(50)='".$registros['importe']."';
            
            UPDATE dbo.gastos SET tipoGasto=@tipoGasto, alias=@alias, descripcion=@descripcion, fecha=@fecha, importe=@importe  WHERE codigoGasto=@codigoGasto;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function bajaGasto($registros){
  
        $sql="           
            DECLARE @codigoGasto nvarchar(15)='".$registros['codigoGasto']. "';
           
            DELETE FROM dbo.gastos WHERE codigoGasto=@codigoGasto;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
}
