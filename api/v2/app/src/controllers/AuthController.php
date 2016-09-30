<?php
namespace App\Controller;

use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class AuthController extends BaseController
{
    protected $table;
    protected $app;
    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("auth");

        $this->flash->addMessage('info', 'Sample flash message');
        $this->flash->addMessage('error', 'Un erreur s\'est produit!');

        $this->view->render($response, 'home.twig');

        return $response;
    }

    public function doLogin(Request $request, Response $response, $args){
      //return 'doing login';
      //$user = $this->db->table('users')->where(array('user_name'=> $args['user'], 'password'=>$args['password']))->get();
      //if($user && )

       $json = $request->getBody();

      var_dump($json);
      return $response;
    }

}
