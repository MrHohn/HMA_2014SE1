<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql_delete = "DELETE FROM EI_type_mood";
mysqli_query($con,$sql_delete);

$type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

//*************take out info from ANEW *********************************************
$sql1 = "SELECT description FROM ANEW";
$sql2 = "SELECT Valence_Mean FROM ANEW";
$sql3 = "SELECT Word_Frequency FROM ANEW";
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
$result3 = mysqli_query($con,$sql3);

$k1=0; $k2=0; $k3=0;
/// $test1 is all description work, 
while($array1 = mysqli_fetch_array($result1)){
  $test1[$k1] = $array1[0];
  $k1++;
}
//// $test2 is all responding valence_mean
while($array2 = mysqli_fetch_array($result2)){
  $test2[$k2] = $array2[0];
  $k2++;
}
/// $test3 is  all responding word_frequency
while($array3 = mysqli_fetch_array($result3)){
  $test3[$k3] = $array3[0];
  $k3++;
}
//***************************************************************
//***************************************************************
//***************************************************************
//***************************************************************

// $test4 is all related type tweets!!!

for($p=0;$p<count($type);$p++){

    $k4=0;
	$sql4 = "SELECT tweet_text FROM tweets WHERE tweet_text LIKE '%".$type[$p]."%'";
	echo $type[$p]."<br>";
    $result4 = mysqli_query($con,$sql4);

    while($array4 = mysqli_fetch_array($result4)){
            $test4[$k4] = $array4[0];
            $k4++;
     }
///这里把tweets的相关内容放入数组test4中,测试通过
     /*print_r($test4);
     for($q=0;$q<100;$q++){
     	echo "<br>";
     } */
   
//start to check respoding key
   ///关于run的多条tweet开始匹配
     $s5=0;
    for($i=0;$i<count($test4);$i++){
    /////准备进行某一条关键词匹配测试
         $k5=0;
         $test5=array();
         $test6=array();

        
	    for($j=0;$j<count($test1);$j++){
		 

		    if(strpos(".$test4[$i].",$test1[$j])){
      
			$test5[$k5]= $j;
			$k5++;
		    }
        }
//test5中放入了匹配当前条的关键词标号
       $s1=0; $s2=0;
//这里计算的是当前条目的评分数
       for($t=0;$t<count($test5);$t++){
       
         $s1 += $test2[$test5[$t]]* $test3[$test5[$t]];
         $s2 += $test3[$test5[$t]];
       
         $s3 = $s1 / $s2;
        
        }
       
//这里 $S3  是某一条的评分数
        $s5=$s3+$s5;
        
       
    } 


      $final = $s5/count($test4);
      echo $final."f";
    
   

  

    $sql = "INSERT INTO EI_type_mood(type,mood_value) VALUES ('".$type[$p]."',$final)";
    mysqli_query($con,$sql);
    unset($test5);
    unset($test4);
    
 }   
echo $final."f";
mysqli_close($con);

?>