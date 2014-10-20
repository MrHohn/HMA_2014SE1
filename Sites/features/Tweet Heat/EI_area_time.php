<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_area_time";
mysqli_query($con,$sql_delete);

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", 
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

$date_array = array("%02:%:%", "%05:%:%", "%08:%:%", "%11:%:%", "%14:%:%", "%17:%:%", "%20:%:%", "%23:%:%");

for($i=0; $i<count($date_array);$i++){
  	for($j = 0; $j < count($state_name); $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$j]."%' AND tweets.created_at LIKE '%".$date_array[$i]."%'"; 
        $result = mysqli_query($con,$sql); 
        while($array = mysqli_fetch_array($result)){
            $sql = "INSERT INTO EI_area_time(time_node, state_name, state_count) VALUES ('".$date_array[$i]."','".$state_name[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result);
mysqli_close($con);

?>