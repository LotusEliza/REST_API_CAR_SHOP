<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/9/19
 * Time: 11:43 AM
 */

namespace application\core;
//
//use application\core\View;
//use application\lib\Helper;
use Exception;
use SimpleXMLElement;
use \Firebase\JWT\JWT;


class Controller
{

    public $route;
    public $view;
    public $model;
    public $var;
    public $format;

    public function __construct($route, $var, $format)
    {
        $this->route = $route;
        $this->var = $var;
        $this->format = $format;
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name){
        $path = 'application\models\\'.ucfirst($name);

        if(class_exists($path)){
            return new $path($this->var);
        }
    }

    public function response($status,$status_message,$data,$format)
    {
        if(!$format){
           $format = '.json';
        }
        $format = ltrim($format, '.');
        if ($format == 'json' || $format == 'txt' || $format == 'xml' || $format == 'html') {
            header("Access-Control-Allow-Origin: *");
            header("HTTP/1.0 " . $status);
            header('Content-Type: application/' . $format);
            $response['status'] = $status;
            $response['status_message'] = $status_message;
            $response['data'] = $data;
            $this->format($format, $response);
        }
    }

    public function format($format, $response){
        switch ($format) {
            case "json":
                echo json_encode($response);
                break;
            case "txt":
                $result = $this->toText($response);
                print_r($result);
                break;
            case "xml":
                echo $this->toXml($response);
                break;
            case "html":
                echo $this->toHtml($response);
                break;
            default:
                break;
        }
    }

    public function jwtValid()
    {
        $data = json_decode(file_get_contents("php://input"));
        $jwt=isset($data->jwt) ? $data->jwt : "";
        if ($jwt){
            try {
                $decoded = JWT::decode($jwt, SECRET_KEY, array('HS256'));
                if($decoded){
                    return true;
                }
            } catch (Exception $e) {
                $this->response(400, ERROR_INCORRECT_JWT, $e->getMessage(), $this->format);
            }
        }
    }

    public  function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function toText($var){
        $result = '';
        foreach($var as $key => $val){
            if(is_array($val)){
                foreach($val as $key1 => $val1){
                    $result .= "{$key1}::\n\n";
                    if(is_array($val1)){
                        foreach ($val1 as $key2 => $val2){
                            foreach ($val2 as $key3 => $val3){
                                $result .= "{$key3}: {$val3}\n";
                            }
                            $result .= "\n";
                        }
                    }elseif(is_string($val1)){
                        $result .= "{$key1}: {$val1}\n";
                    }
                }
            }elseif(is_string($val)){
                $result .= "{$key}: {$val}\n";
            }
        }
        return $result;
    }

    public function toXml($var){
        $xml = new SimpleXMLElement('<data/>');
        if (is_array($var))
        {
            foreach ($var as $key => $val)
            {
                if (is_array($val))
                {
                    $car = $xml->addChild('node');
                    foreach ($val as $key1 => $val1)
                    {
                        if (is_array($val1)){
                            foreach ($val1 as $key2 => $val2){
                                $car1 = $car->addChild('item');
                                if (is_array($val2)){
                                    foreach ($val2 as $key3 => $val3){
                                        $car1->addChild($key3, $val3);
                                    }
                                }elseif (is_string($val2)){
                                    $xml->addChild($key2, $val2);
                                }
                            }
                        }elseif (is_string($val1)){
                            $xml->addChild($key1, $val1);
                        }
                    }
                }
                if(is_string($val))
                {
                    $xml->addChild($key, $val);
                }
            }
            $result = $xml->asXML();
            return $result;
        }
    }

    public function toHtml($var){
        if(is_array($var)){
            $result = "<div class='response'>\n";
            foreach($var as $key => $val){
                if (is_array($val)){
                    $result .= "<div class='data'>\n";
                    foreach($val as $key1 => $val1){
                        $result .= "<div class='car'>\n";
                        if(is_array($val1)){
                            foreach ($val1 as $key2 => $val2){
                                foreach ($val2 as $key3 => $val3){
                                    $result .= "<div class='{$key3}'>$val3</div>\n";
                                }
                                $result .= "<br/>\n";
                            }
                        }elseif(is_string($val1)){
                            $result .= "<div class='{$key1}'>$val1</div>\n";
                        }
                    }
                    $result .= "</div></div>\n";
                }else if(is_string($val)){
                    $result .= "<div class='{$key}'>$val</div>\n";
                }
            }
            $result .= "</div>\n";
            return $result;
        }
        return false;
    }

}