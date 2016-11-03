<?php
function formFila($name)
{
  $form = '<form id="'.$name.'" class="frmRegister">';
  $form .= '<ul>';
  $form .= '<li><label for="txtRa">R.A.</label><input type="text" placeholder="R.A." name="txtRa" ng-model="filaCtrl.ra"></li>';
  $form .= '<li><label for="cbeStatus" >Cód. Atendente</label>';
  $form .= '<select name="cbeAtendantOptions" ng-options="o.nome for o in filaCtrl.EmployeeAvailable" ng-model="filaCtrl.selectedAtendantOption">';
  $form .= '</select></li>';
  $form .= '<li><input type="button" class="btn" ng-click="filaCtrl.save()" name="btnSendForm" value="Salvar"></li>';
  $form .= '<li><input type="button" class="btn" ng-click="filaCtrl.changePage(true)" id="btnCancel" name="btnCancel" value="Cancelar"></li>';
  $form .= '</ul>';
  $form .= '</form>';
  return $form;
}
?>
