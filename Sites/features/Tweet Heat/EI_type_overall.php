<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql = "DELETE FROM EI_type_overall";
mysqli_query($con, $sql);

$type_array = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

function update($type, $con){

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    }

    $sql = "SELECT COUNT(*) FROM tweets WHERE tweet_text LIKE '%".$type."%'";
    
    $result = mysqli_query($con, $sql);
    while($array = mysqli_fetch_array($result)){
        $num = $array[0];
    }
    $sql = "INSERT INTO EI_type_overall(exercise_type, exercise_count) VALUES ('".$type."',".$num.")";
    mysqli_query($con, $sql);
}

for ($i=0; $i < count($type_array); $i++){
    update($type_array[$i], $con);
}

mysql_close($result);
mysql_close($con);

?>