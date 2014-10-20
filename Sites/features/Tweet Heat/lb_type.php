<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

mysqli_query($con, "delete from lb_type");

$exercise_type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

for($i=0; $i<count($exercise_type); $i++){
    
    $sql = "SELECT COUNT(*) as num, screen_name, profile_image_url FROM tweets WHERE tweet_text LIKE '%".$exercise_type[$i]."%' GROUP BY screen_name ORDER BY num DESC LIMIT 15";

    $result= mysqli_query($con,$sql);

    echo "<br>".$exercise_type[$i]."<br>";

    while($array = mysqli_fetch_array($result)){
        $num = $array[0];
        $name =$array[1];
        $url = $array[2];

        echo $name."   ".$num."<br>";

        mysqli_query($con,"INSERT INTO lb_type (exercise_type, screen_name, tweet_num, profile_image_url) VALUES ('".$exercise_type[$i]."','".$name."',".$num.",'".$url."')");

    }
}

mysqli_close($result);
mysqli_close($con);

?>