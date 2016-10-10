app.controller('stockCtrl', function ($scope, $state, $rootScope, $http, Data) {
  Date.prototype.humain = function() {
        var mm = ((this.getMonth() + 1) > 9) ? this.getMonth() + 1: "0" + (this.getMonth() + 1); // getMonth() is zero-based
        var dd = ((this.getDate()) > 9) ? this.getDate() : "0" + (this.getDate());
        return [this.getFullYear(),mm, dd].join('/');
    };

  $scope.loadData = function(){
    $scope.isLoaded = false;
    $scope.cantLoad = false;
    Data.get('stock/date/'+new Date().humain()).then(function(resp){
      $scope.isLoaded = true;
      $scope.cantLoad = false;
    }, function(err){
      $scope.isLoaded = true;
      $scope.cantLoad = true;
    });
  }
  $scope.loadData();
});
