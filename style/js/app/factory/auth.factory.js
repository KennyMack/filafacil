'use strict';

(function (angular) {
  angular.module('filafacil')
    .factory('authFactory', [
      '$window',
      '$location',
      'BASEURLS',
      'LOCALNAME',
      function ($window, $location, BASEURLS, LOCALNAME) {
        return {
          setToken: function (login) {
            console.log(login);
            var token = {
              rand: Math.floor((Math.random() * 99999999) + 1),
              idemployee: login.idEmployee,
              email: login.email,
              name: login.nome.split(' ')[0],
              date: Date.now(),
              dateexp: Date.now() + (24 *3600*1000),
            };

            token['hash']= MD5(JSON.stringify(token));
            $window.localStorage.setItem(LOCALNAME.SESSION, JSON.stringify(token));
          },
          getToken: function () {
            return JSON.parse($window.localStorage.getItem(LOCALNAME.SESSION));
          },
          isAuthenticated: function () {
            var token = this.getToken();

            if (token) {
              if (!this.isExpired(token)) {
                return true;
              }
              return false;
            }

            return false;
          },
          isExpired: function (token) {
            return new Date(token['dateexp']) <= new Date(Date.now() - (24 *3600*1000));
          },
          dologoff: function () {
            $window.localStorage.removeItem(LOCALNAME.SESSION);
          }
        };
      }]);
}(angular))
