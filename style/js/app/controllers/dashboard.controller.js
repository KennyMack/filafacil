'use strict';

(function (angular) {
  angular.module('filafacil')
    .controller('dashboardController', [
      '$interval',
      'BASEURLS',
      '$http',
      function ($interval, BASEURLS,  $http) {
        var self = this;

        self.datatable = [];
        self.interval = null;
        self.time = 1;


        self.loadPage = function () {
          self.update();
          self.interval = $interval(function () {
            self.time += 1;
            if (self.time > 5){
              self.time = 1;
              self.update();
            }
          }, 1000);
        };

        self.update = function () {
          self.datatable = [];
          $http({
            method: 'GET',
            url: BASEURLS.BASE_API + 'fila-dash'
          })
          .then(function (result, response) {
            if (result.data.status) {
              self.datatable = result.data.data;
            }
          },
          function(err) {
            console.log(err);
          });
        };

      }]);
}(angular));
