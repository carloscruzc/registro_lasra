<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class ComprobantePago{

    public static function getAll($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.nombre, pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      WHERE pp.user_id = $id
sql;
      return $mysqli->queryAll($query);
    }

    public static function getAllComprobantes($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.id_producto,pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave,pp.monto,pp.monto,pp.tipo_moneda as t_moneda
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.user_id = $id   GROUP BY pp.clave
sql;
      return $mysqli->queryAll($query);
    }

    public static function getAllComprobantesbyClave($id,$clave){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave, pp.comprado_en, pp.monto,pp.tipo_moneda as t_moneda
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.user_id = $id and pp.clave = '$clave'
sql;
      return $mysqli->queryAll($query);
    }

    public static function getAllComprobantesbyClaveAndStatus($id,$clave){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave, pp.comprado_en
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.user_id = $id and pp.clave = '$clave' and pp.status = 0
sql;
      return $mysqli->queryAll($query);
    }

    public static function updateComprobante($data){
        $mysqli = Database::getInstance(true);
        // var_dump($user);
        $query=<<<sql
        UPDATE pendiente_pago SET url_archivo = :url_archivo, status = 0  WHERE clave = :clave;
sql;
        $parametros = array(
          ':url_archivo'=>$data->_url,
          ':clave' => $data->_clave
          // ':id_pendiente_pago'=>$data->_id_pendiente_pago
        );
       
        return $mysqli->update($query, $parametros);

    }

    public static function insertComprobante($data)
  {
    $mysqli = Database::getInstance(1);
    $query = <<<sql
    INSERT INTO pendiente_pago (id_producto, user_id, reference, clave,fecha, monto, tipo_moneda,tipo_pago,
    status, comprado_en) 
    VALUES (:id_producto, :user_id, :reference, :clave, :fecha, :monto, :tipo_moneda,
    :tipo_pago,0, 1);
sql;

    $parametros = array(
      ':id_producto' => $data->_id_producto,
      ':user_id' => $data->_user_id,
      ':reference' => $data->_reference,
      ':clave' => $data->_clave,
      ':fecha' => $data->_fecha,
      ':monto' => $data->_monto,
      ':tipo_pago' => $data->_tipo_pago,
      ':tipo_moneda' => $data->_tipo_moneda,
    );
    $id = $mysqli->insert($query, $parametros);
    return $id;
  }

    public static function updateComprobanteEstudiante($data){
      $mysqli = Database::getInstance(true);
      // var_dump($user);
      $query=<<<sql
      UPDATE pendiente_estudiante SET url_archivo = :url_archivo, status = 0  WHERE user_id = :user_id;
sql;
      $parametros = array(
        ':url_archivo'=>$data->_url,
        ':user_id' => $data->_user_id
        // ':id_pendiente_pago'=>$data->_id_pendiente_pago
      );
     
      return $mysqli->update($query, $parametros);

  }

  public static function getAllComprobantesEstudiante($id){
    $mysqli = Database::getInstance();
    $query=<<<sql
    SELECT pe.*,ua.usuario,CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre_completo, pe.status
    FROM pendiente_estudiante pe
    INNER JOIN utilerias_administradores ua ON(ua.user_id = pe.user_id)
    WHERE pe.user_id = $id
    GROUP BY pe.user_id;
sql;
    return $mysqli->queryAll($query);
  }
  
}