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
      SELECT pro.id_producto,pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.user_id = $id  GROUP BY pp.clave
sql;
      return $mysqli->queryAll($query);
    }

    public static function getAllComprobantesbyClave($id,$clave){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave, pp.comprado_en
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
        UPDATE pendiente_pago SET url_archivo = :url_archivo WHERE clave = :clave;
sql;
        $parametros = array(
          ':url_archivo'=>$data->_url,
          ':clave' => $data->_clave
          // ':id_pendiente_pago'=>$data->_id_pendiente_pago
        );
       
        return $mysqli->update($query, $parametros);

    }

  
}