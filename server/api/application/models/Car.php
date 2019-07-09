<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/12/19
 * Time: 12:37 PM
 */

namespace application\models;
use application\core\Model;


class Car extends Model
{

    public function getCars()
    {
        $result = $this->db->row('SELECT cars.id, brands.brand, models.model FROM cars 
        INNER JOIN brands ON cars.brand_id = brands.id 
        INNER JOIN models ON cars.model_id = models.id;');
        return $result;
    }

    public function showOneCar($id)
    {
        $result = $this->db->row("SELECT c.year, c.capacity, c.speed, c.price, col.color, b.brand, m.model 
                     FROM cars c INNER JOIN cars_colors cc ON c.id=cc.car_id
                     INNER JOIN brands b ON c.brand_id=b.id
                     INNER JOIN models m ON c.model_id=m.id
                     INNER JOIN colors col ON cc.color_id=col.id WHERE c.id=$id");
        return $result;
    }

    public function searchCars($year, $color, $price, $speed, $capacity)
    {
        $result = $this->db->row("SELECT c.year, c.capacity, c.speed, c.price, col.color, b.brand, m.model 
                     FROM cars c INNER JOIN cars_colors cc ON c.id=cc.car_id
                     INNER JOIN brands b ON c.brand_id=b.id
                     INNER JOIN models m ON c.model_id=m.id
                     INNER JOIN colors col ON cc.color_id=col.id WHERE c.year=$year AND col.color 
                     LIKE '%$color%' AND c.price LIKE '%$price%' AND c.speed LIKE '%$speed%' AND c.capacity LIKE '%$capacity%'");
        return $result;
    }

}


