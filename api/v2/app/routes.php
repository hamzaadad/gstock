<?php
// Routes

$app->post('/login', 'App\Controller\AuthController:doLogin');
$app->get('/logout', 'App\Controller\AuthController:doLogout');
$app->get('/isLoged', 'App\Controller\AuthController:isLoged');
$app->get('/dashboard', 'App\Controller\HomeController:dashboard');
$app->get('/stock/date[/{year}[/{month}[/{day}]]]', 'App\Controller\StockController:getList');
//$app->get('/stock/date(/:year(/:month(/:day)))', 'App\Controller\StockController:getList');
