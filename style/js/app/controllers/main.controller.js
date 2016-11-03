'use strict';
(function(angular){
  angular.module('filafacil')
    .controller('mainController', [
      '$window',
      'BASEURLS',
      'authFactory',
      '$http',
      function($window, BASEURLS, authFactory, $http){
        var self = this;
        self.isLogged = function () {
          return authFactory.isAuthenticated();
        };

        self.getName = function () {
          var token = authFactory.getToken();

          if (token) {
            return token['name'];
          }

          return '';
        };

        self.openDashBoard = function () {
          $window.open('dashboard.php', '_blank');
        };

        self.openLogin = function () {
          window.location = BASEURLS.BASE + 'views/login.php';
        };

        self.doLogoff = function () {
          var token = authFactory.getToken();

          if (!token) {
            authFactory.dologoff();
            window.location=BASEURLS.BASE + 'views/home.php';
          }
          else {
            var data = {
              'email': token['email']
            };

            $http({
              method: 'POST',
              url: BASEURLS.BASE_API + 'funcionario-logoff',
              data: data
            })
            .then(function (result, response) {
              authFactory.dologoff();
              window.location=BASEURLS.BASE + 'views/home.php';
              self.loading = false;
            },
            function(err) {
              self.loading = false;
              console.log(err);
            });
          }

        };





      }]);
}(angular));
