<?php

function mainMenu($page)
{
  $pagina = 'Home';

  switch ($page) {
    case 'funcionario':
      $pagina = 'Funcionários';
      break;
    case 'fila':
      $pagina = 'Fila';
      break;
    case 'atendimento':
      $pagina = 'Atendimentos';
      break;
  }

  $header = '<header>';
  $header .= '    <div class="left">';
  $header .= '        <h1 ng-bind="mainCtrl.getName()"></h1>';
  $header .= '    </div>';
  $header .= '    <div class="center">';
  $header .= '        &nbsp;';
  $header .= '    </div>';
  $header .= '    <div class="right">';
  $header .= '        <nav class="desktop">';
  $header .= '            <ul>';
  $header .= ' <li><a '. ($page=='home' ? 'class="active"' : '' ).' href="home.php">Home</a></li> ';
  $header .= ' <li ng-if="mainCtrl.isLogged()"><a '. ($page=='funcionario' ? 'class="active"' : '' ).' href="funcionarios.php">Funcionário</a></li> ';
  $header .= ' <li ng-if="mainCtrl.isLogged()"><a '. ($page=='fila' ? 'class="active"' : '' ).' href="queue.php">Fila</a></li> ';
  $header .= ' <li ng-if="mainCtrl.isLogged()"><a '. ($page=='atendimento' ? 'class="active"' : '' ).' href="attendance.php">Atendimento</a></li> ';
  $header .= ' <li ng-if="mainCtrl.isLogged()"><a href="#" ng-click="mainCtrl.doLogoff()">Sair</a></li> ';
  $header .= '            </ul>';
  $header .= '        </nav>';
  $header .= '    </div>';
  $header .= '</header>';

    return $header;
}

?>
