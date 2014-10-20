<?php
// $who=$_GET['who'];
// if($who==1) 
//     $id=$_GET['id'];
// else 
//     $id=$_POST['id'];

// $user_name=$_POST['user_name'];

@$id = $_GET['id'];
// $id = 1;
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');

$con=mysqli_connect("127.0.0.1","root","wearethebest","hma2014");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

switch($id){

case 0:
    $sql = "SELECT * FROM ei_area_overall";break;
case 1:
    $sql = "SELECT * FROM ei_type_overall";break;
case 2:
    $sql = "SELECT * FROM ei_time_type";break;
case 3:
    // $sql = "SELECT screen_name, tweet_text, geo_lat, geo_long, profile_image_url FROM tweets WHERE geo_lat != 0.00000 AND geo_long != 0.00000 ORDER BY tweet_id DESC LIMIT 200";break;
    $sql = "SELECT screen_name, geo_lat, geo_long, profile_image_url FROM tweets WHERE geo_lat != 0.00000 AND geo_long != 0.00000 ORDER BY tweet_id DESC LIMIT 200";break;
case 4:
    $sql = "SELECT * FROM ei_time_overall";break;
case 5:
    $sql = "SELECT * FROM leaderboard_overall";break;
case 6:
    include('twitteroauth/twitteroauth.php');
    define('API_KEY', 'N52DOuXGSqJvPDAhqclJtlAli');
    define('API_SECRET', 'VoReVCHdfx5Nmfzdf5GJQe9F8Sa5d7MAiZIQNc0MGd8gxnUc8l');
    define('ACCESSTOKEN', '2796206664-VgDlTzBQYMhcCuO4zFBlS5HNsfEEwCwmBOKLzvN');
    define('ACCESSTOKEN_SECRET', 'yxD1zKrZSnFjpO0pEtxczKIeBPRrGQCbrkNkVgpIMIWNk');
    $twitter = new TwitterOAuth(API_KEY, API_SECRET, ACCESSTOKEN, ACCESSTOKEN_SECRET);
    $keyword = "running OR cycling OR swimming OR basketball OR volleyball OR tennis OR football OR exercise OR gym OR fitness";
    $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=from%3A'.$user_name.'%20'.$keyword.'&result_type=recent&count=200');
    $sql = "delete from user_profiles where user_name = '".$user_name."'";
    mysqli_query($con,$sql);
    foreach($tweets as $v1){
        foreach($v1 as $v2){
            if($v2->text){
            $sql = "INSERT INTO user_profiles(user_name,tweet_text,created_at,profile_image_url) VALUES ('".$user_name."','".$v2->text."','".$v2->created_at."','".$v2->user->profile_image_url."')";
            mysqli_query($con,$sql);
            }
        }
    }
    $sql = "SELECT * FROM user_profiles where user_name = '".$user_name."'";
    break;
case 7:
    $sql = "SELECT * FROM ei_area_time";break;
case 8:
    $sql = "SELECT * FROM ei_area_type";break;
case 9:
    $sql = "SELECT * FROM lb_area";break;
case 10:
    $sql = "SELECT * FROM lb_type";break;
case 11:
    $sql = "SELECT * FROM etime_state_mean";break;
case 12:
    $sql = "SELECT * FROM etime_type_mean";break;
}

if ($result = mysqli_query($con, $sql)){
    $resultArray = array();
    $tempArray = array();
    
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    echo json_encode($resultArray);
}

@mysqli_close($result);
@mysqli_close($con);

?>