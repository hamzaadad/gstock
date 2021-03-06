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

    $json = json_decode($request->getBody(), true);
    //$user = $this->db->table('users')->where(array('user_name'=> $json["customer"]['user'], 'password'=>$json['costumer']['password']))->get();
    $user = $this->db->table('users')->where(array('user_name'=> 'admin', 'password'=>'admin'))->get();
    if(count($user) > 0){
      unset($user[0]->password);
      $_SESSION['isLoged'] = true;

      //var_dump($_SESSION);
      return json_encode(
        array(
          'status' => 'success',
          'user' => $user[0]
        )
      , true);
    }else{
      return json_encode(array(
        "status"=> 'error',
        "message"=> "Un erreur s'est produit!"
      ));
    }
  }

  public function doLogout(Request $request, Response $response, $args){
    $_SESSSION['isLoged'] = false;
    //session_destroy();
    return $response;
  }

  public function isLoged(Request $request, Response $response, $args){
    //var_dump($_SESSION);
    if(isset($_SESSION['isLoged']) && $_SESSION['isLoged'] == true){
      return json_encode(array(
        'status'=> 'loged'
      ));
    }else{
      return json_encode(array(
        'status'=> 'whoareyou?'
      ));
    }

  }

}
