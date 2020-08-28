<?php

require_once 'Request.php';
require_once 'Session.php';
require_once 'Cookies.php';


use src\oop\Cookies;
use src\oop\Request;
use src\oop\Session;



$_POST['1']='Hello';
$_GET['number']='26';
$_SESSION['222']=34;


$cookies = new Cookies();
$cookies->set(1212,34343);


$session = new Session();
$session->set(34234,5345345);

$request = new Request();
$request->all();


echo 'All sessions :' . print_r( $request->session()->all()) . PHP_EOL . PHP_EOL . PHP_EOL;
echo 'All cookies : ' . print_r( $request->cookies()->all()) . PHP_EOL . PHP_EOL . PHP_EOL;
echo 'Get and POST :' . print_r( $request->all()) . PHP_EOL . PHP_EOL . PHP_EOL;
