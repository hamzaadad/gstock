<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require_once __dir__.'/../models/Clients.php';
require_once __dir__.'/../models/ClientWallet.php';
require_once __dir__.'/../models/Stock.php';
final class ClientsController extends BaseController
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
        $clients = \App\Models\Client::all();
        return json_encode(
          array(
            'status' => '200',
            'clients' => $clients
          )
        );
      }else{
        return "ko";
      }
    }
    public function save(Request $request, Response $response, $args){
      $json = json_decode($request->getBody(), true);
      if(!empty($json['nom']) && !empty($json['tell'])){
        $fourn = new \App\Models\Client(array(
          'name' => $json['nom'],
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
        $fourn = \App\Models\Client::where('id', $json['id']);
        if($fourn->update(
          array(
            'name' => $json['nom'],
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
        $fourn = \App\Models\Client::find($args[id]);
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
    public function getCredits(Request $request, Response $response, $args){
      if(isset($_SESSION['isLoged'])){
        $cw = \App\Models\ClientWallet::where('ref_cli', $args['id'])->get();
        return json_encode(
          array(
            'status'=>'200',
            'credit'=>$cw
          )
        );
      }
    }
    public function setCredits(Request $request, Response $response, $args){
      if(isset($_SESSION['isLoged'])){
        $json = json_decode($request->getBody(), true);
        $cw = new \App\Models\ClientWallet(
          array(
            'ref_cli' => $json['client_id'],
            'amout' => $json['givin'] * -1
          )
        );
        if($cw->save()){
          return json_encode(
            array('status' => 'ok')
          );
        }else{
          return json_encode(
            array('status' => 'ko' )
          );
        }
      }
    }
    public function setAchats(Request $request, Response $response, $args){
      $json = json_decode($request->getBody(), true);

      $stock = \App\Models\Stock::where(array(
        'product_id' => intVal($json['id']),
        'date' => $json['date']
      ));
      echo (intVal($stock->qty) - intVal($json['qty']));
      if($stock->update(
        array(
          'qty' => (intVal($stock->qty) - intVal($json['qty']))
        )
      )){
        $cwTotal = new \App\Models\ClientWallet(
          array(
            'ref_cli' => $json['client_id'],
            'amout' => $json['price'] * $json['qty']
          )
        );
        if($cwTotal->save()){
          $cwAvance = new \App\Models\ClientWallet(
            array(
              'ref_cli' => $json['client_id'],
              'amout' => $json['advance'] - $json['avous']
            )
          );
          if($cwAvance->save()){
            return json_encode(
              array('status' => 'ok')
            );
          }else{
            return json_encode(
              array('status' => 'ko' )
            );
          }
        }else{
          return json_encode(
            array('status' => 'ko1' )
          );
        }
      }else{
        return json_encode(
          array('status' => 'ko0' )
        );
      }

    }
}
