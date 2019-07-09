<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/8/19
 * Time: 9:29 PM
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}