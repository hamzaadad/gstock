app.controller('fournisseursCtrl', function ($scope, $state, $rootScope, $http, Data, ngDialog, $window) {
  $scope.loadData = function(){
    $scope.isLoaded = false;
    $scope.cantLoad = false;
    Data.get('fournisseurs').then(function(resp){
      $scope.isLoaded = true;
      $scope.cantLoad = false;
      if('fournisseurs' in resp){
        $scope.fournisseurs = resp.fournisseurs;
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
    Data.delete('fournisseurs/' + $scope.selected.id).then(function(resp){
      if('status' in resp && resp.status == 'ok'){
        $scope.fournisseurs = $scope.fournisseurs.filter(function(elm){
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
    ngDialog.open({
      template: '/partials/modals/fournisseur.add.html',
      className: 'ngdialog-theme-plain',
      scope: $scope,
      controller: function($scope, Data) {
        $scope.four = $scope.selected;
        $scope.save = function(four){


          Data.put('fournisseurs', four).then(function(resp){
            if('status' in resp && resp.status == 'ok'){
              //four['id'] = resp.id;
              //$scope.fournisseurs.push(four);
              $scope.fournisseurs.map(function(elm){
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
          Data.post('fournisseurs', four).then(function(resp){
            if('status' in resp && resp.status == 'ok'){
              four['id'] = resp.id;
              $scope.fournisseurs.push(four);
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
    var url = $state.href('printer', {type:'fournisseur.list' ,data:JSON.stringify($scope.fournisseurs)});
    window.open(url,'_blank');
  }
  $scope.loadData();
});
