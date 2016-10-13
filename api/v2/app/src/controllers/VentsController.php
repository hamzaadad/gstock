<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DB;
require_once __dir__.'/../models/Vents.php';
require_once __dir__.'/../models/Product.php';
require_once __dir__.'/../models/Clients.php';
require_once __dir__.'/../models/Users.php';

final class VentsController extends BaseController
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
          $achats = json_decode(json_encode(\App\Models\Vents::with('product', 'client', 'user')->where('date', 'Like' , "%$date%")->get(), true));
        return json_encode(
          array(
            'status' => '200',
            'vents' => $achats
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
