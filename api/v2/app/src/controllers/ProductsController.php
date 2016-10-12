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
    public function getGrouped(Request $request, Response $response, $args){
      $products = \App\Models\Product::with('product_type')->get();
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

    public function getUpm(Request $request, Response $response, $args){
			$year = isset($args['year']) ? /*$args['year']*/ '2016' : null;
			$month = isset($args['month']) ? /*$args['month']*/ '10': null;
			$day = isset($args['day']) ? /*$args['day']*/ '09': null;
			$date = '';
			if($year){
				$date = $year;
				if($month){
					$date .= '-'.$month;
					if($day){
						$date .= '-'.$day;
					}
				}
			}
			$upm = \App\Models\Uph::where([['id', $args['id']], ['date', "like" ,"%$date%"]])->get();
			if(count($upm) > 0){
				return json_encode(["status"=> '200', 'upm'=>$upm], true);
			}else{
				return json_encode(["status"=> 'ko'], true);
			}

    	// var $id = $args['id']
    }

}
