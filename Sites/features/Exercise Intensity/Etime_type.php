<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM Etime_type");

 $Exe_type = array("run","cycling","swim","basketball","volleyball","tennis","football");
 //$exercisetype = array ("run","swim","basketball","football");

 //************ Average Time Function*************//

function number($str){
  return preg_replace ('/\D/s', '', $str);
}

function extractnum($string){
  //calculate mins
  $pos_min = strpos("$string","min");
    $str_min = substr($string, $pos_min-4, 4); 
    $num_min = number ($str_min);
    $num_min_int = (int)$num_min;
    
    //caculate hours
    $pos_hr = strpos("$string","hr");
    $str_hr = substr($string, $pos_hr-4, 4);
    $num_hr = number($str_hr);
    $num_hr_int = (int)$num_hr;
    // judge if hours exsist
    if ($num_hr_int != 0){
      $num_hr_min = $num_hr_int*60;
    }else{$num_hr_min = 0;}


    $num_min_sum = $num_min_int + $num_hr_min;

 return $num_min_sum;
}

//*****************************************//

 //for ($i = 0; $i < count ($exercisetype);$i++){
for($j = 0; $j < count($Exe_type); $j++){

      $sql = "SELECT tweet_text FROM tweets WHERE tweet_text LIKE
      '%".$Exe_type[$j]."%' AND 
       tweet_text LIKE '%min%'"; 
 //echo $Exe_type[$j];
 //echo $date_array[$i];
        $result = mysqli_query($con,$sql); 

         while($array = mysqli_fetch_array($result)){
           echo "exe_type is:".$Exe_type[$j];
           echo "<br>";
           echo "tweets is:".$array[0];
           echo "<br>";
           $num = extractnum($array[0]);
           echo "extract num is:". $num. "<br>"; 
           
  /*if(!$result1 = 0){
    $sql = "INSERT INTO ExerciseTime(Exe_type,exercise_date,exercise_time) Values ('".$Exe_type[$j]."','"tweets.created_at"','"$result1"')";
        mysqli_query($con,$sql);
  }*/
           if($num != 0 && $num < 200 ){


          
             $sql = "INSERT INTO Etime_type(exercise_type,exercise_time) Values ('".$Exe_type[$j]."','".$num."')";
              echo"int is :". $num."<br>";
            } 
           else {echo "the int is out of scope"."<br>";
            }

          
          mysqli_query($con,$sql);
  
        }
}
 
 mysqli_close($con);
?>