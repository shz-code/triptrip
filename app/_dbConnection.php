<?php
class Database
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "triptrip";
    protected $conn;
    protected function connect()
    {
        try {
            $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
        } catch (mysqli_sql_exception) {
            die(header("HTTP/1.0 503 Service Unavailable Error"));
        }
    }
}

class Packages extends Database
{
    public function getPackages($location, $start = 0, $end = 1000)
    {
        $this->connect();
        $location = mysqli_real_escape_string($this->conn, $location);

        if ($location == "All") {
            $sql = "SELECT * FROM packages LIMIT $start,$end";
        } else {
            $sql = "SELECT * FROM packages WHERE package_location LIKE '%$location%' LIMIT $start,$end";
        }

        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getPackage($id)
    {
        $this->connect();

        $sql = "SELECT * FROM packages WHERE package_id = $id";

        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getPackagesCount()
    {
        $this->connect();
        $sql = "SELECT * FROM packages";
        $result = $this->conn->query($sql);
        $this->conn->close();
        return $result->num_rows;
    }
    public function getPackagesWithQueryCount($location)
    {
        $this->connect();

        $location = mysqli_real_escape_string($this->conn, $location);

        $sql = "SELECT * FROM packages WHERE package_location LIKE '%$location%'";
        $result = $this->conn->query($sql);
        $this->conn->close();
        return $result->num_rows;
    }
}

class Auth extends Database
{
    public function checkUserName($username)
    {
        $this->connect();
        $sql = "SELECT username FROM users WHERE  username = '" . $username . "'";
        $result = $this->conn->query($sql);
        $this->conn->close();

        if ($result->num_rows > 0) {
            return false;
        }

        return true;
    }
    public function checkEmail($email)
    {
        $this->connect();
        $sql = "SELECT email FROM users WHERE email = '" . $email . "'";
        $result = $this->conn->query($sql);
        $this->conn->close();

        if ($result->num_rows > 0) {
            return false;
        }

        return true;
    }

    public function createUser($username, $email, $pass)
    {
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
    public function loginUser($email, $pass)
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE email= '" . $email . "' AND user_pass= '" . $pass . "' ";
        try {
            $result = $this->conn->query($sql);
            $this->conn->close();
            $row = $result->num_rows;
            if ($row == 1) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $result = mysqli_fetch_assoc($result);
                if ($result['is_admin'] == '1') {
                    $_SESSION["is_admin"] = true;
                }
                $_SESSION["user_id"] = $result['id'];
                $_SESSION["logged_in"] = true;
                $_SESSION["Email"] = $email;
            } else {
                die(header("HTTP/1.0 404 User Not Found"));
            }
        } catch (mysqli_sql_exception) {
            $this->conn->close();
            die(header("HTTP/1.0 500 Internal Server Error"));
        }
    }
}

class Users extends Database
{
    public function getAllUsers($limit = 1000)
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE is_admin = 0 ORDER BY date_created LIMIT $limit ";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getUser($id)
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getUsersCount()
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE is_admin = 0";
        $result = $this->conn->query($sql);
        $this->conn->close();
        return $result->num_rows;
    }
}

class Transactions extends Database
{
    public function getAllTransactions($limit = 1000)
    {
        $this->connect();
        $sql = "SELECT * FROM transactions ORDER BY trans_date LIMIT $limit";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getTransaction($id)
    {
        $this->connect();
        $sql = "SELECT * FROM transactions WHERE trans_id = $id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function checkUserTransaction($user_id, $package_id)
    {
        $this->connect();
        $sql = "SELECT * FROM transactions WHERE user_id = $user_id AND package_id = $package_id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getTotalTransactionAmount()
    {
        $this->connect();
        $sql = "SELECT * FROM transactions";
        $result = $this->conn->query($sql);
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['trans_amount'];
        }
        $this->conn->close();
        return $total;
    }
    public function createNewTransaction($trans_id, $user_id, $package_id, $trans_amount, $trans_date, $card_no, $val_id)
    {
        $this->connect();
        $sql = "INSERT INTO transactions (trans_id,user_id,package_id,trans_amount,trans_date,card_no,val_id) VALUES ('" . $trans_id . "'," . $user_id . "," . $package_id . "," . $trans_amount . ",'" . $trans_date . "','" . $card_no . "','" . $val_id . "')";
        $this->conn->query($sql);
        $this->conn->close();
        return "200";
    }
}
