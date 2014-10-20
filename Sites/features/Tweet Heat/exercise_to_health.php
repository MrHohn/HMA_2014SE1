<?php

function linear_regression($x, $y) {

  // calculate number points
  $n = count($x);
  
  // ensure both arrays of points are the same size
  if ($n != count($y)) {

    trigger_error("linear_regression(): Number of elements in coordinate arrays do not match.", E_USER_ERROR);
  
  }

  // calculate sums
  $x_sum = array_sum($x);
  $y_sum = array_sum($y);

  $xx_sum = 0;
  $xy_sum = 0;
  
  for($i = 0; $i < $n; $i++) {
  
    $xy_sum+=($x[$i]*$y[$i]);
    $xx_sum+=($x[$i]*$x[$i]);
    
  }
  
  // calculate slope
  $m = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));
  
  // calculate intercept
  $b = ($y_sum - ($m * $x_sum)) / $n;
    
  // return result
  return array("m"=>$m, "b"=>$b);

}

function Average($arr)
{
    $sum = Sum($arr);
    $num = count($arr);
    
    return $sum/$num;
}

function Sum($arr)
{
    return array_sum($arr);
}

function MeanDeviation($arr, $item)
{
    $average = Average($arr);
    
    return $arr[$item] - $average;
} 

function SquareMeanDeviation($arr, $item)
{
    return MeanDeviation($arr, $item) * MeanDeviation($arr, $item);
}

function SumSquareMeanDeviation($arr)
{
    $sum = 0;
    
    $num = count($arr);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + SquareMeanDeviation($arr, $i);
    }
    
    return $sum;
}

function ProductMeanDeviation($arr1, $arr2, $item)
{
    return (MeanDeviation($arr1, $item) * MeanDeviation($arr2, $item));
}

function SumProductMeanDeviation($arr1, $arr2)
{
    $sum = 0;
    
    $num = count($arr1);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + ProductMeanDeviation($arr1, $arr2, $i);
    }
    
    return $sum;
}

function stats_stat_correlation($arr1, $arr2)
{        
    $correlation = 0;
    
    $k = SumProductMeanDeviation($arr1, $arr2);
    $ssmd1 = SumSquareMeanDeviation($arr1);
    $ssmd2 = SumSquareMeanDeviation($arr2);
    
    $product = $ssmd1 * $ssmd2;
    
    $res = sqrt($product);
    
    $correlation = $k / $res;
    
    return $correlation;
}

function SumMeanDeviation($arr)
{
    $sum = 0;
    
    $num = count($arr);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + MeanDeviation($arr, $i);
    }
    
    return $sum;
}   


$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");

$sql_delete = "DELETE FROM exercise_to_health";
mysqli_query($con,$sql_delete);

$date_array = array("%00:%:%","%01:%:%","%02:%:%", "%03:%:%","%04:%:%","%05:%:%",
				 "%06:%:%","%07:%:%","%08:%:%", "%09:%:%","%10:%:%","%11:%:%", 
				 "%12:%:%","%13:%:%","%14:%:%", "%15:%:%","%16:%:%","%17:%:%", 
				 "%18:%:%","%19:%:%","%20:%:%","%21:%:%","%22:%:%", "%23:%:%");
/*
$date_array = array( "%15:%:%","%16:%:%","%17:%:%", 
				 "%18:%:%");
*/

$health_array = array();
$exercise_array = array();
$fruit_array = array();

for($i=0; $i<count($date_array);$i++){

	$sql1 = "SELECT count(*) FROM tweets WHERE created_at LIKE '%".$date_array[$i]."%'";


	$sql2= "SELECT count(*) FROM tweets 
 	WHERE created_at LIKE '%".$date_array[$i]."%' 
 	AND tweet_text LIKE '%running%'
 	OR '%football%'
 	OR '%cycling%'
 	OR '%swimming%'
 	OR '%basketball%'
 	OR '%volleyball%'
 	OR '%tennis%'";

	$sql3= "SELECT count(*) FROM tweets 
 	WHERE created_at LIKE '%".$date_array[$i]."%'
 	AND tweet_text LIKE '%apple%'
 	OR '%banana%'
 	OR '%lemon%'
 	OR '%orange%'
 	OR '%pear%'
 	OR '%milk%'
 	OR '%meat%' 
 	OR '%vegetable%'";


	$result1 = mysqli_query($con,$sql1);
  
	$result2 = mysqli_query($con,$sql2); 

	$result3 = mysqli_query($con,$sql3);
 
 	$array_tmp1;
 	$array_tmp2;
 
 	while($array1 = mysqli_fetch_array($result1)){

 		$array_tmp1 = $array1[0];
 	}
 
 	while($array2 = mysqli_fetch_array($result2)){

 		$array_tmp2 = $array2[0];
 	}
  
 	while($array3 = mysqli_fetch_array($result3)){
 		$sql = "INSERT INTO exercise_to_health(duration, health_count, exercise_count,fruit_count) 
 		VALUES ('".$date_array[$i]."',".$array_tmp1.",".$array_tmp2.",".$array3[0].")";
 		mysqli_query($con,$sql);
	}
}

