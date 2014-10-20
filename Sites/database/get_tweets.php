<?php
/**
* get_tweets.php
* Collect tweets from the Twitter streaming API
* This must be run as a continuous background process
 *  *   // written by: Gradeigh Clark and Xianyi Gao
  // tested by: Gradeigh Clark and Xianyi Gao
  // debugged by: Gradeigh Clark and Xianyi Gao
*/
require_once('140dev_config.php');
require_once('phirehose/Phirehose.php');
require_once('phirehose/OauthPhirehose.php');

class Consumer extends OauthPhirehose
{
  // A database connection is established at launch and kept open permanently
  public $oDB;
  public function db_connect() {
    require_once('db_lib.php');
    $this->oDB = new db;
  }
	
  // This function is called automatically by the Phirehose class
  // when a new tweet is received with the JSON data in $status
  public function enqueueStatus($status) {
    $display = json_decode($status,true);
    print_r($display);

    $tweet_object = json_decode($status);
    $tweet_id = $tweet_object->id_str;

    // If there's a ", ', :, or ; in object elements, serialize() gets corrupted 
    // You should also use base64_encode() before saving this
    $raw_tweet = base64_encode(serialize($tweet_object));
		
    $field_values = 'raw_tweet = "' . $raw_tweet . '", ' .
      'tweet_id = ' . $tweet_id;
    $this->oDB->insert('json_cache',$field_values);
  }
}

// Open a persistent connection to the Twitter streaming API
$stream = new Consumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);



// Establish a MySQL database connection
$stream->db_connect();

  // $stream->setLocations(array(
   //      array(-122.75, 36.8, -121.75, 37.8), // San Francisco
   //      array(-74, 40, -73, 41),             // New York
    // ));

// The keywords for tweet collection are entered here as an array
// More keywords can be added as array elements
// For example: array('recipe','food','cook','restaurant','great meal')
$stream->setTrack(array(

'running min', 'running mins', 'running minutes', 'running hour', 'running hours', 
'cycling min', 'cycling mins', 'cycling minutes', 'cycling hour', 'cycling hours',
'swimming min', 'swimming mins', 'swimming minutes', 'swimming hour', 'swimming hours',
'basketball min', 'basketball mins', 'basketball minutes', 'basketball hour', 'basketball hours',
'volleyball min', 'volleyball mins', 'volleyball minutes', 'volleyball hour', 'volleyball hours',
'tennis min', 'tennis mins', 'tennis minutes', 'tennis hour', 'tennis hours',
'football min', 'football mins', 'football minutes', 'football hour', 'football hours',

'exercise min', 'exercise mins', 'exercise minutes', 'exercise hour', 'exercise hours',
'exercises min','exercises mins', 'exercises minutes', 'exercises hour', 'exercises hours',
'exercising min','exercising mins', 'exercising minutes', 'exercising hour', 'exercising hours',

'keepfit', 'fitness', 'keep in shape', 'bodybuilding', 'keep healthy', 'loose weight', 'loosing weight',

'health apple', 'healthy apple', 'fitness apple', 'exercising apple', 'loose weight apple',
'health banana','healthy banana', 'fitness banana', 'exercising banana', 'loose weight banana', 
'health lemon','healthy lemon', 'fitness lemon', 'exercising lemon', 'loose weight lemon',
'health orange','healthy orange', 'fitness orange', 'exercising orange', 'loose weight orange',
'health pear','healthy pear', 'fitness pear', 'exercising pear', 'loose weight pear',
'health milk','healthy milk', 'fitness milk', 'exercising milk', 'loose weight milk',
'health meat','healthy meat', 'fitness meat', 'exercising meat', 'loose weight meat',
'health vegetable','healthy vegetable', 'fitness vegetable', 'exercising vegetale', 'loose weight vegetale',

'healthcare', 'health life',
));



// Start collecting tweets
// Automatically call enqueueStatus($status) with each tweet's JSON data
$stream->consume();

?>