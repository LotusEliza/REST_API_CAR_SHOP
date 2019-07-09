<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/12/19
 * Time: 12:37 PM
 */

namespace application\models;


use application\core\Model;

class User extends Model
{

    public function getUser($userName){
        $result = $this->db->row("SELECT * FROM users_rest WHERE name = '".$userName."'");
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function insertUser($user){
        $result = $this->db->query("INSERT INTO users_rest 
        (name, password) VALUES (:userName, :password)", $user);
        $count = $result->rowCount();
        if($count){
            return true;
        }else{
            return false;
        }
    }

}