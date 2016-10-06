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
    templateUrl: 'partials/dashboard.home.html',
    controller: 'homeCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.stock', {
    url:'^/stock',
    templateUrl: 'partials/dashboard.stock.html',
    controller: 'stockCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.achats', {
    url:'^/achats',
    templateUrl: 'partials/dashboard.achats.html',
    controller: 'achatsCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.vents', {
    url:'^/vents',
    templateUrl: 'partials/dashboard.vents.html',
    controller: 'ventsCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.products', {
    url:'^/products',
    templateUrl: 'partials/dashboard.products.html',
    controller: 'productsCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.clients', {
    url:'^/clients',
    templateUrl: 'partials/dashboard.clients.html',
    controller: 'clientsCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
  .state('dashboard.fournisseurs', {
    url:'^/fournisseurs',
    templateUrl: 'partials/dashboard.fournisseurs.html',
    controller: 'fournisseursCtrl',
    middleware: ['authMiddleware'],
    ifLoged: ['initData']
  })
})
.run(function ($rootScope, $location, Data, $injector) {
   $rootScope.$on('$stateChangeStart', function (event, toState, toParams) {
      var currentState = toState;
      $rootScope.current  = toState.name;
      if(currentState && currentState.hasOwnProperty('middleware')){
           if (typeof currentState.middleware === 'object') {
               angular.forEach(currentState.middleware, function (middleWare) {
                 try{
                     $injector.get(middleWare).run(event);
                 }catch(e){
                     console.error('the factory : '+ middleWare+' does not exist:' , e);
                 }
               });
               return;
           }
       }
   });
});
