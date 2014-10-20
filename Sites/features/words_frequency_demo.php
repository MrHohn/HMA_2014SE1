<?php
$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$sql="SELECT tweet_text from tweets limit 0, 2000";
$result= mysqli_query($con,$sql);
//print_r ($result);
while($array = mysqli_fetch_array($result)){
//for($i=0;$i<count($array);$i++){
$a[]=$array['tweet_text'];
//print_r ($str[$i]);
//echo '<br>';
}

//}
//print_r ($a);
//echo '<br>';
$str1=implode("",$a);
$str=preg_replace('|[0-9\x80-\xff~!@$%^&*()_+"/]+|','',$str1);

//echo $str;
//$str="'".implode("','", $a )."'";
//echo $str;
//echo '<br>';*/
//$arr = array('Medical Director - TeamHealth: (#VALLEJO, CA) http://t.co/HUxkGuqQRm #Healthcare #Job #Jobs #TweetMyJobs'
       // ,'#fitness Fitness Camp Starter Kit: Run successful fitness bootcamps without competing on price or worrying about... http://t.co/WsxD1xUdD8'
        //,'When To Use Compression - #yeg #fitness http://t.co/3H1nqSoUEV'
        //,"Today's hit Fitness YouTube Video in Canada.¡¸My Fitness Music¡¹'s ¡ºRhythm Is a Dancer¡» http://t.co/LTY0NCsUcH");
//$str=implode(" ",$arr);
//echo$str;

function splitter($str) {
// Create the empty word frequency array
  $freq = array();
// Split the parameter string into words
  $words = preg_split("/[ \.,;:!\?]\s*/", $str);
  //print_r($words);
// Loop to count the words (either increment or initialize to 1)
  foreach ($words as $word) {
    $keys = array_keys($freq);
    if(in_array($word, $keys))
      $freq[$word]++;
    else
      $freq[$word] = 1;
  }
  return $freq;
} #** End of splitter
// Main test driver
  //$str = "apples are good for you, or don't you like apples?
      //    or maybe you like oranges better than apples";
// Call splitter
  $tbl = splitter($str);
// Display the words and their frequencies
  print "<br /> Word Frequency <br /><br />";
  $sorted_keys = array_keys($tbl);
  rsort($sorted_keys);
foreach ($sorted_keys as $word)
    print "$word $tbl[$word] <br />";
//}


?>