<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM Etime_state_mean");

$state_name = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", 
  "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", 
  "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", 
  "NJ", "NM", "NV", "NY","OH", "OK", "OR", "PA", "RI", "SC", "SD", 
  "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");
   
   for($i = 0; $i < count($state_name); $i++){

      $sql1 = "SELECT AVG(exercise_time) FROM Etime_state WHERE state_name LIKE  '%".$state_name[$i]."%'";

      $sql2 = "SELECT MAX(exercise_time) FROM Etime_state WHERE state_name LIKE  '%".$state_name[$i]."%'";
      $sql3 = "SELECT STDDEV(exercise_time) FROM Etime_state WHERE state_name LIKE  '%".$state_name[$i]."%'";
      $result1 = mysqli_query($con,$sql1); 
      $result2 = mysqli_query($con,$sql2); 
      $result3 = mysqli_query($con,$sql3);
      echo $state_name[$i]."<br>";

      while($array1 = mysqli_fetch_array($result1)){
        $ave = (int)$array1[0];
        echo "Ave is:".$ave."<br>";
      }

      while($array2 = mysqli_fetch_array($result2)){
         $max = (int)$array2[0];
         echo "Max is :".$max."<br>";
      }

      while($array3 = mysqli_fetch_array($result3)){
          $std = (int)$array3[0];
          echo "std is :".$std."<br>";
      }

      $sql = "INSERT INTO Etime_state_mean(state_name,mean,max,std) VALUES ('".$state_name[$i]."','".$ave."','".$max."','".$std."')";
    
      mysqli_query($con,$sql);
    }  


 
 mysqli_close($con);
?>