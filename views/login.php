<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
?>
<!DOCTYPE html>
<html>
<head>

<?php
    echo head('Login');
?>
</head>
<body ng-app="filafacil" >
<div class="container"  ng-controller="mainController as mainCtrl">
  <main ng-controller="loginController as loginCtrl" ng-init="loginCtrl.loadPage()">
    <form class="frmRegister frmLogin column-center">
      <h3 class="group-caption">Login</h3>
      <input type="text" ng-model="loginCtrl.email" placeholder="Email" name="txtEmail">
      <input type="password" ng-model="loginCtrl.pass" placeholder="Senha" name="txtPassword">
      <ul ng-repeat="r in loginCtrl.messages">
        <li class="group-caption">{{ r.message }}</li>
      </ul>
      <input type="button" name="btnLogin" value="Login" ng-click="loginCtrl.doLogin()">
      <input type="button" name="btnCancel" value="Cancelar" ng-click="loginCtrl.clickCancel()">
    </form>
  </main>
</div>
<script type="text/javascript" src="../style/js/md5.js"></script>
<?php
  include_once '../includes/footer.inc.php';
 ?>
 <script type="text/javascript" src="../style/js/app/controllers/login.controller.js"></script>
</body>
</html>
