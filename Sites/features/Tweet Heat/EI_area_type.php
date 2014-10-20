<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_area_type";
mysqli_query($con,$sql_delete);

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE",
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH",
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD",
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");
$state_name_count = count($state_name);
$exercise_type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");
$exercise_type_count = count($exercise_type);

for($i=0;$i< $exercise_type_count;$i++){ 
  	for($j = 0; $j < $state_name_count; $j++){
        $sql = "SELECT count(*) FROM users LEFT JOIN tweets on tweets.user_id = users.user_id WHERE location LIKE '%".$state_name[$j]."%' AND tweet_text LIKE '%".$exercise_type[$i]."%'"; 
        $result = mysqli_query($con,$sql); 
 
        while($array = mysqli_fetch_array($result)){
            $sql = "INSERT INTO EI_area_type(exercise_type, state_name, state_count) VALUES ('".$exercise_type[$i]."','".$state_name[$j]."',".$array[0].")";
            mysqli_query($con,$sql);
        }
    }
}

mysqli_close($result); 
mysqli_close($con);

?>
 
 