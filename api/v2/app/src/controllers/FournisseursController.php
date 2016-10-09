<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require_once __dir__.'/../models/Fourniseur.php';
final class FournisseursController extends BaseController
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
        $fournisseur = \App\Models\Fourniseur::all();
        return json_encode(
          array(
            'status' => '200',
            'fournisseurs' => $fournisseur
          )
        );
      }else{
        return "ko";
      }
    }
    public function save(Request $request, Response $response, $args){
      $json = json_decode($request->getBody(), true);
      if(!empty($json['nom']) && !empty($json['tell'])){
        $fourn = new \App\Models\Fourniseur(array(
          'nom' => $json['nom'],
          'tell' => $json['tell'],
          'address' => $json['address'],
          'city' => $json['city']
        ));
        if($fourn->save()){
          return json_encode(
            array('status' => 'ok', 'id'=> $fourn->id)
          );
        }else{
          return json_encode(
            array('status' => 'ko' )
          );
        }
          // call model save
      }else{
        return json_encode(
          array('status' => 'ko', 'message' => 'empty params' )
        );
      }
    }
    public function update(Request $request, Response $response, $args){
      $json = json_decode($request->getBody(), true);
      if(!empty($json['nom']) && !empty($json['tell'])){
        $fourn = \App\Models\Fourniseur::where('id', $json['id']);
        if($fourn->update(
          array(
            'nom' => $json['nom'],
            'tell' => $json['tell'],
            'address' => $json['address'],
            'city' => $json['city']
          )
        )){
          return json_encode(
            array('status' => 'ok', 'id'=> $fourn->id)
          );
        }else{
          return json_encode(
            array('status' => 'ko' )
          );
        }
      }else{
        return json_encode(
          array('status' => 'ko', 'message' => 'empty params' )
        );
      }
    }
    public function delete(Request $request, Response $response, $args){
      if(!empty($args['id'])){
        $fourn = \App\Models\Fourniseur::find($args[id]);
        if($fourn->delete()){
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
