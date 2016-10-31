<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
    include_once '../includes/funcionarios.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php
    echo head('Funcionários');
?>
</head>
<body ng-app="filafacil">
<div class="container" ng-controller="mainController as mainCtrl">
  <?php echo mainMenu('funcionario'); ?>
  <main ng-controller="funcionariosController as funcionariosCtrl" ng-init="funcionariosCtrl.loadGrid()">
    <div class="row" ng-if="funcionariosCtrl.messages.length">
      <div class="column column-all column-danger">
        <ul ng-repeat="r in funcionariosCtrl.messages">
          <li>{{ r.message }}</li>
        </ul>
      </div>
    </div>
    <div class="row">
      {{self.method}}
      <div class="column column-all column-primary">
        <div ng-if="funcionariosCtrl.state == 'SEARCH'">
          <form class="frmRegister">
            <input type="button" ng-click="funcionariosCtrl.changePage(false)" value="Novo"/>
            <input type="search" placeholder="Buscar por..." name="txtSearch" ng-model="funcionariosCtrl.txtSearch">
          </form>
        </div>
        <div ng-if="funcionariosCtrl.state == 'EDIT'">
          <?php echo formFuncionarios('frmEmployee'); ?>
        </div>
        <!--<div class="tab" id="tab">
          <div class="tab-header">
            <ul>
              <li><a data-page="#page1" id="btn_page1">Professor</a></li>
              <li><a data-page="#page2" id="btn_page2">Secretária</a></li>
            </ul>
          </div>
          <div class="tab-pages">
            {{ funcionariosCtrl.type }}
            <div id="page1" class="tab-page">
              <?php echo formFuncionarios('teacher', 1); ?>
            </div>
            <div id="page2" class="tab-page">
              <?php echo formFuncionarios('secretary', 0); ?>
            </div>
          </div>
        </div>
      </div>-->
    </div>
    <div class="row">
      <div class="column column-all column-notify">
        <table class="tbData">
          <thead>
            <tr>
              <td colspan="2"></td>
              <td>Cód. Funcionário</td>
              <td>Nome</td>
              <td>Descrição</td>
              <td>Disponível</td>
              <td>Dt. Cadastro</td>
              <td>E-mail</td>
              <td>Status</td>
              <td>Tipo</td>
            </tr>
          </thead>
          <tbody>
            <tr ng-if="funcionariosCtrl.loading">
              <td colspan="8">
                Carregando
              </td>
            </tr>
            <tr ng-if="!funcionariosCtrl.loading" ng-repeat="r in funcionariosCtrl.datatable|filter:funcionariosCtrl.txtSearch">
              <td>
                <button type="button" ng-click="funcionariosCtrl.editRow(r)" name="btnEdit">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
              </td>
              <td>
                <button type="button" ng-click="funcionariosCtrl.deleteRow(r.codfuncionario)" name="btnDelete">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
              </td>
              <td ng-bind="r.codfuncionario"></td>
              <td ng-bind="r.nome"></td>
              <td ng-bind="r.descricao"></td>
              <td ng-bind="r.disponivel"></td>
              <td ng-bind="r.dtcadastro"></td>
              <td ng-bind="r.email"></td>
              <td ng-bind="r.status"></td>
              <td ng-bind="r.tipo"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>
<?php
  include_once '../includes/footer.inc.php';
 ?>
 <script type="text/javascript" src="../style/js/app/controllers/funcionarios.controller.js"></script>
</body>
</html>
