<?php
include '../partials/header.php';
include_once "../databases/db_medical_facility.php";
include_once "../classes/cl_user.php";

$db = new db_medical_facility();
$dbase = $db->getConnection();
$user = new cl_user($dbase);


if ($_POST) {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->is_active = 1;
    $user->is_admin = 0;//default access level for standard user
    $user->createUser();
    // if ($user->createUser() === true) {
    //     echo "<div class='success-box show-then-fade'>Registration is Successful!</div>";
    // } elseif ($user->createUser() === 'username_exists') {
    //     echo "<div class='exist-box show-then-fade'>username already exists!</div>";
    // } else {
    //     echo "<div class='fail-box show-then-fade'>Failed Adding!</div>";
    // }
}

?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <div>
        <h2 class="text-dark">Registration</h2>
    </div>
    <div class="mb-5 p-1 bg-dark w-25"></div>

    <form action="registration.php" method="POST" class="d-flex flex-column w-25">
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="username">Username</label>
            <input class="p-2" id='username' type="text" name='username' placeholder='ex. patient_one'
                oninput="validatePassword()" />
        </div>
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="password">Password</label>
            <input class="p-2" id="password" type="password" name="password" placeholder='enter strong password'
                oninput="validatePassword()" />
        </div>
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="confirm_password">Confirm Password</label>
            <input class="p-2" id="confirm-password" type="password" name="confirm_password"
                placeholder='enter strong password again' oninput="validatePassword()" />
        </div>
        <p id="error-message" class="text-danger fw-bold text-center" style="display:none;"></p>
        <p id="toggle-password-button" class="text-decoration-underline text-center" style='cursor:pointer;'
            onclick="togglePassword()">Show password</p>

        <div class='d-flex gap-1'>
            <input id='privacy-checkbox' type='checkbox' required />
            <span>I have read and understood the <a href='../docs/privacy_statement.pdf' target='_blank'>Data Privacy
                    Statement</a> this Medical Facility</span>
        </div>

        <button id='register-button' class='mt-2 w-100 p-2 text-white bg-dark border border-dark' style="display:none;"
            type="submit">Submit</button>

    </form>

    <div class="mt-5 p-1 bg-dark w-25"></div>
    <div>
        <span class="text-dark">Already registered?</span>
        <a href="./login.php" class="text-center text-dark">Login here</a>
    </div>
    <div>
        <a class='text-dark' href="../index.php">Return Home</a>
    </div>
</section>
<script src="../js_functions/registration.js"></script>
<?php include '../partials/footer.php'; ?>