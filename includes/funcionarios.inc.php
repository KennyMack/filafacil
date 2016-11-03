<?php
function formFuncionarios($name)
{
  $form = '<form id="'.$name.'" class="frmRegister">';
  $form .= '<ul>';
  $form .= '<li><label for="txtName">Nome</label><input type="text" placeholder="Nome" name="txtName" ng-model="funcionariosCtrl.name"></li>';
  $form .= '<li><label for="txtEmail">E-mail</label><input type="text" placeholder="E-mail" name="txtEmail" ng-model="funcionariosCtrl.email"></li>';
  $form .= '<li><label for="txtPassword">Senha</label><input type="password" placeholder="Senha" name="txtPassword" ng-model="funcionariosCtrl.password"></li>';
  $form .= '<li><label for="txtDescription">Descrição</label><input type="text" placeholder="Descrição" name="txtDescription" ng-model="funcionariosCtrl.description"></li>';
  $form .= '<li><label for="cbeStatus" >Status</label>';
  $form .= '<select name="cbeStatus" ng-options="o.name for o in funcionariosCtrl.cbeStatusOtions" ng-model="funcionariosCtrl.selectedStatusOption">';
  $form .= '</select></li>';
  $form .= '<li><label for="cbeTipo" >Tipo</label>';
  $form .= '<select name="cbeTipo" ng-options="o.name for o in funcionariosCtrl.cbeTypeOptions" ng-model="funcionariosCtrl.selectedTypeOption">';
  $form .= '</select></li>';
  $form .= '<li><input type="button" class="btn" ng-click="funcionariosCtrl.save()" name="btnSendForm" value="Salvar"></li>';
  $form .= '<li><input type="button" class="btn" ng-click="funcionariosCtrl.changePage(true)" id="btnCancel" name="btnCancel" value="Cancelar"></li>';
  $form .= '</ul>';
  $form .= '</form>';
  return $form;
}
?>
