<?php
    include '../partials/header.php';
    include_once "../databases/db_medical_facility.php";
    include_once "../classes/cl_user.php";
    include_once '../partials/check_if_session_exists.php';
    $db = new db_medical_facility();
    $dbase = $db->getConnection();
    $user = new cl_user($dbase);

    if ($_POST) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->verifyLogin();
}
?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <div>
        <h2 class="text-dark">Login</h2>
    </div>
    <div class="mb-5 p-1 bg-dark w-25"></div>
    <form action="" method="POST" class="d-flex flex-column w-25">
        <div class="w-100 d-flex flex-column">
            <label class='text-dark' for="username">Username:</label>
            <input class='p-2' type="text" id="username" name="username" placeholder='ex. patient_one' required><br><br>
        </div>

        <div class="w-100 d-flex flex-column">
            <label class='text-dark' for="password">Password:</label>
            <input class='p-2' type="password" id="password" name="password" placeholder="your strong password"
                required><br><br>
        </div>

        <div>
            <button class='w-100 p-2 text-light bg-dark border border-dark' style='' type="submit">Login</button>
        </div>
    </form>

    <div class="mt-5 p-1 bg-dark w-25"></div>
    <div>
        <span class="text-dark">Don't have an account?</span>
        <a href="./registration.php" class="text-center text-dark">Register here</a>
    </div>
    <div>
        <a class='text-dark' href="../index.php">Return Home</a>
    </div>
</section>

<?php include '../partials/footer.php'; ?>