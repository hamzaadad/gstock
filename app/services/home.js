app.factory('HomeServcie', function(Data, $state) {
    return {
        data: function(){
          Data.get('dashboard').then(function(resp){
            console.log(resp);
          }, function(err){
            console.log(err);
          })
        }
    };
});
