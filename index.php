<?php
require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Controller/HomeController.php";

$route = new Router(new Request());

$route->reg_page('/', 'home.php');

$route->reg_page('/about',  'about.php');

$route->reg_page('/users',  'users.php');

$route->reg_page('/contact',  [HomeController::class, 'contact']);

$route->post_route("/contact", [HomeController::class, 'postContact']);