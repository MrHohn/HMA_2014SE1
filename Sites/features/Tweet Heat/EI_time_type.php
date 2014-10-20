<?php

$date_array = array("%02:%:%", "%05:%:%", "%08:%:%", "%11:%:%", "%14:%:%", "%17:%:%", "%20:%:%", "%23:%:%");
$type_array = array("overall", "running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql = "DELETE FROM EI_time_type";
mysqli_query($con, $sql);

function update($date,$type,$i,$con){
  
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL" . mysqli_connect_error();
    }

    if($type == "overall"){
        $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."'";
        $result = mysqli_query($con, $sql);
        while($array = mysqli_fetch_array($result)){
            $num = $array[0];
        }

        $sql = "INSERT INTO EI_time_type(exercise_type, time_node, time_count) VALUES ('overall".$i."','".$date."',".$num.")";
        mysqli_query($con, $sql);
    }
    else{
        $sql = "SELECT COUNT(*) FROM tweets WHERE created_at LIKE '".$date."' AND tweet_text LIKE '%".$type."%'";
        $result = mysqli_query($con, $sql);
        while($array = mysqli_fetch_array($result)){
            $num = $array[0];
        }
   
        $sql = "INSERT INTO EI_time_type(exercise_type, time_node, time_count) VALUES ('".$type.$i."','".$date."',".$num.")";
        mysqli_query($con, $sql);
    }
}



for($j=0; $j < count($type_array); $j++){
    for ($i=0; $i < count($date_array); $i++){
        update($date_array[$i], $type_array[$j],$i,$con);
    }
}

mysqli_close($result);
mysqli_close($con);

?>