<?php include '../partials/header.php' ?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <div>
        <h2 class="text-dark">Login</h2>
    </div>
    <div class="mb-5 p-1 bg-dark w-25"></div>
    <form action="" method="post" class="d-flex flex-column w-25">
        <div class="w-100 d-flex flex-column">
            <label class='text-dark' for="email">Username:</label>
            <input class='p-2' type="email" id="email" name="username" placeholder='ex. patient_one' required><br><br>
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