<?php
// Routes
$app->get('/products', 'App\Controller\ProductsController:getList');
$app->get('/product/{id}', 'App\Controller\ProductsController:getProduct');
$app->get('/product/upm/{id}/date[/{year}[/{month}[/{day}]]]', 'App\Controller\ProductsController:getUpm');
$app->get('/products/grouped', 'App\Controller\ProductsController:getGrouped');


$app->post('/login', 'App\Controller\AuthController:doLogin');
$app->get('/logout', 'App\Controller\AuthController:doLogout');
$app->get('/isLoged', 'App\Controller\AuthController:isLoged');
$app->get('/dashboard', 'App\Controller\HomeController:dashboard');


$app->get('/vents[/{year}[/{month}[/{day}]]]', 'App\Controller\VentsController:getList');


$app->get('/stock/date[/{year}[/{month}[/{day}]]]', 'App\Controller\StockController:getList');
$app->delete('/stock/{id}', 'App\Controller\StockController:delete');

$app->get('/fournisseurs', 'App\Controller\FournisseursController:getList');
$app->post('/fournisseurs', 'App\Controller\FournisseursController:save');
$app->put('/fournisseurs', 'App\Controller\FournisseursController:update');
$app->delete('/fournisseurs/{id}', 'App\Controller\FournisseursController:delete');

$app->get('/clients', 'App\Controller\ClientsController:getList');
$app->post('/clients', 'App\Controller\ClientsController:save');
$app->put('/clients', 'App\Controller\ClientsController:update');
$app->delete('/clients/{id}', 'App\Controller\ClientsController:delete');
$app->get('/client/credits/{id}', 'App\Controller\ClientsController:getCredits');
$app->post('/client/credits', 'App\Controller\ClientsController:setCredits');
$app->post('/client/achat', 'App\Controller\ClientsController:setAchats');
//$app->get('/stock/date(/:year(/:month(/:day)))', 'App\Controller\StockController:getList');
