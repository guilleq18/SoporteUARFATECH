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
    public function traerProductosExibidos()
    {
        $sql = "SELECT * FROM UARFASoporte.dbo.productosPreciosCat ";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    
    public function registrarProducto($registros)
    {
        $sql = "  
                DECLARE @EAN nvarchar(24)='".$registros['EAN']."';
                insert into UARFASoporte.dbo.productosPreciosCat (codigoProducto,codigoRelacionado,fechaPrecio,precioPublico)
                select distinct codigoProducto, codigoRelacionado, fechaPrecio, CAST(((1+tasaIva/100) * precioPublico) as numeric(14,2)) as precioventa from (
                select pc.codigoproducto,cr.codigorelacionado, dep.tasaIva,pc.precioPublico,
                case 
                when pc.fechaModificacionPrecioPublico<pc.fechaRegistro then cast(pc.fechaRegistro As date)
                else cast(pc.fechaModificacionPrecioPublico as date)
                end 
                fechaPrecio

                from genProductosCodigosRelacionadosCat cr 
                inner join genProductosCat pc on pc.codigoProducto=cr.codigoProducto
                left join genProductosSucursalVentaCnf psv on psv.codigoProducto=pc.codigoProducto
                left join genDepartamentosIvaCat dep on dep.codigoDepartamento=psv.codigoDepartamento
                where cr.codigoRelacionado=@EAN) as t";
        $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
    }
    public function traerReclamosDetalle($registros)
    {
        $sql = "  
                DECLARE @idReclamo int='".$registros['reclamo']."';
                SELECT * FROM casosDet cd 
                INNER JOIN usuariosCat uc on uc.codigoUsuario=cd.usuarioRespuesta
                where cd.CodigoCaso=@idReclamo;";
        $datos = $this->gestorBD->hacerConsulta($sql);
        return $datos;
    }
  
    public function traerReclamos()
    {
        $sql = "select * from casosCab rd
        inner join tipoCasosCat tr on tr.codigoTipoCaso=rd.CodigoTipoCaso
        inner join CadenasCat cd on cd.codigoCadena=rd.CodigoCadena ; ";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }

    //insert de clientes
    public function registrarCadena($registros){
  
        $sql="           

            DECLARE @cadenaNombre nvarchar(15)='".$registros['cadenaNombre']."';
            DECLARE @cadenaProvincia nvarchar(10)='".$registros['cadenaProvincia']."';
            
            
            INSERT INTO dbo.cadenasCat (nombre, provincia, estatus) VALUES(@cadenaNombre, @cadenaProvincia, 0);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function registrarSucursal($registros){
  
        $sql="           

            DECLARE @idCadena nvarchar(15)='".$registros['idCadena']."';
            DECLARE @nombre nvarchar(20)='".$registros['nombre']."';
            DECLARE @roc nvarchar(20)='".$registros['roc']."';
            
            
            INSERT INTO dbo.sucursalesCat (codigoCadena, nombre, roc, estatus) VALUES (@idCadena, @nombre, @roc, 0);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function modCadena($registros){
  
        $sql="           
            DECLARE @codigoCadena bigint='".$registros['codigoCadena']. "';
            DECLARE @nombreCad nvarchar(40)='".$registros['nombreCad']."';
            DECLARE @provCadena nvarchar(25)='".$registros['provCadena']."';
            
            UPDATE dbo.CadenasCat SET nombre=@nombreCad, provincia=@provCadena WHERE codigoCadena=@codigoCadena;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function modSucursal($registros){
  
        $sql="           
            DECLARE @codigoSucursal bigint='".$registros['codigoSucursal']. "';
            DECLARE @nombreSuc nvarchar(40)='".$registros['nombreSuc']."';
            DECLARE @responsableSuc nvarchar(25)='".$registros['responsableSuc']."';
            
            UPDATE dbo.sucursalesCat SET nombre=@nombreSuc, roc=@responsableSuc WHERE codigoSucursal=@codigoSucursal;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     
     public function deleteCadena($registros){
  
        $sql="           
            DECLARE @codigoCadena bigint='".$registros['codigoCadena']. "';
           
            
            UPDATE dbo.CadenasCat SET estatus=1 WHERE codigoCadena=@codigoCadena;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function deleteSucursal($registros){
  
        $sql="           
            DECLARE @codigoSucursal bigint='".$registros['codigoSucursal']. "';
           
            
            UPDATE dbo.sucursalesCat SET estatus=1 WHERE codigoSucursal=@codigoSucursal;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
    //traer clientes para llenar el select de clientes para los trabajos
    public function traerProvinciasSelect(){
                //con la primera parte de la consulta genero un campo por defecto
		$sql = "SELECT '0' as id, '' as text UNION SELECT pr.codigoProvincia  as id,  pr.provincia as text FROM provinciasCat pr order by id;";
		$datos = $this->gestorBD->hacerConsulta($sql);
		return $datos;
    }

}
