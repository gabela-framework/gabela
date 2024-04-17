<?php

/**
 * @var array $data
 */

getIncluded(TASK_MODEL);

use Gabela\Core\Session;
use Gabela\Tasks\Model\Task;
use Gabela\Core\ClassManager;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['tittle'] ?></title>

    <link rel="stylesheet" href="assets/css/main.css" type="text/css" id="main-css">
    <link rel="stylesheet" href="assets/includes/styles.css" type="text/css">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.isotope.min.js"></script>
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/jquery.ui.totop.js"></script>
    <script src="assets/js/selectnav.js"></script>
    <script src="assets/js/ender.js"></script>
    <script src="assets/js/jquery.lazyload.js"></script>
    <script src="assets/js/jquery.flexslider-min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/contact.js"></script>

    <style>
        .sidebar {
            height: 100vh;
            /* Set sidebar height to full viewport height */
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 56px;
            /* Adjust based on the height of top navigation */
        }

        .content {
            margin-left: 250px;
            /* Ensure content does not go under the sidebar */
            padding: 20px;
            margin-top: 4em;
        }

        .top-nav {
            height: 56px;
            /* Set height for the top navigation */
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 250px;
            /* Match with sidebar width */
            right: 0;
            z-index: 1030;
            /* Ensure top navigation is above sidebar */
        }

        .user-profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="main-menu sidebar">
        <ul class="nav navbar-nav">
            <li class="active menu-icon" ><a   class="fa fa-puzzle-piece" href="<?= BASE_URL . 'admin' ?>">Dashboard</a></li>
            <li><a href="<?= BASE_URL . 'tasks' ?>">Tasks</a></li>
            <li><a href="<?= BASE_URL . 'users' ?>">Users</a></li>
            <li><a href="<?= BASE_URL . 'admin-settings' ?>">Settings</a></li>
        </ul>
    </div>

    <!-- Page Content -->
    <div class="container-fluid">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="user-profile" style="
                                            float: right;
                                            padding-right: 4em;
                                            padding-top: 11px;
                                        ">
                <img src="https://via.placeholder.com/30" alt="User Profile">
                <?php
                $classManager = new ClassManager();
                /** @var Task $task */
                $task = $classManager->createInstance(Task::class);
                ?>
                <span>Welcome, <a
                        href="<?= EXTENTION_PATH ?>/users-profile?user_id=<?php printValue(Session::getCurrentUserId()); ?>">
                        <?= Session::getCurrentUsername(); ?>
                    </a>
                </span>
            </div>
        </div>
        <!-- Page Content -->
        <div class="content">
            <h2>Dashboard</h2>
            <p>Welcome to the admin dashboard.</p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>