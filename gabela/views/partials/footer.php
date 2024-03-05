
        <!-- footer begin -->
        <footer>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="span6">
                            &copy; Copyright  <?php echo date("Y") ?> - Designed by Maneza F8
                        </div>
                        <div class="span6">
                            <nav>
                                <ul>
                                    <!-- Home page -->
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . 'tasks' ?>">Home</a>
                    </li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . '' ?>">Home</a>
                    </li>
                <?php endif; ?>

                <!-- user page  -->
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . 'users' ?>">View Users</a>
                    </li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . '' ?>">users</a>
                    </li>
                <?php endif; ?>

                 <!-- log out page  -->
                 <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a onclick="logoutNow()" href="#">Logout</a></li>
                <?php elseif (!isset($_SESSION['user_id'])) : ?>
                    <li><a href="<?= BASE_URL . '' ?>">Logout</a>
                    </li>
                <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        <!-- footer close -->

    </div>
    <!-- Latest compiled and minified JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#taskTable').DataTable();
        });
    </script>

</body>

</html>