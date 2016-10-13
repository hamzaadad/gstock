app.directive('bindOnce', function() {
    return {
        scope: true,
        link: function( $scope, $element ) {
            setTimeout(function() {
                $scope.$destroy();
            }, 0);
        }
    }
});
app.controller('achatsCtrl', function ($scope, $state, $rootScope, $http, Data, ngDialog) {
  $scope.todayAchats = []
  $scope.stock = {qty: 1, price: 0}
    $scope.go = function(state){
      $state.go(state);
    }
    $scope.loadData = function(){
      Data.get('productTypes').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.productTypes = resp.productTypes;
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }else{
          $scope.isLoaded = false;
          $scope.cantLoad = true;
        }

      }, function(err){
        $scope.isLoaded = false;
        $scope.cantLoad = true;
      })

      Data.get('fournisseurs').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.fournisseurs = resp.fournisseurs;
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }else{
          $scope.isLoaded = false;
          $scope.cantLoad = true;
        }

      }, function(err){
        $scope.isLoaded = false;
        $scope.cantLoad = true;
      })

      Data.post('achats').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.todayAchats = resp.products;
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }else{
          $scope.isLoaded = false;
          $scope.cantLoad = true;
        }

      }, function(err){
        $scope.isLoaded = false;
        $scope.cantLoad = true;
      })
    }

    $scope.loadData();

    $scope.saveAchat = function(){
      Data.post('product', $scope.stock).then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.todayAchats.push(resp.product);
        }else{
          
        }

      }, function(err){
        
      })
    }
    $scope.ShowEditAchat =  function(){
      if(!$scope.selected){
        alert('Selection un achat a moddifier!');
        return;
      }
      ngDialog.open({
        template: '/partials/modals/achat.edit.html',
        className: 'ngdialog-theme-plain',
        scope: $scope,
        controller: function($scope, Data) {
          $scope.editing = $scope.selected;
          $scope.save = function(){
              Data.put('achat', $scope.editing).then(function(resp){
                if('status' in resp && resp.status == '200'){
                  console.log('resp',resp.achat)
                }else{
                  
                }

                }, function(err){
                  
                })
              }
        }
      });
    }

    $scope.select = function(prod){
      $scope.selected = prod;
    }

    $scope.filterAchats = function(){
      console.log('filterDates',$scope.filterDates);
      Data.post('achats', $scope.filterDates).then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.todayAchats = resp.products;
        }else{
          
        }

      }, function(err){
        
      })
    }
});
