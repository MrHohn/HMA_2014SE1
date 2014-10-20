<?php
// Prevent caching.
header('Cache-Control: no-cache, must-revalidate');

// The JSON standard MIME header.
header('Content-type: application/json');

// Create connection                                                                                             
$con=mysqli_connect("localhost","root","wearethebest","hma2014");

// Check connection                                                                                              
if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// This SQL statement selects ALL from the table 'Locations'                                                     
$sql = "SELECT * FROM leaderboard_overall";

// Check if there are results                                                                                    
if ($result = mysqli_query($con, $sql))
    {
        // If so, then create a results array and a temporary one                                                
        // to hold the data                                                                                      
        $resultArray = array();
        $tempArray = array();
        // Loop through each row in the result set                                                               
        while($row = $result->fetch_object())
            {
                // Add each row into our results array                                                           
                $tempArray = $row;
                array_push($resultArray, $tempArray);
            }

        // Finally, encode the array to JSON and output the results                                              
        // print_r($resultArray);                                                                                
        echo json_encode($resultArray);
    }

// Close connections                                                                                             
@mysqli_close($result);
@mysqli_close($con);
?>