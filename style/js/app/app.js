'use strict';
(function(angular) {
  angular.module('filafacil', [
    'ngResource'
  ])
  .constant('BASEURLS', {
    BASE: 'http://127.0.0.1/filafacil/',
    BASE_API: 'http://127.0.0.1/filafacil/app.php/'
  });
}(angular));
