<nav>
    <ul>
        <li>Dashboard</li>
        <li>My Profile</li>
        <li>Welcome, <?php echo $user['username']?></li>
        <li>
            <a href="../partials/logout.php" onclick="return confirmLogout();">Logout</a>
        </li>
    </ul>
</nav>

<script src='../js_functions/menu.js'></script>