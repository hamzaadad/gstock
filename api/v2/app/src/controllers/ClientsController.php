<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require_once __dir__.'/../models/Clients.php';
require_once __dir__.'/../models/ClientWallet.php';
require_once __dir__.'/../models/So.php';
final class ClientsController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
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
      //$stock = \App\Models\Stock::where('date', $json['date']));
      $so = \App\Models\So::where(array(
        'ref_type' => $json['id'],
        'date' => '2016-10-09'//$json['date']
      ))->take(1);

      //var_dump(json_decode(json_encode($so->get(), true)));die;

      //echo $stock->get()))." ";
      //echo (intVal($json['qty']))." ";
      //echo (intVal($stock->qty) - intVal($json['qty']))." ";
      if($so->update(
        array(
          'qty' => $so->get()[0]['qty'] - intVal($json['qty'])
        )
      )){
        $cwTotal = new \App\Models\ClientWallet(
          array(
            'ref_cli' => $json['client_id'],
            'amout' => $json['price'] * $json['qty'],
            'date' => strtotime(date( "Y-m-d",mktime(0, 0, 0))),
            'qty' => $json['qty']
          )
        );
        if($cwTotal->save()){
          $cwAvance = new \App\Models\ClientWallet(
            array(
              'ref_cli' => $json['client_id'],
              'amout' => ($json['advance'] - $json['avous']) * -1,
              'avout' => $json['avous'],
              'date' => strtotime(date( "Y-m-d",mktime(0, 0, 0))),
              'qty' => $json['qty']
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
