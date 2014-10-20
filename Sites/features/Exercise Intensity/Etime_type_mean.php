<?php

 $con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
 mysqli_query($con,"DELETE FROM Etime_type_mean");

$exe_type = array("run","cycling","swim","basketball","volleyball","tennis","football");
   
   for($i = 0; $i < count($exe_type); $i++){

      $sql1 = "SELECT AVG(exercise_time) FROM Etime_type WHERE exercise_type LIKE  '%".$exe_type[$i]."%'";
      $sql2 = "SELECT MAX(exercise_time) FROM Etime_type WHERE exercise_type LIKE  '%".$exe_type[$i]."%'";
      $sql3 = "SELECT STDDEV(exercise_time) FROM Etime_type WHERE exercise_type LIKE  '%".$exe_type[$i]."%'";
      $result1 = mysqli_query($con,$sql1); 
      $result2 = mysqli_query($con,$sql2);
      $result3 = mysqli_query($con,$sql3); 
      echo $exe_type[$i]."<br>";
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

      $sql = "INSERT INTO Etime_type_mean(exercise_type,mean,max,std) VALUES ('".$exe_type[$i]."','".$ave."','".$max."','".$std."')";
    
      mysqli_query($con,$sql);
    }  


 
 mysqli_close($con);
?>