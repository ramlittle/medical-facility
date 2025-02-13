<?php include '../php_functions/php_functions_menu.php';?>
<nav class="p-2 bg-dark d-flex justify-content-end">
    <ul class="d-flex list-unstyled gap-2">
        <li>
            <a class='<?php echo checkActivePage('dashboard');?> text-white ' href='./dashboard.php'                
                >Dashboard
            </a>
        </li>
        <li>
            <a class='<?php echo checkActivePage('my_profile');?> text-white' href="./profile.php"
                >My Profile
            </a>
        </li>
        <li>
            <strong class='text-decoration-underline text-white'>Welcome, <?php echo $user['username'] ?></strong>
        </li>
        <li>
            <a class='text-decoration-none text-danger' href="../partials/logout.php" onclick="return confirmLogout();">Logout</a>
        </li>
    </ul>
</nav>

<script src='../js_functions/menu.js'></script>