app.controller('homeCtrl', function ($scope, $state, $rootScope, $http, Data) {
    $scope.go = function(state){
      $state.go(state);
    }
});
