<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/12/19
 * Time: 12:31 PM
 */

namespace application\controllers;

use application\core\Controller;


class Car extends Controller
{

    public function showAction(){
            $result = $this->model->getCars();
            if ($result) {
                $var = ['cars' => $result];
                $this->response(200, FOUND, $var, $this->format);
            } else {
                $this->response(404, NOT_FOUND, NULL, $this->format);
            }
    }

    public function showOneAction(){
            $result = $this->model->showOneCar($this->var);
            if ($result) {
                $var = ['car' => $result];
                $this->response(200, FOUND, $var, $this->format);
            } else {
                $this->response(404, NOT_FOUND, NULL, $this->format);
            }
    }

    public function searchAction(){
                $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->year)) {
                    $year = $this->testInput($data->year);
                    $color = $this->testInput($data->color);
                    $price = $this->testInput($data->price);
                    $speed = $this->testInput($data->speed);
                    $capacity = $this->testInput($data->capacity);

                    $result = $this->model->searchCars($year, $color, $price, $speed, $capacity);
                    if ($result) {
                        $this->response(200, FOUND, $result, $this->format);
                    } else {
                        $this->response(404, NOT_FOUND, NULL, $this->format);
                    }
            }else{
                $this->response(200, ERROR_YEAR, NULL, $this->format);
            }
    }
}