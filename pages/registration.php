<?php include '../partials/header.php' ?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <div>
        <h2 class="text-dark">Registration</h2>
    </div>
    <div class="mb-5 p-1 bg-dark w-25"></div>

    <form action="" method="post" class="d-flex flex-column w-25">
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="username">Username</label>
            <input class="p-2" id = 'username' type="text" name='username' oninput="validatePassword()"/>
        </div>
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="password">Password</label>
            <input class="p-2" id="password" type="password" name="password" oninput="validatePassword()" />
        </div>
        <div class="w-100 d-flex flex-column">
            <label class="text-dark" for="confirm_password">Confirm Password</label>
            <input class="p-2" id="confirm-password" type="password" name="confirm_password"
                oninput="validatePassword()" />
        </div>
        <p id="error-message" class="text-danger fw-bold text-center" style="display:none;"></p>
        <span id="show-password-button" class="text-decoration-underline text-center" onclick="showPassword()">Show
            password</span>
        <span id="hide-password-button" class="text-decoration-underline text-center" onclick="hidePassword()"
            style="display:none;">Show password</span>
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