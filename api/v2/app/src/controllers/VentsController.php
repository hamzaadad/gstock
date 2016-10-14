<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DB;
require_once __dir__.'/../models/Vents.php';
require_once __dir__.'/../models/ProductType.php';
require_once __dir__.'/../models/Clients.php';
require_once __dir__.'/../models/Users.php';
require_once __dir__.'/../models/ClientWallet.php';
require_once __dir__.'/../models/uph.php';

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
        $date =  date("Y-m-d",mktime(0, 0, 0));

        $achats = \App\Models\ClientWallet::with('product', 'client', 'uph')->where('date', $date)->get();
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
