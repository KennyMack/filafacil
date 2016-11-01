'use strict';
(function (angular) {
  angular.module('filafacil')
    .controller('atendimentoController', [
      '$http',
      'BASEURLS',
      '$filter',
      '$interval',
      function($http, BASEURLS, $filter, $interval)  {
        var self = this;

        self.clearFields = function() {
          self.idEmployee = 9;
          self.idQueue = -1;
          self.dtStart = '';
          self.dtEnd = '';
          self.description = '';
          self.inAttendance = false;
          self.actualTime = 0;
          self.timeout = null;
        }

        self.defaultProps = function() {
          self.messages = [];
          self.datatable = [];
          self.datatableAttendance = [];

          self.loading = false;

          self.clearFields();
        };

        self.defaultProps();

        self.loadGrid = function () {
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
            url: BASEURLS.BASE_API + 'atendimentos'
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
        };

        self.save = function () {
          $interval.cancel(self.timeout);

          self.loading = true;
          var data = {
            "codfila": self.idQueue,
            "dtinicio": self.dtStart.toString(),
            "dtfim": new Date().toString(),
            "observacao": self.description
          };

          console.log(data);

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

        self.startAttendance = function () {
          self.idQueue = Math.max.apply(Math, self.datatable.map(function(item){
            return item.codfila;
          }));

          if (self.idQueue > 0) {
            self.dtStart = new Date();
            self.inAttendance = true;
            self.timeout = $interval(function () {
              self.actualTime += 1 ;
            }, 1000);
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
