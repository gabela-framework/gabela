<div class="container">
    <div id="logo" style=" width: 250px; height: auto; ">
        <div class="inner">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?= BASE_URL . 'tasks' ?>">
                <?php elseif (!isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASE_URL . '' ?>">
                    <?php endif; ?>
                    <img src="assets/images/logo2.png" alt="logo"></a>
        </div>
    </div>

    <!-- mainmenu begin -->
    <ul id="mainmenu">
        <ul id="mainmenu">
            <!-- Home page -->
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . 'tasks' ?>">Home</a>
                    </li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>

                <?php endif; ?>

                <!-- user page  -->
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . 'users' ?>">View Users</a>
                    </li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>

                <?php endif; ?>

                 <!-- log out page  -->
                 <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a onclick="logoutNow()" href="#">Logout</a></li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>
                    <li style="background-color: #ff0000; "><a style="color: #171717;" href="<?= BASE_URL . 'login' ?>"><strong>Login</strong></a>
                    </li>
                <?php endif; ?>
                    
        </ul>
    </ul>
    <!-- mainmenu close -->

</div>
</header>
<!-- header close -->

<!-- subheader begin -->