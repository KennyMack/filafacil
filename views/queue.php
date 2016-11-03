<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
    include_once '../includes/fila.inc.php';
?>
<!DOCTYPE html>
<html>
<head>

<?php
    echo head('Fila');
?>
</head>
<body ng-app="filafacil">
<div class="container" ng-controller="mainController as mainCtrl">
  <?php echo mainMenu('fila'); ?>
    <main ng-controller="filaController as filaCtrl" ng-init="filaCtrl.loadGrid()">
      <div class="row" ng-if="filaCtrl.messages.length">
        <div class="column column-all column-danger">
          <ul ng-repeat="r in filaCtrl.messages">
            <li>{{ r.message }}</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="column column-half column-primary">
          <div ng-if="filaCtrl.state == 'SEARCH'">
            <form class="frmRegister">
              <input type="button" ng-click="filaCtrl.changePage(false)" value="Novo"/>
              <input type="search" placeholder="Buscar por..." name="txtSearch" ng-model="filaCtrl.txtSearch">
            </form>
          </div>
          <div ng-if="filaCtrl.state == 'EDIT'">
            <?php echo formFila('frmQueue'); ?>
          </div>
        </div>
        <div class="column column-half column-main">
          <form class="frmRegister">
            <input type="search" placeholder="Buscar Atendentes..." name="txtSearch" ng-model="filaCtrl.txtSearchEmployee">
          </form>
          <table class="tbData">
            <thead>
              <tr>
                <td>Cód. Funcionário</td>
                <td>Nome Funcionário</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-if="filaCtrl.loading">
                <td colspan="5">
                  Carregando
                </td>
              </tr>
              <tr ng-if="!filaCtrl.loading" ng-repeat="r in filaCtrl.EmployeeAvailable|filter:filaCtrl.txtSearchEmployee">
                <td ng-bind="r.codfuncionario"></td>
                <td ng-bind="r.nome"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="column column-all column-notify">
          <table class="tbData">
            <thead>
              <tr>
                <td></td>
                <td>Cód. Fila</td>
                <td>R.A.</td>
                <td>Cód. Funcionário</td>
                <td>Nome Funcionário</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-if="filaCtrl.loading">
                <td colspan="5">
                  Carregando
                </td>
              </tr>
              <tr ng-if="!filaCtrl.loading" ng-repeat="r in filaCtrl.datatable|filter:filaCtrl.txtSearch">
                <td>
                  <button type="button" ng-click="filaCtrl.deleteRow(r.codfila)" name="btnDelete">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </td>
                <td ng-bind="r.codfila"></td>
                <td ng-bind="r.ra"></td>
                <td ng-bind="r.codfuncionario"></td>
                <td ng-bind="r.funcionarionome"></td>
                <td ng-bind="r.descstatus"></td>
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
 <script type="text/javascript" src="../style/js/app/controllers/fila.controller.js"></script>
</body>
</html>
