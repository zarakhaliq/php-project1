<?php



$x = $_POST['x'];
$y = $_POST['y']; 



$url1= 'http://api.openweathermap.org/data/2.5/weather?lat='.$x.'&lon='.$y.'&appid=c5e47bda76961d3cbe80edc453c83858';
$url2='http://api.geonames.org/findNearbyWikipediaJSON?lat='.$x.'&lng='.$y.'&username=zarakhaliq';

$nodes = array($url1,$url2);
$node_count = count($nodes);

$curl_arr = array();
$master = curl_multi_init();

for($i = 0; $i < $node_count; $i++)
{
    $url =$nodes[$i];
    $curl_arr[$i] = curl_init($url);
    curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
    curl_multi_add_handle($master, $curl_arr[$i]);
}

do {
    curl_multi_exec($master,$running);
} while($running > 0);


for($i = 0; $i < $node_count; $i++)
{
    $results[] = curl_multi_getcontent  ( $curl_arr[$i]  );
}





header('Content-Type: application/json; charset=UTF-8');
echo json_encode($results, JSON_UNESCAPED_UNICODE);
//print_r($results[0]);
///////////////////////getting city from geolocate.php:



   


?>