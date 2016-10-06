app.controller('authCtrl', function ($scope, $state, $rootScope, $location, $http, Data) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.doLogin = function (customer) {
        Data.post('login', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
              $state.transitionTo('dashboard.home');
              //console.log('good')
                //$location.path('dashboard');
            }else{
              alert(results.message);
            }
        }, function(err){
          console.log(err);
        });
    };
    $scope.signup = {email:'',password:'',name:'',phone:'',address:''};
    $scope.signUp = function (customer) {
        Data.post('signUp', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
                $location.path('dashboard');
            }
        });
    };
    $scope.logout = function () {
      $location.path('login');
        Data.get('logout').then(function (results) {
            //Data.toast(results);
            $location.path('login');
        });
    }
});
