<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM Etime_state");
 //*****count EX MIn*********///
function number($str) {
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
//////*****************Weight_follower*******************////
function Weight_follower($fol_num){
   
    if ($fol_num < 100){
      $weight = 1;
    }else if($fol_num < 1000){
      $weight = 2;
    }else if($fol_num < 2000){
      $weight = 3;
    }else if($fol_num < 10000){
      $weight = 4;
    }else {$weight = 5; }

    return $weight;
    
 }  
 /////*****************************


 $state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");
    
 for($j = 0; $j < count($state_name); $j++){

      $sql = "SELECT tweets.tweet_text, users.followers_count FROM tweets LEFT JOIN users on tweets.user_id = users.user_id WHERE location LIKE
      '%".$state_name[$j]."%' AND 
       tweets.tweet_text LIKE '%min%'"; 

        $result = mysqli_query($con,$sql); 

         while($array = mysqli_fetch_array($result)){
           $num = extractnum($array[0]);
           echo "state name is:".$state_name[$j];
           echo "<br>";
           echo "tweets is:".$array[0];
           echo "<br>";
           echo "extract num is:". $num. "<br>"; 
           echo "follower number is:".$array[1]."<br>";
           
          
          $weight = Weight_follower($array[1]); 
          //ExTime_Weight_Efficient
          echo "weight is:".$weight."<br>";


           if($num != 0 && $num < 200 ){

              $sql = "INSERT INTO ETime_State(state_name,exercise_time) Values ('".$state_name[$j]."','".$num."')";
              echo"int is :". $num."<br>";
            } 
           else {echo "the int is out of scope"."<br>";
            }

          
          mysqli_query($con,$sql);
  
        }
}
 
 mysqli_close($con);
?>