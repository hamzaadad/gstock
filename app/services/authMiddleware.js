app.factory('authMiddleware', function(Data, $state) {
    return {
        run : function(event){
          Data.get('isLoged').then(function(resp){
            console.log(resp);
            if('status' in resp && resp.status != 'whoareyou?'){
                console.log('welcome');
            }else{
              alert('who are you ?')
              $state.go('Login');
            }

          }, function(err){
            $state.go('Login  ')
          })
        }
    };
});
