<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_area_overall";
mysqli_query($con,$sql_delete);

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE",
"FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
"MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH",
"NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD",
"TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

for($i=0;$i<count($state_name);$i++) {  
    $sql = "SELECT COUNT(location) FROM users WHERE location LIKE BINARY '%".$state_name[$i]."%'" ;
    $result = mysqli_query($con,$sql);
    
    while($array = mysqli_fetch_array($result)){
        $state_count = $array[0];
        $sql = "INSERT INTO EI_area_overall(state_name,state_count) VALUES ('".$state_name[$i]."',".$state_count.")";
        mysqli_query($con,$sql);
    }
}

mysqli_close($result);
mysqli_close($con);
?>
 
 