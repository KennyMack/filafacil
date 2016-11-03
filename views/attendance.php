<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
?>
<!DOCTYPE html>
<html>
<head>

<?php
    echo head('Atendimento');
?>
</head>
<body ng-app="filafacil" >
<div class="container"  ng-controller="mainController as mainCtrl">
  <?php echo mainMenu('atendimento'); ?>
    <main ng-controller="atendimentoController as atendimentoCtrl" ng-init="atendimentoCtrl.loadGrid()">
      <div class="row" ng-if="atendimentoCtrl.messages.length">
        <div class="column column-all column-danger">
          <ul ng-repeat="r in atendimentoCtrl.messages">
            <li>{{ r.message }}</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="column column-half column-primary">

          <h3 class="group-caption">Atendimento<span ng-if="atendimentoCtrl.idQueue > 0"> - {{ atendimentoCtrl.idQueue }}</span></h3>
          <div ng-if="atendimentoCtrl.inAttendance">

            <p class="p-Time">
              Hora Inicio - {{ atendimentoCtrl.dtStart|date:'dd/MM/yyyy HH:mm' }}
            <br>
              Tempo Decorrido - {{ atendimentoCtrl.actualTime }}
            </p>

            <form class="frmRegister">
              <ul>
                <li>
                  <textarea ng-model="atendimentoCtrl.description" name="txtObservacao"></textarea>
                </li>
                <li>
                  <input style="display:block; margin: 0 auto" type="button"
                    ng-click="atendimentoCtrl.save()" class="btn"
                  name="btnSave" value="Salvar e Encerrar"/>
                </li>
                <li>
                  <input style="display:block; margin: 10px auto" type="button"
                    ng-click="atendimentoCtrl.cancel()" class="btn"
                  name="btnCancel" value="Cancelar"/>
                </li>
            </ul>
            </form>
          </div>
        </div>
        <div class="column column-half column-main">
          <h3 class="group-caption">Fila</h3>
          <table class="tbData">
            <thead>
              <tr>
                <td>Cód. Fila</td>
                <td>R.A.</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-if="atendimentoCtrl.loading">
                <td colspan="5">
                  Carregando
                </td>
              </tr>
              <tr ng-if="!atendimentoCtrl.loading" ng-repeat="r in atendimentoCtrl.datatable|orderBy:codfila:true">
                <td ng-bind="r.codfila"></td>
                <td ng-bind="r.ra"></td>
              </tr>
            </tbody>
          </table>
            <form class="frmRegister" >
              <input style="display:block; margin: 0 auto"
                ng-if="!atendimentoCtrl.inAttendance"
                ng-click="atendimentoCtrl.startAttendance()" class="btn"
               type="button" name="btnNext" value="Próximo"/>
            </form>

        </div>
      </div>
      <div class="row">
        <div class="column column-all column-notify">
          <table class="tbData">
            <thead>
              <tr>
                <td>Cód. Atendimento</td>
                <td>Cód. Fila</td>
                <td>Dt. Início</td>
                <td>Dt. Término</td>
                <td>Observação</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-if="atendimentoCtrl.loading">
                <td colspan="5">
                  Carregando
                </td>
              </tr>
              <tr ng-if="!atendimentoCtrl.loading" ng-repeat="r in atendimentoCtrl.datatableAttendance">
                <td ng-bind="r.codatendimento"></td>
                <td ng-bind="r.codfila"></td>
                <td ng-bind="r.dtinicio|date:'dd/MM/yyyy HH:mm:ss'"></td>
                <td ng-bind="r.dtfim|date:'dd/MM/yyyy HH:mm:ss'"></td>
                <td ng-bind="r.observacao"></td>
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
 <script type="text/javascript" src="../style/js/app/controllers/atendimento.controller.js"></script>
</body>
</html>
