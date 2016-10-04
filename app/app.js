var app = angular.module('myApp', ['ui.router', 'ngAnimate', 'toaster']);

app.config(function($stateProvider, $urlRouterProvider) {


  $urlRouterProvider.otherwise('/login');

  $stateProvider
  .state('Login', {
    url: '/login',
    templateUrl: 'partials/login.html',
    controller: 'authCtrl'
  })
  .state('Logout', {
    url:'/logout' ,
    templateUrl: 'partials/login.html',
    controller: 'logoutCtrl'
  })
  .state('Signup', {
    url: '/signup',
    templateUrl: 'partials/signup.html',
    controller: 'authCtrl'
  })
  .state('dashboard', {
    url: '/dashboard',
    abstract: true,
    templateUrl: 'partials/dashboard.html',
    controller: 'authCtrl'
  })
  .state('dashboard.home', {
    url:'^/home',
    templateUrl: 'partials/dashboard.home.html'
  });
})
.run(function ($rootScope, $location, Data) {
  $rootScope.$on("$routeChangeStart", function (event, next, current) {
    $rootScope.authenticated = false;
    Data.get('session').then(function (results) {
      if (results.uid) {
        $rootScope.authenticated = true;
        $rootScope.uid = results.uid;
        $rootScope.name = results.name;
        $rootScope.email = results.email;
      } else {
        var nextUrl = next.$$route.originalPath;
        if (nextUrl == '/signup' || nextUrl == '/login') {

        } else {
          $location.path("/login");
        }
      }
    });
  });
});
