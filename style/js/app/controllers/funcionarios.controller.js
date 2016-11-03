'use strict';
(function (angular) {
  angular.module('filafacil')
    .controller('funcionariosController', [
      '$http',
      'BASEURLS',
      '$filter',
      '$window',
      'authFactory',
      function($http, BASEURLS, $filter, $window, authFactory){

        var self = this;
        self.cbeStatusOtions = [
          { name:'Inativo', id: 0 },
          { name:'Ativo', id: 1 }
        ];
        self.cbeTypeOptions = [
          { name: 'Secretária', id: 0 },
          { name: 'Atendente', id: 1 }
        ];

        self.clearFields = function() {
          self.idEmployee = -1;
          self.name = '';
          self.email = '';
          self.password = '';
          self.description = '';
          self.status = 0;
          self.type = 0;
          self.txtSearch = '';
          self.selectedStatusOption = self.cbeStatusOtions[1];
          self.selectedTypeOption = self.cbeTypeOptions[0];
        }



        self.defaultProps = function() {
          self.clearFields();
          self.messages = [];
          self.datatable = [];
          self.loading = false;
          self.state = 'SEARCH';
          self.method = 'NEW';

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
          if (!authFactory.isAuthenticated()){
            window.location = BASEURLS.BASE + 'views/login.php';
          }
          else {
            self.datatable = [];
            self.loading = true;
            $http({
              method: 'GET',
              url: BASEURLS.BASE_API + 'funcionario'
            })
            .then(function (result, response) {
              if (result.data.status) {
                self.datatable = result.data.data;
                for (var i = 0; i < self.datatable.length; i++) {
                  self.datatable[i]['dtcadastro'] =
                  $filter('date')(new Date(self.datatable[i]['dtcadastro']), 'dd/MM/yyyy');
                  self.datatable[i]['disponivel'] = self.datatable[i]['disponivel'] == '1' ? 'Sim' : 'Não';
                  self.datatable[i]['tipo'] = self.datatable[i]['tipo'] == '1' ? 'Atendente' : 'Secretária';
                  self.datatable[i]['status'] = self.datatable[i]['status'] == '1' ? 'Ativo' : 'Inativo';
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

        self.deleteRow = function(id) {
          self.loading = true;
          $http({
            method: 'DELETE',
            url: BASEURLS.BASE_API + 'funcionario/' + id
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

        self.validate = function(typeval) {
          self.messages = [];
          if (typeval === 'update') {
            if ((!self.idEmployee) ||
               (self.idEmployee == -1) ||
               (self.idEmployee == undefined)) {

              self.messages.push({
                id: Math.floor((Math.random() * 100) + 1),
                message: 'Cód. do funcionário não preenchido.'
              });
            }
          }

          if ((!self.name) ||
             (self.name == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Nome não preenchido.'
            });
          }
          if ((!self.email) ||
             (self.email == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'E-mail não preenchido.'
            });
          }
          if ((!self.password) ||
             (self.password == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Senha não preenchida.'
            });
          }
          if ((!self.description) ||
             (self.description == undefined)) {
            self.messages.push({
              id: Math.floor((Math.random() * 100) + 1),
              message: 'Descrição não preenchida.'
            });
          }

          return self.messages.length <= 0;
        };

        self.editRow = function(employee) {
          self.idEmployee = employee.codfuncionario,
          self.name = employee.nome,
          self.email = employee.email,
          self.password = employee.senha,
          self.description = employee.descricao,
          self.status = employee.status,
          self.type = employee.tipo;
          self.selectedStatusOption = self.cbeStatusOtions[self.status.toUpperCase()  == 'ATIVO' ? 1 : 0];
          self.selectedTypeOption = self.cbeTypeOptions[self.type.toUpperCase()  == 'ATENDENTE' ? 1 : 0];


          self.changePage();
          self.method = 'EDIT';
        };

        self.save = function() {
          console.log(self.method);
          if (self.method === 'NEW')
            self.create();
          else
            self.update();
        }

        self.create = function() {
          if (self.validate('create')) {
            self.loading = true;
            var data = {
              "codfuncionario": self.idEmployee,
              "nome": self.name,
              "email": self.email,
              "senha": self.password,
              "descricao": self.description,
              "status": self.selectedStatusOption.id,
              "tipo": self.selectedTypeOption.id
            };

            $http({
              method: 'POST',
              url: BASEURLS.BASE_API + 'funcionario',
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
        }

        self.update = function() {
          if (self.validate('update')) {
            self.loading = true;
            var data = {
              "codfuncionario": self.idEmployee,
              "nome": self.name,
              "email": self.email,
              "senha": self.password,
              "descricao": self.description,
              "status": self.selectedStatusOption.id,
              "tipo": self.selectedTypeOption.id
            };

            $http({
              method: 'PUT',
              url: BASEURLS.BASE_API + 'funcionario',
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
        }


    }]);
}(angular));
