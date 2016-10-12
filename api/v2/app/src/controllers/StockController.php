<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DB;
require_once __dir__.'/../models/Stock.php';
require_once __dir__.'/../models/Product.php';
require_once __dir__.'/../models/Fourniseur.php';

final class StockController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
        //$this->logger->info("Home page action dispatched");

        //$this->flash->addMessage('info', 'Sample flash message');

        //$this->view->render($response, 'home.twig');
        return $response;
    }
    public function getList(Request $request, Response $response, $args){
      if(isset($_SESSION['isLoged'])){
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
        // need to group by product type
          $stocks = \App\Models\Stock::with('product', 'fournisseur')->where('date', 'Like' , "%$date%")->get();

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
    public function delete(Request $request, Response $response, $args){
      if(!empty($args['id'])){
        $stock = \App\Models\Stock::find($args[id]);
        if($stock->delete()){
          return json_encode(
            array(
              'status'=>'ok'
            )
          );
        }else{
          return json_encode(
            array(
              'status'=>'ko'
            )
          );
        }
      }else{
        return json_encode(
          array(
            'status'=>'ko'
          )
        );
      }
    }
}
