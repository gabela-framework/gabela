<?php


$controllerConfigs = [];

// Load main application controllers
$controllerConfigs += getIncluded(USER_CONTROLLER_CONFI);
$controllerConfigs += getIncluded(TASKS_CONTROLLER_CONFI);
$controllerConfigs += getIncluded('/gabela/config/GabelaPathsConfig.php');
// Include other module configs as needed

return $controllerConfigs;