app.controller('stockCtrl', function ($scope, $state, $rootScope, $http, Data) {
  Date.prototype.humain = function() {
    var mm = ((this.getMonth() + 1) > 9) ? this.getMonth() + 1: "0" + (this.getMonth() + 1); // getMonth() is zero-based
    var dd = ((this.getDate()) > 9) ? this.getDate() : "0" + (this.getDate());
    return [this.getFullYear(),mm, dd].join('/');
  };
  $scope.products =[];
  $scope.fournisseurs = [];
  $scope.loadData = function(){
    $scope.isLoaded = false;
    $scope.cantLoad = false;
    Data.get('stock/date/'+new Date().humain()).then(function(resp){
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
            console.log(qties[elm.product.ref_type])
            elm.qty = qties[elm.product.ref_type];
          }
        });

        $scope.isLoaded = true;
        $scope.cantLoad = false;
      }

    }, function(err){
      $scope.isLoaded = true;
      $scope.cantLoad = true;
    });
  }
  $scope.loadUpm = function(id){
    $scope.uphLoaded = false;
    $scope.uph = null;
    Data.get('product/upm/'+id+'/date/'+ new Date().humain()).then(function(resp){
      if('status' in resp && resp.status == "200"){
        $scope.uphLoaded = true;
        $scope.uph = resp.upm[0].price;
      }else{
        $scope.uphLoaded = true;

        alert('Impossible de charger le prix unitaire!');
      }
    }, function(err){
      $scope.uphLoaded = true;
      console.log('err', err);
    })
  }
  $scope.select = function(stock){
    $scope.loadUpm(stock.product.id);
    $scope.selected = stock;
  }
  $scope.delete = function(id){

    console.log(id);
    Data.delete('stock/'+id).then(function(resp){
      if('status' in resp && resp.status == "200"){
        $scope.stocks =$scope.stocks.filter(function(elm){
          return elm.id != id;
        });
      }
    }, function(err){
      alert('id', id)
    })
  }
  $scope.loadData();
});
