<!doctype html>
<html ng-app="miApp">
  <head>
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js')}}
    {{HTML::script('js/angular/app.js')}}
  </head>
  <body ng-controller="angularCtrl">
    <div>
      <button ng:click="fetch()">Load date</button>
      <hr>
      <h1>Date is [[date]]!</h1>
    </div>
  </body>
</html>