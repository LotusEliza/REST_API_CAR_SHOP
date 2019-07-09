<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/12/19
 * Time: 12:37 PM
 */

namespace application\models;


use application\core\Model;

class Order extends Model
{

    public function saveOrder($array)
    {
        $result = $this->db->query('INSERT INTO orders (name, surname, car_id, payment) 
        VALUES (:name, :surname, :car_id, :payment)', $array);
        $count = $result->rowCount();
        if($count){
            return SUCCESS;
        }else{
            return ERROR_ORDER;
        }
    }

}