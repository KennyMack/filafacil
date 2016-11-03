<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
?>
<!DOCTYPE html>
<html>
<head>

<?php
    echo head('Home');
?>
</head>
<body ng-app="filafacil" >
<div class="container"  ng-controller="mainController as mainCtrl">
  <?php echo mainMenu('home'); ?>
    <main>
      <div class="row">
        <div class="column column-half column-primary">
          <button type="button" class="btn-big btn-orange"
            ng-click="mainCtrl.openDashBoard()">
            <i class="fa-3x fa fa-television" aria-hidden="true"></i>DashBoard</button>
        </div>
        <div class="column column-half column-main">
          <button type="button" class="btn-big btn-green"
            ng-click="mainCtrl.openLogin()">
            <i class="fa-3x fa fa-cogs" aria-hidden="true"></i>Controle</button>
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
