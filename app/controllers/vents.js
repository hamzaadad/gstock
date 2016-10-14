app.controller('ventsCtrl', function ($scope, $state, $rootScope, $http, Data) {
    $scope.go = function(state){
      $state.go(state);
    }
    $scope.vents = {
      'qty':1,
      'avance':0,
      'price':0
    }
    Date.prototype.humain = function(sep) {
      var mm = ((this.getMonth() + 1) > 9) ? this.getMonth() + 1: "0" + (this.getMonth() + 1); // getMonth() is zero-based
      var dd = ((this.getDate()) > 9) ? this.getDate() : "0" + (this.getDate());
      return [this.getFullYear(),mm, dd].join(sep);
    };
    $scope.products =[];
    $scope.fournisseurs = [];
    $scope.loadData = function(){
      $scope.isLoaded = false;
      $scope.cantLoad = false;
      Data.get('clients').then(function(res){
        $scope.clients = res.clients
      }, function(err){
        $scope.isLoaded = true;
        $scope.cantLoad = true;
      });
      Data.get('vents/today').then(function(res){
        $scope.ventsHistory = res.vents;
      }, function(err){
        $scope.isLoaded = true;
        $scope.cantLoad = true;
      })
      Data.get('productTypes').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.types = resp.productTypes;
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }
        /*
        if('status' in resp && resp.status == '200'){
          var qties = {};
          var mySet = new Set();
          $scope.stocks = resp.stocks.filter(function(x) {
            var key = x.product.ref_type, isNew = !mySet.has(key);
            if (isNew){
              mySet.add(key);
              if(x.product){
                $scope.products.push(x.product);
              }
              if(x.fournisseur){
                $scope.fournisseurs.push(x.fournisseur);
              }
            }
            if(x.product.ref_type in qties){
              qties[x.product.ref_type] = qties[x.product.ref_type] +  x.qty
            }else{
              qties[x.product.ref_type] = x.qty
            }

            return isNew;
          });
          $scope.stocks.map(function(elm){
            if(elm.product.ref_type in qties){
              elm.qty = qties[elm.product.ref_type];
            }
          });
          Data.get('clients').then(function(res){
            $scope.clients = res.clients
          }, function(){
            $scope.isLoaded = true;
            $scope.cantLoad = true;
          });
          Data.get('vents/'+ new Date().humain("/")).then(function(res){
            $scope.ventsHistory = res.vents;
          }, function(err){
            $scope.isLoaded = true;
            $scope.cantLoad = true;
          })
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }
        */
      }, function(err){
        $scope.isLoaded = true;
        $scope.cantLoad = true;
      });

    }


    $scope.select = function(stock){
      $scope.selected = stock;
    }
    $scope.watchInput = function(type, min, max){
      if($scope.vent[type] < min){
        $scope.vent[type] = min
      }else if($scope.vent[type] > max){
        $scope.vent[type] = max
      }
    }
    $scope.whatStock = function(){
      $scope.prodprice = 0
      Data.get('product/upm/'+$scope.vent.id+'/date/' + new Date().humain('/')).then(function(resp){
        $scope.prodprice = resp.upm[0].price;
        console.log(resp);
      }, function(err){
        alert('Impossible de charger le pris unitaire!');
      });
        /*$scope.selected =  $scope.stocks.filter(function(elm){
          return elm.id == $scope.vent.id
        })[0]*/
    }

    $scope.save = function(vents){
      console.log(vents);
    }

    $scope.loadCredits = function(id){
      if(id != -1){
        Data.get('client/credits/'+id).then(function(resp){
          console.log(resp);
            $scope.credits = {
              client_id: id,
              sold:0
            }
            resp.credit.map(function(elm){
              $scope.credits.sold = parseInt($scope.credits.sold) + elm.amout;
            });
        }, function(err){
          console.log(err)
        })
      }
    }
    $scope.saveCredit = function(credits){
      if(credits.client_id){
        Data.post('client/credits', credits).then(function(resp){
          $state.reload();
        }, function(){
          alert('Impossible d\'effectuer cette operation!');
        })
      }
    }
    $scope.saveAchat = function(vent, price){
      if(vent){
        vent['price'] = price;
        vent['date'] = new Date().humain("-");
        vent['resp'] = vent['advance'] - vent['avous']
        Data.post('client/achat', vent).then(function(resp){
          $state.reload();
        }, function(err){
          alert('Immpossible d\'effectuer cette operation!')
        })
      }
    }
    $scope.loadData();
});
