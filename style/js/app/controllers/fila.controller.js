'use strict';

(function (angular) {
  angular.module('filafacil')
    .controller('filaController', [
      '$http',
      'BASEURLS',
      '$filter',
      '$window',
      function($http, BASEURLS, $filter, $window) {
        var self = this;

        self.clearFields = function() {
          self.idQueue = -1;
          self.ra = '';
          self.idEmployee = '';
          self.status = 0;
          self.txtSearch = '';
          self.txtSearchEmployee = '';
          if (self.EmployeeAvailable.length)
            self.selectedAtendantOption = self.EmployeeAvailable[0];
          else
            self.selectedAtendantOption = '';
        }

        self.defaultProps = function() {
          self.messages = [];
          self.datatable = [];
          self.EmployeeAvailable = [];
          self.loading = false;
          self.state = 'SEARCH';
          self.method = 'NEW';
          self.clearFields();
        };

        self.defaultProps();

        self.changePage = function(clear) {
          if(clear)
            self.clearFields();
          self.messages = [];
          self.state = self.state == 'SEARCH' ? 'EDIT' : 'SEARCH';
          self.method = 'NEW';
        };

        self.loadGrid = function () {
          self.datatable = [];
          self.EmployeeAvailable = [];

          self.loading = true;
          $http({
            method: 'GET',
            url: BASEURLS.BASE_API + 'fila'
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
            url: BASEURLS.BASE_API + 'funcionario-available'
          })
          .then(function (result, response) {
            if (result.data.status) {
              self.EmployeeAvailable = result.data.data;
              if (self.EmployeeAvailable.length)
                self.selectedAtendantOption = self.EmployeeAvailable[0];
              else
                self.selectedAtendantOption = '';
            }
            self.loading = false;
          },
          function(err) {
            self.loading = false;
            console.log(err);
          });
        };

        self.deleteRow = function(id) {
          self.loading = true;
          $http({
            method: 'DELETE',
            url: BASEURLS.BASE_API + 'fila/' + id
          })
          .then(function (result, response) {
            if (result.data.status){
              self.loadGrid();
            }
            else{
              self.messages = [];
              self.messages.push({
                id: Math.floor((Math.random() * 100) + 1),
                message: 'Registro não pode ser excluído'
              });
              self.loading = false;
            }

          },
          function(err) {
            self.loading = false;
            console.log(err);
          });
        }

        self.validate = function() {
          self.messages = [];

          if ((!self.selectedAtendantOption) ||
             (self.selectedAtendantOption == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Selecione o Atendente.'
            });
          }

          return self.messages.length <= 0;
        };

        self.save = function() {
          if (self.validate()) {
            self.loading = true;
            var data = {
              "codfuncionario": self.selectedAtendantOption.codfuncionario,
              "ra": self.ra
            };

            $http({
              method: 'POST',
              url: BASEURLS.BASE_API + 'fila',
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

          }
        };


    }]);
}(angular));
