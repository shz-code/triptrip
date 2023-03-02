<?php 
include_once("./_dbConnection.php");

if (isset($_POST["query"]) && isset($_POST['start']) && isset($_POST['end'])) {
    $location = $_POST['query'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $query = new Query();
    $data = array();
                
    if ($location != "") {
        $allRes = $query->getPackagesWithQueryCount(($location));
        $res = $query->getPackages($location, $start, $end);
        array_push($data,$allRes);
        while($row = mysqli_fetch_assoc($res))
        {
            array_push($data,$row);
        }
    } 
    else
    {
        $allRes = $query->getPackagesCount();
        $res = $query->getPackages("All", $start, $end);
        array_push($data,$allRes);
        while($row = mysqli_fetch_assoc($res))
        {
            array_push($data,$row);
        }
    }
    $out = array_values($data);
    echo json_encode($out);
}

?>