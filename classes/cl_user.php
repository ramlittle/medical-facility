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
    public $personal_information_id;
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

    public function isUserIdExists($userId)
    {
        $query = "SELECT COUNT(*) as count FROM users WHERE user_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $userId);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row['count'] > 0;
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
    
        //verify if user is active
        if($user && $user['is_active']===1){
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
            }else{
                //Redirect with error invalid credentials
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
                exit();
            }
        }else {
            // Redirect with account deactivated
            echo "
                <script>
                        let timerInterval;
                        Swal.fire({
                            icon: 'error',
                            html:
                                '<span>Your Account is deactivated! Please notify the administration.</span>',
                                showConfirmButton: false,
                                timer: 3000
                        }).then(function() {
                            window.location.href='./login.php?error=1';
                        });
                    </script>";            
            exit();
        }
        
    }

    public function readUsers(){
        $query = "SELECT 
                user_id,
                username,
                is_active,
                created_at
                FROM users";

        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function archiveSelectedUser($user_id){
        $query = "UPDATE users
          SET is_active = :is_active
          WHERE user_id = :user_id";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':is_active', $this->is_active, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if($statement->execute()) {
            echo "
            <script>
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    html:
                        '<span>Archiving Successful</span>',
                        showConfirmButton: false,
                        timer: 3000
                }).then(function() {
                    window.location.href='administration.php';
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
    public function restoreSelectedUser($user_id){
        $query = "UPDATE users
          SET is_active = :is_active
          WHERE user_id = :user_id";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':is_active', $this->is_active, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if($statement->execute()) {
            echo "
            <script>
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    html:
                        '<span>Archiving Successful</span>',
                        showConfirmButton: false,
                        timer: 3000
                }).then(function() {
                    window.location.href='administration.php';
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
    // Personal informations
    public function createPersonalInformation($page_to_return_to){
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

            if($statement->execute()) {
                if($page_to_return_to==='administration.php'){
                    echo "
                        <script>
                            let timerInterval;
                            Swal.fire({
                                icon: 'success',
                                html:
                                    '<span>You have successfully ' +
                                    '<b>updated</b> ' +
                                    'a record!</span>',
                                    showConfirmButton: false,
                                    timer: 3000
                            }).then(function() {
                                window.location.href='administration.php';
                            });
                        </script>";   		
                    } else {
                        echo "
                            <script>
                                let timerInterval;
                                Swal.fire({
                                    icon: 'success',
                                    html:
                                        '<span>You have successfully ' +
                                        '<b>updated</b> ' +
                                        'a record!</span>',
                                        showConfirmButton: false,
                                        timer: 3000
                                }).then(function() {
                                    window.location.href='profile.php';
                                });
                            </script>"; 
                    }
                }else{
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

    public function readPersonalInformationPerUserId($user_id){
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

    public function updatePersonalInformation($page_to_return_to){    
        $query = "UPDATE personal_informations
                    SET image_url = :image_url,
                    given_name = :given_name,
                    middle_name = :middle_name,
                    last_name = :last_name,
                    suffix_name =:suffix_name,
                    sex = :sex,
                    date_of_birth = :date_of_birth,
                    place_of_birth = :place_of_birth,
                    civil_status = :civil_status,
                    employment_status = :employment_status,
                    religion = :religion,
                    nationality = :nationality,
                    user_id = :user_id
                    WHERE personal_information_id = :personal_information_id";        
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
        $statement->bindParam(':personal_information_id', $this->personal_information_id, PDO::PARAM_INT);
          
        if($statement->execute()) {
            if($page_to_return_to==='administration.php'){
                echo "
                    <script>
                        let timerInterval;
                        Swal.fire({
                            icon: 'success',
                            html:
                                '<span>You have successfully ' +
                                '<b>updated</b> ' +
                                'a record!</span>',
                                showConfirmButton: false,
                                timer: 3000
                        }).then(function() {
                            window.location.href='administration.php';
                        });
                    </script>";   		
                } else {
                    echo "
                        <script>
                            let timerInterval;
                            Swal.fire({
                                icon: 'success',
                                html:
                                    '<span>You have successfully ' +
                                    '<b>updated</b> ' +
                                    'a record!</span>',
                                    showConfirmButton: false,
                                    timer: 3000
                            }).then(function() {
                                window.location.href='profile.php';
                            });
                        </script>"; 
                }
            }else{
                echo "
                    <script>
                        Swal.fire({
                            title: 'Error',
                            icon: 'error'
                        });
                    </script>";
            }
              		
    }

    public function readAllPersonalInformation(){
        $query = "SELECT 
                personal_information_id,
                created_at,
                image_url,
                CONCAT(given_name,' ',middle_name,' ',last_name,' ',suffix_name) AS full_name,
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
            ";

        $statement = $this->conn->prepare($query);        
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}