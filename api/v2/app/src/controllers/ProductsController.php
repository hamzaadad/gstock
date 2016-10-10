<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
// use App\Models\Product;

require_once __dir__.'/../models/Stock.php';
require_once __dir__.'/../models/Product.php';
require_once __dir__.'/../models/ProductType.php';
require_once __dir__.'/../models/uph.php';
require_once __dir__.'/../models/Fourniseur.php';

final class ProductsController extends BaseController{
	public function dispatch(Request $request, Response $response, $args)
    {
        // $this->logger->info("Product page action dispatched");

        // $this->flash->addMessage('info', 'Sample flash message');

        // $this->view->render($response, 'home.twig');
        return $response;
    }

    public function getList(Request $request, Response $response, $args){
      $products = \App\Models\Product::with('product_type', 'uph')->get();
      return json_encode(
          array(
            'status' => '200',
            'stocks' => $products
          )
       	);
    }

    public function getProduct(Request $request, Response $response, $args){
    	// var $id = $args['id']
    }
}