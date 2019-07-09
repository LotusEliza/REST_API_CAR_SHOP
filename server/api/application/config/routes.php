<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2/8/19
 * Time: 8:35 PM
 */

return [

    //----------------MAIN_CONTROLLER------------------------------
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    //----------------CAR_CONTROLLER------------------------------
    'car' => [
        'controller' => 'car',
        'action' => 'show',
    ],

    'car/([.][a-z]+)' => [
        'controller' => 'car',
        'action' => 'show',
    ],

    'car/([0-9]+)' => [
        'controller' => 'car',
        'action' => 'showOne',
    ],

    'car/([0-9]+)/([.a-z]+)' => [
        'controller' => 'car',
        'action' => 'showOne',
    ],

    'car/search' => [
        'controller' => 'car',
        'action' => 'search',
    ],

    //----------------ORDER_CONTROLLER------------------------------
    'order' => [
        'controller' => 'order',
        'action' => 'makeOrder',
    ],

    'order/([.][a-z]+)' => [
        'controller' => 'order',
        'action' => 'makeOrder',
    ],

    //----------------USER_CONTROLLER------------------------------
    'user/register' => [
        'controller' => 'user',
        'action' => 'createUser',
    ],

    'user/logout' => [
        'controller' => 'user',
        'action' => 'logout',
    ],

    'user/login' => [
        'controller' => 'user',
        'action' => 'login',
    ],

];