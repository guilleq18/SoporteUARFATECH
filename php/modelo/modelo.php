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

    
    //metodo que realiza la consulta de clientes
    public function traercadenas()
    {
        $sql = "SELECT cad.codigoCadena, cad.nombre, cad.provincia, pr.provincia as nombreProvincia FROM CadenasCat cad
        inner join provinciasCat pr on pr.codigoProvincia=cad.provincia
        where cad.estatus=0; ";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }
    
    public function traerSucursales($registros)
    {
        $sql = "  
                DECLARE @idCadena int='".$registros['id']."';
                SELECT sc.codigoSucursal, sc.codigoCadena, cc.nombre as nombreCadena, sc.nombre, sc.roc FROM SucursalesCat sc
                INNER JOIN CadenasCat cc on cc.codigoCadena=sc.codigoCadena 
                WHERE sc.codigoCadena=@idCadena and sc.estatus=0 ;";
                $datos = $this->gestorBD->hacerConsulta($sql);
                //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
                return $datos;
    }
    public function traerDetReclamos($registros)
    {
        $sql = "  
                DECLARE @codigo int='".$registros['codigoReclamo']."';

                select cc.codigoCadena, rc.codigoReclamo, rc.codigoimagen, rc.tipoReclamo, rc.estado as codEstado, rc.titulo, rc.codigoSucursal, sc.nombre, convert(varchar, rc.hora, 108) as hora, rc.fechaReclamo, tr.reclamo, rc.usuarioReclamo, rc.descripcion, rc.respuesta, CASE WHEN rc.estado=2 THEN 'OK' ELSE 'PENDIENTE' END as estado, us.nombreUsuario  from reclamosCab rc
                inner join sucursalesCat sc on sc.codigoSucursal=rc.codigoSucursal
                inner join CadenasCat cc on cc.codigoCadena=sc.codigoCadena
                inner join tipoReclamoCat tr on tr.codigoTipoReclamo=rc.tipoReclamo
                inner join usuariosCat us on us.codigoUsuario=rc.codigoUsuarioUt
                where rc.codigoReclamo=@codigo;";
                $datos = $this->gestorBD->hacerConsulta($sql);
                //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
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
    public function traerReclamosCab()
    {
        $sql = "select rc.codigoReclamo, rc.titulo as titulo, rc.codigoSucursal, sc.nombre, convert(varchar, rc.hora, 108) as hora, rc.fechaReclamo, tr.reclamo, rc.usuarioReclamo, rc.descripcion, rc.respuesta, CASE WHEN rc.estado=2 THEN 'OK' ELSE 'PENDIENTE' END as estado, us.nombreUsuario  from reclamosCab rc
        inner join sucursalesCat sc on sc.codigoSucursal=rc.codigoSucursal
		inner join tipoReclamoCat tr on tr.codigoTipoReclamo=rc.tipoReclamo
		inner join usuariosCat us on us.codigoUsuario=rc.codigoUsuarioUt
        where rc.estado!=3
        order by rc.codigoReclamo desc; ";
        //instancio en datos la consulta que se envia al metodo hacerConsulta que me devuelve los datos a mostrar
        $datos = $this->gestorBD->hacerConsulta($sql);
        //retorno la variable datos para poder ser utilizada posteriormente al ser llamado el metodo
        return $datos;
    }

    //insert de Cadenas
    public function registrarCadena($registros){
  
        $sql="           

            DECLARE @cadenaNombre nvarchar(50)='".$registros['cadenaNombre']."';
            DECLARE @cadenaProvincia nvarchar(10)='".$registros['cadenaProvincia']."';
            
            
            INSERT INTO dbo.cadenasCat (nombre, provincia, estatus) VALUES(@cadenaNombre, @cadenaProvincia, 0);";
            
          
       $datos = $this->gestorBD->hacerInsert($sql);
        return $datos;
     }
     public function registrarUsuario($registros){
  
        $sql="           

            DECLARE @nombre nvarchar(25)='".$registros['nombre']."';
            DECLARE @apellido nvarchar(20)='".$registros['apellido']."';
            DECLARE @usuario nvarchar(20)='".$registros['usuario']."';
            DECLARE @pass nvarchar(30)='".$registros['pass']."';
            
            INSERT INTO dbo.usuariosCat (nombreUsuario, fechaAlta, password, nombre, apellido, status,rol) VALUES(@usuario, GETDATE(), @pass, @nombre, @apellido, 'A',1);";
            
            $datos = $this->gestorBD->hacerInsert($sql);
            return $datos;
     }
     public function registrarProblema($registros){
  
        $sql="           

            DECLARE @idCadena nvarchar(15)='".$registros['empresa']."';
            DECLARE @idsucursal nvarchar(20)='".$registros['sucursal']."';
            DECLARE @usuarioUt nvarchar(20)='".$registros['usuarioUt']."';
            DECLARE @tipoReclamo nvarchar(20)='".$registros['motivo']."';
            DECLARE @titulo nvarchar(50)='".$registros['titulo']."';
            DECLARE @fecha date='".$registros['fecha']."';
            DECLARE @time time='".$registros['time']."';
            DECLARE @descripcion nvarchar(300)='".$registros['descripcion']."';
            DECLARE @Respuesta nvarchar(300)='".$registros['Respuesta']."';
            DECLARE @estado nvarchar(10)='".$registros['estado']."';
            DECLARE @usuarioR nvarchar(50)='".$registros['usuarioR']."';
            DECLARE @imagen nvarchar(100)='".$registros['imagen']."';
            
            insert into reclamosCab (fechaActualizacion,codigoUsuarioUt,hora,fechaReclamo,titulo, descripcion,respuesta, tipoReclamo,codigoImagen, usuarioReclamo, estado, codigoSucursal) VALUES (GETDATE(), @usuarioUt, @time, @fecha,@titulo, @descripcion, @Respuesta, @tipoReclamo, @imagen, @usuarioR, @estado, @idsucursal);";
            
          
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
     public function modificarProblema($registros){
  
        $sql="           
            DECLARE @codigoReclamo nvarchar(20)='".$registros['codigoReclamo']."';
            DECLARE @idsucursal nvarchar(20)='".$registros['sucursal']."';
            DECLARE @usuarioUt nvarchar(20)='".$registros['usuarioUt']."';
            DECLARE @tipoReclamo nvarchar(20)='".$registros['motivo']."';
            DECLARE @titulo nvarchar(50)='".$registros['titulo']."';
            DECLARE @fecha date='".$registros['fecha']."';
            DECLARE @time time='".$registros['time']."';
            DECLARE @descripcion nvarchar(300)='".$registros['descripcion']."';
            DECLARE @Respuesta nvarchar(300)='".$registros['Respuesta']."';
            DECLARE @estado nvarchar(10)='".$registros['estado']."';
            DECLARE @usuarioR nvarchar(50)='".$registros['usuarioR']."';
            DECLARE @imagen nvarchar(100)='".$registros['imagen']."';
            
            update reclamosCab set fechaActualizacion=GETDATE(), codigoUsuarioUt=@usuarioUt, hora=@time, fechaReclamo=@fecha, titulo=@titulo, descripcion=@descripcion, respuesta=@Respuesta,tipoReclamo=@tipoReclamo,codigoImagen=@imagen,usuarioReclamo=@usuarioR, estado=@estado, codigoSucursal=@idsucursal where codigoReclamo=@codigoReclamo;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function modificarProblemaSinSucursal($registros){
  
        $sql="           
            DECLARE @codigoReclamo nvarchar(20)='".$registros['codigoReclamo']."';
            DECLARE @usuarioUt nvarchar(20)='".$registros['usuarioUt']."';
            DECLARE @tipoReclamo nvarchar(20)='".$registros['motivo']."';
            DECLARE @titulo nvarchar(50)='".$registros['titulo']."';
            DECLARE @fecha date='".$registros['fecha']."';
            DECLARE @time time='".$registros['time']."';
            DECLARE @descripcion nvarchar(100)='".$registros['descripcion']."';
            DECLARE @Respuesta nvarchar(100)='".$registros['Respuesta']."';
            DECLARE @estado nvarchar(10)='".$registros['estado']."';
            DECLARE @usuarioR nvarchar(50)='".$registros['usuarioR']."';
            DECLARE @imagen nvarchar(100)='".$registros['imagen']."';
            
            update reclamosCab set fechaActualizacion=GETDATE(), codigoUsuarioUt=@usuarioUt, hora=@time, fechaReclamo=@fecha, titulo=@titulo, descripcion=@descripcion, respuesta=@Respuesta,tipoReclamo=@tipoReclamo,codigoImagen=@imagen,usuarioReclamo=@usuarioR, estado=@estado where codigoReclamo=@codigoReclamo;";
            
          
       $datos = $this->gestorBD->hacerCambio($sql);
        return $datos;
     }
     public function modEstado($registros){
  
        $sql="           
            DECLARE @codigoReclamo bigint='".$registros['codigoReclamo']. "';
           
            
            UPDATE dbo.reclamosCab SET estado=2 WHERE codigoReclamo=@codigoReclamo;";
            
          
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
     public function deleteReclamo($registros){
  
        $sql="           
            DECLARE @codigoReclamo bigint='".$registros['codigoReclamo']. "';
           
            
            UPDATE dbo.reclamosCab SET estado=3 WHERE codigoReclamo=@codigoReclamo;";
            
          
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
    public function traerEmpresaSelect(){
        //con la primera parte de la consulta genero un campo por defecto
        $sql = "SELECT '0' as id, '' as text UNION SELECT cad.codigoCadena  as id,  cad.nombre as text FROM CadenasCat cad order by id;";
        $datos = $this->gestorBD->hacerConsulta($sql);
        return $datos;
        }
    public function traerSucursalSelect($registros){
        
            $sql = "
            
            DECLARE @codigoEmpresa bigint='".$registros['empresa']. "';
            SELECT '0' as id, '' as text UNION SELECT suc.codigoSucursal  as id,  suc.nombre as text FROM sucursalesCat suc where codigoCadena=@codigoEmpresa and suc.estatus=0 order by id;";
            $datos = $this->gestorBD->hacerConsulta($sql);
            return $datos;
            }

    public function traerUsuario($registros){
        
                $sql = "
                DECLARE @usuario nvarchar(20)='".$registros['usuario']. "';
                DECLARE @pass nvarchar(100)='".$registros['pass']. "';
                select * from usuariosCat where nombreUsuario=@usuario  and password=@pass and status='A';";
               
                $user = json_decode($this->gestorBD->hacerConsulta($sql), true);
                return $user;
    }        
    
}
?>