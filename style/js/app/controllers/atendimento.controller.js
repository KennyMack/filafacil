'use strict';
(function (angular) {
  angular.module('filafacil')
    .controller('atendimentoController', [
      '$http',
      'BASEURLS',
      '$filter',
      '$interval',
      'authFactory',
      function($http, BASEURLS, $filter, $interval, authFactory)  {
        var self = this;

        self.clearFields = function() {
          self.idEmployee = self.getEmployee();
          self.idQueue = -1;
          self.dtStart = '';
          self.dtEnd = '';
          self.description = '';
          self.inAttendance = false;
          self.actualTime = 0;
          self.timeout = null;
        }

        self.getEmployee = function () {
          var token = authFactory.getToken();
          if (token)
            return token['idemployee'];

          return '-1';
        };

        self.defaultProps = function() {
          self.messages = [];
          self.datatable = [];
          self.datatableAttendance = [];

          self.loading = false;

          self.clearFields();
        };

        self.defaultProps();

        self.loadGrid = function () {
          if (!authFactory.isAuthenticated()){
            window.location = BASEURLS.BASE + 'views/login.php';
          }
          else {
            self.datatable = [];

            self.loading = true;
            $http({
              method: 'GET',
              url: BASEURLS.BASE_API + 'fila-employee/'+ self.idEmployee
            })
            .then(function (result, response) {
              if (result.data.status) {
                self.datatable = result.data.data;
                for (var i = 0; i < self.datatable.length; i++) {
                  self.datatable[i]['dtinicio'] =
                  $filter('date')(new Date(self.datatable[i]['dtinicio']), 'dd/MM/yyyy HH:mm:ss');
                  self.datatable[i]['dtfim'] =
                  $filter('date')(new Date(self.datatable[i]['dtfim']), 'dd/MM/yyyy HH:mm:ss');
                  var desc = '';
                  switch (self.datatable[i]['status']) {
                    case '0':
                      desc = 'Aguardando';
                      break;
                    case '1':
                      desc = 'Andamento';
                      break;
                    case '2':
                      desc = 'Finalizado';
                      break;
                  }

                  self.datatable[i]['descstatus'] = desc;
                }
              }
              self.loading = false;
            },
            function(err) {
              self.loading = false;
              console.log(err);
            });

            $http({
              method: 'GET',
              url: BASEURLS.BASE_API + 'atendimentos-funcionario/'+ self.idEmployee
            })
            .then(function (result, response) {
              if (result.data.status) {
                self.datatableAttendance = result.data.data;
                for (var i = 0; i < self.datatableAttendance.length; i++) {
                  self.datatableAttendance[i]['dtinicio'] =
                  $filter('date')(new Date(self.datatableAttendance[i]['dtinicio']), 'dd/MM/yyyy hh:mm:ss');
                  self.datatableAttendance[i]['dtfim'] =
                  $filter('date')(new Date(self.datatableAttendance[i]['dtfim']), 'dd/MM/yyyy hh:mm:ss');
                }
              }
              self.loading = false;
            },
            function(err) {
              self.loading = false;
              console.log(err);
            });
          }
        };

        self.save = function () {
          $interval.cancel(self.timeout);

          self.loading = true;
          var data = {
            "codfila": self.idQueue,
            "dtinicio": $filter('date')(self.dtStart, 'yyyy-MM-dd HH:mm:ss'),
            "dtfim": $filter('date')(new Date(), 'yyyy-MM-dd HH:mm:ss'),
            "observacao": self.description
          };

          $http({
            method: 'POST',
            url: BASEURLS.BASE_API + 'atendimentos-termina',
            data: data
          })
          .then(function (result, response) {
            if (result.data.status){
              self.loadGrid();
              self.defaultProps();
            }
            else{
              self.messages = [];
              self.messages.push({
                id: Math.floor((Math.random() * 100) + 1),
                message: 'Não foi possível salvar'
              });
              self.loading = false;
            }

          },
          function(err) {
            self.messages = [];
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Não foi possível salvar'
            });
            self.loading = false;
          });


        };

        self.cancel = function () {
          $interval.cancel(self.timeout);

          $http({
            method: 'POST',
            url: BASEURLS.BASE_API + 'fila-cancelar',
            data: {
              "codfila": self.idQueue
            }
          })
          .then(function (result, response) {
            if (result.data.status){
              self.inAttendance = false;
              self.loadGrid();
              self.defaultProps();
            }
            else{
              console.log(result.data);
              self.messages = [];
              self.messages.push({
                id: Math.floor((Math.random() * 100) + 1),
                message: 'Não foi possível salvar'
              });
              self.loading = false;
            }

          },
          function(err) {
            self.messages = [];
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Não foi possível salvar'
            });
            self.loading = false;
          });

        };

        self.startAttendance = function () {
          self.idQueue = Math.min.apply(Math, self.datatable.map(function(item){
            return item.codfila;
          }));

          if (self.idQueue > 0) {

            $http({
              method: 'POST',
              url: BASEURLS.BASE_API + 'fila-andamento',
              data: {
                "codfila": self.idQueue
              }
            })
            .then(function (result, response) {
              if (result.data.status){
                self.loadGrid();
                self.dtStart = Date.now();
                self.inAttendance = true;
                self.timeout = $interval(function () {
                  self.actualTime += 1 ;
                }, 1000);
              }
              else{
                self.messages = [];
                self.messages.push({
                  id: Math.floor((Math.random() * 100) + 1),
                  message: 'Não foi possível salvar'
                });
                self.loading = false;
              }

            },
            function(err) {
              self.messages = [];
              self.messages.push({
                id: Math.floor((Math.random() * 100) + 1),
                message: 'Não foi possível salvar'
              });
              self.loading = false;
            });


          }
          else {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Nenhum atendimento na fila.'
            });
          };
        };

    }]);
}(angular));
