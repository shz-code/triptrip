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

/*
    Known bugs:
    * Package price can be negative
    * Two users purchase a product at the same time not handled.
    * User purchasing same package multiple times not handled.
    * One user can add multiple reviews on same package
    * Users can write reviews before finishing the tour
*/

class Packages extends Database
{
    public function createPackage($package_name, $package_desc, $package_start, $package_end, $package_price, $package_location, $is_hotel, $is_transport, $is_food, $is_guide, $package_capacity, $map_loc, $master_image, $extra_image_1, $extra_image_2)
    {
        $this->connect();
        $package_name = mysqli_real_escape_string($this->conn, $package_name);
        $package_desc = mysqli_real_escape_string($this->conn, $package_desc);
        $package_location = mysqli_real_escape_string($this->conn, $package_location);
        $map_loc = mysqli_real_escape_string($this->conn, $map_loc);
        $master_image = mysqli_real_escape_string($this->conn, $master_image);
        $extra_image_1 = mysqli_real_escape_string($this->conn, $extra_image_1);
        $extra_image_2 = mysqli_real_escape_string($this->conn, $extra_image_2);

        $sql = "INSERT INTO packages (package_name,package_desc,package_start,package_end,package_price,package_location,is_hotel,is_transport,is_food,is_guide,package_capacity,map_loc,master_image,extra_image_1,extra_image_2)
        VALUES
        ('" . $package_name . "', '" . $package_desc . "', '" . $package_start . "', '" . $package_end . "', '" . $package_price . "', '" . $package_location . "', '" . $is_hotel . "', '" . $is_transport . "', '" . $is_food . "', '" . $is_guide . "', '" . $package_capacity . "', '" . $map_loc . "', '" . $master_image . "', '" . $extra_image_1 . "', '" . $extra_image_2 . "')";

        $this->conn->query($sql);

        $this->conn->close();
        return "200";
    }
    public function updatePackage($package_id, $package_name, $package_desc, $package_start, $package_end, $package_price, $package_location, $is_hotel, $is_transport, $is_food, $is_guide, $package_capacity, $map_loc, $master_image, $extra_image_1, $extra_image_2)
    {
        $this->connect();
        $package_name = mysqli_real_escape_string($this->conn, $package_name);
        $package_desc = mysqli_real_escape_string($this->conn, $package_desc);
        $package_location = mysqli_real_escape_string($this->conn, $package_location);
        $map_loc = mysqli_real_escape_string($this->conn, $map_loc);
        $master_image = mysqli_real_escape_string($this->conn, $master_image);
        $extra_image_1 = mysqli_real_escape_string($this->conn, $extra_image_1);
        $extra_image_2 = mysqli_real_escape_string($this->conn, $extra_image_2);

        $sql = "UPDATE packages 
                SET package_name = '$package_name', package_desc = '$package_desc', package_start = '$package_start', package_end = '$package_end',  package_price = $package_price, package_location = '$package_location', is_hotel = $is_hotel, is_transport = $is_transport, is_food = $is_food,is_guide = $is_guide,package_capacity = $package_capacity,map_loc = '$map_loc',master_image = '$master_image',extra_image_1 = '$extra_image_1',extra_image_2 = '$extra_image_2' 
                WHERE package_id = $package_id";

        $this->conn->query($sql);

        $this->conn->close();
        return "200";
    }
    public function getPackages($location, $start = 0, $end = 1000)
    {
        $this->connect();
        $location = mysqli_real_escape_string($this->conn, $location);

        if ($location == "All") {
            $sql = "SELECT * FROM packages ORDER BY package_id DESC LIMIT $start,$end";
        } else {
            $sql = "SELECT * FROM packages WHERE package_location LIKE '%$location%' ORDER BY package_id DESC LIMIT $start,$end";
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
    public function updatePackagePurchase($id, $count)
    {
        $this->connect();

        $sql = "UPDATE packages SET package_booked = $count WHERE package_id = $id";
        $this->conn->query($sql);

        $this->conn->close();
        return '200';
    }
    public function updateRating($id, $rating)
    {
        $this->connect();

        $sql = "UPDATE packages SET package_rating = $rating WHERE package_id = $id";
        $this->conn->query($sql);

        $this->conn->close();
        return '200';
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
        $date_created = date("Y-m-d H:m:s");
        try {
            $sql = "INSERT INTO users(username, email, user_pass, date_created) VALUES ('$username','$email','$pass','$date_created')";
            $this->conn->query($sql);
            $this->conn->close();
            return "200";
        } catch (mysqli_sql_exception) {
            $this->conn->close();
            die(header("HTTP/1.0 500 Internal Server Error"));
        }
    }
    public function checkAccountStatus($email)
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE email = '" . $email . "' ";
        $result = $this->conn->query($sql);
        $this->conn->close();

        $user = mysqli_fetch_assoc($result);
        if ($result->num_rows > 0 && $user['account_status'] == 0) {
            return false;
        }
        return true;
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
    public function updateUser($user_id, $email, $phone, $name, $address,)
    {
        $this->connect();
        $sql = "UPDATE users 
                SET email = '$email', phone = '$phone', address = '$address', full_name = '$name' 
                WHERE id = $user_id";
        $this->conn->query($sql);
        $this->conn->close();
        return '200';
    }
    public function updateAccountStatus($user_id, $status)
    {
        $this->connect();
        $sql = "UPDATE users 
                SET account_status = $status
                WHERE id = $user_id";
        $this->conn->query($sql);
        $this->conn->close();
        return '200';
    }
}

class Transactions extends Database
{
    public function getAllTransactions($limit = 1000)
    {
        $this->connect();
        $sql = "SELECT * 
            FROM transactions INNER JOIN users ON
            transactions.user_id = users.id
            INNER JOIN packages ON
            transactions.package_id = packages.package_id 
            ORDER BY trans_date 
            LIMIT $limit";
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
    public function userAllTransactions($user_id)
    {
        $this->connect();
        $sql = "SELECT * 
                FROM transactions INNER JOIN packages ON
                transactions.package_id = packages.package_id
                WHERE user_id = $user_id 
                ORDER BY trans_date";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getUserTransaction($user_id, $package_id)
    {
        $this->connect();
        $sql = "SELECT * 
                FROM transactions INNER JOIN users ON
                transactions.user_id = users.id
                INNER JOIN packages ON
                transactions.package_id = packages.package_id 
                WHERE user_id = $user_id AND transactions.package_id = $package_id
                ORDER BY trans_date
                LIMIT 1";
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
    public function createNewTransaction($trans_id, $user_id, $package_id, $trans_amount, $trans_date, $card_no, $val_id, $card_type)
    {
        $this->connect();
        $sql = "INSERT INTO transactions (trans_id,user_id,package_id,trans_amount,trans_date,card_no,val_id,card_type) VALUES ('" . $trans_id . "'," . $user_id . "," . $package_id . "," . $trans_amount . ",'" . $trans_date . "','" . $card_no . "','" . $val_id . "','" . $card_type . "')";
        $this->conn->query($sql);
        $this->conn->close();
        return "200";
    }
    public function getRangedTransitions($days)
    {
        $this->connect();
        $sql =  "SELECT * 
                FROM transactions INNER JOIN  users ON
                transactions.user_id = users.id 
                INNER JOIN  packages ON
                transactions.package_id = packages.package_id
                WHERE trans_date > CURRENT_DATE - INTERVAL $days day";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getRangedTransitionsTotal($days)
    {
        $this->connect();
        $sql = "SELECT * FROM transactions WHERE trans_date > CURRENT_DATE - INTERVAL $days day";
        $result = $this->conn->query($sql);
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['trans_amount'];
        }
        $this->conn->close();
        return $total;
    }
}

class Testimonials extends Database
{
    public function getAllTestimonials($limit = 1000)
    {
        $this->connect();
        $sql = "SELECT * 
            FROM testimonials INNER JOIN users ON
            testimonials.user_id = users.id
            INNER JOIN packages ON
            testimonials.package_id = packages.package_id 
            ORDER BY testimonials.date_created DESC
        LIMIT $limit";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function getPackageTestimonials($package_id, $limit = 1000)
    {
        $this->connect();
        $sql = "SELECT * 
            FROM testimonials INNER JOIN users ON
            testimonials.user_id = users.id
            INNER JOIN packages ON
            testimonials.package_id = packages.package_id 
            WHERE  testimonials.package_id = $package_id
            ORDER BY testimonials.date_created DESC
            LIMIT $limit";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function checkUserTestimonialStatus($user_id)
    {
        $this->connect();
        $sql = "SELECT DISTINCT package_id 
            FROM testimonials 
            WHERE user_id = $user_id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result;
    }
    public function addTestimonial($desc, $user_id, $package_id, $rating)
    {
        $this->connect();
        $desc = mysqli_real_escape_string($this->conn, $desc);
        $sql = "INSERT INTO testimonials (message,user_id,package_id,rating) VALUES('$desc',$user_id,$package_id,$rating)";
        $this->conn->query($sql);

        $this->conn->close();
        return '200';
    }
}
