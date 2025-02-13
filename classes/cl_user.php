<?php
class cl_user
{
    private $conn;

    //USERS
    public $user_id;
    public $username;
    public $password;
    public $is_admin;
    public $is_active;

    //PERSONAL INFOS
    public $image_url;
    public $given_name;
    public $middle_name;
    public $last_name;
    public $suffix_name;
    public $sex;
    public $date_of_birth;
    public $place_of_birth;
    public $civil_status;
    public $employment_status;
    public $religion;
    public $nationality;


    public function __construct($dbase)
    {
        $this->conn = $dbase;
    }

    // Users
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
                'user_id'       => $user['user_id'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin'],
                'is_active'=> $user['is_active']
            ];
    
            // Redirect to dashboard
            header("Location: ./dashboard.php");
            exit();
        } else {
            // Redirect with error message
            echo "
                <script>
                        let timerInterval;
                        Swal.fire({
                            icon: 'warning',
                            html:
                                '<span>Login Failed! Invalid Credentials!</span>',
                                showConfirmButton: false,
                                timer: 3000
                        }).then(function() {
                            window.location.href='./login.php?error=1';
                        });
                    </script>";
            // header("Location: ./login.php?error=1");
            exit();
        }
    }

    // Personal informations
    public function createPersonalInformation(){
        $query = "INSERT INTO personal_informations 
                SET image_url = :image_url,
                given_name = :given_name,
                middle_name = :middle_name,
                last_name=:last_name,
                suffix_name = :suffix_name,
                sex = :sex,
                date_of_birth = :date_of_birth,
                place_of_birth = :place_of_birth,
                civil_status = :civil_status,
                employment_status = :employment_status,
                religion = :religion,
                nationality = :nationality,
                user_id = :user_id
                ";
            $statement = $this->conn->prepare($query);            

            $statement->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
            $statement->bindParam(':given_name', $this->given_name, PDO::PARAM_STR);
            $statement->bindParam(':middle_name', $this->middle_name, PDO::PARAM_STR);
            $statement->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
            $statement->bindParam(':suffix_name', $this->suffix_name, PDO::PARAM_STR);
            $statement->bindParam(':sex', $this->sex, PDO::PARAM_STR);
            $statement->bindParam(':date_of_birth', $this->date_of_birth, PDO::PARAM_STR);
            $statement->bindParam(':place_of_birth', $this->place_of_birth, PDO::PARAM_STR);
            $statement->bindParam(':civil_status', $this->civil_status, PDO::PARAM_STR);
            $statement->bindParam(':employment_status', $this->employment_status, PDO::PARAM_STR);
            $statement->bindParam(':religion', $this->religion, PDO::PARAM_STR);
            $statement->bindParam(':nationality', $this->nationality, PDO::PARAM_STR);
            $statement->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);            

            if ($statement->execute()) {
                echo "
                    <script>
                        let timerInterval;
                        Swal.fire({
                            icon: 'success',
                            html:
                                '<span>Success!</span>',
                                showConfirmButton: false,
                                timer: 1000
                        }).then(function() {
                            window.location.href='profile.php';
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

    public function isPersonalInformationExisting($user_id){
        $query = "SELECT COUNT(*) as count FROM personal_informations WHERE user_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $user_id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row['count'] > 0;
    }

    public function readPersonalInformation($user_id){
        $query = "SELECT 
                personal_information_id,
                image_url,
                given_name, 
                middle_name,
                last_name,
                suffix_name,
                sex,
                date_of_birth,
                place_of_birth,
                civil_status,
                employment_status,
                religion,
                nationality,
                user_id
                FROM personal_informations            
                WHERE user_id = :user_id 
            ";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
}