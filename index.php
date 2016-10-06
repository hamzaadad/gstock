<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>G-stock by Hamza ADAD</title>
  <!-- Bootstrap -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <style>
  a {
    color: orange;
  }
  </style>
</head>
<body ng-cloak="">
    <div class="app-holder" ui-view></div>
</body>
<!-- Libs -->
<script src="js/angular.min.js"></script>
<script src="js/angular-route.min.js"></script>
<script src="js/angular-animate.min.js" ></script>
<script src="js/angular-ui-router.min.js" ></script>
<script src="js/toaster.js"></script>

<!-- my shit -->
<script src="app/app.js"></script>

<!-- Services -->
<script src="app/services/authMiddleware.js"></script>
<script src="app/services/home.js"></script>
<script src="app/data.js"></script>

<!-- Directives -->
<script src="app/directives.js"></script>

<!-- Controllers -->
<script src="app/authCtrl.js"></script>
<script src="app/controllers/home.js"></script>
<script src="app/controllers/stock.js"></script>
<script src="app/controllers/achats.js"></script>
<script src="app/controllers/vents.js"></script>
<script src="app/controllers/products.js"></script>
</html>
