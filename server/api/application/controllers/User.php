<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 6/23/19
 * Time: 1:47 PM
 */

namespace application\controllers;

use application\core\Controller;
use \Firebase\JWT\JWT;


class User extends Controller
{

    public $loginUserName;
    public $loginPassword;

    public function createUserAction(){
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->userName) && !empty($data->password) &&
            !ctype_space($data->userName) && !ctype_space($data->password)){
            $userName = $this->testInput($data->userName);
            $password = $this->testInput($data->password);

            if(!$this->model->getUser($userName)) {
                $password = $this->bcrypt($password);
                $user = ['userName'=>$userName, 'password'=>$password];
                $result = $this->model->insertUser($user);
                $array = $this->createToken();
                if($result){
                    $this->response(201,USER_CREATED,$array,$this->format);
                }else{
                    $this->response(503,ERROR_CREATE_USER,NULL,$this->format);
                }
            }else{
                $this->response(409,NAME_EXIST,NULL,$this->format);
            }
        }else{
            $this->response(400,ERROR_EMPTY,NULL,$this->format);
        }
    }

    public function loginAction(){
        $data = json_decode(file_get_contents("php://input"));
        if(!empty($data->loginUserName) && !empty($data->loginPassword)){
            $this->loginUserName = $this->testInput($data->loginUserName);
            $this->loginPassword = $this->testInput($data->loginPassword);

            $user = $this->model->getUser($this->loginUserName);
            $validPassword = $this->verify($this->loginPassword, $user[0]['password']);
                if($validPassword){
                    $array = $this->createToken();
                    $this->response(200,SUCCESS, $array ,$this->format);
                }else{
                    $this->response(400,ERROR,ERROR_PASS, $this->format);
                }
        }else{
            $this->response(400,ERROR_EMPTY,NULL,$this->format);
        }
    }

    protected function createToken()
    {
        $secret_key = SECRET_KEY;
        $issuer_claim = URL; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 1; //not before in seconds
        $expire_claim = $issuedat_claim + 1000000000000; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "useName" => $this->loginUserName,
            ));
        JWT::$leeway = 5;
        $jwt = JWT::encode($token, $secret_key);
        return array("message" => SUCCESS, "jwt" => $jwt);
    }

    public function bcrypt($password){
        return $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify($password, $userPassword){
        return $validPassword = password_verify($password, $userPassword);
    }

}