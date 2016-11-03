<?php
    include_once '../includes/header.inc.php';
    include_once '../includes/nav.inc.php';
?>
<!DOCTYPE html>
<html>
<head>

<?php
    echo head('DashBoard');
?>
</head>
<body ng-app="filafacil" >
<div class="container"  ng-controller="mainController as mainCtrl">
    <main class="row-max" ng-controller="dashboardController as dashboardCtrl" ng-init="dashboardCtrl.loadPage()">
      <ul class="dash" ng-repeat="r in dashboardCtrl.datatable">
        <li>
          <h4 class="employee-name" ng-bind="r.funcionarionome"></h4>
          <h3 class="queue-number" ng-bind="r.ra"></h3>
        </li>
      </ul>
    </main>
</div>
<?php
  include_once '../includes/footer.inc.php';
 ?>
 <script type="text/javascript" src="../style/js/app/controllers/dashboard.controller.js"></script>
</body>
</html>
