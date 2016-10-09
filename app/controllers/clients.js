app.controller('clientsCtrl', function ($scope, $state, $rootScope, $http, Data, ngDialog, $window) {
  $scope.loadData = function(){
    $scope.isLoaded = false;
    $scope.cantLoad = false;
    Data.get('clients').then(function(resp){
      $scope.isLoaded = true;
      $scope.cantLoad = false;
      if('clients' in resp){
        $scope.clients = resp.clients;
      }else{
        $scope.isLoaded = true;
        $scope.cantLoad = true;
      }
    }, function(err){
      $scope.isLoaded = true;
      $scope.cantLoad = true;
    });
  }
  $scope.showDelete = function(){
    if(!$scope.selected){
      alert('Selection un fournisseur a supprimer!');
      return;
    }
    Data.delete('clients/' + $scope.selected.id).then(function(resp){
      if('status' in resp && resp.status == 'ok'){
        $scope.clients = $scope.clients.filter(function(elm){
          return elm.id != $scope.selected.id;
        });
        $scope.selected = null;
        ngDialog.close();
      }else{
        alert("Erreur de supprission");
      }
    }, function(err){
      alert("Erreur de supprission");
    })
  }
  $scope.showEdit = function(){
    if(!$scope.selected){
      alert('Selection un fournisseur a moddifier!');
      return;
    }
    $scope.selected['nom'] = $scope.selected['name']
    ngDialog.open({
      template: '/partials/modals/fournisseur.add.html',
      className: 'ngdialog-theme-plain',
      scope: $scope,
      controller: function($scope, Data) {
        $scope.four = $scope.selected;
        $scope.save = function(four){


          Data.put('clients', four).then(function(resp){
            if('status' in resp && resp.status == 'ok'){
              //four['id'] = resp.id;
              //$scope.fournisseurs.push(four);
              $scope.clients.map(function(elm){
                if(elm.id == resp.id){

                  elm = four
                }
              })
              $scope.isLoaded = true;
              $scope.cantLoad = false;
              ngDialog.close();
            }else{
              alert('Impossible d\'enregister!');
            }
          }, function(err){
            alert('Impossible d\'enregister!')
          })
        }
      }
    });
  }
  $scope.showAdd = function(){
    ngDialog.open({
      template: '/partials/modals/fournisseur.add.html',
      className: 'ngdialog-theme-plain',
      scope: $scope,
      controller: function($scope, Data) {
        $scope.save = function(four){
          Data.post('clients', four).then(function(resp){
            if('status' in resp && resp.status == 'ok'){
              four['id'] = resp.id;
              four['name'] = four['nom']
              $scope.clients.push(four);
              $scope.isLoaded = true;
              $scope.cantLoad = false;
              ngDialog.close();
            }else{
              alert('Impossible d\'enregister!');
            }
          }, function(err){
            alert('Impossible d\'enregister!')
          })
        }
      }
    });
  }
  $scope.select = function(four){
    $scope.selected = four;
  }

  $scope.print = function(){
    var url = $state.href('printer', {type:'fournisseur.list' ,data:JSON.stringify($scope.clients)});
    window.open(url,'_blank');
  }
  $scope.loadData();
});
