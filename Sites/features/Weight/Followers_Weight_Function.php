<?php

 function Weight_follower($fol_num){
 	 
    if ($fol_num < 100){
    	$weight = 1;
    }else if($fol_num < 1000){
    	$weight = 2;
    }else if($fol_num < 2000){
    	$weight = 3;
    }else if($fol_num < 10000){
    	$weight = 4;
    }else {$weight = 5; }

    return $weight;
    
 }  
 
 ?>
