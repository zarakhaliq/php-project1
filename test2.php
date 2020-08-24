<?php

$x = $_POST['x'];
$y = $_POST['y']; 

$ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL,'https://api.opencagedata.com/geocode/v1/json?q='.$x.','.$y.'&pretty=1&key=f633db6e5a2842dd96bf3b1b66a53a23');

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      
        $output = curl_exec($ch);
       
        $yummy = json_decode($output);

        $city=$yummy->results[0]->components->city;

        if($output!==0){
    
       curl_setopt($ch, CURLOPT_URL, 'https://restcountries.eu/rest/v2/capital/'.$city);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        }
        // close curl resource to free up system resources
        //curl_close($ch);     

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

        
        


// set url



?>