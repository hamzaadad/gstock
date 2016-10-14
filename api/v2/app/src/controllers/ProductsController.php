<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
// use App\Models\Product;

require_once __dir__.'/../models/Stock.php';
require_once __dir__.'/../models/Achat.php';
require_once __dir__.'/../models/Product.php';
require_once __dir__.'/../models/ProductType.php';
require_once __dir__.'/../models/uph.php';
require_once __dir__.'/../models/Fourniseur.php';

final class ProductsController extends BaseController{
	public function dispatch(Request $request, Response $response, $args)
    {
        return $response;
    }

    public function getList(Request $request, Response $response, $args){

      $products = \App\Models\Achat::with('product_type', 'uph')->get();
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
			$upm = \App\Models\Uph::where([['ref_type', $args['id']], ['date', "like" ,"%$date%"]])->get();
			if(count($upm) > 0){
				return json_encode(["status"=> '200', 'upm'=>$upm], true);
			}else{
				return json_encode(["status"=> 'ko'], true);
			}

    	// var $id = $args['id']
    }

    public function save(Request $request, Response $response, $args){
      $achat = new \App\Models\Achat;
      $data = json_decode($request->getBody(), true);
      $achat["name"] = $data["name"];
      $achat["prix"] = $data["price"];
      $achat["qty"] = $data["qty"];
      $achat["ref_for"] = $data["fournisseur"]["id"];
      $achat["ref_type"] = $data["product"]["id"];
      $achat->save();
      if($product->id){
        $stock = new \App\Models\Stock;
        $stock["ref_type"] = $product["id"];
        $stock["qty"] = $data["qty"];
        $stock["fourniseurs_id"] = $product["ref_four"];
        $stock->save();
        if($stock->id){
          $product = $product::where('id', $product->id)->with(['product_type','fournisseur'])->get();
          return json_encode(["status"=>"200","product"=>$product]);
          //update unite price
        }
      }
    }

    public function productTypes(Request $request, Response $response, $args){
      $types = \App\Models\ProductType::all();
    	return json_encode(["status"=>"200","productTypes"=>$types]);
    }
    public function productTypesUph(Request $request, Response $response, $args){
      $types = \App\Models\ProductType::all();
			foreach(json_decode(json_encode($types), true) as $index=>$type){
				$types[$index]['uph'] = \App\Models\uph::where(['ref_type'=>$type['id'], 'date'=>'2016-10-09'])->get()->take(1)[0];
			}
    	return json_encode(["status"=>"200","productTypes"=>$types]);
    }

    public function todayProducts(Request $request, Response $response, $args){
      $data = json_decode($request->getBody(), true);
      $start = $data["start"]? $data["start"] : '2016-10-13';//$data["start"];
      $end = $data["end"]? $data["end"]: '2016-10-13';//$data["end"];
      $products = \App\Models\Product::whereBetween('created_at',array($start, $end))->with(['product_type','fournisseur', 'stock'])->get();
      return json_encode(["status"=>"200","products"=>$products]);
    }

    public function updateAchat(Request $request, Response $response, $args){
      $data = json_decode($request->getBody(), true);
      $product = \App\Models\Product::find($data["id"]);
      $product["name"] = $data["name"];
      $product["price"] = $data["price"];
      $product["ref_four"] = $data["fournisseur"]["id"];
      $product["ref_type"] = $data["product_type"]["id"];
      if($product->save()){
        $stock = \App\Models\Stock::find($data["stock"]["id"]);
        $stock["qty"] = $data["stock"]["qty"];
        if($stock->save()){
          $product = \App\Models\Product::whereBetween('created_at',array($start, $end))->with(['product_type','fournisseur', 'stock'])->get();
          return json_encode(["status"=>"200","achat"=>$product]);
        }else{
          return json_encode(["status"=>"304","message"=>"update failed"]);
        }
      }else{
        return json_encode(["status"=>"304","message"=>"update failed"]);
      }
    }

    public function filterProducts(Request $request, Response $response, $args){
      $data = json_decode($request->getBody(), true);
      $start = $data["start"] ? $data["start"] : date("Y-m-d");
      $end = $data["end"] ? $data["end"] : date("Y-m-d");
      $product = \App\Models\Achat::whereBetween('created_at', array($start, $end))->with(['product_type','fournisseur', 'stock'])->get();
      return json_encode(["status"=>"200","products"=>$product]);
    }

}
