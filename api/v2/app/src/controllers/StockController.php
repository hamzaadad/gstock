<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
        // test if year add year to Date
        // test if month add month
        // test if day add day
        // get model get a list of product
        return 'ok';
      }else{
        return "ko";
      }
    }

}
