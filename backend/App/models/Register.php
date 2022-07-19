<?php

namespace App\models;
defined("APPPATH") or die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Register
{

   

    public static function insertNewUser($register)
    {
        $mysqli = Database::getInstance();
        $query = <<<sql
        INSERT INTO utilerias_administradores(usuario,title,nombre,apellidop,apellidom,telefono,id_categoria,especialidades,id_pais,id_estado,referencia,monto_congreso,status) VALUES(:usuario,:title,:nombre,:apellidop,:apellidom,:telefono,:id_categoria,:especialidades,:id_pais,:id_estado,:referencia,:monto_congreso,1)                        
sql;

        $parametros = array(
            ':usuario' => $register->_email,
            ':title' => $register->_prefijo,
            ':nombre' => $register->_nombre,
            ':apellidop' => $register->_apellidop,
            ':apellidom' => $register->_apellidom,
            ':telefono' => $register->_telephone,
            ':id_categoria' => $register->_categorias,
            ':especialidades' => $register->_especialidades,
            ':id_pais' => $register->_nationality,
            ':id_estado' => $register->_state,
            ':referencia' => $register->_referencia,
            ':monto_congreso' => $register->_monto_congreso
        );

        $id = $mysqli->insert($query, $parametros);
        return $id;
    }

    public static function updateBecado($user)
  {
    $mysqli = Database::getInstance(true);
    $query = <<<sql
    UPDATE utilerias_administradores SET title = :prefijo, nombre = :nombre, apellidop = :apellidop, apellidom = :apellidom, telefono = :telefono, id_pais = :id_pais, id_estado = :id_estado, status = 1 WHERE usuario = :email;
sql;
    $parametros = array(
      ':prefijo' => $user->_prefijo,
      ':nombre' => $user->_nombre,
      ':apellidop' => $user->_apellidop,
      ':apellidom' => $user->_apellidom,
      ':telefono' => $user->_telephone,
      ':id_pais' => $user->_nationality,
      ':id_estado' => $user->_state,
      ':email' => $user->_email

    );

    return $mysqli->update($query, $parametros);
  }

  public static function UpdateUser($user)
  {
    $mysqli = Database::getInstance(true);
    $query = <<<sql
    UPDATE utilerias_administradores SET title = :prefijo, nombre = :nombre, apellidop = :apellidop, apellidom = :apellidom, telefono = :telefono, referencia = :referencia,id_categoria = :id_categoria, especialidades = :especialidades,id_pais = :id_pais, id_estado = :id_estado ,monto_congreso = :monto_congreso,status = 1 WHERE usuario = :email;
sql;

    $parametros = array(
      ':prefijo' => $user->_prefijo,
      ':nombre' => $user->_nombre,
      ':apellidop' => $user->_apellidop,
      ':apellidom' => $user->_apellidom,
      ':telefono' => $user->_telephone,
      ':referencia' => $user->_referencia,
      ':id_categoria' =>$user->_categorias,
      ':especialidades' => $user->_especialidades,
      ':id_pais' => $user->_nationality,
      ':id_estado' => $user->_state,
      ':email' => $user->_email,
      ':monto_congreso' =>$user->_monto_congreso

    );

    return $mysqli->update($query, $parametros);
  }




    public static function getUser($email){
        $mysqli = Database::getInstance(true);
        $query =<<<sql
        SELECT * FROM utilerias_administradores  WHERE usuario = '$email'
sql;
    
        return $mysqli->queryAll($query);
    }

    public static function getUserById($id){
        $mysqli = Database::getInstance(true);
        $query =<<<sql
        SELECT * FROM utilerias_administradores  WHERE user_id = '$id'
sql;
    
        return $mysqli->queryAll($query);
    }

    public static function getCountryAll()
    {
        $mysqli = Database::getInstance();
        $query = <<<sql
      SELECT * FROM paises WHERE id_pais != 156 ORDER BY country ASC
sql;
        return $mysqli->queryAll($query);
    }

    public static function getState($pais)
    {
        $mysqli = Database::getInstance();
        $query = <<<sql
     SELECT * FROM estados WHERE id_pais = $pais;
sql;
        return $mysqli->queryAll($query);
    }

    public static function getPais(){       
        $mysqli = Database::getInstance();
        $query=<<<sql
        SELECT * FROM paises
sql;
        return $mysqli->queryAll($query);
      }

      public static function getPaisById($id){       
        $mysqli = Database::getInstance();
        $query=<<<sql
        SELECT * FROM paises WHERE id_pais = $id 
sql;
        return $mysqli->queryAll($query);
      }

      public static function getStateByCountry($id_pais){
        $mysqli = Database::getInstance(true);
        $query =<<<sql
        SELECT * FROM estados where id_pais = '$id_pais'
sql;
      
        return $mysqli->queryAll($query);
      }

      public static function getAllEspecialidades(){
        $mysqli = Database::getInstance();
        $query=<<<sql
        SELECT * FROM especialidades
sql;
        return $mysqli->queryAll($query);
        
    }

    public static function getMontoPago($id_categoria){
        $mysqli = Database::getInstance(true);
        $query =<<<sql
        SELECT * FROM categorias where id_categoria = '$id_categoria'
sql;
      
        return $mysqli->queryOne($query);

    }

    public static function updateFiscalData($user)
  {
    $mysqli = Database::getInstance(true);
    $query = <<<sql
    UPDATE utilerias_administradores SET business_name_iva = :business_name_iva, code_iva = :code_iva, email_receipt_iva = :email_receipt_iva  WHERE usuario = :usuario;
sql;



    $parametros = array(
      ':business_name_iva' => $user->_business_name_iva,
      ':code_iva' => $user->_code_iva,
      ':email_receipt_iva' => $user->_email_receipt_iva,
      ':usuario' => $user->_email
    );

    return $mysqli->update($query, $parametros);
  }

  public static function getDataUser($user){
    $mysqli = Database::getInstance(true);
    $query=<<<sql
    SELECT * FROM utilerias_administradores WHERE usuario = '$user'
sql;
    return $mysqli->queryOne($query);
  }


  /* Pendiente de Pago */
  public static function inserPendientePago($data){ 
    $mysqli = Database::getInstance(1);
    $query=<<<sql
    INSERT INTO pendiente_pago (id_producto, user_id, reference, clave	,fecha, monto, tipo_pago,status, comprado_en) VALUES (:id_producto, :user_id, :reference, :clave, :fecha, :monto, :tipo_pago,:status, 1);
sql;

  $parametros = array(
    ':id_producto'=>$data->_id_producto,
    ':user_id'=>$data->_user_id,
    ':reference'=>$data->_reference,
    ':clave'=>$data->_clave,
    ':fecha'=>$data->_fecha,
    ':monto'=>$data->_monto,
    ':tipo_pago'=>$data->_tipo_pago,
    ':status'=>$data->_status
        
  );
  $id = $mysqli->insert($query,$parametros);
  return $id;
}

public static function getProductosPendientesPagoByUser($user_id){
  $mysqli = Database::getInstance();
  $query=<<<sql
  SELECT ua.monto_congreso as amout_due,ua.clave_socio,p.*,pp.*
  FROM utilerias_administradores ua 
  INNER JOIN pendiente_pago pp ON(ua.user_id = pp.user_id)
  INNER JOIN productos p ON (p.id_producto = pp.id_producto)
  WHERE pp.user_id = $user_id AND pp.status = 0
sql;
  return $mysqli->queryAll($query);
}

public static function insertAsignaProducto($data){

  $mysqli = Database::getInstance();
  $query = <<<sql
  INSERT INTO asigna_producto (user_id,id_producto,fecha_asignacion,status) VALUES(:user_id,:id_producto,NOW(),1)                        
sql;

  $parametros = array(
      ':user_id' => $data->_user_id,
      ':id_producto' => $data->_id_producto
  );

  $id = $mysqli->insert($query, $parametros);

  return $id;
    
}

public static function getProductosPendientesPago($user_id,$id_producto){
  $mysqli = Database::getInstance();
  $query=<<<sql
  SELECT * FROM pendiente_pago WHERE id_producto = $id_producto AND user_id = $user_id 
sql;
  return $mysqli->queryAll($query);
}

public static function getProductosAsignaProducto($user_id,$id_producto){
  $mysqli = Database::getInstance();
  $query=<<<sql
  SELECT * FROM asigna_producto WHERE user_id = $user_id and id_producto = $id_producto
sql;
  return $mysqli->queryAll($query);
}    

}