$sql = "select * from exercise_to_health order by health_count";
$result = mysqli_query($con,$sql);

$sql_delete = "DELETE FROM exercise_to_health";
mysqli_query($con,$sql_delete);

while($array = mysqli_fetch_array($result)){
	echo $array[0]."   ";
	echo $array[1]."   ";
	echo $array[2]."   ";
	echo $array[3]."<br>";
	$health_array[$i]=$array[1];
	$exercise_array[$i]=$array[2];
	$fruit_array[$i]=$array[3];
	
	$sql = "INSERT INTO exercise_to_health(duration, health_count, exercise_count,fruit_count) 
 	VALUES ('".$array[0]."',".$array[1].",".$array[2].",".$array[3].")";
 	mysqli_query($con,$sql);
 	$i++;
}
 
//test function
/* $array_x = array(5,3,6,7,4,2,9,5);
$array_y = array(4,3,4,8,3,2,10,5);
$he_index = stats_stat_correlation($array_x,$array_y);
*/

 

//health & exercise

$sql_delete = "DELETE FROM correlation_he";
mysqli_query($con,$sql_delete);

$he_index = stats_stat_correlation($health_array, $exercise_array);

 
$he = array();
$he = linear_regression($health_array, $exercise_array); 
echo "m is: ".$he["m"]."<br>";
echo "b is: ".$he["b"]."<br>";


$sql4= "SELECT health_count,exercise_count FROM exercise_to_health";
$result4 = mysqli_query($con,$sql4);

while($array4 = mysqli_fetch_array($result4)){
	
echo "health_count is: ".$array4[0]."<br>";

	
$y_he=$array4[0]*$he["m"]+$he["b"];
	
echo "old_y is: ".$array4[1]."<br>";
echo "new_y is: ".$y_he."<br>";
echo "he_index is:".$he_index."<br>";
	//,x_hf,y_hf,hf_index,x_ef,y_ef,ef_index

	
$sql = "INSERT INTO correlation_he(x_he,y_he, he_index) VALUES (".$array4[0].",".$y_he.",".$he_index.")";
mysqli_query($con,$sql);    
}

//health & fruit
$sql_delete = "DELETE FROM correlation_hf";
mysqli_query($con,$sql_delete);

$hf_index = stats_stat_correlation($health_array, $fruit_array);

 
$hf = array();
$hf = linear_regression($health_array, $fruit_array); 
echo "m is: ".$hf["m"]."<br>";
echo "b is: ".$hf["b"]."<br>";


$sql5= "SELECT health_count,fruit_count FROM exercise_to_health";
$result5 = mysqli_query($con,$sql5);

while($array5 = mysqli_fetch_array($result5)){
	
echo "health_count is: ".$array5[0]."<br>";

	
$y_hf=$array5[0]*$hf["m"]+$hf["b"];
	
echo "old_y is: ".$array5[1]."<br>";
echo "new_y is: ".$y_hf."<br>";
echo "hf_index is:".$hf_index."<br>";
	//,x_hf,y_hf,hf_index,x_ef,y_ef,ef_index

	
$sql = "INSERT INTO correlation_hf(x_hf,y_hf, hf_index) VALUES (".$array5[0].",".$y_hf.",".$hf_index.")";
mysqli_query($con,$sql);    
}

//exercise & fruit
$sql_delete = "DELETE FROM correlation_ef";
mysqli_query($con,$sql_delete);

$ef_index = stats_stat_correlation($exercise_array, $fruit_array);

 
$ef = array();
$ef = linear_regression($exercise_array, $fruit_array); 
echo "m is: ".$ef["m"]."<br>";
echo "b is: ".$ef["b"]."<br>";


$sql6= "SELECT exercise_count,fruit_count FROM exercise_to_health";
$result6 = mysqli_query($con,$sql6);

while($array6 = mysqli_fetch_array($result6)){
	
echo "exersie_count is: ".$array6[0]."<br>";

	
$y_ef=$array6[0]*$ef["m"]+$hf["b"];
	
echo "old_y is: ".$array6[1]."<br>";
echo "new_y is: ".$y_ef."<br>";
echo "ef_index is:".$ef_index."<br>";
	//,x_hf,y_hf,hf_index,x_ef,y_ef,ef_index

	
$sql = "INSERT INTO correlation_ef(x_ef,y_ef, ef_index) VALUES (".$array6[0].",".$y_ef.",".$ef_index.")";
mysqli_query($con,$sql);    
}




 
mysqli_close($con);


?>
