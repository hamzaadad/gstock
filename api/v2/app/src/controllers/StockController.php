<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require_once __dir__.'/../models/Stock.php';
require_once __dir__.'/../models/Product.php';
require_once __dir__.'/../models/Fourniseur.php';
final class StockController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        $this->flash->addMessage('info', 'Sample flash message');

        $this->view->render($response, 'home.twig');
        return $response;
    }
    public function getList(Request $request, Response $response, $args){
      if(isset($_SESSION['isLoged'])){
        $year = isset($args['year']) ? $args['year'] : null;
        $month = isset($args['month']) ? $args['month'] : null;
        $day = isset($args['month']) ? $args['month'] : null;
        $stocks = \App\Models\Stock::with('product', 'fournisseur')->where('date', "2016-10-09")->get();
        return json_encode(
          array(
            'status' => '200',
            'stocks' => $stocks
          )
        );

      }else{
        return json_encode(
          array(
            'status' => 'ko'
          )
        );
      }
    }

}
