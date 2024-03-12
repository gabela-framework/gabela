<?php

$controllerConfigs = [];

// Load main application controllers
$controllerConfigs += getIncluded(USER_CONTROLLER_CONFI);
$controllerConfigs += getIncluded(TASKS_CONTROLLER_CONFI);
$controllerConfigs += getIncluded(PAYFAST_CONTROLLER_CONFI);
$controllerConfigs += getIncluded('/gabela/config/GabelaPathsConfig.php');

return $controllerConfigs;