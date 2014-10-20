<?php
/**
 * Using the API from third party to update gender, age and type in the user table.
 */

$con = mysqli_connect("localhost", "root", "wearethebest", "hma2014");
$query = 'SELECT screen_name, name, description FROM users';

if ($result = mysqli_query($con, $query)) {
    //fetch associative array
    while ($row = mysqli_fetch_array($result)) {
        $screen_name = $row['screen_name'];
		$name = $row['name'];
		$description = $row['description'];
		
		$gender = getGender($screen_name, $name, $description);
		$age = getAge($screen_name, $name, $description);
		$type = getTp($screen_name, $name, $description);
		
		mysqli_query($con, "UPDATE users SET gender='".$gender."', age='".$age."', type='".$type."' 
		WHERE screen_name='".$screen_name."'");
		
    }
	
	echo "All Done!";
	
    //free result set
    $result->free();
	mysqli_close($con);
}



function getGender($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);

	$gd = '';
	if(isset($json['gender'])) {
	  //$info .= 'Gender: ';
	  if($json['gender'] == 'M')
		$gd = 'MALE';
	  else if($json['gender'] == 'F')
		$gd = 'FEMALE';
	}
	
	return $gd;

}



function getAge($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);

	$ag = '';
	if(isset($json['age'])) {
	  $ag = $json['age'];
	}
	
	return $ag;
}


function getTp($user, $name, $description) {
	$api = 'http://textalytics.com/core/userdemographics-1.0';
	$key = '0e70ff2a84eab3fda9019ab2202cd91e';
	
	// We make the request and parse the response to an array
	$response = sendPost($api, $key, $user, $name, $description);
	$json = json_decode($response, true);
	
	$tp = '';
	if(isset($json['type'])) {
	  if($json['type'] == 'P')
		$tp = 'PERSON';
	  else if($json['type'] == 'O')
		$tp = 'ORGANIZATION';
	}
	
	return $tp;
}


// Auxiliary function to make a post request 
function sendPost($api, $key, $user, $name, $description) {
  $data = http_build_query(array('key'=>$key,
                                 'user'=>$user,
                                 'name'=>$name,
                                 'desc'=>$description,
                                 'src'=>'sdk-php-1.0')); // management internal parameter
  $context = stream_context_create(array('http'=>array(
        'method'=>'POST',
        'header'=>
          'Content-type: application/x-www-form-urlencoded'."\r\n".
          'Content-Length: '.strlen($data)."\r\n",
        'content'=>$data)));
  
  $fd = fopen($api, 'r', false, $context);
  $response = stream_get_contents($fd);
  fclose($fd);
  return $response;
} // sendPost


?>
