
<?php
	// print "<b>Welcome to my home page <br> <br>";
	// print "Today is:</b> ";
	// print date("l, F jS");
	// print "<br>";
	
	// $txt1="Learn PHP";
	// $txt2="W3School.com.cn";
	// $cars=array("Volvo","BMW","SAAB");
	
	// print "Some apples are red <br> No kumquats are <br>";
	// echo $txt1;
	// echo "<br>";
	// echo "<br>";
	// echo "<br>";
	// echo "Study PHP at {$txt2} <br>";
	// echo "My car is a {$cars[0]}";
function splitter($str) {
// Create the empty word frequency array
 $freq = array();
// Split the parameter string into words
 $words = preg_split("/[ \.,;:!\?]\s*/", $str);
// Loop to count the words (either increment or initialize to 1)
 foreach ($words as $word) {
		$keys = array_keys($freq);
		if(in_array($word, $keys))
			$freq[$word]++;
		else
			$freq[$word] = 1;
			print_r($freq);
		}
	return $freq;
} #** End of splitter
// Main test driver
 $str = "apples are good for you, or don't you like apples?
 or maybe you like oranges better than apples";
// Call splitter
 $tbl = splitter($str);
// Display the words and their frequencies
	print "\n Word Frequency \n\n";
	$sorted_keys = array_keys($tbl);
	sort($sorted_keys);
	foreach ($sorted_keys as $word)
 		print "$word $tbl[$word] \n";

?>


	