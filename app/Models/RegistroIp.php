<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroIp extends Model
{
    protected $table      = "registro_ips";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'municipio',
        'sede',
        'codigo_despacho',
        'despacho',
        'oficina',
    	'tipo_equipo',
        'nombre_equipo',
        'ip',
        'usuario_creador'
    ];
    
   
    
    public static function  equipos()
 {
      $equipo=['COMPUTADOR'=>'COMPUTADOR','IMPRESORA'=>'IMPRESORA','ESCANER'=>'ESCANER','ACCESS POINT'=>'ACCESS POINT','LIFESIZE'=>'LIFESIZE','TELEFONO IP'=>'TELEFONO IP','ROUTER AUTORIZADO'=>'ROUTER AUTORIZADO',
      'TV AUTORIZADO'=>'TV AUTORIZADO','SERVIDOR'=>'SERVIDOR','SERVIDOR VIRTUAL'=>'SERVIDOR VIRTUAL','SWITCH'=>'SWITCH','PORTATIL AUTORIZADO'=>'PORTATIL AUTORIZADO','UPS'=>'UPS',];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
 
     public static function  municipios()
 {
      $municipio=['CALI'=>'CALI','SEVILLA'=>'SEVILLA','CAICEDONIA'=>'CAICEDONIA','ROLDANILLO'=>'ROLDANILLO', 'BOLIVAR'=>'BOLIVAR','LA UNION'=>'LA UNION','ZARZAL'=>'ZARZAL','TORO'=>'TORO','VERSALLES'=>'VERSALLES','EL DOVIO'=>'EL DOVIO',
      'ANDALUCIA'=>'ANDALUCIA', 'SAN PEDRO'=>'SAN PEDRO','RIOFRIO'=>'RIOFRIO','BUGALAGRANDE'=>'BUGALAGRANDE','TRUJILLO'=>'TRUJILLO','ALCALA'=>'ALCALA','ANSERMANUEVO'=>'ANSERMANUEVO','OBANDO'=>'OBANDO','CALIMA'=>'CALIMA',
      'CANDELARIA'=>'CANDELARIA','DAGUA'=>'DAGUA','EL CERRITO'=>'EL CERRITO','FLORIDA'=>'FLORIDA','GINEBRA'=>'GINEBRA','GUACARI'=>'GUACARI','JAMUNDI'=>'JAMUNDI','LA CUMBRE'=>'LA CUMBRE', 'PRADERA'=>'PRADERA','RESTREPO'=>'RESTREPO',
      'VIJES'=>'VIJES','YOTOCO'=>'YOTOCO','YUMBO'=>'YUMBO','PALMIRA'=>'PALMIRA','B/VENTURA'=>'B/VENTURA','CARTAGO'=>'CARTAGO', 'BUGA'=>'BUGA','TULUA'=>'TULUA'];
        ksort($municipio);
      
      return $municipios = collect($municipio);
 }
 
     public static function  sedes()
 {
      
      $sede=['PALACIO JUSTICIA'=>'PALACIO JUSTICIA','GOYA'=>'GOYA','ENTRECEIBAS'=>'ENTRECEIBAS','PLAZA CAICEDO'=>'PLAZA CAICEDO','BRITILANA'=>'BRITILANA','LEY DE TIERRAS'=>'LEY DE TIERRAS','EDIFICIO OTERO'=>'EDIFICIO OTERO',
      'ADOLECENTES'=>'ADOLECENTES','SEDE ALTERNA'=>'SEDE ALTERNA','EDIFICIO ATLANTIS'=>'EDIFICIO ATLANTIS','EDIFICIO JIRETH'=>'EDIFICIO JIRETH','EDIFICIO DE TRANSFERENCIA'=>'EDIFICIO DE TRANSFERENCIA','PALACIO NACIONAL'=>'PALACIO NACIONAL'];
      ksort($sede);
      return $sedes = collect($sede);
      
 }
 
  public static function  Seccionales()
 {
      
      $sede=['CALI'=>'CALI'];
      ksort($sede);
      return $sedes = collect($sede);
      
 }

}
