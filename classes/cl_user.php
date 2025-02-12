<?php
class cl_user
{
    private $conn;
    public $user_id;
    public $username;
    public $password;
    public $is_admin;
    public $is_active;

    public function __construct($dbase)
    {
        $this->conn = $dbase;
    }

    public function isUsernameExists($username)
    {
        $query = "SELECT COUNT(*) as count FROM users WHERE username = ?";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $username);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row['count'] > 0;
    }

    public function createUser()
{
        // Check if username already exists
        if ($this->isUsernameExists($this->username)) {
            echo "
            <script>
                let timerInterval;
                Swal.fire({
                    icon: 'warning',
                    html:
                        '<span>Sorry, username already exists!</span>',
                        showConfirmButton: false,
                        timer: 3000
                }).then(function() {
                    window.location.href='registration.php';
                });
            </script>";
        } else {
            //continue if new user
            $query = "INSERT INTO users 
                SET username = :username,
                password = :password,
                is_active=:is_active,
                is_admin = :is_admin";
            $statement = $this->conn->prepare($query);
            $hash_password = password_hash($this->password, PASSWORD_BCRYPT);

            $statement->bindParam(':username', $this->username, PDO::PARAM_STR);
            $statement->bindParam(':password', $hash_password, PDO::PARAM_STR);
            $statement->bindParam(':is_active', $this->is_active, PDO::PARAM_INT);
            $statement->bindParam(':is_admin', $this->is_admin, PDO::PARAM_INT);

            if ($statement->execute()) {
                echo "
                    <script>
                        let timerInterval;
                        Swal.fire({
                            icon: 'success',
                            html:
                                '<span>You have registered successfully! Login and complete your profile!</span>',
                                showConfirmButton: false,
                                timer: 5000
                        }).then(function() {
                            window.location.href='login.php';
                        });
                    </script>";
                                } else {
                                    echo "
                    <script>
                        Swal.fire({
                            title: 'Error',
                            icon: 'error'
                        });
                    </script>";
            }
        }
    }

    public function verifyLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Fetch user from database
        $query = "SELECT user_id, username, password, is_admin,is_active FROM users WHERE username = :username";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':username', $this->username, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        // Verify password
        if ($user && password_verify($this->password, $user['password'])) {
            // Store only necessary data in session
            $_SESSION['user'] = [
                'id'       => $user['user_id'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin'],
                'is_active'=> $user['is_active']
            ];
    
            // Redirect to dashboard
            header("Location: ./dashboard.php");
            exit();
        } else {
            // Redirect with error message
            header("Location: ./login.php?error=1");
            exit();
        }
    }
    
}