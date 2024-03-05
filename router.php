<?php

use Gabela\Core\Router;


$config = getIncluded('/gabela/config/config.php');
$extensionPath = $config["path"]["additionalPath"];

$router = new Router();

$router->get("{$extensionPath}/", "IndexController::Index")->pass('guest');
$router->get("{$extensionPath}/login", "LoginPageController::index")->pass('guest');

$router->get("{$extensionPath}/forgot-password", "ForgotPasswordController::forgot")->pass('guest');
$router->post("{$extensionPath}/forgot-password-submit", "ForgotPasswordSubmitController::submit")->pass('guest');
$router->get("{$extensionPath}/reset-password", "ResetPasswordController::reset")->pass('guest');
$router->post("{$extensionPath}/reset-password-submit", "ResetPasswordSubmitController::submit")->pass('guest');

$router->get("{$extensionPath}/tasks", "TasksController::tasks")->pass('auth');
$router->get("{$extensionPath}/tasks-create", "TasksCreateController::create")->pass('auth');
$router->post("{$extensionPath}/tasks-create-submit", "TasksCreateSubmitController::submit")->pass('auth');
$router->get("{$extensionPath}/task-edit", "TasksEditController::edit")->pass('auth');
$router->post("{$extensionPath}/task-edit-submit", "TasksSubmitController::submit")->pass('auth');
$router->get("{$extensionPath}/task-delete", "TasksDeleteController::delete")->pass('auth');

$router->get("{$extensionPath}/users", "UsersController::users")->pass('auth');
$router->get("{$extensionPath}/user-edit", "UsersEditController::edit")->pass('auth');
$router->post("{$extensionPath}/users-edit-submit", "UsersSubmitController::submit")->pass('auth');
$router->get("{$extensionPath}/user-delete", "UsersDeleteController::delete")->pass('auth');
$router->get("{$extensionPath}/users-profile", "ProfileController::profile")->pass('auth');

$router->post("{$extensionPath}/login-submit", "LoginController::login")->pass('guest');
$router->get("{$extensionPath}/logout", "LogoutController::logout")->pass('auth');
$router->post("{$extensionPath}/register-submit", "RegisterController::register")->pass('guest');

$router->get("{$extensionPath}/admin", "AdminController::Action")->pass('admin');

return $router;
