<?php 
class Database
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "triptrip";
    protected $conn;
    protected function connect(){
        $this->conn = new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
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

?>