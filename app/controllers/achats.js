app.controller('achatsCtrl', function ($scope, $state, $rootScope, $http, Data) {
    $scope.go = function(state){
      $state.go(state);
    }
    $scope.loadData = function(){
      Data.get('product/grouped').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.products = resp.products;
          $scope.isLoaded = true;
          $scope.cantLoad = true;
        }else{
          $scope.isLoaded = true;
          $scope.cantLoad = true;
        }

      }, function(err){
        $scope.isLoaded = true;
        $scope.cantLoad = true;
      })
    };

    $scope.loadData();
});
