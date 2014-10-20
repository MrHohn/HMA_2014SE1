<?php

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql_delete = "DELETE FROM EI_type_mood";
mysqli_query($con,$sql_delete);

$type = array("running", "cycling", "swimming", "basketball", "volleyball", "tennis", "football");

//*************take out info from ANEW *********************************************
$sql_desc = "SELECT description FROM ANEW";
$sql_val_mean = "SELECT Valence_Mean FROM ANEW";
$sql_val_sd = "SELECT Valence_ SD FROM ANEW";
//Arousal_ Mean
//Arousal_ SD
//Word Frequency

$result_desc = mysqli_query($con,$sql_desc);
$result_val_mean = mysqli_query($con,$sql_val_mean);
$result_val_sd = mysqli_query($con,$sqlval_sd);

$k_desc=0; $k_val_mean=0; $k_val_sd=0;
/// $desc is all description work, 
while($array1 = mysqli_fetch_array($result_desc)){
  $desc[$k_desc] = $array1[0];
  $k_desc++;
}
//// $val_mean is all responding valence_mean
while($array2 = mysqli_fetch_array($result_val_mean)){
  $val_mean[$k_val_mean] = $array2[0];
  $k_val_mean++;
}
/// $val_sd is  all responding word_frequency
while($array3 = mysqli_fetch_array($result_val_sd)){
  $val_sd[$k_val_sd] = $array3[0];
  $k_val_sd++;
}
//***************************************************************
//***************************************************************
//***************************************************************
//***************************************************************

// $tweet_related is all related type tweets!!!

for($p=0;$p<count($type);$p++){

    $k_tweet=0;
	$sql4 = "SELECT tweet_text FROM tweets WHERE tweet_text LIKE '%".$type[$p]."%'";
	echo $type[$p]."<br>";
    $result_tweet = mysqli_query($con,$sql4);

    while($array4 = mysqli_fetch_array($result_tweet)){
            $tweet_related[$k_tweet] = $array4[0];
            $k_tweet++;
     }
///这里把tweets的相关内容放入数组tweet_related中,测试通过
     /*print_r($tweet_related);
     for($q=0;$q<100;$q++){
     	echo "<br>";
     } */
   
//start to check respoding key
   ///关于run的多条tweet开始匹配
     $score_all=0;
    for($i=0;$i<count($tweet_related);$i++){
    /////准备进行某一条关键词匹配测试
         $k5=0;
         $test5=array();
         $test6=array();

        
	    for($j=0;$j<count($desc);$j++){
		 

		    if(strpos(".$tweet_related[$i].",$desc[$j])){
      
			$test5[$k5]= $j;
			$k5++;
		    }
        }
//test5中放入了匹配当前条的关键词标号
       $s1=0; $s2=0;
//这里计算的是当前条目的评分数
       for($t=0;$t<count($test5);$t++){
       
         $s1 += $val_mean[$test5[$t]]* $val_sd[$test5[$t]];
         $s2 += $val_sd[$test5[$t]];
       
         $s3 = $s1 / $s2;
        
        }
       
//这里 $S3  是某一条的评分数
        $score_all=$s3+$score_all;
        
       
    } 


      $final = $score_all/count($tweet_related);
      echo $final."f";
    
   

  

    $sql = "INSERT INTO EI_type_mood(type,mood_value) VALUES ('".$type[$p]."',$final)";
    mysqli_query($con,$sql);
    unset($test5);
    unset($tweet_related);
    
 }   
echo $final."f";
mysqli_close($con);

?>