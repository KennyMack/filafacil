'use strinct';

(function (angular) {
  angular.module('filafacil')
    .controller('loginController', [
      '$window',
      '$location',
      'BASEURLS',
      'LOCALNAME',
      'authFactory',
      '$http',
      function ($window, $location, BASEURLS, LOCALNAME, authFactory, $http) {
        var self = this;
        self.loading = false;

        self.email = '';
        self.pass = '';

        self.loadPage = function () {
          if (authFactory.isAuthenticated()){
            window.location = BASEURLS.BASE + 'views/home.php';
          }
          else
            authFactory.dologoff();
        };

        self.validate = function() {
          self.messages = [];

          if ((!self.email) ||
             (self.email == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Informe o e-mail.'
            });
          }

          if ((!self.pass) ||
             (self.pass == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Informe a senha.'
            });
          }

          return self.messages.length <= 0;
        };

        self.doLogin = function () {
          if (self.validate()) {
            self.loading = true;
            var data = {
              'email': self.email,
              'senha': self.pass
            };

            $http({
              method: 'POST',
              url: BASEURLS.BASE_API + 'funcionario-login',
              data: data
            })
            .then(function (result, response) {
              if (result.data.status) {
                authFactory.setToken({
                  'idEmployee': result.data.data.codfuncionario,
                  'email': self.email,
                  'nome': result.data.data.nome
                });
                window.location = BASEURLS.BASE + 'views/home.php';
              }
              else {
                self.messages.push({
                  id: Math.floor((Math.random() * 100) + 1),
                  message: 'E-mail e/ou senha inválido.'
                });
                authFactory.dologoff();
              }


              self.loading = false;
            },
            function(err) {
              self.loading = false;
              console.log(err);
            });
          }

        };

        self.clickCancel = function () {
          authFactory.dologoff();
          window.location=BASEURLS.BASE + 'views/home.php';
        };



        //self.result = (MD5(value));

        /*self.setToken = function (login) {
          var token = {
            dateexp: new Date(Date.now() + (24 *3600*1000))
          };


          //
          //JSON

        };

        self.getToken = function () {
           return JSON.parse($window.localStorage.getItem(LOCALNAME.SESSION));
        };



        self.isAuthenticated = function () {
          var session = self.getToken();

          if (session) {
            if (!self.isExpired()) {
              return true;
            }
            return false;
          }

          return false;
        };

        self.isExpired = function (json) {
          return new Date(json['dateexp']) <= Date.now();
        };

        self.logoff = function () {
          $window.localStorage.removeItem(LOCALNAME.SESSION);
        };*/

      }]);
}(angular))
