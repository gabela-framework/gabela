<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Unauthenticated</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive Minimal Bootstrap Theme">
    <meta name="keywords" content="responsive,minimal,bootstrap,theme">
    <meta name="author" content="">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" href="css/ie.css" type="text/css">
    <![endif]-->

    <!-- Include DataTables CSS and JavaScript 
     =================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- CSS Files
    ================================================== -->
    <link rel="stylesheet" href="assets/css/main.css" type="text/css" id="main-css">
    <link rel="stylesheet" href="assets/includes/styles.css" type="text/css">

    <!-- Javascript Files
    ================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.isotope.min.js"></script>
    <!-- <script src="assets/js/jquery.prettyPhoto.js"></script> -->
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/jquery.ui.totop.js"></script>
    <script src="assets/js/selectnav.js"></script>
    <script src="assets/js/ender.js"></script>
    <script src="assets/js/jquery.lazyload.js"></script>
    <script src="assets/js/jquery.flexslider-min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/contact.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <style>
        footer {
            display: flex;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- header begin -->
        <header>
            <div class="container">
                <div id="logo" style=" width: 250px; height: auto; ">
                    <div class="inner">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?= BASE_URL . 'tasks' ?>">
                            <?php elseif (!isset($_SESSION['user_id'])): ?>
                                <a href="<?= BASE_URL . '' ?>">
                                <?php endif; ?>
                                <img src="assets/images/logo2.png" alt="logo">
                            </a>
                    </div>
                </div>

                <!-- mainmenu begin -->
                <ul id="mainmenu">
                    <!-- Home page -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= BASE_URL . 'tasks' ?>">Home</a>
                        </li>
                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= BASE_URL . '' ?>">Home</a>
                        </li>
                    <?php endif; ?>

                    <!-- user page  -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= BASE_URL . 'users' ?>">Users</a>
                        </li>
                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= BASE_URL . '' ?>">users</a>
                        </li>
                    <?php endif; ?>

                    <!-- log out page  -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a onclick="logoutNow()" href="#">Logout</a></li>
                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                        <li style="background-color: #ff0000; "><a style="color: #171717;" href="<?= BASE_URL . 'login' ?>"><strong>Login</strong></a>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- mainmenu close -->

            </div>
        </header>

        <!-- services section begin -->
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold">You are not authorized to view this page.</h1>

                <p class="mt-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= BASE_URL . 'tasks' ?>">Home</a>

                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                        <a href="<?= BASE_URL . '' ?>">Home</a>

                    <?php endif; ?>
                </p>
            </div>

            <div style="padding: 0em 10em; ">
                <img class="mg-responsive" src="assets/images/gabela403.png" alt="404" />
            </div>
            <br />
        </main>

        <?php getIncluded(FOOTER_PARTIAL); ?>