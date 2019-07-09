<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 6/23/19
 * Time: 11:18 AM
 */


namespace application\controllers;

use application\core\Controller;
use Exception;


class Order extends Controller
{

    public function makeOrderAction()
    {
        if ($this->jwtValid()) {
            $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->name) && !empty($data->carId)) {
                $name = $this->testInput($data->name);
                $surname = $this->testInput($data->surname);
                $carId = $this->testInput($data->carId);
                $payment = $this->testInput($data->payment);
                $this->check($name, $carId, $payment);
                    $array = ['name' => $name, 'surname' => $surname, 'car_id' => $carId, 'payment' => $payment];
                    $result = $this->model->saveOrder($array);
                    $this->response(200,SUCCESS,$result,$this->format);
            }
        }
    }

    public function check($name, $carId, $payment){
        if (!$name){
            throw new Exception(ERROR_NAME);
        }
        if (!$carId || !is_numeric($carId) || $carId<0){
            throw new Exception(ERROR_CARID);
        }
        if ($payment!="1" && $payment!="2"){
            throw new Exception(ERROR_PAYMENT);
        }
    }
}