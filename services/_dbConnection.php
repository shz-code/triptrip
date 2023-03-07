<?php 
class Database
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "triptrip";
    protected $conn;
    protected function connect(){
        try {
            $this->conn = new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
        } catch (mysqli_sql_exception) {
            die(header("HTTP/1.0 503 Service Unavailable Error"));
        }
    }
}

class Query extends Database
{
    public function getPackages($location,$start,$end){
        $this->connect();
        $location = mysqli_real_escape_string($this->conn ,$location);
        
        if($location == "All")
        {
            $sql = "SELECT * FROM packages LIMIT $start,$end";
        }
        else $sql = "SELECT * FROM packages WHERE package_location LIKE '%$location%' LIMIT $start,$end";

        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getPackage($id){
        $this->connect();
        
        $sql = "SELECT * FROM packages WHERE package_id = $id";

        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getPackagesCount(){
        $this->connect();
        $sql = "SELECT * FROM packages";
        $result = $this->conn->query($sql);
        $this->conn->close();
        return $result->num_rows;
    }
    public function getPackagesWithQueryCount($location){
        $this->connect();

        $location = mysqli_real_escape_string($this->conn ,$location);

        $sql = "SELECT * FROM packages WHERE package_location LIKE '%$location%'";
        $result = $this->conn->query($sql);
        $this->conn->close();
        return $result->num_rows;
    }
}

class Auth extends Database
{
    public function checkUserName($username){
        $this->connect();
        $sql = "SELECT username FROM users WHERE  username = '" . $username . "'";
        $result = $this->conn->query($sql);
        $this->conn->close();
        
        if($result->num_rows > 0) return false;
        return true;
    }
    public function checkEmail($email){
        $this->connect();
        $sql = "SELECT email FROM users WHERE email = '" . $email . "'";
        $result = $this->conn->query($sql);
        $this->conn->close();
        
        if($result->num_rows > 0) return false;
        return true;
    }

    public function createUser($username,$email,$pass){
        $this->connect();
        $sql = "INSERT INTO users(username, email, user_pass) VALUES ('$username','$email','$pass')";
        try {
            $this->conn->query($sql);
            $this->conn->close();
            echo "200";
        } catch (mysqli_sql_exception) {
            $this->conn->close();
            die(header("HTTP/1.0 500 Internal Server Error"));
        }
    }
    public function loginUser($email,$pass){
        $this->connect();
        $sql = "SELECT email, user_pass FROM users WHERE email= '" . $email . "' AND user_pass= '" . $pass . "' ";
        try {
            $result = $this->conn->query($sql);
            $this->conn->close();
            $row = $result->num_rows;
            if($row == 1) 
            {
                if (!isset($_SESSION)) session_start();
                $_SESSION["logged_in"] = true;
                $_SESSION["Email"] = $email;
            }
            else die(header("HTTP/1.0 404 User Not Found"));
        } catch (mysqli_sql_exception) {
            $this->conn->close();
            die(header("HTTP/1.0 500 Internal Server Error"));
        }
    }
}

?>