<?php

$date_array = array("%02:%:%", "%05:%:%", "%08:%:%", "%11:%:%", "%14:%:%", "%17:%:%", "%20:%:%", "%23:%:%");

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql = "DELETE FROM EI_time_overall";
mysqli_query($con, $sql);

function update($date,$con){
  
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    }

    $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."'";
    $result = mysqli_query($con, $sql);
    while($array = mysqli_fetch_array($result)){
        $num = $array[0];
    }
   
    $sql = "INSERT INTO EI_time_overall(time_node, time_count) VALUES ('".$date."',".$num.")";
    mysqli_query($con, $sql);
}

for ($i=0; $i < count($date_array); $i++){
    update($date_array[$i],$con);
}

mysqli_close($result);
mysqli_close($con);

?>