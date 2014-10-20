<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM EI_time_mood";
mysqli_query($con,$sql_delete);



//*************take out info from ANEW ********************************************
$sql1 = "SELECT description FROM ANEW";
$sql2 = "SELECT Valence_Mean FROM ANEW";
$sql3 = "SELECT Valence_SD FROM ANEW";
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
$result3 = mysqli_query($con,$sql3);

$k1=0; $k2=0; $k3=0;
/// $test1 is all description work, 
while($array1 = mysqli_fetch_array($result1)){
  $desp[$k1] = $array1[0];
  $k1++;
}
//// $test2 is all responding valence_mean
while($array2 = mysqli_fetch_array($result2)){
  $valence_mean[$k2] = $array2[0];
  $k2++;
}
/// $test3 is  all responding Valence_SD
while($array3 = mysqli_fetch_array($result3)){
  $Valence_SD[$k3] = $array3[0];
  $k3++;
}
$k5=0;
   $tweets = array("my wife","treat me","very well","triumphant love paradise","I run today","I am very happy");

     for ($i=0;$i<count($tweets);$i++){

       for($j=0;$j<count($desp);$j++){
          if(strpos(".$tweets[$i].",$desp[$j])){
          $desp_key[$k5]= $j;
        
          $k5++;
         
         }
       }  

       $EX_all=0; $Val_SD=0;
         
       $s5=0;

        for($t=0;$t<count($desp_key);$t++){
           
        $Val_SD_weight = 1 / $Valence_SD[$desp_key[$t]];
        echo "Val_SD_weight is " .$Val_SD_weight."<br>";
       
        $EX_all+= $valence_mean[$desp_key[$t]] * $Val_SD_weight ;
        echo "EX_all is " .$EX_all."<br>";
        $Val_SD +=  $Val_SD_weight;
        echo "Val_SD is " .$Val_SD."<br>";
       
         
        }
          $EX_single = $EX_all / $Val_SD; 
        
          //得到某一条tweets的评分,0.39894
          
          $s5 += $EX_single;//$s5记录某个时间段所有tweets的评分和

       
        echo $s5."<br>";
         unset($desp_key);
        
     //单条tweets匹配检测结束
        
   
     
    }
      //某个时间段所有tweets匹配检测结束

  
          
  

?>