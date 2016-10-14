app.controller('homeCtrl', function ($scope, $state, $rootScope, $http, Data) {
  Date.prototype.humain = function(sep) {
    var mm = ((this.getMonth() + 1) > 9) ? this.getMonth() + 1: "0" + (this.getMonth() + 1); // getMonth() is zero-based
    var dd = ((this.getDate()) > 9) ? this.getDate() : "0" + (this.getDate());
    return [this.getFullYear(),mm, dd].join(sep);
  };
    $scope.go = function(state){
      $state.go(state);
    }
    $scope.loadData = function(){
      Data.get('productTypes/uph').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.types = resp.productTypes;
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }
      }, function(err){
        console.log(err)
      })
      Data.get('vents/today').then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.vents = resp.vents;
          $scope.ventsTotal = resp.vents.map(function(elm){
            return elm.amout
          }).reduce(function(pv, cv) { return pv + cv; }, 0);
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }
      }, function(err){
        console.log(err)
      })
      Data.get('achats/'+new Date().humain('/')).then(function(resp){
        if('status' in resp && resp.status == '200'){
          $scope.achats = resp.achats;
          // $scope.ventsTotal = resp.vents.map(function(elm){
          //   return elm.amout
          // }).reduce(function(pv, cv) { return pv + cv; }, 0);
          $scope.isLoaded = true;
          $scope.cantLoad = false;
        }
      }, function(err){
        console.log(err)
      })
    };

    $scope.loadData();
});
